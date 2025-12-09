<?php

namespace App\Livewire\Admin\Member;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class MemberTable extends Component
{
    use WithPagination;

    public $member;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 saat search berubah
    }

    public function mount()
    {
        $this->member = Member::latest()->get();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-alert', id: $id);
    }

    public function delete($id)
    {
        $member = Member::find($id);
        if ($member) {
            $member->delete();
            $this->member = Member::latest()->get();
            $this->dispatch('deleted');
        }
    }
    public function render()
    {
        return view('livewire.admin.member.member-table', [
            'members' => Member::where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
