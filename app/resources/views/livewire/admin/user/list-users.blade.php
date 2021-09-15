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
                <livewire:admin.dashboard.user-count />
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
                                <button class="btn btn-dark" wire:click.prevent="openAddUserModal">
                                    <i class="fas fa-plus text-danger m2-2"></i> Add User
                                </button>
                                <x-search-input wire:model.delay="searchUser"/>
                        </div>
                    </div><!--card-header -->
                    <div class="card-body">
                         {{--<div>
                            @if (session()->has('message'))
                            <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
                                <strong>{{ session('message') }}</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            @endif
                        </div>--}}
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody wire:loading.class="searchLoading">
                                @forelse ($users as $key => $user)
                                    <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>
                                        @if ($user->avatar)
                                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}" style="width: 70px; height:70px;">
                                        @else
                                        <img src="{{url('noimage.png')}}" style="width: 70px; height:70px;" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                      <select class="form-control" wire:change="changeRole({{ $user }}, $event.target.value)">
                                        <option value="admin" {{ ($user->role === 'admin') ? 'selected' : '' }}>ADMIN</option>
                                        <option value="user" {{ ($user->role === 'user') ? 'selected' : '' }}>USER</option>
                                      </select>
                                    </td>
                                    <td>
                                        <a href="" wire:click.prevent="userEdit({{ $user }})">
                                            <i class="fas fa-edit text-warning m2-2"></i>
                                        </a>
                                        <a href="" wire:click.prevent="userDelete({{ $user->id }})">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                             <img src="{{ asset('image/search.svg') }}" alt="">
                                             <br><br>
                                             <p>No Results Found</p>
                                        </td>         
                                    </tr>

                                @endforelse
                            </tbody>
                            </table>
                    </div><!--card-body -->
                    <div class="card-footer d-flex justify-content-end">
                       {{ $users->links() }}
                    </div>
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
                    <h3 class="text-light" id="exampleModalLabel">
                        @if ($showEditModal)
                          <span>Edit User</span>
                          @else  
                          <span>Add New User</span>
                        @endif
                    </h3>
                </div>
                <div class="modal-body">
                    <form autocomplete="true" wire:submit.prevent="{{ $showEditModal ? 'UpdateUser' : 'createUser'}}">
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid  @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter your name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid  @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid  @enderror" id="password" placeholder="Password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="cpassword" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label for="customFile">Custom Photo</label>
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="img d-block my-2 w-100 rounded">
                            @else
                                <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded" >
                            @endif
                            
                            <div class="custom-file">
                            <div x-data="{ isUploading: false, progress: 5 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false; progress = 5"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                               <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                 <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                   <span class="sr-only">40% Complete (success)</span>
                                 </div>
                               </div>
                            </div>

                              <label class="custom-file-label" for="customFile">
                                  @if ($photo)
                                    {{ $photo->getClientOriginalName() }}
                                  @else
                                     Choose file
                                  @endif
                              </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancle</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> 
                             @if ($showEditModal)
                                <span>Update</span> 
                             @else
                                <span>Save</span>
                             @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header  p-0 bg-danger d-flex justify-content-center">
                        <h3 class="text-light">
                           Confirm Delete User !
                        </h3>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img src="{{ asset('image/danger.png') }}" height="300px" width="300px"alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancle</button>
                        <button  type="button" wire:click.prevent="confirmUserDelete" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
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
            toastr.success(event.detail.message, 'Success!');
    });
    
    window.addEventListener('showDeleteUserModal', event =>{
            $('#deleteUserModal').modal('show');
    });

    window.addEventListener('hideDeleteUserModal', event =>{
            $('#deleteUserModal').modal('hide');
            toastr.success(event.detail.message, 'Success!');
    });

    window.addEventListener('successAlert', event =>{
        toastr.success(event.detail.message, 'Success!');
    });
</script>



