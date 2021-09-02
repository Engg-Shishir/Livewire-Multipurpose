<?php

namespace App\Http\Livewire\Admin\Appoinments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appoinment;
class ListAppoinments extends AdminComponent
{
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
