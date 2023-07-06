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
                        <h2 class="h5 mb-4">معلومات عامة</h2>
                        <form action="{{ route('editUser') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <label for="name">الأسم <span class="text-danger">*</span></label>
                                        <input value="{{ old('name', $user->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            type="text" name="name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="country_code">رمز الدولة  <span class="text-danger">*</span></label>
                                        <input class="form-control @error('country_code') is-invalid @enderror"
                                            id="country_code" value="{{ old('country_code', $user->country_code) }}"
                                            type="number" name="country_code" placeholder="+12-345 678 910">
                                        @error('country_code')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="phone">رقم الهاتف <span class="text-danger">*</span></label>
                                        <input class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            value="{{ old('phone', $user->phone) }}" type="number" name="phone"
                                            placeholder="+12-345 678 910">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">الأيميل <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email', $user->email) }}" type="email" name="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ID">الرقم الوطني <span class="text-danger">*</span></label>
                                        <input name="nationalty_number"
                                            class="form-control @error('nationalty_number') is-invalid @enderror"
                                            id="ID" type="text"
                                            value="{{ old('nationalty_number', $user->nationalty_number) }}">
                                        @error('nationalty_number')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="customer_type">نوع العميل <span class="text-danger">*</span></label>
                                        <select name="customer_type"
                                            class="form-select mb-0 @error('customer_type') is-invalid @enderror"
                                            id="customer_type">
                                            <option value="owner"
                                                {{ old('customer_type', $user->customer_type) == 'owner' ? 'selected' : '' }}>
                                                مــالك</option>
                                            <option value="user"
                                                {{ old('customer_type', $user->customer_type) == 'user' ? 'selected' : '' }}>
                                                مستــأجر</option>
                                        </select>
                                        @error('customer_type')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">الحالة <span class="text-danger">*</span></label>
                                        <select class="form-select mb-0 @error('status') is-invalid @enderror"
                                            id="status" name="status">
                                            <option value="0"
                                                {{ old('status', $user->active) == 0 ? 'selected' : '' }}>غير فــعال
                                            </option>
                                            <option value="1"
                                                {{ old('status', $user->active) == 1 ? 'selected' : '' }}>فعـــال
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">حفظ </button>
                                </div>
                        </form>
                    </div>
                    @if ($user->customer_type == 'owner')

                    <div class="card card-body shadow border-0 table-wrapper table-responsive">
                        <h2 class="h5 mb-4">معلومات القعار </h2>

                        <table class="table user-table table-hover align-items-center" id="propertytable">
                            <thead>
                                <tr>

                                    <th class="border-bottom">الرقم</th>
                                    <th class="border-bottom"> القسم </th>
                                    <th class="border-bottom">القسم الثانوي </th>
        
                                    <th class="border-bottom">عمر البنــاء </th>
                                    <th class="border-bottom">مفروش </th>
        
        
                                    <th class="border-bottom">الحالة </th>
                                    <th class="border-bottom">الســعر </th>
                                    <th class="border-bottom">إجرائات </th>


                                </tr>
                            </thead>
                                <tbody>
                                    @php
                                    function getTranslatedConstructionAge($constructionAge) {
                                        $constructionAgeTranslations = [
                                            '0-11 months' => '0-11 شهر',
                                            '1-5 years' => '1-5 سنة',
                                            '6-9 years' => '6-9 سنة',
                                            '10-19 years' => '10-19 سنة',
                                            '20+ years' => '20+ سنة',
                                            'Under Construction' => 'تحت الأنشــاء'
                                        ];
                                    
                                        return $constructionAgeTranslations[$constructionAge] ?? '';
                                    }
                                    
                                    function getTranslatedSubSection($subSection) {
                                        $subSectionTranslations = [
                                            'Apartments' => 'شقق',
                                            'Villa - Palace' => 'فلل - قصور',
                                            'Townhouses' => 'منازل المدينة',
                                            'Lands' => 'أراضي',
                                            'Commercial' => 'تجاري',
                                            'Farms & Chalets' => 'مزارع وشاليهات',
                                            'Whole Building' => 'عمارة كاملة',
                                            'Foreign Real Estate' => 'عقارات خارجية'
                                        ];
                                    
                                        return $subSectionTranslations[$subSection] ?? '';
                                    }
                                    
                                    function getTranslatedFurnishedStatus($furnished) {
                                        if ($furnished === 'Furnished') {
                                            return 'مفروش';
                                        } else if ($furnished === 'Semi Furnished') {
                                            return 'شبه مفروش';
                                        } else {
                                            return 'غير مفروش';
                                        }
                                    }
                                    @endphp
                                    
                                    @foreach ($properties as $property)
                                        <tr>
                                            <td>{{ $property->id }}</td>
                                            <td><span class="fw-normal">{{ $property->section === 'Rent' ? 'ايجار' : 'بيع' }}</span></td>
                                            <td><span class="fw-normal d-flex align-items-center">{{ getTranslatedSubSection($property->sub_section) }}</span></td>
                                            
                                            <td><span class="fw-normal d-flex align-items-center">{{ getTranslatedConstructionAge($property->construction_age) }}</span></td>
                                            <td><span class="fw-normal d-flex align-items-center">{{ getTranslatedFurnishedStatus($property->furnished) }}</span></td>
                                            
                                            @if ($property->status == 1)
                                                <td><span class="fw-normal d-flex align-items-center text-success">فعال</span></td>
                                            @elseif ($property->status == 0)
                                                <td><span class="fw-normal d-flex align-items-center text-warning">مؤرشف</span></td>
                                            @else
                                                <td><span class="fw-normal d-flex align-items-center text-danger">محذوف</span></td>
                                            @endif
                                            
                                            <td><span class="fw-normal d-flex align-items-center">{{ $property->price }}</span></td>
                                       
                                         

                                        <td>

                                            <div class="btn-group">
                                                <button
                                                    class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <svg class="icon icon-xs" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                        </path>
                                                    </svg>
                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                </button>
                                                <div
                                                    class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                                    @php
                                                          $userId = auth()->id();

                                                    $response = $permission->checkPermission($userId, 'properties','view_property');
     
                                                    @endphp
                                                
                                                @if ($response->getStatusCode() === 200)
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ route('properties_view', ['id' => $property->id]) }}">
                                                        <span class="fas fa-box "></span>
                                                        مشاهدة 
                                                    </a>
                                                    @endif
                                                    @php
                                                          $response = $permission->checkPermission($userId, 'properties','edit_property');
     
                                                     @endphp
 
                                                    @if ($response->getStatusCode() === 200)
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ route('properties_edit', ['id' => $property->id]) }}">
                                                        <span class="fas fa-edit"></span>
                                                    تعديل    
                                                    </a>
                                                    @endif
                                                    @php
                                                    $response = $permission->checkPermission($userId, 'properties','delete_property');

                                               @endphp

                                              @if ($response->getStatusCode() === 200)
                                                    <a class="dropdown-item text-danger d-flex align-items-center"  href="{{ route('properties_delete', ['id' => $property->id]) }}">
                                                        <span class="fas fa-trash-alt"></span>
                                                        حذف
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                        <!-- Display other client details -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <br>
                    <br>

                </div>
                <div class="card card-body shadow border-0 table-wrapper table-responsive">
                    <h2 class="h5 mb-4"> Orders</h2>
        
                    <table class="table user-table table-hover align-items-center" id="ordertable">
                        <thead>
                            <tr>
        
                                <th class="border-bottom">الرقم</th>
                                <th class="border-bottom">نوع الطلب </th>
        
        
                                <th class="border-bottom"> الطلب </th>
        {{--                         <th class="border-bottom">description </th>
         --}}                        <th class="border-bottom"> الصورة  </th>
        
                                <th class="border-bottom"> التاريخ </th>
        
                                
                                <th class="border-bottom"> الحالة </th>
        
                                <th class="border-bottom">إجرائات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
        
                                    <td>
                                       {{$item->id}}
                                    </td>
                                    
        
                                    <td>
                                        {{$item->type}}
                                     </td>
                               
                                    <td><span class="fw-normal"></span>{{$item->name}}
                                    </td>
                                {{--     <td>
                                        <span class="fw-normal d-flex align-items-center text-truncate" style="max-width: 150px;">
                                            {{ $item->description }}
                                        </span>
                                   
                                    </td> --}}
                                  
                                        <td>
                                            <div class="d-flex align-items-center">
                                              <img src="{{asset('storage/'.$item->image)}}" class="img-thumbnail" alt="Image Preview">
                                            </div>
                                          </td>
                                
        
                                    <td>
                                        <span class="fw-normal d-flex align-items-center">
                                            {{ $item->created_at->format('Y-m-d') }}
                                        </span>
                                    </td>
                                  
                                   
                                  
                               
                            
                                    @if ($item->status==1)
                                    <td><span class="fw-normal d-flex align-items-center text-success">موافق عليه</span></td>
        
                                        
                                   @elseif ($item->status==0)
                                    <td>
                                        <span class="fw-normal d-flex align-items-center text-warning">قيد الأنتظار</span></td>
        
                                    @else
                                    <td><span class="fw-normal d-flex align-items-center text-danger ">مرفوض</span></td>
        
                                    @endif
                                  
        
        
                                    <td>
        
                                        <div class="btn-group">
                                            <button
                                                class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg class="icon icon-xs" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                    </path>
                                                </svg>
                                                <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <div
                                                class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                                @php
                                                  $userId = auth()->id();
                                                    $response = $permission->checkPermission($userId, 'orders', 'View');
                                                    
                                                @endphp
        
                                                @if ($response->getStatusCode() === 200)
                                                 
                                                <a href="{{ route('details_maintenance_order', ['id' => $item->id]) }}" class="dropdown-item d-flex align-items-center">
                                                    <span class="fas fa-eye" style="color: rgb(4, 81, 145);"></span>
                                                    مشاهدة
                                                </a>
                                                @endif
                                                @php
                                                    
                                                    $response = $permission->checkPermission($userId, 'orders', 'Approve');
                                                    
                                                @endphp
                                                         @if ($item->status==0)

                                                @if ($response->getStatusCode() === 200)
                                                 
                                                     
                                                <a onclick="updateStates({{$item->id}},1)" class="dropdown-item d-flex align-items-center">
                                                    <span class="fas fa-check" style="color: green;"></span>
                                                    موافق
                                                </a>
                                                @endif
                                                @php
                                                    
                                                    $response = $permission->checkPermission($userId, 'orders', 'Reject');
                                                    
                                                @endphp
        
                                                @if ($response->getStatusCode() === 200)
                                                 
                                                <a onclick="updateStates({{$item->id}},2)" class="dropdown-item d-flex align-items-center"
                                                     {{-- href="{{ route('edit_contract', ['id' => $checkRequest->id]) }}" --}}>
                                                     <span class="fas fa-times" style="color: red;"></span>
                                                     رفض
                                                </a>
                                                @endif

                                                @endif
                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Display other client details -->
                                @endforeach
                        </tbody>
                    </table>
                </div>
              
        

            </div>

          
               <script>
                function updateStates(id,status) {
                    let formData=new FormData();
                    formData.append('id',id);
                    formData.append('status',status);
            
                    $.ajax({
                url: '../../api/order/status/update',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
            console.log("true");
                  if (data.status == 200) {
                    Swal.fire({
              title: 'Success',
              text: 'Contract updated successfully',
              icon: 'success',
            }).then(function() {
              location.reload(); // Reload the page
            });
            
            
                } else {
                  Swal.fire('Error', 'Failed to update contract', 'error');
                }
              },
              error: function(error) {
                // Handle the error
                Swal.fire('Error', 'An error occurred', 'error');
              }
              });
            
                }
                 $(document).ready(function() {
                    var table = new DataTable('#propertytable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json',
    },
});
var table2 = new DataTable('#ordertable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json',
    },
});
            });   
                        
            </script>


            {{-- Footer --}}
            @include('layouts.footer')
    </main>

</x-layouts.base>
