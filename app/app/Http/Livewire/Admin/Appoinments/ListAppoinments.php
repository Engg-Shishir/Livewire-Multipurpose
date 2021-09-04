<?php

namespace App\Http\Livewire\Admin\Appoinments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appoinment;

class ListAppoinments extends AdminComponent
{
    
    protected $listeners = ['appoinmentDeleteConfirmed'=>'appoinmentDelete'];
    public $appoinmentIdRemoval = null;

   
    public function confirmAppoinmentRemoval($id)
    {
      # code...
      //dd($id);
      $this->appoinmentIdRemoval = $id;
       $this->dispatchBrowserEvent('showDeleteAppoinmentConfirmation');
    }

    public function appoinmentDelete()
    {
        # code...
        $user = Appoinment::findOrFail($this->appoinmentIdRemoval);
        $user->delete();
        $this->dispatchBrowserEvent('alertSuccess',['message'=>'Appoinment Deleted successfully']);
    }


    public function render()
    {
        $appoinments = Appoinment::with('client')
            ->latest()
            ->paginate();
            
        return view('livewire.admin.appoinments.list-appoinments',[
            'appoinments'=> $appoinments,
        ]);
    }
}
