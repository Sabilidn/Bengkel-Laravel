<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ];

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'isAdmin' => 1, // tambahkan flag admin
        ]);

        toastr()->success('Admin berhasil ditambahkan.');
        $this->reset(['name', 'email', 'password']); // reset form jika perlu
        return redirect()->route('user.index');
    }
    public function render()
    {
        return view('livewire.admin.user.user-create');
    }
}
