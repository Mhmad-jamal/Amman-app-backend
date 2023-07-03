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
                <div class="card card-body shadow border-0 table-wrapper table-responsive">
                    <h2 class="h5 mb-4"> Orders</h2>
        
                    <table class="table user-table table-hover align-items-center" id="checkTable">
                        <thead>
                            <tr>
        
                                <th class="border-bottom">Id</th>
                                <th class="border-bottom">Order Type</th>
        
        
                                <th class="border-bottom"> Type </th>
        {{--                         <th class="border-bottom">description </th>
         --}}                        <th class="border-bottom"> image  </th>
        
                                <th class="border-bottom"> date </th>
        
                                
                                <th class="border-bottom"> Status </th>
        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
        
                                    <td>
                                       {{$item->id}}
                                    </td>
                                    
        
                                    <td>
                                        {{$item->type}}
                                     </td>
                               
                                    <td><span class="fw-normal"></span>{{$item->name}}
                                    </td>
                                {{--     <td>
                                        <span class="fw-normal d-flex align-items-center text-truncate" style="max-width: 150px;">
                                            {{ $item->description }}
                                        </span>
                                   
                                    </td> --}}
                                  
                                        <td>
                                            <div class="d-flex align-items-center">
                                              <img src="{{asset('storage/'.$item->image)}}" class="img-thumbnail" alt="Image Preview">
                                            </div>
                                          </td>
                                
        
                                    <td>
                                        <span class="fw-normal d-flex align-items-center">
                                            {{ $item->created_at->format('Y-m-d') }}
                                        </span>
                                    </td>
                                  
                                   
                                  
                               
                            
                                    @if ($item->status==1)
                                    <td><span class="fw-normal d-flex align-items-center text-success">Approve</span></td>
        
                                        
                                   @elseif ($item->status==0)
                                    <td>
                                        <span class="fw-normal d-flex align-items-center text-warning">On hold</span></td>
        
                                    @else
                                    <td><span class="fw-normal d-flex align-items-center text-danger ">Reject</span></td>
        
                                    @endif
                                  
        
        
                                   
                                </tr>
                                <!-- Display other client details -->
                                @endforeach
                        </tbody>
                    </table>
                </div>
              
        
        </div>

        <script>
            $(document).ready(function() {
              $('#propertytable').DataTable();
              $('#checkTable').DataTable();

            });
          </script>
         

        
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

</x-layouts.base>
