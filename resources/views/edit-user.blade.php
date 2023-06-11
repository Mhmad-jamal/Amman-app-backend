<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <title>Edit user</title>
        <div>
          <br>
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">General information</h2>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name"> Name</label>
                                        <input value="{{$user->name}}" class="form-control" id="first_name" type="text"
                                            placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="country_code">Country code</label>
                                        <input class="form-control" id="country_code" value="{{$user->country_code}}" type="number"
                                            placeholder="+12-345 678 910">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" value="{{$user->phone}}" type="number"
                                            placeholder="+12-345 678 910">
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
                                        <input class="form-control" id="ID" type="text" value="{{$user->nationalty_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="customer_type">Customer type</label>
                                        <select class="form-select mb-0" id="customer_type">
                                    
                                        <option value="owner"{{($user->customer_type=="owner")?"selected":""}}>owner</option>
                                        <option value="user" {{($user->customer_type=="user")?"selected":""}}>user</option>
                             
                            
                            </select>                                     </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-select mb-0" id="status" name="status">
                                    
                                            <option value="0"{{($user->active=="0")?"selected":""}}>Inactive</option>
                                            <option value="1" {{($user->active=="1")?"selected":""}}>Active</option>
                                 
                                
                                </select>                                     </div>
                                </div>
                               
                            </div>
                          
                            <div class="mt-3">
                                <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                            </div>
                        </form>
                    </div>
                    <div class="card card-body border-0 shadow mb-4 mb-xl-0">
                        <h2 class="h5 mb-4">Alerts & Notifications</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                                <div>
                                    <h3 class="h6 mb-1">Company News</h3>
                                    <p class="small pe-4">Get Rocket news, announcements, and product updates</p>
                                </div>
                                <div>
                                    <div class="form-check form-switch">
                                        <select class="form-select mb-0" id="customer_type"
                                    
                                                <option value="owner">owner</option>
                                                <option value="user" selected="">user</option>
                                     
                                    
                                    </select>   
                                     <label class="form-check-label" for="user-notification-1"></label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                                <div>
                                    <h3 class="h6 mb-1">Account Activity</h3>
                                    <p class="small pe-4">Get important notifications about you or activity you've missed</p>
                                </div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="user-notification-2" checked>
                                        <label class="form-check-label" for="user-notification-2"></label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                <div>
                                    <h3 class="h6 mb-1">Meetups Near You</h3>
                                    <p class="small pe-4">Get an email when a Dribbble Meetup is posted close to my location</p>
                                </div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="user-notification-3" checked>
                                        <label class="form-check-label" for="user-notification-3"></label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
              
        
        </div>



        
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

</x-layouts.base>
