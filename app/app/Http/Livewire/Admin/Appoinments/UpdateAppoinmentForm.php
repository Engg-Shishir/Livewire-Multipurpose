<?php

namespace App\Http\Livewire\Admin\Appoinments;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\Client;
use App\Models\Appoinment;

class UpdateAppoinmentForm extends Component
{
    public $state = [];
    public $appoinment;

    // This pass appoinment come form route paraneter
    public function mount(Appoinment $PassAppoinment)
    {
         $this->state = $PassAppoinment->toArray();
         $this->appoinment = $PassAppoinment;
    }

    public function updateAppointment()
	{
        //dd('here');
        Validator::make($this->state,[
				'client_id' => 'required',
				'date' => 'required',
				'time' => 'required',
				'note' => 'nullable',
				'status' => 'required|in:SCHEDULED,CLOSED',],
			['client_id.required' => 'The client field is required.'])->validate();
        
		$this->appoinment->update($this->state);

		$this->dispatchBrowserEvent('SuccessAlert', ['message' => 'Appointment Updated successfully!']);
	}


    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appoinments.update-appoinment-form',[
            'clients'=> $clients,
        ]);
    }


}
