<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <div>
   
            <div class="row mt-5">
                <div class="col-12 col-xl-8">
                   
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">General information</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name">First Name</label>
                                        <input  disabled name="first_name" class="form-control" id="first_name" type="text"
                                            value="{{$user->first_name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="last_name">Last Name</label>
                                        <input  disabled name="last_name" class="form-control" id="last_name" type="text"
                                            value="{{$user->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input  disabled name="email" class="form-control" id="email" type="email"
                                           value="{{$user->email}}" disabled>
                                    </div>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender">Gender</label>
                                    <select disabled name="gender" class="form-select mb-0" id="gender"
                                        aria-label="Gender select example">
                                        <option >Choose...</option>
                                        
                                        <option {{ $user->gender == "Female" ? "selected" : "" }} value="Female">Female</option>
                                        <option {{ $user->gender == "Male" ? "selected" : "" }} value="Male">Male</option>

                                    </select>
                                    @error('user.gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <h2 class="h5 my-4">Location</h2>
                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input  disabled value="{{$user->address}}" name="address" class="form-control" id="address" type="text">
                                    </div>
                                    @error('user.address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="form-group">
                                        <label for="number">Number</label>
                                        <input  disabled name="number" class="form-control" id="number" type="number"
                                       value="{{$user->number}}"     placeholder="No.">
                                    </div>
                                    @error('user.number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input  disabled name="city" value="{{$user->city}}" class="form-control" id="city" type="text"
                                           >
                                    </div>
                                    @error('user.city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input  disabled value="{{$user->ZIP}}" name="ZIP" class="form-control" id="zip" type="tel" placeholder="ZIP">
                                    </div>
                                </div>
                                @error('user.ZIP') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                           
                      
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card shadow border-0 text-center p-0">
                                <div wire:ignore.self class="profile-cover rounded-top"
                                    data-background="../../../assets/img/profile-cover.jpg"></div>
                                <div class="card-body pb-5">
                                    @if ($user->gender=="Female")
                                        
                                    <img src="../../../assets/img/team/download.png" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
        
        
                                        
                                    @else
                                    <img src="../../../assets/img/team/man-with-beard-avatar-character-isolated-icon-free-vector.jpg" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
        
        
                                    @endif
        
                                    <h4 class="h3">
                                        {{  $user->first_name ? $user->first_name . ' ' . $user->last_name : 'User Name'}}
                                    </h4>
                                    <h6>{{$user->created_at}}</h6>
                                    <h5 class="fw-normal"></h5>
                                    <p class="text-gray mb-4"></p>
                                 
                                 
        
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
          
        
        

        @include('layouts.footer')
</main>

</x-layouts.base>