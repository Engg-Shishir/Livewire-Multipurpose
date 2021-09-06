<?php

namespace App\Http\Livewire\Admin\Appoinments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appoinment;

class ListAppoinments extends AdminComponent
{
    
    protected $listeners = ['appoinmentDeleteConfirmed'=>'appoinmentDelete'];
    public $appoinmentIdRemoval = null;
    
    public $status = null;
    protected $queryString = ['status'];
   
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

    public function filterAppoinmentsByStatus($status = null)
    {
        $this->resetPage();
       $this->status = $status;
    }


    public function render()
    {
        $appoinments = Appoinment::with('client') 
            ->when($this->status, function($query,$status){
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(2);

        $appoinmentsCount = Appoinment::count();
        $scheduledAppoinmentsCount = Appoinment::where('status','scheduled')->count();
        $closedAppoinmentsCount = Appoinment::where('status','closed')->count();


        return view('livewire.admin.appoinments.list-appoinments',[
            'appoinments'=> $appoinments,
            'appoinmentsCount'=> $appoinmentsCount,
            'scheduledAppoinmentsCount'=>$scheduledAppoinmentsCount,
            'closedAppoinmentsCount'=> $closedAppoinmentsCount,
        ]);
    }
}
