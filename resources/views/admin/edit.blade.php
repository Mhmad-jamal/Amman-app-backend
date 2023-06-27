<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <div>
   
            <div class="row mt-5">
                <div class="col-12 col-xl-8">
                   
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">General information</h2>
                        <form  action="{{route('Admin_update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name">First Name</label>
                                        <input name="first_name" class="form-control" id="first_name" type="text"
                                            value="{{$user->first_name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="last_name">Last Name</label>
                                        <input name="last_name" class="form-control" id="last_name" type="text"
                                            value="{{$user->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" class="form-control" id="email" type="email"
                                           value="{{$user->email}}" >
                                    </div>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-select mb-0" id="gender"
                                        aria-label="Gender select example">
                                        <option >Choose...</option>
                                        
                                        <option {{ $user->gender == "Female" ? "selected" : "" }} value="Female">Female</option>
                                        <option {{ $user->gender == "Male" ? "selected" : "" }} value="Male">Male</option>

                                    </select>
                                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <h2 class="h5 my-4">Location</h2>
                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input value="{{$user->address}}" name="address" class="form-control" id="address" type="text">
                                    </div>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="form-group">
                                        <label for="number">Number</label>
                                        <input name="number" class="form-control" id="number" type="number"
                                       value="{{$user->number}}"     placeholder="No.">
                                    </div>
                                    @error('number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input name="city" value="{{$user->city}}" class="form-control" id="city" type="text"
                                           >
                                    </div>
                                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input value="{{$user->ZIP}}" name="ZIP" class="form-control" id="zip" type="tel" placeholder="ZIP">
                                    </div>
                                </div>
                                @error('ZIP') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                            </div>
                        </form>
                      
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card shadow border-0 text-center p-0">
                                <div wire:ignore.self class="profile-cover rounded-top"
                                    data-background="../assets/img/profile-cover.jpg"></div>
                                <div class="card-body pb-5">
                                    @if ($user->gender=="Female")
                                        
                                    <img src="../../../assets/img/team/download.png" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
        
        
                                        
                                    @else
                                    <img src="../../../assets/img/team/man-with-beard-avatar-character-isolated-icon-free-vector.jpg" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
        
        
                                    @endif
        
                                    <h4 class="h3">
                                        {{  $user->first_name ? $user->first_name . ' ' . $user->last_name : 'User Name'}}
                                    </h4>
                                    <h6>{{$user->created_at}}</h6>
                                    <h5 class="fw-normal"></h5>
                                    <p class="text-gray mb-4"></p>
                                    <a class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                                        </svg>
                                        Change Password
                                    </a>
                                    <!-- Modal -->
        
                                </div>
                                <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{route('Admin_edit_Password')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                               
                                                    <div class="mb-3">
                                                        <label for="new_password" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="new_password" placeholder="Enter new password" name="new_password">
                                                    </div>
                                                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <select id="Page" data-select2-id="select2-data-Page" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true"> <option data-select2-id="select2-data-2-lz0y"></option>
                <option value="dashboardActive" data-id=" Dashboard"> Dashboard</option>
                
                <option value="CarExpectedBackActive" data-id="  Car Expected Back">  Car Expected Back</option>
                
                <option value="AvailableCar" data-id=" Available Car"> Available Car</option>
                
                <option value="customersActive" data-id=" Customers"> Customers</option>
                
                <option value="customerStatementActive" data-id=" Customer Statement Report"> Customer Statement Report</option>
                
                <option value="renteredVehiclesActive" data-id=" Reservation Cars"> Reservation Cars</option>
                
                <option value="carReservationReportActive" data-id=" Report of Car Reservation"> Report of Car Reservation</option>
                
                <option value="ordersActive" data-id=" On Hold Orders"> On Hold Orders</option>
                
                <option value="bookingsActive" data-id=" Bookings"> Bookings</option>
                
                <option value="ReportbookingsActive" data-id=" Rebort Bookings"> Rebort Bookings</option>
                
                <option value="manaVestActive" data-id=" Mana Vest"> Mana Vest</option>
                
                <option value="contractsActive" data-id=" Rental Car"> Rental Car</option>
                
                <option value="trafficViolationActive" data-id=" Traffic Violations"> Traffic Violations</option>
                
                <option value="extraMoneyActive" data-id=" Extra Money"> Extra Money</option>
                
                <option value="gasolineActive" data-id=" Gasoline"> Gasoline</option>
                
                <option value="reportgasolineActive" data-id=" report_gasoline"> report_gasoline</option>
                
                <option value="transportationContractsActive" data-id=" Transportations"> Transportations</option>
                
                <option value="contract_report" data-id="Contracts Report">Contracts Report</option>
                
                <option value="banksActive" data-id=" Banks"> Banks</option>
                
                <option value="paymentsActive" data-id=" Payments"> Payments</option>
                
                <option value="reportpaymentActive" data-id=" Payments Report"> Payments Report</option>
                
                <option value="vehiclesActive" data-id=" Car Rental Prices Customer"> Car Rental Prices Customer</option>
                
                <option value="transportationActive" data-id=" Customer Transportation Prices"> Customer Transportation Prices</option>
                
                <option value="companyRentalActive" data-id=" Car Rental Prices Company"> Car Rental Prices Company</option>
                
                <option value="VehicleFullDayActive" data-id="  Prices Company Full Day">  Prices Company Full Day</option>
                
                <option value="transportationCompany" data-id="  Company Transportation Price">  Company Transportation Price</option>
                
                <option value="externalVehiclesActive" data-id=" External Vehicles"> External Vehicles</option>
                
                <option value="employeesActive" data-id=" Employees"> Employees</option>
                
                <option value="companiesActive" data-id=" Companies"> Companies</option>
                
                <option value="customerVehiclesActive" data-id=" Vehicles"> Vehicles</option>
                
                <option value="vehiclesReportActive" data-id=" Vehicles Report"> Vehicles Report</option>
                
                <option value="pushNotificationsActive" data-id=" Push Notifications"> Push Notifications</option>
                
                <option value="offersActive" data-id=" Offers"> Offers</option>
                
                <option value="usersActive" data-id=" Users"> Users</option>
                
                <option value="accountsTreeActive" data-id=" Accounting Tree"> Accounting Tree</option>
                
                <option value="registrationDeedActive" data-id=" Registration Deed"> Registration Deed</option>
                
                <option value="costCentersActive" data-id=" Cost Centers"> Cost Centers</option>
                
                <option value="purchasingActive" data-id="Purchasing">Purchasing</option>
                
                <option value="purchasing_fund_lyonActive" data-id="Purchasing lyon">Purchasing lyon</option>
                
                <option value="purchasing_fund_lyon_rentalActive" data-id="Purchasing lyon Rental">Purchasing lyon Rental</option>
                
                <option value="purchasing_fund_marvelActive" data-id="Purchasing marvel">Purchasing marvel</option>
                
                <option value="ProcurementsActiove" data-id="Procurements">Procurements</option>
                
                <option value="Procurements_lyonActive" data-id="Procurements lyon">Procurements lyon</option>
                
                <option value="Procurements_lyon_rentalActive" data-id="Procurements lyon Rental">Procurements lyon Rental</option>
                
                <option value="Procurements_marvelActive" data-id="Procurements marvel">Procurements marvel</option>
                
                <option value="CheckActive" data-id="Check">Check</option>
                
                <option value="Check_lyonAtive" data-id="Check lyon">Check lyon</option>
                
                <option value="Check_lyon_RentalActive" data-id="Check lyon Rental">Check lyon Rental</option>
                
                <option value="Check_MarvellActive" data-id="Check Marvell">Check Marvell</option>
                </select>
        </div>
        
          
        <div id="action"></div>
        <script>
            allPage=([
    {
        "page": " Dashboard",
        "pageId": "dashboardActive",
        "action": {
            "Show": 1,
            "Available_Vehicles_Table": 1,
            "Rental_Car_Contracts_Table": 1,
            "Transportaion_Contracts_Table": 1,
            "Renewal_Table": 1
        }
    },
    {
        "page": "  Car Expected Back",
        "pageId": "CarExpectedBackActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Available Car",
        "pageId": "AvailableCar",
        "action": {
            "Show": 1,
            "Available_Vehicles_Report": 1,
            "Car_Location_Table": 1,
            "Car_Location_Transform": 0
        }
    },
    {
        "page": " Customers",
        "pageId": "customersActive",
        "action": {
            "Show": 1,
            "Add_New_Customer": 0,
            "Show_Customer_Table": 1,
            "Customer_Table_View": 0,
            "Customer_Table_Edit": 0
        }
    },
    {
        "page": " Customer Statement Report",
        "pageId": "customerStatementActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Reservation Cars",
        "pageId": "renteredVehiclesActive",
        "action": {
            "Show": 1,
            "Show_Reservation_Table": 1,
            "View_Reservation_Table": 1,
            "Edit_Reservation_Table": 0,
            "Delete_Reservation_Table": 0
        }
    },
    {
        "page": " Report of Car Reservation",
        "pageId": "carReservationReportActive",
        "action": {
            "Show": 1,
            "edit": 0,
            "delete": 0
        }
    },
    {
        "page": " On Hold Orders",
        "pageId": "ordersActive",
        "action": {
            "Show": 0,
            "Show_Orders_Table": 0,
            "View_Orders_Table": 0,
            "Approve_Orders_Table": 0,
            "Delete_Orders_Table": 0
        }
    },
    {
        "page": " Bookings",
        "pageId": "bookingsActive",
        "action": {
            "Show": 0,
            "Show_Bookings_Table": 0,
            "Details_Orders_Table": 0,
            "Relay_Orders_Table": 0,
            "Delete_Orders_Table": 0
        }
    },
    {
        "page": " Rebort Bookings",
        "pageId": "ReportbookingsActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Mana Vest",
        "pageId": "manaVestActive",
        "action": {
            "Show": 0
        }
    },
    {
        "page": " Rental Car",
        "pageId": "contractsActive",
        "action": {
            "Show": 1,
            "View_Rental_Table": 1,
            "Details_Rental_Table": 1,
            "Edit_Rental_Table": 0,
            "View_Contract_Invoice_Rental_Table": 1,
            "Send_ByEmail_Rental_Table": 0,
            "Send_ByWhatsApp_Rental_Table": 0
        }
    },
    {
        "page": " Traffic Violations",
        "pageId": "trafficViolationActive",
        "action": {
            "Show": 1,
            "View_Traffic_Violations_Table": 1,
            "Add_Traffic_Violations_Table": 0,
            "Details_Traffic_Violations_Table": 1,
            "Edit_Traffic_Violations_Table": 0,
            "Delete_Traffic_Violations_Table": 0
        }
    },
    {
        "page": " Extra Money",
        "pageId": "extraMoneyActive",
        "action": {
            "Show": 1,
            "View_Extra_Money_Table": 1,
            "Add_Extra_Money_Table": 0,
            "Details_Extra_Money_Table": 1,
            "Edit_Extra_Money_Table": 0,
            "Delete_Extra_Money_Table": 0
        }
    },
    {
        "page": " Gasoline",
        "pageId": "gasolineActive",
        "action": {
            "Show": 1,
            "Add_Gasoline_Table": 0,
            "Edit_Gasoline_Table": 0,
            "View_Gasoline_Table": 1,
            "Delete_Gasoline_Table": 0
        }
    },
    {
        "page": " report_gasoline",
        "pageId": "reportgasolineActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Transportations",
        "pageId": "transportationContractsActive",
        "action": {
            "Show": 1,
            "View_Transportations_Table": 1,
            "Details_Transportations_Table": 1,
            "Edit_Transportations_Table": 0,
            "Get_Contract_Transportations_Table": 0,
            "Send_ByEmail_Transportations_Table": 0,
            "Send_ByWhatsApp_Transportations_Table": 0
        }
    },
    {
        "page": "Contracts Report",
        "pageId": "contract_report",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Banks",
        "pageId": "banksActive",
        "action": {
            "Show": 0,
            "View_Banks_Table": 0,
            "banksReport": 0,
            "Add_Banks_Table": 0,
            "Edit_Banks_Table": 0,
            "Delete_Banks_Table": 0,
            "Report_Bank_Lyon_Travel": 0,
            "Report_Bank_Lyon_Rental": 0,
            "Report_Bank_Lyon_Marvel": 0
        }
    },
    {
        "page": " Payments",
        "pageId": "paymentsActive",
        "action": {
            "Show": 1,
            "Add_New_payments": 0,
            "View_Payments_Report": 1,
            "Daily_Report": 0,
            "Edit_Payments_Table": 0,
            "View_Payments_Table": 0,
            "Transfare_Bank_Payment": 0,
            "Delete_Payment": 0
        }
    },
    {
        "page": " Payments Report",
        "pageId": "reportpaymentActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Car Rental Prices Customer",
        "pageId": "vehiclesActive",
        "action": {
            "Show": 0,
            "Add_New_Vehicles": 0,
            "View_Vehicles_Table": 0,
            "Detail_Vehicles_Table": 0,
            "Edit_Vehicles_Table": 0,
            "Delete_Vehicles_Table": 0
        }
    },
    {
        "page": " Customer Transportation Prices",
        "pageId": "transportationActive",
        "action": {
            "Show": 0,
            "Add_New_Customer_Transportation": 0,
            "View_Customer_Transportation_Table": 0,
            "Detail_Customer_Transportation_Table": 0,
            "Edit_Customer_Transportation_Table": 0,
            "Delete_Customer_Transportation_Table": 0
        }
    },
    {
        "page": " Car Rental Prices Company",
        "pageId": "companyRentalActive",
        "action": {
            "Show": 0,
            "Add_New_Company_Vehicles": 0,
            "View_Company_Vehicles_Table": 0,
            "Edit_Company_Vehicles_Table": 0
        }
    },
    {
        "page": "  Prices Company Full Day",
        "pageId": "VehicleFullDayActive",
        "action": {
            "Show": 0,
            "Add_New_Full_Day_Company": 0,
            "View_Full_Day_Company_Table": 0,
            "Edit_Full_Day_Company_Table": 0
        }
    },
    {
        "page": "  Company Transportation Price",
        "pageId": "transportationCompany",
        "action": {
            "Show": 0,
            "Edit": 0,
            "Add": 0,
            "Delete": 0,
            "View": 0
        }
    },
    {
        "page": " External Vehicles",
        "pageId": "externalVehiclesActive",
        "action": {
            "Show": 0,
            "Add_New_External_Vehicles": 0,
            "View_External_Vehicles_Table": 0,
            "Detail_External_Vehicles_Table": 0,
            "Edit_External_Vehicles_Table": 0,
            "Delete_External_Vehicles_Table": 0
        }
    },
    {
        "page": " Employees",
        "pageId": "employeesActive",
        "action": {
            "Show": 0,
            "Add_New_Employee": 0,
            "View_Employees_Table": 0,
            "Detail_Employees_Table": 0,
            "Edit_Employees_Table": 0
        }
    },
    {
        "page": " Companies",
        "pageId": "companiesActive",
        "action": {
            "Show": 0,
            "Add_New_Companies": 0,
            "View_Companies_Table": 0,
            "Delete_Companies_Table": 0,
            "Edit_Companies_Table": 0
        }
    },
    {
        "page": " Vehicles",
        "pageId": "customerVehiclesActive",
        "action": {
            "Show": 1,
            "Add_New_Vehicles": 0,
            "View_Vehicles_Table": 1,
            "Delete_Vehicles_Table": 0,
            "Edit_Vehicles_Table": 0
        }
    },
    {
        "page": " Vehicles Report",
        "pageId": "vehiclesReportActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": " Push Notifications",
        "pageId": "pushNotificationsActive",
        "action": {
            "Show": 0,
            "View_Push_Notifications_Table": 0,
            "Add_New_Push_Notifications_Table": 0,
            "Delete_Push_Notifications_Table": 0
        }
    },
    {
        "page": " Offers",
        "pageId": "offersActive",
        "action": {
            "Show": 0,
            "Add_New_Offers": 0
        }
    },
    {
        "page": " Users",
        "pageId": "usersActive",
        "action": {
            "Show": 0,
            "Add_New_Users": 0,
            "View_Users_Table": 0,
            "Delete_Users_Table": 0,
            "Edit_Users_Table": 0
        }
    },
    {
        "page": " Accounting Tree",
        "pageId": "accountsTreeActive",
        "action": {
            "Show": 0,
            "Add_New_Folder": 0,
            "Delete_Folder": 0
        }
    },
    {
        "page": " Registration Deed",
        "pageId": "registrationDeedActive",
        "action": {
            "Show": 0,
            "Add_New_Registration_Deed": 0,
            "View_Registration_Deed_Table": 0,
            "Detail_Registration_Deed_Table": 0,
            "Edit_Registration_Deed_Table": 0,
            "Delete_Registration_Deed_Table": 0,
            "Get_Contracrt_Registration_Deed_Table": 0
        }
    },
    {
        "page": " Cost Centers",
        "pageId": "costCentersActive",
        "action": {
            "Show": 0,
            "Add_New_Cost_Centers": 0,
            "View_Cost_Centers_Table": 0,
            "Delete_Cost_Centers_Table": 0,
            "Edit_Cost_Centers_Table": 0
        }
    },
    {
        "page": "Purchasing",
        "pageId": "purchasingActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": "Purchasing lyon",
        "pageId": "purchasing_fund_lyonActive",
        "action": {
            "Show": 0,
            "Add_purchasing_fund_lyon": 0,
            "View_purchasing_fund_lyon_Table": 0,
            "Details_purchasing_fund_lyon_Table": 0,
            "Edit_purchasing_fund_lyon_Table": 0,
            "Delete_purchasing_fund_lyon_Table": 0,
            "Approve_purchasing_fund_lyon_Table": 0,
            "Cancel_purchasing_fund_lyon_Table": 0
        }
    },
    {
        "page": "Purchasing lyon Rental",
        "pageId": "purchasing_fund_lyon_rentalActive",
        "action": {
            "Show": 1,
            "Add_purchasing_fund_lyon_rental": 0,
            "View_purchasing_fund_lyon_rental_Table": 1,
            "Details_purchasing_fund_lyon_rental_Table": 1,
            "Edit_purchasing_fund_lyon_rental_Table": 0,
            "Delete_purchasing_fund_lyon_rental_Table": 0,
            "Approve_fund_lyon_rental": 1,
            "Cancel_fund_lyon_rental": 0
        }
    },
    {
        "page": "Purchasing marvel",
        "pageId": "purchasing_fund_marvelActive",
        "action": {
            "Show": 0,
            "Add_purchasing_fund_marvel": 0,
            "View_purchasing_fund_marvel_Table": 0,
            "Details_purchasing_fund_marvel_Table": 0,
            "Edit_purchasing_fund_marvel_Table": 0,
            "Delete_purchasing_fund_marvel_Table": 0,
            "Approve_fund_marvel": 0,
            "Cancel_fund_marvel": 0
        }
    },
    {
        "page": "Procurements",
        "pageId": "ProcurementsActiove",
        "action": {
            "Show": 1
        }
    },
    {
        "page": "Procurements lyon",
        "pageId": "Procurements_lyonActive",
        "action": {
            "Show": 0,
            "Add_Procurements_lyon": 0,
            "View_Procurements_lyon_Table": 0,
            "Details_Procurements_lyon_Table": 0,
            "Edit_Procurements_lyon_Table": 0,
            "Delete_Procurements_lyon_Table": 0,
            "Approve_Procurements_lyon_Table": 0,
            "Cancel_Procurements_lyon_Table": 0
        }
    },
    {
        "page": "Procurements lyon Rental",
        "pageId": "Procurements_lyon_rentalActive",
        "action": {
            "Show": 1,
            "Add_Procurements_lyon_rental": 0,
            "View_Procurements_lyon_rental_Table": 1,
            "Details_Procurements_lyon_rental_Table": 1,
            "Edit_Procurements_lyon_rental_Table": 0,
            "Delete_Procurements_lyon_rental_Table": 0,
            "Approve_lyon_rental": 1,
            "Cancel_lyon_rental": 0
        }
    },
    {
        "page": "Procurements marvel",
        "pageId": "Procurements_marvelActive",
        "action": {
            "Show": 0,
            "Add_Procurements_marvel": 0,
            "View_Procurements_marvel_Table": 0,
            "Details_Procurements_marvel_Table": 0,
            "Edit_Procurements_marvel_Table": 0,
            "Delete_Procurements_marvel_Table": 0,
            "Approve_marvel": 0,
            "Cancel_marvel": 0
        }
    },
    {
        "page": "Check",
        "pageId": "CheckActive",
        "action": {
            "Show": 1
        }
    },
    {
        "page": "Check lyon",
        "pageId": "Check_lyonAtive",
        "action": {
            "Show": 0,
            "Add_Check_lyon": 0,
            "View_Check_lyon_Table": 0,
            "Details_Check_lyon_Table": 0,
            "Edit_Check_lyon_Table": 0,
            "Delete_Check_lyon_Table": 0,
            "Approve_Check_lyon_Table": 0,
            "Cancel_Check_lyon_Table": 0
        }
    },
    {
        "page": "Check lyon Rental",
        "pageId": "Check_lyon_RentalActive",
        "action": {
            "Show": 1,
            "Add_Check_lyon_Rental": 0,
            "View_Check_lyon_Rental_Table": 1,
            "Details_Check_lyon_Rental_Table": 1,
            "Edit_Check_lyon_Rental_Table": 0,
            "Delete_Check_lyon_Rental_Table": 0,
            "Approve_Check_lyon_Rental_Table": 1,
            "Cancel_Check_lyon_Rental_Table": 0
        }
    },
    {
        "page": "Check Marvell",
        "pageId": "Check_MarvellActive",
        "action": {
            "Show": 0,
            "Add_Check_Marvell": 0,
            "View_Check_Marvell_Table": 0,
            "Details_Check_Marvell_Table": 0,
            "Edit_Check_Marvell_Table": 0,
            "Delete_Check_Marvell_Table": 0,
            "Approve_Check_Marvell_Table": 0,
            "Cancel_Check_Marvell_Table": 0
        }
    }
])
         document.getElementById("Page").onchange = function (e) {
    console.log("change");
    document.getElementById("action").innerHTML = "";
    let selectedPAge = document.getElementById("Page").value;
    console.log(selectedPAge);
    allPage.forEach(function (e) {
      if (e.pageId.trim() == selectedPAge) {
        let x = 0;
        for (let key in e.action) {
          x++;
          console.log(key + ": " + e.action[key]);
          if (e.action[key] == 1) {
            $("#action").append(
              `
          <div class="form-check form-switch">
            <input class="form-check-input  mt-3" checked type="checkbox" role="switch" id="Radio` +
                x +
                `" value="${key.replace(/_/g, " ")}">
            <label class="form-check-label">${key.replace(/_/g, " ")}</label>
          </div>
        
        `
            );
          } else {
            $("#action").append(`
          <div class="form-check form-switch">
            <input class="form-check-input mt-3" type="checkbox" role="switch" value="${key.replace(/_/g, " ")}"  id="Radio` +
            x +
            `">
            <label class="form-check-label">${key.replace(/_/g, " ")}</label>
          </div>
        
        `);
          }
          let checkbox = document.getElementById("Radio"+x);
          checkbox.onchange = function (e) {
            let selected_Page=document.getElementById("Page").value;

            if (checkbox.checked) {
Selected_Permetion=checkbox.value;
Selected_Permetion=Selected_Permetion.replace(/ /g,"_");
allPage.forEach(function (e) {
if(e.pageId==selected_Page ){
 
  let tagetAction= e.action

  console.log(tagetAction[Selected_Permetion]);

  tagetAction[Selected_Permetion]=1;
  return;
}else{


}

})
            } else {
              Selected_Permetion=checkbox.value;
              Selected_Permetion=Selected_Permetion.replace(/ /g,"_");
              allPage.forEach(function (e) {
              if(e.pageId==selected_Page ){
               
                let tagetAction= e.action
              
                console.log(tagetAction[Selected_Permetion]);
              
                tagetAction[Selected_Permetion]=0;
                return;
              }else{
      
              }
              
              })
                      


            }
          }; 
        }

       
      }
    });
  };</script>

        @include('layouts.footer')
</main>

</x-layouts.base>