<?php

namespace App\Livewire\Admin\Member;

use App\Models\Member;
use Livewire\Component;

class MemberEdit extends Component
{
    public $memberId, $nama, $nomor_handphone;

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:100|unique:members,nama,' . $this->memberId,
            'nomor_handphone' => 'required|max:15',
        ];
    }

    public function mount($id)
    {
        $member = Member::find($id);
        $this->memberId = $member->id;
        $this->nama = $member->nama;
        $this->nomor_handphone = $member->nomor_handphone;
    }

    public function update()
    {
        $this->validate();
        $member = Member::find($this->memberId);
        $member->update([
            'nama' => $this->nama,
            'nomor_handphone' => $this->nomor_handphone,
        ]);
        if (!$member) {
            toastr()->error('Data Tidak Valid');
            return redirect()->route('member.index');
        }
        toastr()->success('Berhasil Update Data');
        return redirect()->route('member.index');
    }
    public function render()
    {
        return view('livewire.admin.member.member-edit');
    }
}
