<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 p-3 mt-3">
            <h2 class="h5 mb-4"> Owner Information </h2>
           <div class="row">
            <div class="col-md-3">
                <label for="owner_name"> name</label>
                <input type="text" disabled class="form-control is-valid" id="owner_name" value="{{$contract->owner_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
           
            <div class="col-md-3">
                <label for="owner_name"> Phone</label>
                <input disabled type="text" class="form-control " id="owner_name" value="{{$contract->owner_country_code.'-'.$contract->owner_phone}}" required="">
                
            </div>
            <div class="col-md-3">
                <label for="owner_name"> Nationality ID</label>
                <input type="text"  name="user_national_number" class="form-control " id="owner_name" value="{{$contract->owner_nationalty_number}}" disabled required="">
                
            </div>
            <div class="col-md-3  pt-3">

                <a href="{{ route('properties_view', ['id' => $contract->property_id]) }}">
                    <button type="button" class="btn btn-info mt-3" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Click here to see property" data-bs-trigger="hover">
                        View the property
                    </button>
                </a>
            </div>
           </div>
          
        </div>
        <br>
        <br>
        <div class="card card-body shadow border-0 p-3">
            <h2 class="h5 mb-4">Client Information </h2>
           <div class="row">
            <div class="col-md-4">
                <label for="client_name"> Name</label>
                <input type="text" class="form-control is-valid" id="client_name" value="{{$contract->client_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
            <div class="col-md-4">
                <label for="client_phone">Phone</label>
                <input type="text" class="form-control " id="client_phone" value="{{$contract->client_phone}}" required="">
                
            </div>
            <div class="col-md-4">
                <label for="user_national_number"> Nationality ID</label>
                <input disabled type="text" name="user_national_number" class="form-control " id="user_national_number" value="{{$contract->user_national_number}}" required="">
                
            </div>
            
           </div>
          
        </div>
        <br><br>
        <div class="card card-body shadow border-0 p-3">
            <h2 class="h5 mb-4">Contract Information </h2>
           <div class="row">
            <div class="col-md-4">
                <label for="start_date"> Start Date</label>
                <input type="date" class="form-control " name="start_date" id="start_date" value="{{$contract->start_date}}" required="">
             
            </div>
            <div class="col-md-4">
                <label for="end_date"> End Date</label>
                <input type="date" class="form-control " id="end_date" name="end_date" value="{{$contract->end_date}}" required="">
                
            </div>
            <div class="col-md-4">
                    <label for="textarea">Additional Clause </label>
                    <textarea name="clause" class="form-control" placeholder="" id="clause" rows="1">{{$contract->clause}}</textarea>
                
            </div>
            <div class="col-md-4">
                <label for="discount">Discount</label>
                <input type="text" class="form-control" id="discount" name="discount" value="{{$contract->discount}}" required="">
            </div>
            <div class="col-md-4">
                <label for="price">price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{$contract->price}}" required="">
            </div>
           </div>
          
         @foreach ($contract->due_dates as $item)
      
<div class="row">
    <div class="col-md-3">
        <label for="dateFormat"> Date</label>
        <input type="date" class="form-control " id="dateFormat" name="dateFormat" value="{{$item["dateFormat"]}}" required="">
    </div>
    <div class="col-md-3">
        <label for="amount"> amount</label>
        <input type="text" class="form-control " id="amount" name="amount" value="{{$item["amount"]}}" required="">
    </div>
</div> 
         
             
         @endforeach

        </div>

<script>
     $(document).ready(function() {
              $('#propertytable').DataTable();
            });
</script>
@include('layouts.footer')
</main>

</x-layouts.base>