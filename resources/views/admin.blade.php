{{-- @extends('layouts.master')

@section('content')
    <h1>Halo!!</h1>
    <div>Selamat datang di halaman  {{  Auth::user()->name }} </div>
    <div><a href="/logout" class="btn btn-sm btn-secondary">Logout >></a></div>
    <div class="card mt-3">
      <ul class="list-group list-group-flush">
        @if(Auth::user()->role == 'admin')
        <li class="list-group-item">Menu admin</li>
        <li class="list-group-item">Menu petugas</li>
        <li class="list-group-item">Menu pimpinan</li>
        @endif
        @if(Auth::user()->role == 'petugas')
        <li class="list-group-item">Menu petugas</li>
        @endif
        @if(Auth::user()->role == 'pimpinan')
        <li class="list-group-item">Menu pimpinan</li>
      
        @endif
       
      </ul>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
  @endsection --}}
