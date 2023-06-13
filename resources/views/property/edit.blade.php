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
                        <input type="hidden" value="{{$property->id}}" name="id">
                        <input type="hidden" value="{{$property->owner_id}}" name="owner_id">

                        <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="section">Section <span class="text-danger">*</span></label>
                                        <select class="form-select mb-0" id="section" name="section">
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
                                        <input class="form-control" id="sub_section" name="sub_section"
                                            value="{{ $property->sub_section }}" type="text">
                                        @if ($errors->has('sub_section'))
                                            <span class="text-danger">{{ $errors->first('sub_section') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="room_number">Room number <span class="text-danger">*</span></label>
                                        <input class="form-control" name="room_number" id="room_number"
                                            value="{{ $property->room_number }}" type="text">
                                        @if ($errors->has('room_number'))
                                            <span class="text-danger">{{ $errors->first('room_number') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="bath_number">Bath number <span class="text-danger">*</span></label>
                                        <input class="form-control" id="bath_number" name="bath_number"
                                            value="{{ $property->bath_number }}" type="text">
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
                                            <input class="form-control" id="building_area" name="building_area"
                                                type="text" value="{{ $property->building_area }}">
                                            @if ($errors->has('building_area'))
                                                <span class="text-danger">{{ $errors->first('building_area') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="floor">Floor <span class="text-danger">*</span></label>
                                            <select class="form-select mb-0" id="floor" name="floor">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $property->floor == $i ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
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
                                            <input class="form-control" id="construction_age" name="construction_age"
                                                type="text" value="{{ $property->construction_age }}">
                                            @if ($errors->has('construction_age'))
                                                <span
                                                    class="text-danger">{{ $errors->first('construction_age') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="furnished">Furnished <span class="text-danger">*</span></label>
                                            <input class="form-control" id="furnished" name="furnished" type="text"
                                                value="{{ $property->furnished }}">
                                            @if ($errors->has('furnished'))
                                                <span class="text-danger">{{ $errors->first('furnished') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-select mb-0" id="status" name="status">
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
                                            <input class="form-control" id="ad_title" name="ad_title"
                                                type="text" value="{{ $property->ad_title }}">
                                            @if ($errors->has('ad_title'))
                                                <span class="text-danger">{{ $errors->first('ad_title') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="ad_details">Ad details <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="ad_details" name="ad_details"
                                                type="text" value="{{ $property->ad_details }}">
                                            @if ($errors->has('ad_details'))
                                                <span class="text-danger">{{ $errors->first('ad_details') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input class="form-control" id="address" name="address" type="text"
                                                value="{{ $property->address }}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-9 mb-3">
                                        <div class="form-group">
                                            <label for="features">Features </label>
                                            <br>
                                            @php
                                                $data = [
                                                    'features' => 1,
                                                    'condition' => 0,
                                                    'car' => 1,
                                                ];
                                            @endphp
                                            @foreach ($data as $key => $value)
                                                <label style="margin-left: 10px">
                                                    <input type="radio" name="{{ $key }}" value="1"
                                                        {{ $value == 1 ? 'checked' : '' }}>
                                                    {{ $key }}
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                </label>
                                            @endforeach
                                            @if ($errors->has('features'))
                                                <span class="text-danger">{{ $errors->first('features') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <input class="form-control" id="price" name="price" type="text"
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
                        </div>

                        <br>
                        <br>

                    </div>


                </div>




                {{-- Footer --}}
                @include('layouts.footer')
    </main>

</x-layouts.base>
