<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <title>View user</title>
        <div>
          <br>
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">General information</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name"> Name</label>
                                        <input disabled value="{{$user->name}}" class="form-control" id="first_name" type="text"
                                            placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="country_code">Country code</label>
                                        <input class="form-control" id="country_code" value="{{$user->country_code}}" type="number"
                                        disabled  placeholder="+12-345 678 910">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" value="{{$user->phone}}" type="number"
                                        disabled   placeholder="+12-345 678 910">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input  class="form-control" id="email" value="{{$user->email}}" type="email"
                                            placeholder="name@company.com" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ID">ID/Passport</label>
                                        <input class="form-control" disabled id="ID" type="text" value="{{$user->nationalty_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="customer_type">Customer type</label>
                                        <select disabled class="form-select mb-0" id="customer_type">
                                    
                                        <option value="owner"{{($user->customer_type=="owner")?"selected":""}}>owner</option>
                                        <option value="user" {{($user->customer_type=="user")?"selected":""}}>user</option>
                             
                            
                            </select> </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select disabled class="form-select mb-0" id="status" name="status">
                                    
                                            <option value="0"{{($user->active=="0")?"selected":""}}>Inactive</option>
                                            <option value="1" {{($user->active=="1")?"selected":""}}>Active</option>
                                 
                                
                                </select>                                     </div>
                                </div>
                               
                            </div>
                          
                           
                    
                    </div>
                @if (($user->customer_type == 'owner'))
                    

                    <div class="card card-body shadow border-0 table-wrapper table-responsive">
                        <h2 class="h5 mb-4">Properties information</h2>

                        <table class="table user-table table-hover align-items-center" id="propertytable">
                            <thead>
                                <tr>

                                    <th class="border-bottom">Id</th>
                                    <th class="border-bottom"> Section </th>
                                    <th class="border-bottom">sub section </th>
                                    
                                    <th class="border-bottom">construction age </th>
                                    <th class="border-bottom">furnished </th>

                                    
                                    <th class="border-bottom">status </th>
                                    <th class="border-bottom">Price </th>

                                    <th class="border-bottom">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                    <tr>

                                        <td>
                                            {{ $property->id }}
                                        </td>
                                        <td><span class="fw-normal"> {{ $property->section }}</span></td>
                                        <td><span
                                                class="fw-normal d-flex align-items-center">{{ $property->sub_section }}</span>
                                        </td>
                                    

                                       
                                

                                        <td><span
                                                class="fw-normal d-flex align-items-center">{{ $property->construction_age }}</span>
                                        </td>
                                        <td><span
                                                class="fw-normal d-flex align-items-center">{{ $property->furnished }}</span>
                                        </td>
                                      

                                
                                        @if ($property->status==1)
                                        <td><span class="fw-normal d-flex align-items-center text-success">Active</span></td>

                                            
                                        @elseif ($property->status==0)
                                        <td><span class="fw-normal d-flex align-items-center text-warining">Draft</span></td>

                                        @else
                                        <td><span class="fw-normal d-flex align-items-center text-danger ">Delete</span></td>

                                        @endif
                                        <td><span
                                                class="fw-normal d-flex align-items-center">{{ $property->price }}</span>
                                        </td>


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
                                                        href="{{ route('properties_view', ['id' => $property->id]) }}">
                                                        <span class="fas fa-box "></span>
                                                        View Details
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ route('properties_edit', ['id' => $property->id]) }}">
                                                        <span class="fas fa-edit"></span>
                                                        Edit Property
                                                    </a>
                                                    <a class="dropdown-item text-danger d-flex align-items-center"  href="{{ route('properties_delete', ['id' => $property->id]) }}">
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
                @endif
                    <br>
                    <br>
                  
                </div>
              
        
        </div>

        <script>
            $(document).ready(function() {
              $('#propertytable').DataTable();
            });
          </script>

        
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

</x-layouts.base>
