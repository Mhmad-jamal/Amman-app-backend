<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 table-wrapper table-responsive">
            <h2 class="h5 mb-4">Maintenanc order</h2>

            <table class="table user-table table-hover align-items-center" id="checkTable">
                <thead>
                    <tr>

                        <th class="border-bottom">Id</th>
                        <th class="border-bottom">Order Type</th>

                        <th class="border-bottom"> Client Id</th>

                        <th class="border-bottom"> Type </th>
{{--                         <th class="border-bottom">description </th>
 --}}                        <th class="border-bottom"> image  </th>

                        <th class="border-bottom"> date </th>

                        
                        <th class="border-bottom"> Status </th>

                        <th class="border-bottom">Action</th>
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
                            <td>
                               <a class="text-success" href="{{ route('view_user', ['id' => $item->client_id]) }}">
                                 {{$item->client_nationality_number}}</a>
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
                            <td><span class="fw-normal d-flex align-items-center text-success">Approve</span></td>

                                
                           @elseif ($item->status==0)
                            <td>
                                <span class="fw-normal d-flex align-items-center text-warning">On hold</span></td>

                            @else
                            <td><span class="fw-normal d-flex align-items-center text-danger ">Reject</span></td>

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
                                        <a href="{{ route('details_maintenance_order', ['id' => $item->id]) }}" class="dropdown-item d-flex align-items-center">
                                            <span class="fas fa-eye" style="color: rgb(4, 81, 145);"></span>
                                            View
                                        </a>
                                        <a onclick="updateStates({{$item->id}},1)" class="dropdown-item d-flex align-items-center">
                                            <span class="fas fa-check" style="color: green;"></span>
                                            Approve
                                        </a>
                                        <a onclick="updateStates({{$item->id}},2)" class="dropdown-item d-flex align-items-center"
                                             {{-- href="{{ route('edit_contract', ['id' => $checkRequest->id]) }}" --}}>
                                             <span class="fas fa-times" style="color: red;"></span>
                                             Reject
                                        </a>
                                        
                                        
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
 $('#checkTable').DataTable();
 




            });
</script>
@include('layouts.footer')
</main>

</x-layouts.base>