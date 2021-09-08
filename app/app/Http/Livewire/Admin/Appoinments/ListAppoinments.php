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

	public $selectedRows = [];
	public $selectPageRows = false;





    /* This is Livewire default updated hook */
	public function updatedSelectPageRows($value)
	{
		if ($value) {
			$this->selectedRows = $this->appointments->pluck('id')->map(function ($id) {
				return (string) $id;
			});
		} else {
			$this->reset(['selectedRows', 'selectPageRows']);
		}
	}
   /* This is Livewire default get Attribute hook */
	public function getAppointmentsProperty()
	{
        return Appoinment::with('client') 
        ->when($this->status, function($query,$status){
            return $query->where('status', $status);
        })
        ->latest()
        ->paginate(2);
	}

    public function deleteSelectedRows()
	{
		Appoinment::whereIn('id', $this->selectedRows)->delete();

		$this->dispatchBrowserEvent('SuccessAlert', ['message' => 'All selected appointment got deleted.']);

		$this->reset(['selectPageRows', 'selectedRows']);
	}
    public function markAllAsScheduled()
	{
		Appoinment::whereIn('id', $this->selectedRows)->update(['status' => 'SCHEDULED']);

		$this->dispatchBrowserEvent('SuccessAlert', ['message' => 'Appointments marked as scheduled']);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

	public function markAllAsClosed()
	{
		Appoinment::whereIn('id', $this->selectedRows)->update(['status' => 'CLOSED']);

		$this->dispatchBrowserEvent('alertSuccess', ['message' => 'Appointments marked as closed.']);

		$this->reset(['selectPageRows', 'selectedRows']);
	}












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
        $appoinments = $this->appointments;//Here $this->appointments indicate getAppointmentsProperty().

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
