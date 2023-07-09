<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <div>
          <br>
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">معلومات عامة</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name"> الأسم</label>
                                        <input disabled value="{{$user->name}}" class="form-control" id="first_name" type="text"
                                            placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="country_code">رمز الدولة </label>
                                        <input class="form-control" id="country_code" value="{{$user->country_code}}" type="number"
                                        disabled  placeholder="+12-345 678 910">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="phone">رقم الهاتف</label>
                                        <input class="form-control" id="phone" value="{{$user->phone}}" type="number"
                                        disabled   placeholder="+12-345 678 910">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">البريد الألكتروني </label>
                                        <input  class="form-control" id="email" value="{{$user->email}}" type="email"
                                            placeholder="name@company.com" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ID">الرقم الوطني</label>
                                        <input class="form-control" disabled id="ID" type="text" value="{{$user->nationalty_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="customer_type">نوع العميل</label>
                                        <select disabled class="form-select mb-0" id="customer_type">
                                    
                                        <option value="owner"{{($user->customer_type=="owner")?"selected":""}}>مــالك</option>
                                        <option value="user" {{($user->customer_type=="user")?"selected":""}}>مـــستخدم</option>
                             
                            
                            </select> </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">الحالة</label>
                                        <select disabled class="form-select mb-0" id="status" name="status">
                                    
                                            <option value="0"{{($user->active=="0")?"selected":""}}>غير فــعال</option>
                                            <option value="1" {{($user->active=="1")?"selected":""}}>فعـــال</option>
                                 
                                
                                </select>                                     </div>
                                </div>
                               
                            </div>
                          
                           
                    
                    </div>
                @if (($user->customer_type == 'owner'))
                    

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
                    <h2 class="h5 mb-4"> معلومات الطلبات</h2>
        
                    <table class="table user-table table-hover align-items-center" id="checkTable">
                        <thead>
                            <tr>
        
                                <th class="border-bottom">الرقم</th>
                                <th class="border-bottom">نوع الطلب </th>
        
        
                                <th class="border-bottom"> الطلب </th>
        {{--                         <th class="border-bottom">description </th>
         --}}                        <th class="border-bottom"> الصورة  </th>
        
                                <th class="border-bottom"> التاريخ </th>
        
                                
                                <th class="border-bottom"> الحالة </th>
        
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
                                  
        
        
                                   
                                </tr>
                                <!-- Display other client details -->
                                @endforeach
                        </tbody>
                    </table>
                </div>
              
        
        </div>

        <script>
            $(document).ready(function() {
           

              var table = new DataTable('#propertytable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json',
    },
});
var table2 = new DataTable('#checkTable', {
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
