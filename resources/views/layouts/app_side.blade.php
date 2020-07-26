@extends('layouts.app')

@section('content_layout')
      
   @include('layouts/sidebar')

   <div class="content">

      @include('layouts/navbar')
      <div class="row p-lg-4 p-md-3 p-sm-2 sticky-margin-top-ie justify-content-center">
         @yield('content')
      </div>

      <footer class="w-100">
         @include('layouts/footer')
      </footer>
   </div>   
@endsection
