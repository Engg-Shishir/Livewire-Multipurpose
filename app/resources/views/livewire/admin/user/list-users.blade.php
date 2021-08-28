<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User List</h1>
            </div><!-- col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- col -->
            </div><!-- row -->
        </div>
    </div>
    <!-- content-header -->

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
    
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
    
                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>
    
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
    
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex justify-content-between w-100">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>Sales
                        </h3>

                        <button class="btn btn-dark" wire:click.prevent="openAddUserModal">
                            <i class="fas fa-plus text-danger m2-2"></i> Add User
                        </button>
                        </div>
                    </div><!--card-header -->
                    <div class="card-body">
                        <div>
                            @if (session()->has('message'))
                            <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
                                <strong>{{ session('message') }}</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            @endif
                        </div>
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="">
                                            <i class="fas fa-edit text-warning m2-2"></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                    </div><!--card-body -->
                </div>
                <!--card-->
            </section>
            </div>
        </div>
    </section>


  
  <!-- Modal -->
  <div class="modal fade" id="addUserForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  p-0 bg-gray-dark d-flex justify-content-center">
                    <h3 class="text-light" id="exampleModalLabel">Add New User</h3>
                </div>
                <div class="modal-body">
                    <form autocomplete="true" wire:submit.prevent="createUser">
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid  @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter your name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid  @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" wire:model.lazy="password" class="form-control @error('password') is-invalid  @enderror" id="password" placeholder="Password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" wire:model.lazy="password_confirmation" class="form-control" id="cpassword" placeholder="Confirm Password">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
  </div>



</div>




<script>
    window.addEventListener('openAddUserModal', event =>{
        $('#addUserForm').modal('show');
    });

    
  
  window.addEventListener('closeAddUserModal', event =>{
        $('#addUserForm').modal('hide');
        
  });
</script>



