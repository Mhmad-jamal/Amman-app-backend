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
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Admin Permission</h2>
                        <select id="Page"  data-select2-id="select2-data-Page" tabindex="-1" class="select2-hidden-accessible form-select" aria-hidden="true"> 
                            <option selected value="Select" disabled data-id="Select">Select Page</option>

                            <option value="dashboard" data-id="dashboard">Dashboard Page</option>
            
                            <option value="client_page" data-id="Client_Page">Client Page</option>
                            <option value="subsicription" data-id="subsicription_Page">subsicription Page</option>

                            <option value="properties" data-id="properties">Properties Page</option>
                            
                            <option value="banner_Page" data-id="banner_Page">Banner Page</option>
                            
                            <option value="contract_page" data-id="contract page">Contract page</option>
                            <option value="all_contract_page" data-id="all_contract_page">All contract Page</option>
                            <option value="Check_request" data-id="Check_request">Check request</option>
            
                            <option value="order_page" data-id="order_page">Orders Page</option>
                            <option value="orders" data-id="orders">Orders Controller</option>

                            <option value="admin_page" data-id="admin_page">Admin</option>
            
                            
                            
                            </select>
                            <div id="action" class="mt-3"></div>

                            <div class="mt-3">
                                <input type="hidden" id="user_id" value="{{$user->id}}">
                                <button type="button" id="permessionbtn" class="btn btn-gray-800 mt-2 animate-up-2">Save </button>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card shadow border-0 text-center p-0">
                                <div wire:ignore.self class="profile-cover rounded-top"
                                    data-background="../../assets/img/profile-cover.jpg"></div>
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
            
        </div>
        @php
        $permission = json_decode($user->Permission);
        $allPage = json_encode($permission);
    @endphp
    
    <script>
        var allPage = {!! $allPage !!};
        console.log(allPage); 
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
            <input class="form-check-input  " checked type="checkbox" role="switch" id="Radio` +
                x +
                `" value="${key.replace(/_/g, " ")}">
            <label class="form-check-label">${key.replace(/_/g, " ")}</label>
          </div>`);
          } else {
            $("#action").append(`
          <div class="form-check form-switch">
            <input class="form-check-input " type="checkbox" role="switch" value="${key.replace(/_/g, " ")}"  id="Radio` +
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
  };
  

  document.getElementById("permessionbtn").addEventListener("click", function(){
let formData=new FormData();
    formData.append("permission", JSON.stringify(allPage));
    formData.append("id", document.getElementById('user_id').value);

    $.ajax({
      type: "POST",
      url: "/api/users/update/permession",
      data: formData,
      processData: false,
      contentType: false,
    }).done(function (response) {
      console.log(response);
      if (response["status"] === 200) {
   console.log("done");
   swal({
    title: "Success",
    text: response.message,
    icon: "success",
    button: "OK",
  });
      }
    });

  });
  
  
  </script>

        @include('layouts.footer')
</main>

</x-layouts.base>