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
            <form action="{{route('properties_update')}}" method="POST">
@csrf
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Property Details</h2>
                        <input  type="hidden" value="{{$property->id}}" name="id">
                        <input  type="hidden" value="{{$property->owner_id}}" name="owner_id">

                        <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="section">Section <span class="text-danger">*</span></label>
                                        <select  class="form-select mb-0" id="section" name="section">
                                            <option value="Sale"
                                                {{ $property->section == 'Sale' ? 'selected' : '' }}>Sale</option>
                                            <option value="Rent"
                                                {{ $property->section == 'Rent' ? 'selected' : '' }}>Rent</option>
                                        </select>
                                        @if ($errors->has('section'))
                                            <span class="text-danger">{{ $errors->first('section') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="sub_section">Sub Section <span class="text-danger">*</span></label>
                                        <select class="form-select mb-0" id="sub_section" name="sub_section">
                                            <option value="Apartments" <?php echo $property->sub_section === 'Apartments' ? 'selected' : ''; ?>>Apartments</option>
                                            <option value="Villa - Palace" <?php echo $property->sub_section === 'Villa - Palace' ? 'selected' : ''; ?>>Villa - Palace</option>
                                            <option value="Townhouses" <?php echo $property->sub_section === 'Townhouses' ? 'selected' : ''; ?>>Townhouses</option>
                                            <option value="Lands" <?php echo $property->sub_section === 'Lands' ? 'selected' : ''; ?>>Lands</option>
                                            <option value="Commercial" <?php echo $property->sub_section === 'Commercial' ? 'selected' : ''; ?>>Commercial</option>
                                            <option value="Farms & Chalets" <?php echo $property->sub_section === 'Farms & Chalets' ? 'selected' : ''; ?>>Farms & Chalets</option>
                                            <option value="Whole Building" <?php echo $property->sub_section === 'Whole Building' ? 'selected' : ''; ?>>Whole Building</option>
                                            <option value="Foreign Real Estate" <?php echo $property->sub_section === 'Foreign Real Estate' ? 'selected' : ''; ?>>Foreign Real Estate</option>
                                          </select>
                                          
                                        @if ($errors->has('sub_section'))
                                            <span class="text-danger">{{ $errors->first('sub_section') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="room_number">Room number <span class="text-danger">*</span></label>
                                        <select  name="room_number" class="form-select mb-0">
                                            <option value="1" {{$property->room_number == '1' ? 'selected' : ''}}>1</option>
                                            <option value="2" {{$property->room_number == '2' ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$property->room_number == '3' ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$property->room_number == '4' ? 'selected' : ''}}>4</option>
                                            <option value="5" {{$property->room_number == '5' ? 'selected' : ''}}>5</option>
                                            <option value="6+" {{$property->room_number == '6+' ? 'selected' : ''}}>6+</option>
                                            <option value="Studio" {{$property->room_number == 'Studio' ? 'selected' : ''}}>Studio</option>
                                        </select>
                                        
                                        @if ($errors->has('room_number'))
                                            <span class="text-danger">{{ $errors->first('room_number') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="bath_number">Bath number <span class="text-danger">*</span></label>
                                        <select  name="bath_number" class="form-select mb-0">
                                            <option value="One" {{$property->bath_number == 'One' ? 'selected' : ''}}>One</option>

                                            <option value="2" {{$property->bath_number == '2' ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$property->bath_number == '3' ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$property->bath_number == '4' ? 'selected' : ''}}>4</option>
                                            <option value="5+" {{$property->bath_number == '5+' ? 'selected' : ''}}>5+</option>
                                        </select>
                                        
                                        @if ($errors->has('bath_number'))
                                            <span class="text-danger">{{ $errors->first('bath_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="building_area">Building area <span
                                                    class="text-danger">*</span></label>
                                                    <input  class="form-control" name="building_area" id="building_area"
                                                    value="{{ $property->building_area }}" type="text">
                                                                                                      
                                            @if ($errors->has('building_area'))
                                                <span class="text-danger">{{ $errors->first('building_area') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="floor">Floor <span class="text-danger">*</span></label>
                                            <select  class="form-select mb-0" id="floor" name="floor">
                                                <option value="Basement" {{$property->floor == 'Basement' ? 'selected' : ''}}>Basement</option>
                                                <option value="Ground Floor" {{$property->floor == 'Ground Floor' ? 'selected' : ''}}>Ground Floor</option>
                                                <option value="First Floor" {{$property->floor == 'First Floor' ? 'selected' : ''}}>First Floor</option>
                                                <option value="Second Floor" {{$property->floor == 'Second Floor' ? 'selected' : ''}}>Second Floor</option>
                                                <option value="Third Floor" {{$property->floor == 'Third Floor' ? 'selected' : ''}}>Third Floor</option>
                                                <option value="Fourth Floor" {{$property->floor == 'Fourth Floor' ? 'selected' : ''}}>Fourth Floor</option>
                                                <option value="Fifth Floor" {{$property->floor == 'Fifth Floor' ? 'selected' : ''}}>Fifth Floor</option>
                                            </select>
                                            
                                            
                                            @if ($errors->has('floor'))
                                                <span class="text-danger">{{ $errors->first('floor') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="construction_age">Construction age <span
                                                    class="text-danger">*</span></label>
                                                    <select  class="form-select mb-0" id="construction_age" name="construction_age">
                                                        <option value="0-11 months" {{$property->construction_age == '0-11 months' ? 'selected' : ''}}>0-11 months</option>
                                                        <option value="1-5 years" {{$property->construction_age == '1-5 years' ? 'selected' : ''}}>1-5 years</option>
                                                        <option value="6-9 years" {{$property->construction_age == '6-9 years' ? 'selected' : ''}}>6-9 years</option>
                                                        <option value="10-19 years" {{$property->construction_age == '10-19 years' ? 'selected' : ''}}>10-19 years</option>
                                                        <option value="20+ years" {{$property->construction_age == '20+ years' ? 'selected' : ''}}>20+ years</option>
                                                        <option value="Under Construction" {{$property->construction_age == 'Under Construction' ? 'selected' : ''}}>Under Construction</option>
                                                    </select>
                                            @if ($errors->has('construction_age'))
                                                <span
                                                    class="text-danger">{{ $errors->first('construction_age') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="furnished">Furnished <span class="text-danger">*</span></label>
                                            <select  name="furnished" class="form-select mb-0">
                                                <option value="Furnished" {{$property->furnished == 'Furnished' ? 'selected' : ''}}>Furnished</option>
                                                <option value="Semi Furnished" {{$property->furnished == 'Semi Furnished' ? 'selected' : ''}}>Semi Furnished</option>
                                                <option value="Unfurnished" {{$property->furnished == 'Unfurnished' ? 'selected' : ''}}>Unfurnished</option>
                                            </select>
                                            
                                            @if ($errors->has('furnished'))
                                                <span class="text-danger">{{ $errors->first('furnished') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select  class="form-select mb-0" id="status" name="status">
                                            <option value="0" {{ $property->status == '0' ? 'selected' : '' }}>
                                                Draft</option>
                                            <option value="1" {{ $property->status == '1' ? 'selected' : '' }}>
                                                Publish</option>
                                            <option value="2" {{ $property->status == '2' ? 'selected' : '' }}>
                                                Cancel</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="ad_title">Ad title <span class="text-danger">*</span></label>
                                            <input  class="form-control" id="ad_title" name="ad_title"
                                                type="text" value="{{ $property->ad_title }}">
                                            @if ($errors->has('ad_title'))
                                                <span class="text-danger">{{ $errors->first('ad_title') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="electric_bill">Electric bill <span
                                                    class="text-danger">*</span></label>
                                            <input  class="form-control" id="electric_bill" name="electric_bill"
                                                type="text" value="{{ $property->electric_bill }}">
                                            @if ($errors->has('electric_bill'))
                                                <span class="text-danger">{{ $errors->first('electric_bill') }}</span>
                                            @endif
                                        </div>
                                      
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        
                                        <div class="form-group">
                                            <label for="water_bill">Water bill <span
                                                    class="text-danger">*</span></label>
                                            <input  class="form-control" id="water_bill" name="water_bill"
                                                type="text" value="{{ $property->water_bill }}">
                                            @if ($errors->has('water_bill'))
                                                <span class="text-danger">{{ $errors->first('water_bill') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="ad_details">Ad details <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="ad_details" name="ad_details" rows="1" oninput="autoResize(this)">{{ $property->ad_details }}</textarea>
                                            @if ($errors->has('ad_details'))
                                                <span class="text-danger">{{ $errors->first('ad_details') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input  class="form-control" id="address" name="address" type="text"
                                                value="{{ $property->address }}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                              
                            
                            <div class="row">
                            
                                <div class="form-group">
                                    <label for="features">Features</label>
                                    <br>
                                    @php
                                    $features = [
                                        'Air Conditioning',
                                        'Central Air Conditioning',
                                        'Heating',
                                        'Balcony',
                                        'Maid Room',
                                        'Laundry Room',
                                        'Built in Wardrobes',
                                        'Private Pool',
                                        'Double Glazed Windows',
                                        'Jacuzzi',
                                        'Installed Kitchen',
                                        'Electric Shutters',
                                        'Underfloor Heating',
                                        'Washing Machine',
                                        'Dishwasher',
                                        'Microwave',
                                        'Oven',
                                        'Refrigerator'
                                    ];
                                    @endphp
                                
                                    @foreach ($features as $index => $feature)
                                        @if ($index % 4 === 0)
                                            <div class="row">
                                        @endif
                                        <div class="col-md-3">
                                            <label style="margin-left: 10px">
                                                <input type="checkbox" name="features[]" value="{{ $feature }}"
                                                {{ in_array($feature, json_decode($property->features, true)) ? 'checked' : '' }}>
                                                {{ $feature }}
                                            </label>
                                        </div>
                                        @if (($index + 1) % 4 === 0 || $index === count($features) - 1)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                           
                    
                        
                        
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <input  class="form-control" id="price" name="price" type="text"
                                                value="{{ $property->price }}">
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save
                                        All</button>
                                </div>
                            </form>
                            <br>
                            <div class="row">
                                <h2 class="h5 mb-4">Property Images</h2>
                                <br>
                                @php
                                $images = json_decode($property->image, true);
                                 @endphp
                         <div class="row">
                            @foreach ($images as $index => $imagePath)
                            <div class="col-md-3 d-flex flex-column align-items-center">
                                <a href="{{ asset('storage/' . $imagePath) }}" data-lightbox="property-gallery">
                                    <img style="width: 100%; height: 150px;" class="property-image" src="{{ asset('storage/' . $imagePath) }}" alt="Image">
                                </a>
                                <form method="POST" action="{{ route('delete_image') }}" class="delete-form">
                                    @csrf
                                    <input type="hidden" name="index" value="{{ $index }}">
                                    <input type="hidden" name="id" value="{{ $property->id }}">
                                    <button type="button" class="btn btn-danger delete-btn mt-3"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                              </div>
                              <br>

                              <div class="row">
                                <div class="col-md-6">
                                    <form method="POST" action="{{ route('add_image') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $property->id }}">
                                        <input class="form-control" type="file" name="image[]" multiple accept="image/*">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Add Images</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>

                        <br>
                        <br>

                    </div>


                </div>
               
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<style>
    .btn-danger{
        background-color: #fa3a22;
    border-color: #fa3a22;
    }
    .btn-danger:hover{
        background-color: #fa3a22;
    border-color: #fa3a22;
    transform: scale(1.1);
    }
    </style>
                <script>
                     $('.delete-btn').on('click', function() {
        const form = $(this).closest('.delete-form');
        
        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if user confirms deletion
                form.submit();
            }
        });
    });
                    function autoResize(textarea) {
                        textarea.style.height = 'auto';
                        textarea.style.height = textarea.scrollHeight + 'px';
                    }
                    autoResize(document.getElementById('ad_details'));
                    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });
                </script>




                {{-- Footer --}}
                @include('layouts.footer')
    </main>

</x-layouts.base>
