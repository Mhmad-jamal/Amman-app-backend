<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 p-3 mt-3">
            <h2 class="h5 mb-4"> Owner Information </h2>
            <input type="hidden" name="id" value="{{$contract->id}}" >
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
                <input type="text" class="form-control is-valid" name="client_name" id="client_name" value="{{$contract->client_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
            <div class="col-md-4">
                <label for="client_phone">Phone</label>
                <input type="text" class="form-control" name="client_phone" id="client_phone" value="{{$contract->client_phone}}" required="">
                
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
          @php
          
          $due_date= json_decode($contract->due_dates);
                @endphp
           @foreach ( $due_date as $key => $item)
           <div class="row due_dates">
             <div class="col-md-3">
               <label for="dateFormat">Date</label>
               <input type="date" class="form-control" id="dateFormat{{$key}}" name="dateFormat" value="{{$item->dateFormat}}" required="">
             </div>
             <div class="col-md-3">
               <label for="amount">amount</label>
               <input type="text" class="form-control" id="amount{{$key}}" name="amount" value="{{$item->amount}}" required="">
             </div>
           </div>
         @endforeach
         <div id="due_date">

         </div>
<div class="row">
    <div class="col-md-3">
        <button type="button" class="btn btn-primary mt-3" id="add-due-date">Add Due Date</button>

    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 d-flex justify-content-center">
      <button type="button" class="btn btn-tertiary mt-3" id="saveButton">Save</button>
    </div>
  </div>
        </div>

<script>
     $(document).ready(function() {
        $('#add-due-date').click(function() {
  $("#due_date").append(`
  <div class="row due_dates">
    <div class="col-md-3">
        <label for="dateFormat"> Date</label>
        <input type="date" class="form-control "  name="dateFormat" value="" required="">
    </div>
    <div class="col-md-3">
        <label for="amount"> amount</label>
        <input type="text" class="form-control" name="amount" value="" required="">
    </div>
</div> 
  `);
    });
 
              $('#propertytable').DataTable();
           
    $('#saveButton').on('click', function() {
        var formData = new FormData();
  $(':input:not(:disabled)').each(function() {
    if($(this).attr('name')!= "dateFormat"|| ($(this).attr('name')!= "amount")){
    formData.append($(this).attr('name'), $(this).val());
    }
  });
  var due_dates = [];
$('.due_dates').each(function() {
  var dateFormat = $(this).find('input[name="dateFormat"]').val();
  var amount = $(this).find('input[name="amount"]').val();
  if(dateFormat !="" && amount !=""){

  
  due_dates.push({
    'dateFormat': dateFormat,
    'amount': amount
  });
}
});
var json = JSON.stringify(due_dates);
formData.append('due_dates', json);

for (var entry of formData.entries()) {
  console.log(entry[0], entry[1]);
}


  // Send the data to the server
  $.ajax({
    url: '../../api/cotnract/update',
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
      console.log(data.status);
      if (data.status == 200) {
      Swal.fire('Success', 'Contract updated successfully', 'success');
    } else {
      Swal.fire('Error', 'Failed to update contract', 'error');
    }
  },
  error: function(error) {
    // Handle the error
    Swal.fire('Error', 'An error occurred', 'error');
  }
  });
    });
});

</script>
@include('layouts.footer')
</main>

</x-layouts.base>