<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')


        <div class="card card-body shadow border-0 table-wrapper table-responsive">
            <h2 class="h5 mb-4">معلومات العقد</h2>




            <table class="table user-table table-hover align-items-center" id="propertytable">
                <thead>
                    <tr>
                        <th class="border-bottom">الرقم </th>
                        <th class="border-bottom">اسم المالك</th>
                        <th class="border-bottom">اسم العميل</th>
                        
                        <th class="border-bottom">تاريخ البدء</th>
                        <th class="border-bottom">تاريخ الانتهاء</th>
                        
                        <th class="border-bottom">هاتف المالك</th>
                        <th class="border-bottom">هاتف العميل</th>
                        <th class="border-bottom">الحالة</th>
                        
                        <th class="border-bottom">إجرائات</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $contract)
                        <tr>

                            <td>
                                {{ $contract->id }}
                            </td>
                            <td><span class="fw-normal"></span>{{ $contract->owner_name }}
                            </td>
                            <td><span class="fw-normal d-flex align-items-center">{{ $contract->client_name }}</span>
                            </td>


                            <td><span class="fw-normal d-flex align-items-center">{{ $contract->start_date }}</span>
                            </td>
                            <td><span class="fw-normal d-flex align-items-center">{{ $contract->end_date }}</span>
                            </td>
                            <td><span
                                    class="fw-normal d-flex align-items-center">{{ $contract->owner_country_code . '-' . $contract->owner_phone }}</span>
                            </td>
                            <td><span class="fw-normal d-flex align-items-center">{{ $contract->client_phone }}</span>
                            </td>

                            @if ($contract->status == 1)
                                <td><span class="fw-normal d-flex align-items-center text-success">فعــال</span></td>
                            @elseif ($contract->status == 0)
                                <td><span class="fw-normal d-flex align-items-center text-warining">غير فــعال</span></td>
                            @else
                                <td><span class="fw-normal d-flex align-items-center text-danger ">محذوف</span></td>
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
                                            
                                            $response = $permission->checkPermission($userId, 'all_contract_page', 'view_contract');
                                            
                                        @endphp

                                        @if ($response->getStatusCode() === 200)
                                           
                                        <a class="dropdown-item d-flex align-items-center"
                                            href=" {{ route('details_contract', ['id' => $contract->id]) }} ">
                                            <span class="fas fa-box "></span>
                                            مشاهدة
                                        </a>
                                        @endif
                                        @php
                                            
                                            $response = $permission->checkPermission($userId, 'all_contract_page', 'edit_contract');
                                            
                                        @endphp

                                        @if ($response->getStatusCode() === 200)
                                           
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('edit_contract', ['id' => $contract->id]) }}">
                                            <span class="fas fa-edit"></span>
                                           تعديل
                                        </a>
                                        @endif
                                        @php
                                            
                                            $response = $permission->checkPermission($userId, 'all_contract_page', 'delete_contract');
                                            
                                        @endphp

                                       {{--  @if ($response->getStatusCode() === 200)
                                           
                                        <a class="dropdown-item text-danger d-flex align-items-center"
                                            href="{{-- {{ route('Contracts_delete', ['id' => $Contract->id]) }} ">
                                            <span class="fas fa-trash-alt"></span>
                                           حذف
                                        </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Display other client details -->
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                var table = new DataTable('#propertytable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json',
    },
});
            });
        </script>
        @include('layouts.footer')
    </main>

</x-layouts.base>
