<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')

        <div class="card card-body border-0 shadow mb-4 mb-xl-0">
            <h2 class="h5 mb-4">أبحث عن عقار</h2>
            <div class="row">
                <div class="mb-4 col-md-3">
                    <label class="my-1 me-2" for="country">القســم</label>
                    <select class="form-select" id="section" name="section" aria-label="Default select example">
                        <option disabled selected value="">اختيار قسم </option>

                        <option value="Rent">أيجــار</option>
                        <option value="Sale">بيــع</option>
                    </select>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="form-group">

                        <label class="my-1 me-2" for="sub_section"> قســم ثانوي</label>
                        <select class="form-select mb-0" id="sub_section" name="sub_section">
                            <option disabled selected value=""> اختيار قسم </option>


                            <option value="Apartments">شقق</option>
                            <option value="Villa - Palace">فلل - قصور</option>
                            <option value="Townhouses">منازل المدينة </option>
                            <option value="Lands">أراضي</option>
                            <option value="Commercial">تجاري</option>
                            <option value="Farms & Chalets">مزارع وشاليهات</option>
                            <option value="Whole Building">عمارة كاملة</option>
                            <option value="Foreign Real Estate">عقارات خارجية</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label for="construction_age">عمر البناء </label>
                        <select class="form-select mb-0" id="construction_age" name="construction_age">
                            <option disabled selected value="">اختيار عمر</option>

                            <option value="0-11 months">0-11 شهر</option>
                            <option value="1-5 years">1-5 سنة</option>
                            <option value="6-9 years">6-9 سنة</option>
                            <option value="10-19 years">10-19 سنة</option>
                            <option value="20+ years">20+ سنة</option>
                            <option value="Under Construction">تحت الأنشــاء</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-3">

                    <button class="btn mx-1 me-2 btn-secondary" style="margin-top:12%" id="submitbtn" type="button"><i
                            class="fas fa-search mx-1"></i>بحــث</button>
                </div>
            </div>
            <div class="card card-body shadow border-0 table-wrapper table-responsive">
                <h2 class="h5 mb-4">تفاصيــل العفار</h2>

                <table class="table user-table table-hover align-items-center" id="properties-table">
                    <thead>
                        <tr>

                            <th class="border-bottom">الرقم</th>
                            <th class="border-bottom"> القسم </th>
                            <th class="border-bottom">القسم الثانوي </th>

                            <th class="border-bottom">عمر النــاء </th>
                            <th class="border-bottom">مفروش </th>


                            <th class="border-bottom">الحالة </th>
                            <th class="border-bottom">الســعر </th>

                            <th class="border-bottom">إجرائات </th>
                        </tr>
                    </thead>
                    <tbody></tbody>



            </div>

            <script>
                $(document).ready(function() {
                    // Your code here

                    $("#submitbtn").click(function() {
                        var formData = new FormData();
                        if (document.getElementById("section") != "" || document.getElementById("section").value !=
                            NULL) {
                            formData.append("section", document.getElementById("section").value);
                        }
                        if (document.getElementById("sub_section") != "" || document.getElementById("sub_section")
                            .value != NULL) {
                            formData.append("sub_section", document.getElementById("sub_section").value);
                        }
                        if (document.getElementById("construction_age") != "" || document.getElementById(
                                "construction_age").value != NULL) {
                            formData.append("construction_age", document.getElementById("construction_age").value);

                        }

                        $.ajax({
                            type: "POST",
                            url: "api/getallpropertiesSearch",
                            processData: false,
                            contentType: false,
                            cache: false,
                            data: formData,
                        }).done(function(response) {
                            const subSectionTranslations = {
                                Apartments: 'شقق',
                                'Villa - Palace': 'فلل - قصور',
                                Townhouses: 'منازل المدينة',
                                Lands: 'أراضي',
                                Commercial: 'تجاري',
                                'Farms & Chalets': 'مزارع وشاليهات',
                                'Whole Building': 'عمارة كاملة',
                                'Foreign Real Estate': 'عقارات خارجية'
                            };
                            const constructionAgeTranslations = {
                                '0-11 months': '0-11 شهر',
                                '1-5 years': '1-5 سنة',
                                '6-9 years': '6-9 سنة',
                                '10-19 years': '10-19 سنة',
                                '20+ years': '20+ سنة',
                                'Under Construction': 'تحت الأنشــاء'
                            };

                            // Function to get the translated construction_age value
                            function getTranslatedConstructionAge(constructionAge) {
                                return constructionAgeTranslations[constructionAge] || '';
                            }

                            // Function to get the translated sub_section value
                            function getTranslatedSubSection(subSection) {
                                return subSectionTranslations[subSection] || '';
                            }

                            function getTranslatedFurnishedStatus(furnished) {
                                if (furnished === 'Furnished') {
                                    return 'مفروش';
                                } else if (furnished === 'Semi Furnished') {
                                    return 'شبه مفروش';
                                } else {
                                    return 'غير مفروش';
                                }
                            }
                            if (response["status"] === 200) {
                                var properties = response["data"];
                                // Clear existing table rows
                                $("#properties-table tbody").empty();

                                // Iterate over properties and append to table
                                properties.forEach(function(property) {
                                    var row = `<tr>
                                 <td>${property.id}</td>
                                 <td>
  <span class="fw-normal">
    ${property.section === 'Rent' ? 'ايجار' : 'بيع'}
  </span>
</td>
                                        <td><span class="fw-normal d-flex align-items-center">${getTranslatedSubSection(property.sub_section)}
</span></td>
                                        <td><span class="fw-normal d-flex align-items-center">    ${getTranslatedConstructionAge(property.construction_age)}
</span></td>
                                        <td><span class="fw-normal d-flex align-items-center">    ${getTranslatedFurnishedStatus(property.furnished)}
</span></td>
                              
                                    ${property.status == 0 ? `<td><span class="fw-normal d-flex align-items-center text-warning"مؤرشف</span></td>` :
     property.status == 1 ? `<td><span class="fw-normal d-flex align-items-center text-success">فعال</span></td>` :
     property.status == 2 ? `<td><span class="fw-normal d-flex align-items-center text-danger">محذوف</span></td>` : ''}

                                        <td><span class="fw-normal d-flex align-items-center">${property.price}</span></td>

                                      
                                        <td>
                                            <div class="btn-group">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                    
                                    @php
                                        $userId = auth()->id();
                                        
                                        $response = $permission->checkPermission($userId, 'properties', 'view_property');
                                        
                                    @endphp
  
  @if ($response->getStatusCode() === 200)
                                    <a class="dropdown-item d-flex align-items-center"
                                    href="/properties/view/${property.id}">
                                        <span class="fas fa-box"></span>
                                          مشــاهدة
                                    </a>
                                    @endif
                                    @php
                                        $response = $permission->checkPermission($userId, 'properties', 'edit_property');
                                        
                                    @endphp
 
 @if ($response->getStatusCode() === 200)
                                    <a class="dropdown-item d-flex align-items-center"
                                    href="/properties/edit/${property.id}">
                                        <span class="fas fa-edit"></span>
                                         تعديــل
                                    </a>
                                    @endif
                                    @php
                                        $response = $permission->checkPermission($userId, 'properties', 'delete_property');
                                        
                                    @endphp
 
 @if ($response->getStatusCode() === 200)
                                    <a class="dropdown-item text-danger d-flex align-items-center"
                                        href="/properties/delete/${property.id}">
                                        <span class="fas fa-trash-alt"></span>
                                          حذف
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>`;

                                    $("#properties-table tbody").append(row);
                                });


                                // Initialize DataTable on the updated table
                                var table = new DataTable('#properties-table', {
                                    language: {
                                        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json',
                                    },
                                });
                            }
                        });
                    });
                });
            </script>
    </main>


</x-layouts.base>
