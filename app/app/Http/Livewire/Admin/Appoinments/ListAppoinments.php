<?php

namespace App\Http\Livewire\Admin\Appoinments;

use App\Http\Livewire\Admin\AdminComponent;

class ListAppoinments extends AdminComponent
{
    public function render()
    {
        return view('livewire.admin.appoinments.list-appoinments');
    }
}
