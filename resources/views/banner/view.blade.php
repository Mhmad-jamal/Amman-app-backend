<x-layouts.base>
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')


    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        <title>View </title>
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
                            <div class="col-md-4 mt-3 mb-3 d-flex flex-column align-items-center">
                                <a href="{{ asset('storage/' . $banner->image) }}" data-lightbox="banner-gallery" class="banner-gallery">
                                    <img class="banner-image h-100" src="{{ asset('storage/' . $banner->image) }}" alt="Image">
                                    <div class="banner-text text-center">
                                    {{$banner->href}}
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
<br>
                        <hr>
<br>
                            
                      
                        
                           
    {{-- Footer --}}    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    @include('layouts.footer')
</main>

</x-layouts.base>