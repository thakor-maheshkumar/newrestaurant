<x-app-layout>
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
 	   @include('admin.admincss')
  </head>
  <body>
  	<div class="container-scroller">
    @include('admin.navbar')
    @yield('content')
    </div>
      	
      <!-- page-body-wrapper ends -->
    
    @include('admin.adminscript')
  </body>
</html>