<?php

use App\Http\Controllers\AdminController;
use App\Livewire\Admin\Booking\CancelTable;
use App\Livewire\Admin\Booking\ConfirmationTable;
use App\Livewire\Admin\Booking\EndTable;
use App\Livewire\Admin\Booking\ProcessTable;
use App\Livewire\Admin\Category\CategoryEdit;
use App\Livewire\Admin\Member\MemberEdit;
use App\Livewire\Admin\Product\ProductEdit;
use App\Livewire\Admin\Service\ServiceEdit;
use App\Livewire\Admin\Transaction\TransactionHistory;
use App\Livewire\Admin\Transaction\TransactionPrint;
use App\Livewire\Admin\Transaction\TransactionTabel;
use App\Livewire\Admin\User\UserEdit;
use App\Livewire\Users\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/home', [AdminController::class, 'dashboard'])->name('home1');

    Route::get('/admin/User', [AdminController::class, 'user'])->name('user.index');
    Route::get('/admin/User/{id}/edit', UserEdit::class)->name('user.edit');

    Route::get('/admin/booking-komfirmasi', ConfirmationTable::class)->name('booking.confirmation');
    Route::get('/admin/booking-sedang-pengerjaan', ProcessTable::class)->name('booking.process');
    Route::get('/admin/booking-Selesai', EndTable::class)->name('booking.end');
    Route::get('/admin/booking-dibatalkan', CancelTable::class)->name('booking.cancel');

    Route::get('/admin/report-pelanggan', [AdminController::class, 'ReportMember'])->name('member.report');
    Route::get('/admin/pelanggan', [AdminController::class, 'member'])->name('member.index');
    Route::get('/admin/pelanggan/{id}/edit', MemberEdit::class)->name('member.edit');
    Route::get('/admin/report-pelanggan', [AdminController::class, 'ReportMember'])->name('member.report');
    Route::get('/member/report/pdf', [AdminController::class, 'exportPdf'])->name('member.report.pdf');

    Route::get('/admin/category', [AdminController::class, 'category'])->name('category.index');
    Route::get('/admin/category/{id}/edit', CategoryEdit::class)->name('category.edit');

    Route::get('/admin/product', [AdminController::class, 'product'])->name('product.index');
    Route::get('/admin/product/{id}/edit', ProductEdit::class)->name('product.edit');

    Route::get('/admin/service', [AdminController::class, 'service'])->name('service.index');
    Route::get('/admin/service/{id}/edit', ServiceEdit::class)->name('service.edit');

    Route::get('/admin/transaction', [AdminController::class, 'transaction'])->name('transaction.index');
    Route::get('/admin/transaction-print/{id}', [AdminController::class, 'print'])->name('transaction.print');
    Route::get('/admin/transaction-history', [TransactionHistory::class, 'render'])->name('transaction.history');
    Route::get('/admin/transaction-detail/{id}', [AdminController::class, 'detail'])->name('item.detail');
    Route::get('/admin/report-transaction', [AdminController::class, 'ReportTransaction'])->name('transactions.report');
    Route::get('/transaction/report/pdf', [AdminController::class, 'exportPdfTransaction'])->name('transaction.report.pdf');
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', Booking::class)->name('booking');
