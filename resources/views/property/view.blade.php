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
                        <h2 class="h5 mb-4">Property Details</h2>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div>
                                    <label for="section"> Section</label>
                                    <select class="form-select mb-0" id="section" name="section">

                                        <option value="Sale"  {{($property->section=="Sale")?"selected":""}} >Sale</option>
                                        <option value="Rent" {{($property->section=="Rent")?"selected":""}}>Rent</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="sub_section">Sub Section </label>
                                    <input class="form-control" id="sub_section" name="sub_section" value="{{$property->sub_section}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="room_number">Room number</label>
                                    <input class="form-control" name="room_number" id="room_number" value="{{$property->room_number}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="bath_number">Bath number</label>
                                    <input class="form-control" id="bath_number" name="bath_number" value="{{$property->bath_number}}" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="ID">Building area</label>
                                    <input class="form-control" id="building_area" name="building_area" type="text" value="{{$property->building_area}}">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="floor">Floor</label>
                                    <select class="form-select mb-0" id="floor" name="floor">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $property->floor == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="status">Construction age</label>
                                    <input class="form-control" id="construction_age" name="construction_age"
                                        type="text" value="{{$property->construction_age}}">

                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="status">Furnished </label>
                                    <input class="form-control" id="furnished" name="furnished" type="text"
                                        value="{{$property->furnished}}">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">

                                <label for="status">Status</label>
                                <select class="form-select mb-0" id="status" name="status">

                                    <option value="0" {{($property->status=="0")?"selected":""}}>Publish</option>
                                    <option value="1" {{($property->status=="1")?"selected":""}}>Draft</option>
                                    <option value="2" {{($property->status=="2")?"selected":""}}>Cancel</option>

                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="customer_type">Ad title </label>
                                    <input class="form-control"id="ad_title" name="ad_title" type="text"
                                        value="{{$property->ad_title}}">


                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="status">Ad details </label>
                                    <input class="form-control" id="ad_details" name="ad_details" type="text"
                                        value="{{$property->ad_details}}">

                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="status">address </label>
                                    <input class="form-control" id="address" name="address" type="text"
                                        value="{{$property->address}}">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <div class="form-group">
                                    <label for="features"> features </label>
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
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
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
