<?php

namespace App\Http\Livewire\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

use App\Models\User;



class ListUsers extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;


    public $state =[];

    public function openAddUserModal()
    {
       $this->dispatchBrowserEvent('openAddUserModal');
    }



    public function createUser()
    {
        


      $data = $this->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
      ]);

      User::create($data);
      $this->dispatchBrowserEvent('closeAddUserModal',['message'=>'User added successfully']);

      /* session()->flash('message', 'Comment added successfully 😁'); */
    }




    public function render()
    {
        $users = User::latest()->paginate();

        return view('livewire.admin.user.list-users',[
          'users' => $users,
        ]);
    }
}
