<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class Profile extends Component
{
    public $name, $email, $phone, $point_id, $role, $selectedId;

    public $oldPassword, $newPassword, $confirmNewPassword, $confirm;
    public function mount()
    {
        $user = Auth::user();
        $this->selectedId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->point_id = $user->point_id;
        $this->role = $user->roles[0]->name ?? '';
    }
    public function render()
    {
        return view('livewire.profile', ['cities'=>\App\Models\City::with(['points'])->get()]);
    }

    public function save()
    {
        $user = \App\Models\User::find($this->selectedId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->point_id = $this->point_id;
        $user->save();
        session()->flash('message', $this->name.' disimpan.');
    }

    public function updatedConfirmNewPassword()
    {
        if ($this->newPassword != $this->confirmNewPassword)
        {
            $this->confirm = 'Pasword baru berbeda';
        }else{
            $this->confirm = '';
        }
    }

    public function changePassword()
    {
        if (Hash::check($this->oldPassword, Auth::user()->getAuthPassword()))
        {
            \App\Models\User::where('id',$this->selectedId)->update(['password'=>bcrypt($this->newPassword)]);
            session()->flash('message', 'Password diperbarui');
        }else{
            session()->flash('message', 'Password lama salah!');
        }
    }
}
