<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')

        <div class="card card-body border-0 shadow mb-4 mb-xl-0">
            <h2 class="h5 mb-4">Search Properties</h2>
            <div class="row">
                <div class="mb-4 col-md-3">
                    <label class="my-1 me-2" for="country">Section</label>
                    <select class="form-select" id="section" name="section" aria-label="Default select example">
                        <option disabled selected value="">Select an option</option>

                        <option value="Rent">Rent</option>
                        <option value="Sale">Sale</option>
                    </select>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="form-group">

                        <label class="my-1 me-2" for="sub_section"> Sub Section</label>
                        <select class="form-select mb-0" id="sub_section" name="sub_section">
                            <option disabled selected value="">Select an option</option>


                            <option value="Apartments">Apartments</option>
                            <option value="Villa - Palace">Villa - Palace</option>
                            <option value="Townhouses">Townhouses</option>
                            <option value="Lands">Lands</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Farms & Chalets">Farms & Chalets</option>
                            <option value="Whole Building">Whole Building</option>
                            <option value="Foreign Real Estate">Foreign Real Estate</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label for="construction_age">Construction age </label>
                        <select class="form-select mb-0"  id="construction_age" name="construction_age">
                            <option disabled selected value="">Select an option</option>

                            <option value="0-11 months">0-11 months</option>
                            <option value="1-5 years">1-5 years</option>
                            <option value="6-9 years">6-9 years</option>
                            <option value="10-19 years">10-19 years</option>
                            <option value="20+ years">20+ years</option>
                            <option value="Under Construction">Under Construction</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-3">

                    <button class="btn mx-1 me-2 btn-secondary" style="margin-top:12%" id="submitbtn" type="button"><i
                            class="fas fa-arrow-down mx-1"></i>Download</button>
                </div>
            </div>
            <div class="card card-body shadow border-0 table-wrapper table-responsive">
                <h2 class="h5 mb-4">Properties information</h2>

                <table class="table user-table table-hover align-items-center" id="properties-table">
                    <thead>
                        <tr>

                            <th class="border-bottom">Id</th>
                            <th class="border-bottom"> Section </th>
                            <th class="border-bottom">sub section </th>

                            <th class="border-bottom">construction age </th>
                            <th class="border-bottom">furnished </th>


                            <th class="border-bottom">status </th>
                            <th class="border-bottom">Price </th>

                            <th class="border-bottom">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>



            </div>

            <script>
                $(document).ready(function() {
  // Your code here
  
                $("#submitbtn").click(function() {
                    var formData = new FormData();
                    if (document.getElementById("section") != "" || document.getElementById("section").value !=NULL) {
                        formData.append("section", document.getElementById("section").value);
                    }
                    if (document.getElementById("sub_section") != "" || document.getElementById("sub_section").value!=NULL) {
                        formData.append("sub_section", document.getElementById("sub_section").value);
                    }
                    if (document.getElementById("construction_age") != "" || document.getElementById("construction_age").value!=NULL) {
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
                        console.log(response);
                        console.log(response["data"]);

                        if (response["status"] === 200) {
                            var properties = response["data"];
                            // Clear existing table rows
                            $("#properties-table tbody").empty();

                            // Iterate over properties and append to table
                            properties.forEach(function(property) {
                                var row = `<tr>
                                 <td>${property.id}</td>
                                     <td><span class="fw-normal">${property.section}</span></td>
                                        <td><span class="fw-normal d-flex align-items-center">${property.sub_section}</span></td>
                                        <td><span class="fw-normal d-flex align-items-center">${property.construction_age}</span></td>
                                        <td><span class="fw-normal d-flex align-items-center">${property.furnished}</span></td>
                              
                                    ${property.status == 0 ? `<td><span class="fw-normal d-flex align-items-center text-warning">Draft</span></td>` :
     property.status == 1 ? `<td><span class="fw-normal d-flex align-items-center text-success">Active</span></td>` :
     property.status == 2 ? `<td><span class="fw-normal d-flex align-items-center text-danger">Delete</span></td>` : ''}

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
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="/properties_view/${property.id}">
                                        <span class="fas fa-box"></span>
                                        View Details
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="/properties_edit/${property.id}">
                                        <span class="fas fa-edit"></span>
                                        Edit Property
                                    </a>
                                    <a class="dropdown-item text-danger d-flex align-items-center"
                                        href="/properties_delete/${property.id}">
                                        <span class="fas fa-trash-alt"></span>
                                        Delete Property
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>`;

                                $("#properties-table tbody").append(row);
                            });

                            // Initialize DataTable on the updated table
                            $("#properties-table").DataTable();
                        }
                    });
                });
            });
            </script>
            @include('layouts.footer')
    </main>

</x-layouts.base>
