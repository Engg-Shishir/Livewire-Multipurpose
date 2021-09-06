<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Appointments</h1>
            </div><!-- col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Appointments</li>
                </ol>
            </div><!-- col -->
            </div><!-- row -->
        </div>
    </div>
    <!-- content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex justify-content-between w-100">
                                <a href="{{ route('admin.appoinments.create') }}">
                                   <button class="btn btn-dark">
                                       <i class="fas fa-plus text-danger m2-2"></i> Add Appoinments
                                   </button>
                                </a>
   
                                <div class="btn-group">
                                   <button  wire:click="filterAppoinmentsByStatus " type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                                     <span class="mr-1">All</span> 
                                     <span class="badge badge-pill badge-info">{{ $appoinmentsCount }}</span>
                                   </button>
                                 
                                   <button wire:click="filterAppoinmentsByStatus('scheduled')" type="button" class="btn {{ ($status=='scheduled' ? 'btn-secondary' : 'btn-default') }}">
                                     <span class="mr-1">Scheduled</span>
                                     <span class="badge badge-pill badge-primary">{{ $scheduledAppoinmentsCount }}</span>
                                   </button>
                                 
                                   <button wire:click="filterAppoinmentsByStatus('closed')" type="button" class="btn {{ ($status=='closed' ? 'btn-secondary' : 'btn-default') }}">
                                     <span class="mr-1">Closed</span>
                                     <span class="badge badge-pill badge-success">{{ $closedAppoinmentsCount }}</span>
                                   </button>
                                </div>
                            </div>
                        </div><!--card-header -->
                        <div class="card-body">

                            <table class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appoinments as  $appoinment)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $appoinment->client->name }}</td>
                                            <td>{{ $appoinment->date }}</td>
                                            <td>{{ $appoinment->time }}</td>
                                            <td>
                                                <span class="badge badge-{{ $appoinment->status_badge }}">{{ $appoinment->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.appoinments.edit', $appoinment) }}">
                                                    <i class="fas fa-edit text-warning m2-2"></i>
                                                </a>
                                                <a href="" wire:click.prevent = "confirmAppoinmentRemoval({{ $appoinment->id }})">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>                                        
                                    @endforeach

                                
                                </tbody>
                                </table>
                        </div><!--card-body -->
                        <div class="card-footer d-flex justify-content-end">
                          {!! $appoinments->links() !!}
                        </div>
                    </div>
                    <!--card-->
                </section>
            </div>
        </div>
    </section>
</div>




<script>
  window.addEventListener('showDeleteAppoinmentConfirmation', event =>{
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't to delete this Appoinment",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
              Livewire.emit('appoinmentDeleteConfirmed')
            }
        })
  });

  window.addEventListener('alertSuccess', event =>{
        Swal.fire(
            'Deleted!',
            event.detail.message ,
            'success'
        )
        
  });
</script>



