<?php

namespace App\Http\Livewire\Admin\Appoinments;

use App\Models\Client;
use Livewire\Component;
use App\Models\Appoinment;
use Illuminate\Support\Facades\Validator;


class CreateAppoinmentForm extends Component
{
    public $state = ['status' => 'SCHEDULED'];
	public function createAppointment()
	{
        //dd($this->state);
        Validator::make($this->state,[
				'client_id' => 'required',
				'date' => 'required',
				'time' => 'required',
				'note' => 'nullable',
				'status' => 'required|in:SCHEDULED,CLOSED',],
			['client_id.required' => 'The client field is required.'])->validate();
        
		Appoinment::create($this->state);

		$this->dispatchBrowserEvent('createAppoinment', ['message' => 'Appointment created successfully!']);
	}

    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appoinments.create-appoinment-form', [
        	'clients' => $clients,
        ]);
    }
}
