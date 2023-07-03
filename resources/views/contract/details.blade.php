<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 p-3 mt-3">
            <h2 class="h5 mb-4"> Owner Information </h2>
            <input  disabled type="hidden" name="id" value="{{$contract->id}}" >
           <div class="row">
            <div class="col-md-3">
                <label for="owner_name"> name</label>
                <input   type="text" disabled class="form-control is-valid" id="owner_name" value="{{$contract->owner_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
           
            <div class="col-md-3">
                <label for="owner_name"> Phone</label>
                <input  disabled  type="text" class="form-control " id="owner_name" value="{{$contract->owner_country_code.'-'.$contract->owner_phone}}" required="">
                
            </div>
            <div class="col-md-3">
                <label for="owner_name"> Nationality ID</label>
                <input  disabled type="text"  name="user_national_number" class="form-control " id="owner_name" value="{{$contract->owner_nationalty_number}}" disabled required="">
                
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
                <input  disabled type="text" class="form-control is-valid" name="client_name" id="client_name" value="{{$contract->client_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
            <div class="col-md-4">
                <label for="client_phone">Phone</label>
                <input  disabled type="text" class="form-control" name="client_phone" id="client_phone" value="{{$contract->client_phone}}" required="">
                
            </div>
            <div class="col-md-4">
                <label for="user_national_number"> Nationality ID</label>
                <input  disabled type="text" name="user_national_number" class="form-control " id="user_national_number" value="{{$contract->user_national_number}}" required="">
                
            </div>
            
       
           <div class="col-md-4">
            <label for="client_name"> Guarantor Name</label>
            <input type="text" disabled class="form-control is-valid" name="client_name" id="client_name" value="{{$contract->guarantor_name}}" required="">
            <div class="valid-feedback">
                
            </div>  
        </div>
        <div class="col-md-4">
          <label for="client_name"> Guarantor Phone</label>
          <input type="text" disabled class="form-control " name="client_name" id="client_name" value="{{$contract->guarantor_number}}" required="">
          <div class="valid-feedback">
              
          </div>  
        </div>
        </div>
        <br><br>
        <div class="card card-body shadow border-0 p-3">
            <h2 class="h5 mb-4">Contract Information </h2>
           <div class="row">
            <div class="col-md-4">
                <label for="start_date"> Start Date</label>
                <input  disabled type="date" class="form-control " name="start_date" id="start_date" value="{{$contract->start_date}}" required="">
             
            </div>
            <div class="col-md-4">
                <label for="end_date"> End Date</label>
                <input  disabled type="date" class="form-control " id="end_date" name="end_date" value="{{$contract->end_date}}" required="">
                
            </div>
            <div class="col-md-4">
                    <label for="textarea">Additional Clause </label>
                    <textarea disabled name="clause" class="form-control" placeholder="" id="clause" rows="1">{{$contract->clause}}</textarea>
                
            </div>
            <div class="col-md-4">
                <label for="discount">Discount</label>
                <input  disabled type="text" class="form-control" id="discount" name="discount" value="{{$contract->discount}}" required="">
            </div>
            <div class="col-md-4">
                <label for="price">price</label>
                <input  disabled type="text" class="form-control" id="price" name="price" value="{{$contract->price}}" required="">
            </div>
            <div class="col-md-4">
                <label for="price">Contract Status</label>
                <select disabled class="form-control form-select" id="status" name="status" required>
                  <option value="0" {{ $contract->status == 0 ? 'selected' : '' }}>مغلق</option>
                  <option value="1" {{ $contract->status == 1 ? 'selected' : '' }}>مفتوح</option>
                </select>
                          </div>
           </div>
           @foreach ( $contract['payment'] as $key => $item)   
           <div class="row due_dates">
             <div class="col-md-3">
               <label for="date">Date</label>
               <input  disabled type="date" class="form-control" id="date{{$key}}" name="date" value="{{$item["date"]}}" required="">
             </div>
             <div class="col-md-3">
               <label for="amount">amount</label>
               <input  disabled type="text" class="form-control" id="amount{{$key}}" name="amount" value="{{$item["amount"]}}" required="">
             </div>
             <div class="col-md-3">

                <label for="Status">Status</label>
                <br>
                <label style="margin-left: 10px" class="mt-2">
                 <input disabled  type="checkbox" name="Paymentstatus" data-id="{{$item["id"]}}" {{ ($item["status"] == 1 ? 'checked' : '') }}>
                 Payed
             </label>
                </div>
           </div>
         @endforeach 
         <div id="due_date">

         </div>


        </div>

<script>
</script>
@include('layouts.footer')
</main>

</x-layouts.base>