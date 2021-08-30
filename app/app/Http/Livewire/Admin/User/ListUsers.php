<?php

namespace App\Http\Livewire\Admin\User;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\withPagination;



class ListUsers extends Component
{
    // This stop pagination browser refresh 
    use withPagination;
    // By default , Livewire pagination use Tailwind css Theme.But here we use bootstrap Theme.
    //If you want to use Tailwind CSS Theme bydefault uou dont need this line of code  
    protected $paginationTheme = 'bootstrap';


    public $showEditModal = false;
    public $state =[];
    public $user;
    public $userId;

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
      $this->state = [];
      $this->dispatchBrowserEvent('closeAddUserModal',['message'=>'User added successfully']);

      /* session()->flash('message', 'Comment added successfully 😁'); */
    }

   public function userEdit( User $user)
   {
     # code...
     $this->showEditModal = true;
     $this->user = $user;
     $this->state = $user->toArray();
    /*  dd($user->toArray()); */
     $this->dispatchBrowserEvent('openAddUserModal');
     
   }
 
   public function userDelete($id)
   {
     # code...
     $this->userId = $id;
      $this->dispatchBrowserEvent('showDeleteUserModal');
   }
   public function confirmUserDelete()
   {
     # code...
     $user = User::findOrFail($this->userId);
     $user->delete();
     $this->dispatchBrowserEvent('showDeleteUserModal');
     $this->dispatchBrowserEvent('hideDeleteUserModal',['message'=>'User Deleted successfully']);
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
        $users = User::latest()->paginate(5);

        return view('livewire.admin.user.list-users',[
          'users' => $users,
        ]);
    }
}
