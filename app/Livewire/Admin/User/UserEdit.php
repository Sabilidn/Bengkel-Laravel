<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserEdit extends Component
{
     public $userId;
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email,{{userId}}',
        'password' => 'nullable|string|min:6', // opsional diubah jika perlu
    ];

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        toastr()->success( 'Data admin berhasil diperbarui.');
        return redirect()->route('user.index');
    }
    public function render()
    {
        return view('livewire.admin.user.user-edit');
    }
}
