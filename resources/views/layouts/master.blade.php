<!DOCTYPE html>
<html>
<head>
  <title>IPOS - @yield('title')</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

  <header>
    @include('layouts.navbar')
  </header>

  <main>
    <div class="container">
      @yield('content')
    </div>
  </main>

  <footer class="">
    
  </footer>


  @yield('jsScripts')
</body>
</html>