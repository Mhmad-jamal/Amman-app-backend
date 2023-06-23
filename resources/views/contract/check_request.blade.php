<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
       

        <div class="card card-body shadow border-0 table-wrapper table-responsive">
            <h2 class="h5 mb-4">Contracts information</h2>

            <table class="table user-table table-hover align-items-center" id="checkTable">
                <thead>
                    <tr>

                        <th class="border-bottom">Id</th>
                        <th class="border-bottom"> Owner name </th>
                        <th class="border-bottom">Client name </th>
                        <th class="border-bottom"> Nationality Number </th>

                        <th class="border-bottom"> date </th>

                        
                        <th class="border-bottom"> Status </th>

                        <th class="border-bottom">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checkRequests as $checkRequest)
                    <tr>

                            <td>
                               {{$checkRequest->id}}
                            </td>
                            <td><span class="fw-normal"></span>{{$checkRequest->owner_name}}
                            </td>
                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$checkRequest->client_name}}</span>
                            </td>
                            <td><span
                                class="fw-normal d-flex align-items-center">{{$checkRequest->nationalty_number}}</span>
                        </td>
                        

                            <td><span
                                    class="fw-normal d-flex align-items-center">{{$checkRequest->created_at}}</span>
                            </td>
                          
                           
                          
                       
                    
                            @if ($checkRequest->check_status==1)
                            <td><span class="fw-normal d-flex align-items-center text-success">Approve</span></td>

                                
                           @elseif ($checkRequest->check_status==0)
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
                                        <a onclick="updateStates({{$checkRequest->id}},1)" class="dropdown-item d-flex align-items-center">
                                            <span class="fas fa-check" style="color: green;"></span>
                                            Approve
                                        </a>
                                        <a onclick="updateStates({{$checkRequest->id}},2)" class="dropdown-item d-flex align-items-center"
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
        formData.append('check_status',status);

        $.ajax({
    url: '../../api/check/status/update',
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