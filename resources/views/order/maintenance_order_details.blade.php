<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">تفاصيل الطلب</h2>



            <div class="row">
                    <div class="col-md-3 mb-3">
                        <div>
                            <label for="first_name">نوع الطلب</label>




                            <input disabled value="{{$order->type}}" class="form-control" id="first_name" type="text"
                                placeholder="Enter your first name" required>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for=""> الموضوع</label>
                            <input class="form-control" id="" value="{{$order->name}}" type="text"
                            disabled  >
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="client"> اسم العميل</label>
                            <input  class="form-control" id="client" value="{{$order->client_name}}" type="text"
                             disabled>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="ID">الرقم الوطني</label>
                            <input class="form-control" disabled id="ID" type="text" value="{{$order->client_nationality_number}}">
                        </div>
                    </div>
                 
                </div>
            <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">التفاصيل</label>
                            <textarea rows="5" class="form-control" id="" 
                            disabled   >{{$order->description}}</textarea>
                        </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">الصور</label>
                            <img src="{{asset('storage/'.$order->image)}}" class="img-fluid" alt="...">

                        </div>
                    
                </div>
            </div>
                   
                </div>
              
               
        
        </div>
@include('layouts.footer')
</main>

</x-layouts.base>