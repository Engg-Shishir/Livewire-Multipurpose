<?php

namespace App\Http\Livewire\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

use App\Models\User;



class ListUsers extends Component
{
    public $showEditModal = false;
    public $state =[];
    public $user;

    public function openAddUserModal()
    {
      $this->showEditModal = false;
       $this->dispatchBrowserEvent('openAddUserModal');
    }



    public function createUser()
    {
      $validatedData = Validator::make($this->state,[
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
      ])->validate();

       $validatedData['password'] = bcrypt( $validatedData['password']);


      User::create($validatedData);
      $this->dispatchBrowserEvent('closeAddUserModal',['message'=>'User added successfully']);

      /* session()->flash('message', 'Comment added successfully 😁'); */
    }

   public function edit( User $user)
   {
     # code...
     $this->showEditModal = true;
     $this->user = $user;
     $this->state = $user->toArray();
    /*  dd($user->toArray()); */
     $this->dispatchBrowserEvent('openAddUserModal');
     
   }

   public function UpdateUser(){

    $validatedData = Validator::make($this->state,[
      'name' => 'required',
      'email' => 'required|email|unique:users,email,'.$this->user->id,
      'password' => 'sometimes|confirmed'
    ])->validate();
       
    if(!empty($validatedData['password'])){
      $validatedData['password'] = bcrypt( $validatedData['password']);
    }

    # This Code also give same result

    /*if(!$validatedData['password']=''){
      $validatedData['password'] = bcrypt( $validatedData['password']);
    }*/

      $this->user->update($validatedData);
      $this->dispatchBrowserEvent('closeAddUserModal',['message'=>'User Updated successfully']);
   }


    public function render()
    {
        $users = User::latest()->paginate();

        return view('livewire.admin.user.list-users',[
          'users' => $users,
        ]);
    }
}
