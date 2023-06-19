<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 table-wrapper table-responsive">
            <h2 class="h5 mb-4">Properties information</h2>

            <table class="table user-table table-hover align-items-center" id="propertytable">
                <thead>
                    <tr>

                        <th class="border-bottom">Id</th>
                        <th class="border-bottom"> Owner name </th>
                        <th class="border-bottom">Client name </th>
                        
                        <th class="border-bottom">Start date </th>
                        <th class="border-bottom">end date </th>

                        
                        <th class="border-bottom">Owner phone </th>
                        <th class="border-bottom">client phone </th>
                        <th class="border-bottom">status</th>

                        <th class="border-bottom">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $contract)
                    <tr>

                            <td>
                               {{$contract->id}}
                            </td>
                            <td><span class="fw-normal"></span>{{$contract->owner_name}}
                            </td>
                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$contract->client_name}}</span>
                            </td>
                        

                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$contract->start_date}}</span>
                            </td>
                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$contract->end_date}}</span>
                            </td>
                            <td><span
                                class="fw-normal d-flex align-items-center">{{$contract->owner_country_code.'-'.$contract->owner_phone}}</span>
                        </td>
                        <td><span
                            class="fw-normal d-flex align-items-center">{{$contract->client_phone}}</span>
                    </td>
                    
                            @if ($contract->status==1)
                            <td><span class="fw-normal d-flex align-items-center text-success">Active</span></td>

                                
                           @elseif ($contract->status==0)
                            <td><span class="fw-normal d-flex align-items-center text-warining">Draft</span></td>

                            @else
                            <td><span class="fw-normal d-flex align-items-center text-danger ">Deleted</span></td>

                            @endif
                          


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
                                            href="{{-- {{ route('contract_details', ['id' => $contract->id]) }} --}}">
                                            <span class="fas fa-box "></span>
                                            View Details
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('edit_contract', ['id' => $contract->id]) }}">
                                            <span class="fas fa-edit"></span>
                                            Edit Property
                                        </a>
                                        <a class="dropdown-item text-danger d-flex align-items-center"  href="{{-- {{ route('properties_delete', ['id' => $property->id]) }} --}}">
                                            <span class="fas fa-trash-alt"></span>
                                            Delete Property
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