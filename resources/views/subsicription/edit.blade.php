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
         
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

</x-layouts.base>