<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       <div class="row">
        <div class="col-md-12">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">General information</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name"> Name</label>
                                <input disabled value="{{$user->name}}" class="form-control" id="first_name" type="text"
                                    placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="country_code">Country code</label>
                                <input class="form-control" id="country_code" value="{{$user->country_code}}" type="number"
                                disabled  placeholder="+12-345 678 910">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" value="{{$user->phone}}" type="number"
                                disabled   placeholder="+12-345 678 910">
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
                                <input class="form-control" disabled id="ID" type="text" value="{{$user->nationalty_number}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="customer_type">Customer type</label>
                                <select disabled class="form-select mb-0" id="customer_type">
                            
                                <option value="owner"{{($user->customer_type=="owner")?"selected":""}}>owner</option>
                                <option value="user" {{($user->customer_type=="user")?"selected":""}}>user</option>
                     
                    
                    </select> </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select disabled class="form-select mb-0" id="status" name="status">
                            
                                    <option value="0"{{($user->active=="0")?"selected":""}}>Inactive</option>
                                    <option value="1" {{($user->active=="1")?"selected":""}}>Active</option>
                         
                        
                        </select>                                     </div>
                        </div>
                       
                    </div>
                  
                   
            
            </div>
        </div>
      
        <div class="card card-body border-0 shadow mb-4">
            <div class="btn-toolbar mb-2 mb-md-0 d-flex justify-content-end">
                <button href="#" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center" data-toggle="modal"
                    data-target="#exampleModal">
                    اضافة اشتراك جديد
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                </button>
    
    
            </div>
            <h2 class="h5 mb-4 text-center mb-5">جميع الأشتراكات</h2>

            @foreach ($subscriptions as $subscription )
                <form action="{{route('update_subsicription')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$subscription->id}}">
        <div class="row" dir="rtl">
            <div class="col-md-1" >
                <label for="start_date">الرقم   </label>
                <div class="input-group">
                    {{$subscription->id}}
                </div>
            </div>
                   <div class="col-md-3" >
                                <label for="start_date">تاريخ البداية </label>
                                <div class="input-group">
                                    <input  type="date" class="form-control text-end" id="start_date" name="start_date"
                                        value="{{$subscription->start_date}}" required="">
                                </div>
                            </div>
                  
                    <div class="col-md-3 " >
                        <label for="end_date">تاريخ النهاية</label>
                        <div class="input-group">
                            <input  type="date" class="form-control text-end" id="end_date" name="end_date"
                                value="{{$subscription->end_date}}" required="">
                        </div>
                    </div>
                    <div class="col-md-2" >
                        <label for="end_date">القيمة </label>
                        <div class="input-group">
                            <input  type="text" class="form-control" id="payment_amount" name="payment_amount" value="{{$subscription->payment_amount}}" required="">
                        </div>
                    </div>
          <div class="col-md-2 mt-3 d-flex">
            <button  type="submit" class="btn btn-primary edit-btn mt-3 "><i class="fas fa-pencil-alt"></i></button>
          </form>
          @php
          $userId = auth()->id();
          
          $response = $permission->checkPermission($userId, 'subsicription', 'delete_subsicription');
          
      @endphp
        @if ($response->getStatusCode() === 200)

            <form  action="{{route('delete_subsicription')}}" method="POST">
                @csrf
            <input type="hidden" name="id" value="{{$subscription->id}}">
            <button type="submit" class="btn btn-danger delete-btn mt-3 " style=" margin-right: 10px;"><i class="fas fa-trash-alt"></i></button>

            </form>
            @endif
          </div>
            </div>
            <hr>
            @endforeach

        </div>
       </div>
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       style="display: none;" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" style="background: none;border: none;" class="close  "
                       data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
                   <h5 class="modal-title" id="exampleModalLabel">اضافة اشتراك جديد</h5>

               </div>
               <div class="modal-body" dir="rtl">
                   <form action="{{ route('create_subsicription') }}" method="POST">
                       @csrf
                       <div class="form-group mb-4"">
                           <label for="client_name">اسم العميل </label>
                           <select disabled class="form-select mb-0" id="client_name" >
                               <option disabled="" selected="" value="">اختار اسم العميل</option>
                                   <option  selected value="{{ $user->id }}">{{ $user->name }}</option>

                           </select>
<input type="hidden" name="client_id" value="{{$user->id}}">
                       </div>


                       <!-- End of Form -->
                       <!-- Form -->
                       <div class="form-group mb-4">
                           <label for="start_date">تاريخ البداية </label>
                           <div class="input-group">
                               <input type="date" class="form-control" id="start_date" name="start_date"
                                   value="" required="">
                           </div>
                       </div>

                       <div class="form-group mb-4">
                           <label for="end_date">تاريخ النهاية</label>
                           <div class="input-group">
                               <input type="date" class="form-control" id="end_date" name="end_date"
                                   value="" required="">
                           </div>
                       </div>
                       <div class="form-group mb-4">
                           <label for="end_date">القيمة </label>
                           <div class="input-group">
                               <input type="text" class="form-control" id="payment_amount"
                                   name="payment_amount" value="" required="">
                           </div>
                       </div>






               </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق </button>
                   <button type="submit" class="btn btn-primary">حفــظ</button>
               </div>

               </form>
           </div>
       </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

</x-layouts.base>