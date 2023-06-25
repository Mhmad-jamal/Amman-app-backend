<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 table-wrapper table-responsive">
            <div wire:id="IOiqzSHsz63Wn7uuPcTg" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-4 mb-md-0">
                   
                    <h2 class="h4">Admin List</h2>
                 
                </div>
                <div class="btn-toolbar mb-2 mb-md-0">
                   
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        New Admin
                      </button>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                      <button type="button" style="background: none;border: none;" class="close  " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('add_new_admin')}}" method="POST">
                            <!-- Form -->
                            @csrf
                            <div class="form-group mt-4 mb-4">
                                <label for="email">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg></span>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="example@company.com" autofocus required>
                                </div>
                                @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">Your Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                        <input name="password" type="password" placeholder="Password" class="form-control" id="password" required>
                                    </div>  
                                    @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                </div>
                                <!-- End of Form -->
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="confirm_password">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon5"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                        <input name="passwordConfirmation" type="password" placeholder="Confirm Password" class="form-control" id="confirm_password" required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="terms" required>
                                    <label class="form-check-label fw-normal mb-0" for="terms">
                                        I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                            
                       
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
            <table class="table user-table table-hover align-items-center" id="propertytable">
                <thead>
                    <tr>

                        <th class="border-bottom">Id</th>
                        <th class="border-bottom">  name </th>
                        <th class="border-bottom">  email </th>

                        <th class="border-bottom"> Role  </th>
                        
                        <th class="border-bottom">Created At </th>

                        

                        <th class="border-bottom">Action</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach ($users as $user)
                    <tr>

                            <td>
                               {{$user->id}}
                            </td>
                            <td><span class="fw-normal"></span>{{$user->first_name." ".$user->last_name}}
                            </td>
                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$user->email}}</span>
                            </td>
                        

                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$user->role}}</span>
                            </td>
                            <td>
                                <span class="fw-normal d-flex align-items-center">{{ $user->created_at->format('Y-m-d') }}</span>
                            </td>
                           
                       
                    
                         {{--    @if ($contract->status==1)
                            <td><span class="fw-normal d-flex align-items-center text-success">Active</span></td>

                                
                           @elseif ($contract->status==0)
                            <td><span class="fw-normal d-flex align-items-center text-warining">Draft</span></td>

                            @else
                            <td><span class="fw-normal d-flex align-items-center text-danger ">Deleted</span></td>

                            @endif --}}
                          


                            <td>

                                <div class="btn-group">
                                    <button
                                        class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <svg class="icon icon-xs" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                            </path>
                                        </svg>
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <div
                                        class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                        <a class="dropdown-item d-flex align-items-center"
                                            href=" {{ route('details_admin', ['id' => $user->id]) }} ">
                                            <span class="fas fa-box "></span>
                                            View Details
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('edit_admin', ['id' => $user->id]) }}">
                                            <span class="fas fa-edit"></span>
                                            Edit Admin
                                        </a>
                                        <a class="dropdown-item text-danger d-flex align-items-center"  href="{{ route('Admin_delete', ['id' => $user->id]) }}  ">
                                            <span class="fas fa-trash-alt"></span>
                                            Delete Admin
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Display other client details -->
                        @endforeach 
                </tbody>
            </table>
        </div>
<script>
     $(document).ready(function() {
              $('#propertytable').DataTable();
            });
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@include('layouts.footer')
</main>

</x-layouts.base>