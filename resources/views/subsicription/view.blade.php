<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')



        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">

                <h2 class="h4">قائمة المالكـين  </h2>

            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
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
        </div>


        <div class="card card-body shadow border-0 table-wrapper table-responsive">

            <table class="table user-table table-hover align-items-center" id="usersTable">
                <thead>
                    <tr>
                
                        <th class="border-bottom">الأسم</th>
                        <th class="border-bottom">نوع المستخم </th>
                        <th class="border-bottom">رقم الهاتف</th>
                        <th class="border-bottom">الرقم الوطني</th>
        
                        <th class="border-bottom">الحالة</th>
                        <th class="border-bottom">إجرائات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>

                            <td>
                                <a href="#" class="d-flex align-items-center">
                                    <img src="../assets/img/team/profile-picture-1.jpg"
                                        class="avatar rounded-circle me-3" alt="Avatar">
                                    <div class="d-block">
                                        <span class="fw-bold">{{ $client->name }}</span>
                                        <div class="small text-gray">{{ $client->email }}</div>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <span class="fw-normal">
                                  {{$client->customer_type === 'owner' ? 'مـالك' : 'مستخدم'}}
                                </span>
                              </td>                            <td><span
                                    class="fw-normal d-flex align-items-center">{{ $client->country_code . $client->phone }}</span>
                            </td>
                            <td><span
                                    class="fw-normal d-flex align-items-center">{{ $client->nationalty_number }}</span>
                            </td>

                            @if ($client->active == 1)
                                <td><span class="fw-normal text-success">فعال</span></td>
                            @else
                                <td><span class="fw-normal text-danger">غير فعال</span></td>
                            @endif
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
                                            
                                            $response = $permission->checkPermission($userId, 'subsicription', 'view_subsicription');
                                            
                                        @endphp

                                        @if ($response->getStatusCode() === 200)
                                            <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('details_subsicription', ['id' => $client->id]) }}">
                                            
                                            <span class="fas fa-user-shield me-2"></span>
                                                مشاهدة التفاصيل
                                            </a>
                                        @endif
                                        @php
                                            $response = $permission->checkPermission($userId, 'subsicription', 'edit_subsicription');
                                            
                                        @endphp

                                        @if ($response->getStatusCode() === 200)
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('edit_subsicription', ['id' => $client->id]) }}">
                                                <span class="fas fa-user-edit me-2"></span>
                                                تعديل الأشتراكات
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة اشتراك جديد</h5>

                        <button type="button" style="background: none;border: none;" class="close  "
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                    </div>
                    <div class="modal-body" dir="rtl">
                        <form action="{{ route('create_subsicription') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4"">
                                <label for="client_name">اسم العميل </label>
                                <select class="form-select mb-0" id="client_name" name="client_id">
                                    <option disabled="" selected="" value="">اختار اسم العميل</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach

                                </select>

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
        <script>
            $(document).ready(function() {
                var table = new DataTable('#usersTable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json',
    },
});            });
        </script>

        @include('layouts.footer')
    </main>

</x-layouts.base>
