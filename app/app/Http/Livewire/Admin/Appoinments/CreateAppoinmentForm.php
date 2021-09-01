<?php

namespace App\Http\Livewire\Admin\Appoinments;

use App\Models\Client;
use Livewire\Component;
use App\Models\Appoinment;
use Illuminate\Support\Facades\Validator;


class CreateAppoinmentForm extends Component
{
    public $state = [];

	public function createAppointment()
	{
        //dd($this->state);
        $this->state['status'] = 'Status';
        
		Appoinment::create($this->state);
		/* $this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully!']); */
	}

    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appoinments.create-appoinment-form', [
        	'clients' => $clients,
        ]);
    }
}
