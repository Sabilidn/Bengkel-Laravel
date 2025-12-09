<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $member = Member::count();
        $category = Category::count();
        $product = Product::count();
        $transaction = Transaction::count();

        // Ambil total income per bulan untuk tahun ini
        $monthlyIncome = TransactionDetail::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Format array agar semua bulan tetap ada
        $monthlyIncomeFormatted = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyIncomeFormatted[] = $monthlyIncome->get($i, 0);
        }

        // Tambahan untuk footer
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $thisMonth = TransactionDetail::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total');

        $thisYear = TransactionDetail::whereYear('created_at', $currentYear)
            ->sum('total');

        $previousYear = TransactionDetail::whereYear('created_at', $currentYear - 1)
            ->sum('total');

        $percentGrowth = $previousYear > 0 ? (($thisYear - $previousYear) / $previousYear) * 100 : 100;

        return view('livewire.admin.dashboard', compact(
            'member',
            'category',
            'product',
            'transaction',
            'monthlyIncomeFormatted',
            'thisMonth',
            'thisYear',
            'previousYear',
            'percentGrowth'
        ));
    }
    public function user()
    {
        return view('livewire.admin.user.index');
    }
    public function category()
    {
        return view('livewire.admin.category.index');
    }
    public function product()
    {
        return view('livewire.admin.product.index');
    }
    public function member()
    {
        return view('livewire.admin.member.index');
    }
    public function service()
    {
        return view('livewire.admin.service.index');
    }
    public function transaction()
    {
        return view('livewire.admin.transaction.index');
    }

    public function print($id)
    {
        $transaction = Transaction::with(['member', 'user'])->findOrFail($id);

        // Ambil detail transaksi
        $details = TransactionDetail::where('transaction_id', $id)->get();

        // Hitung total berdasarkan jenis
        $total_sparepart = $details->where('jenis', 'Produk')->sum('total');
        $total_jasa = $details->where('jenis', 'Service')->sum('total');

        // Grand total
        $total = $total_sparepart + $total_jasa;

        return view('livewire.admin.transaction.transaction-print', compact(
            'transaction',
            'details',
            'total_sparepart',
            'total_jasa',
            'total'
        ));
    }

    public function detail($id)
    {
        $details = TransactionDetail::where('transaction_id', $id)->get();
        return view('livewire.admin.transaction.transaction-detail', compact('details'));
    }

    public function ReportMember()
    {
        $members = Member::paginate(10);
        return view('livewire.admin.member.report', compact('members'));
    }

    public function exportPdf()
    {
        $members = Member::all();
        $pdf = Pdf::loadView('livewire.admin.member.member-pdf', compact('members'));
        return $pdf->stream('data-member.pdf');
    }

    public function ReportTransaction(Request $request)
    {
        // Ambil transaksi dengan relasi
        $query = Transaction::with(['user', 'member', 'details']);

        // Filter berdasarkan tanggal jika tersedia
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Ambil semua data transaksi yang difilter (tanpa pagination untuk total)
        $transactionsAll = $query->get();

        // Hitung total dari semua transaksi yang sudah difilter (bukan semua transaksi di DB)
        $total_semua = $transactionsAll->flatMap->details->sum('total');

        // Setelah itu, paginasi untuk ditampilkan di tabel
        $transactions = $query->paginate(10);

        return view('livewire.admin.transaction.report', compact('transactions', 'total_semua'));
    }

    public function exportPdfTransaction(Request $request)
    {
        $query = Transaction::with('details', 'member', 'user');

        // Filter berdasarkan tanggal jika tersedia
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $transaction = $query->get();

        // Hitung total hanya untuk data yang difilter
        $total_semua = $transaction->flatMap->details->sum('total');

        $pdf = Pdf::loadView('livewire.admin.transaction.transaction-pdf', compact('transaction', 'total_semua'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-transaksi.pdf');
    }
}
