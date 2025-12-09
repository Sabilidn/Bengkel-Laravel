<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $user;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 saat search berubah
    }

    public function mount()
    {
        $this->user = User::latest()->get();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-alert', id: $id);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->user = User::latest()->get();
            $this->dispatch('deleted');
        }
    }
    public function render()
    {
        return view('livewire.admin.user.user-table', [
            'users' => User::where('isAdmin', 1)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
