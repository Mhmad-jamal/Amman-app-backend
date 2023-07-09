<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 p-3 mt-3">
          <h2 class="h5 mb-4">معلومات المالك</h2>
          <input type="hidden" name="id" value="{{$contract->id}}" >
           <div class="row">
            <div class="col-md-3">
              <label for="owner_name"> الأسم</label>
              <input type="text" disabled class="form-control is-valid" id="owner_name" value="{{$contract->owner_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
           
            <div class="col-md-3">
              <label for="owner_name"> رقم الهاتف</label>
              <input disabled type="text" class="form-control " id="owner_name" value="{{$contract->owner_country_code.'-'.$contract->owner_phone}}" required="">
                
            </div>
            <div class="col-md-3">
              <label for="owner_name">  الرقم الوطني</label>
              <input type="text"  name="user_national_number" class="form-control " id="owner_name" value="{{$contract->owner_nationalty_number}}" disabled required="">
                
            </div>
            <div class="col-md-3  pt-3">

                <a href="{{ route('properties_view', ['id' => $contract->property_id]) }}">
                  <button type="button" class="btn btn-info mt-3" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Click here to see property" data-bs-trigger="hover">
                    مشاهدة  العقار                   </button>
                </a>
            </div>
           </div>
          
        </div>
        <br>
        <br>
        <div class="card card-body shadow border-0 p-3">
          <h2 class="h5 mb-4"> معلومات المستخدم </h2>
          <div class="row">
            <div class="col-md-4">
              <label for="client_name"> الأسم</label>
              <input type="text" class="form-control is-valid" name="client_name" id="client_name" value="{{$contract->client_name}}" required="">
                <div class="valid-feedback">
                    
                </div>  
            </div>
            <div class="col-md-4">
              <label for="client_name"> رقم الهاتف</label>
                <input type="text" class="form-control" name="client_phone" id="client_phone" value="{{$contract->client_phone}}" required="">
                
            </div>
            <div class="col-md-4">
              <label for="client_name">  الرقم الوطني</label>
              <input disabled type="text" name="user_national_number" class="form-control " id="user_national_number" value="{{$contract->user_national_number}}" required="">
                
            </div>
            <div class="col-md-4">
              <label for="guarantor_name">  اسم المعرف</label>
              <input type="text" class="form-control is-valid" name="guarantor_name" id="guarantor_name" value="{{$contract->guarantor_name}}" required="">
              <div class="valid-feedback">
                  
              </div>  
          </div>
          <div class="col-md-4">
            <label for="guarantor_number"> رقم هاتف المعرف</label>
            <input type="text" class="form-control " name="guarantor_number" id="guarantor_number" value="{{$contract->guarantor_number}}" required="">
            <div class="valid-feedback">
                
            </div>  
        </div>
           </div>
          
        </div>
        <br><br>
        <div class="card card-body shadow border-0 p-3">
          <h2 class="h5 mb-4"> معلومات العقد </h2>
          <div class="row">
            <div class="col-md-4">
              <label for="end_date"> تاريخ النهاية</label>
              <input type="date" class="form-control text-end " name="start_date" id="start_date" value="{{$contract->start_date}}" required="">
             
            </div>
            <div class="col-md-4">
              <label for="end_date"> تاريخ النهاية</label>
              <input type="date" class="form-control text-end" id="end_date" name="end_date" value="{{$contract->end_date}}" required="">
                
            </div>
            <div class="col-md-4">
              <label for="textarea"> بنود اضافية </label>
              <textarea name="clause" class="form-control " placeholder="" id="clause" rows="1">{{$contract->clause}}</textarea>
                
            </div>
            <div class="col-md-4">
              <label for="discount">الخصم</label>
              <input type="text" class="form-control" id="discount" name="discount" value="{{$contract->discount}}" required="">
            </div>
            <div class="col-md-4">
              <label for="price">السعر</label>
              <input type="text" class="form-control" id="price" name="price" value="{{$contract->price}}" required="">
            </div>
            <div class="col-md-4">
              <label for="price"> الحالة</label>
              <select class="form-control form-select" id="status" name="status" required>
                <option value="0" {{ $contract->status == 0 ? 'selected' : '' }}>مغلق</option>
                <option value="1" {{ $contract->status == 1 ? 'selected' : '' }}>مفتوح</option>
              </select>
               </div>
           </div>
           @foreach ($contract['payment'] as $key => $item)   
           <div class="row due_dates mt-3">
           
             <div class="col-md-3">
              <label for="date">التاريخ</label>
              <input  type="date" class="form-control" id="date{{$key}}" name="dateFormat" value="{{$item['date']}}" required="">
             </div>
             <div class="col-md-3">
              <label for="amount">القيمة </label>
              <input  type="text" class="form-control" id="amount{{$key}}" name="amount" value="{{$item['amount']}}" required="">
             </div>
             <input type="hidden" name="payment_id[]" value="{{$item['id']}}">
             <div class="col-md-3">

              <label for="Status">الحالة</label>
              <br>
             <label style="margin-left: 10px" class="mt-2">
              <input  type="checkbox" name="Paymentstatus" data-id="{{$item["id"]}}" {{ ($item["status"] == 1 ? 'checked' : '') }}>
              مدفوع
          </label>
             </div>
             

          
         
           </div>
        @endforeach

         <div id="due_date">

         </div>
<div class="row">
    <div class="col-md-3">
        <button type="button" class="btn btn-primary mt-3" id="add-due-date">  اضافة تاريخ الاستحقاق</button>

    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 d-flex justify-content-center">
      <button type="button" class="btn btn-tertiary mt-3" id="saveButton">حفظ</button>
    </div>
  </div>
        </div>

<script>
     $(document).ready(function() {
     
        $('#add-due-date').click(function() {
  $("#due_date").append(`
  <div class="row due_dates">
    <div class="col-md-3">
        <label for="dateFormat"> التاريخ</label>
        <input type="date" class="form-control "  name="dateFormat" value="" required="">
    </div>
    <div class="col-md-3">
        <label for="amount"> القيمة</label>
        <input type="text" class="form-control" name="amount" value="" required="">
    </div>
</div> 
  `);
    });
 

    $('#saveButton').on('click', function() {
      
  var formData = new FormData();
  $(':input:not(:disabled)').each(function() {

    if ($(this).attr('name') !== 'dateFormat' && $(this).attr('name') !== 'amount' && $(this).attr('name') !== 'Paymentstatus') {

      formData.append($(this).attr('name'), $(this).val());
    }
  });



  var due_dates = [];
  $('.due_dates').each(function() {
    var dateFormat = $(this).find('input[name="dateFormat"]').val();
    var amount = $(this).find('input[name="amount"]').val();
    var paymentIdInput = $(this).find('input[name="payment_id[]"]');
    var paymentId = paymentIdInput.length > 0 ? paymentIdInput.val() : 0;
    if (dateFormat !== '' && amount !== '') {
      due_dates.push({
        'dateFormat': dateFormat,
        'amount': amount,
        'payment_id': paymentId
      });
    }
  });

  var json = JSON.stringify(due_dates);


formData.append('due_dates', json);

for (const [key, value] of formData.entries()) {
    console.log(`${key}: ${value}`);
  }


  // Send the data to the server
  $.ajax({
    url: '../../api/contract/update',
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
      console.log(data);
      if (data.status == 200) {
        Swal.fire({
          title: 'تم بنجاح',
text: 'تم تحديث العقد بنجاح',
icon: 'success',
}).then(function() {
  location.reload(); // Reload the page
});


    } else {
      Swal.fire('خطأ', 'فشل تحديث العقد', 'error');




}
  },
  error: function(error) {
    // Handle the error
    Swal.fire('خطأ', 'حدث خطأ', 'error');




}
  });
    });
  
   // Get all checkboxes with the name attribute "status"

// Iterate through each checkbox
// Get all checkboxes with the name attribute "status"
const checkboxes = document.querySelectorAll('input[name="Paymentstatus"]');

// Iterate through each checkbox
checkboxes.forEach(checkbox => {
  // Retrieve the data-id attribute value
  const dataId = checkbox.dataset.id;

  // Add onclick event listener
  checkbox.addEventListener('click', () => {
    const value = checkbox.checked ? 1 : 0;
    console.log('Clicked checkbox data-id:', dataId);
    console.log('Checkbox value:', value);
    let formData=new FormData();
    formData.append('id',dataId);
    formData.append('status',value);

    $.ajax({
    url: '../../api/payment/update/status',
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
      console.log(data);
      if (data.status == 200) {
        Swal.fire({
          title: 'تم بنجاح',
text: 'تم تحديث الدفعة بنجاح',
icon: 'success',





}).then(function() {
  location.reload(); // Reload the page
});


    } else {
      Swal.fire('خطأ', 'فشل تحديث الدفعة', 'error');




}
  },
  error: function(error) {
    // Handle the error
    Swal.fire('خطأ', 'حدث خطأ', 'error');




}
  });
  });
});


});

</script>
@include('layouts.footer')
</main>

</x-layouts.base>