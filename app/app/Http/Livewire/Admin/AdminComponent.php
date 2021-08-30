<?php
namespace App\Http\Livewire\Admin;
use Livewire\Component;

// For Make Viladion
use Illuminate\Support\Facades\Validator;

// For Pagination system
use Livewire\withPagination;

// This Component is our self created Component. Which is extend Livewire default Component.So All of common import or others thing we insert here.And All off created others component extends this.Thats why they get this component Behaviour automatically.
class AdminComponent extends Component
{
    // This stop pagination browser refresh 
    use withPagination;
    // By default , Livewire pagination use Tailwind css Theme.But here we use bootstrap Theme.
    //If you want to use Tailwind CSS Theme bydefault uou dont need this line of code  
    protected $paginationTheme = 'bootstrap';

    
}