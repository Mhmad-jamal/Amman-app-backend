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
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Add New image</h2>
                            
                        <div class="row">
                            <form method="POST" action="{{ route('create_banner') }}" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="file" name="image[]" multiple accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </form>
                        </div>
                        
                           
    {{-- Footer --}}
    @include('layouts.footer')
</main>

</x-layouts.base>