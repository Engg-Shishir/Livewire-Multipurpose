<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Appointment;

class AppoinmentsCount extends Component
{
    public $appointmentsCount;

    public function mount()
    {
        $this->getAppointmentsCount();
    }

    public function getAppointmentsCount($status = null)
    {
        $this->appointmentsCount = Appointment::query()
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.appoinments-count');
    }
}
