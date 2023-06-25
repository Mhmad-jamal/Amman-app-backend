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
                    <a href="#" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                            </path>
                        </svg>
                        New User
                    </a>
                  
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
@include('layouts.footer')
</main>

</x-layouts.base>