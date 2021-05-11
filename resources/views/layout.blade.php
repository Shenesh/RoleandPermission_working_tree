<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.4/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.4/datatables.min.js"></script>
      <link rel="stylesheet" href="{{ asset('assets/css/tagsinput.css') }}"> 



<title>Dashboard - SB Admin</title>
        @include('partials.styles')
    </head>
    <body class="sb-nav-fixed">
        @include('partials.topbar')
        <div id="layoutSidenav">
          @include('partials.sidebar')
            <div id="layoutSidenav_content">
                <div class="container-fluid">
                @yield('content')
                </div>
                @include('partials.footer')
            </div>
        </div>
       @include('partials.scripts')
    </body>
</html>
