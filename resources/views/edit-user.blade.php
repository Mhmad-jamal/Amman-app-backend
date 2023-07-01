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
                        <form action="{{ route('editUser') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input value="{{ old('name', $user->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            type="text" name="name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="country_code">Country code <span class="text-danger">*</span></label>
                                        <input class="form-control @error('country_code') is-invalid @enderror"
                                            id="country_code" value="{{ old('country_code', $user->country_code) }}"
                                            type="number" name="country_code" placeholder="+12-345 678 910">
                                        @error('country_code')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                        <input class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            value="{{ old('phone', $user->phone) }}" type="number" name="phone"
                                            placeholder="+12-345 678 910">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email', $user->email) }}" type="email" name="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ID">ID/Passport <span class="text-danger">*</span></label>
                                        <input name="nationalty_number"
                                            class="form-control @error('nationalty_number') is-invalid @enderror"
                                            id="ID" type="text"
                                            value="{{ old('nationalty_number', $user->nationalty_number) }}">
                                        @error('nationalty_number')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="customer_type">Customer type<span class="text-danger">*</span></label>
                                        <select name="customer_type"
                                            class="form-select mb-0 @error('customer_type') is-invalid @enderror"
                                            id="customer_type">
                                            <option value="owner"
                                                {{ old('customer_type', $user->customer_type) == 'owner' ? 'selected' : '' }}>
                                                Owner</option>
                                            <option value="user"
                                                {{ old('customer_type', $user->customer_type) == 'user' ? 'selected' : '' }}>
                                                User</option>
                                        </select>
                                        @error('customer_type')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-select mb-0 @error('status') is-invalid @enderror"
                                            id="status" name="status">
                                            <option value="0"
                                                {{ old('status', $user->active) == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                            <option value="1"
                                                {{ old('status', $user->active) == 1 ? 'selected' : '' }}>Active
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                                </div>
                        </form>
                    </div>
                    @if ($user->customer_type == 'owner')

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
                                                    @php
                                                          $userId = auth()->id();

                                                    $response = $permission->checkPermission($userId, 'properties','view_property');
     
                                                    @endphp
                                                
                                                @if ($response->getStatusCode() === 200)
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ route('properties_view', ['id' => $property->id]) }}">
                                                        <span class="fas fa-box "></span>
                                                        View Details
                                                    </a>
                                                    @endif
                                                    @php
                                                          $response = $permission->checkPermission($userId, 'properties','edit_property');
     
                                                     @endphp
 
                                                    @if ($response->getStatusCode() === 200)
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ route('properties_edit', ['id' => $property->id]) }}">
                                                        <span class="fas fa-edit"></span>
                                                        Edit Property
                                                    </a>
                                                    @endif
                                                    @php
                                                    $response = $permission->checkPermission($userId, 'properties','delete_property');

                                               @endphp

                                              @if ($response->getStatusCode() === 200)
                                                    <a class="dropdown-item text-danger d-flex align-items-center"  href="{{ route('properties_delete', ['id' => $property->id]) }}">
                                                        <span class="fas fa-trash-alt"></span>
                                                        Delete Property
                                                    </a>
                                                    @endif
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
