<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <title>View user</title>
        <div>
          <br>
         
          <style>
            .banner-image {
                object-fit: cover;
                height: 100%;
            }
            .banner-gallery{
                min-height: 250px;
                max-height: 250px;

            }
        </style>
      
        
       
            <div class="row mt-3 mb-3">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Banner image</h2>
                        <div class="row">
                            @foreach ($banners as $index => $banner)
                            <br>
                            <div class="col-md-4 mt-5 mb-5 d-flex flex-column align-items-center">
                                <a href="{{ asset('storage/' . $banner->image) }}" data-lightbox="banner-gallery" class="banner-gallery">
                                    <img class="banner-image h-100" src="{{ asset('storage/' . $banner->image) }}" alt="Image">
                                    <div class="banner-text text-center w-100">
                                  
                                </a>
                                    <form method="POST" action="{{ route('delete_banner_image') }}" class="delete-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $banner->id }}">
                                        <div class="form-group mt-3">
                                                    <input class="form-control" name="href" value="  {{$banner->href}}" id="href{{ $banner->id }}" type="text">
                                                                 
                                                    </div>
                                                                                    
                                                    <button onclick="edit({{ $banner->id }})" type="button" class="btn btn-primary edit-btn mt-3"><i class="fas fa-pencil-alt"></i></button>

@php
      $userId = auth()->id();

      $response = $permission->checkPermission($userId, 'banner_Page','delete_banner');
     
     @endphp
 
 @if ($response->getStatusCode() === 200)    
 <button type="submit" class="btn btn-danger delete-btn mt-3"><i class="fas fa-trash-alt"></i></button>
@endif
                                                    
                                 </div>
                      
                             
                            </div>
                            @endforeach
                        </div>
                    </form>
                      
                   
                            <br>
                        <hr>
                        <br>
                        
@php

$response = $permission->checkPermission($userId, 'banner_Page','add_banner');

@endphp

@if ($response->getStatusCode() === 200)    
                        <h2 class="h5 mb-4">Add New image</h2>
                        <div class="row flex-column">
                            <form method="POST" action="{{route('add_new_banner')}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="Vdz4oXe4Trs9qvmpzkVIJl5rdc16EyktAflBiOEb">                                <div class="col-md-6 mb-3">

                                <input class="form-control" type="file" name="image[]" multiple="" accept="image/*">
                                                                <br>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="href">Image link <span class="text-danger"></span></label>
                                                <input class="form-control" name="href" id="href" type="text">
                                                                                                  
                                                                                </div>
                                </div>
                                <div class="col-md-6 mb-3">

                                <button type="submit" class="btn btn-primary">Add Images</button>
                                </div>
                            </form>
                        </div>   
                        @endif   
                </div>
                    </div>
                </div>
            
                           
    {{-- Footer --}}    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
function edit(id) {
  console.log(id);
  let link = document.getElementById('href' + id).value;
  console.log(link);
  
  let formdata = new FormData();
  formdata.append('id', id);
  formdata.append('href', link);
  
  fetch('/api/update/banner', {
    method: 'POST',
    body: formdata,
    headers: {
      'Accept': 'application/json',
    },
    cache: 'no-cache',
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    // Code to handle the response
    
    // Display SweetAlert success message
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: 'Banner updated successfully',
    });
  })
  .catch(error => {
    console.log(error);
    // Code to handle errors
    
    // Display SweetAlert error message
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to update banner',
    });
  });
}


    </script>
    @include('layouts.footer')
</main>

</x-layouts.base>