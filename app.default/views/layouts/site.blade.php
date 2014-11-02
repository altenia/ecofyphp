<!doctype html>
<html lang="en">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{ $siteContext->name }}</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width">
      <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
      
      {{ HTML::style('bootstrap/css/bootstrap.css') }}
      {{ HTML::style('css/main.css') }}
      {{ HTML::script('js/jquery-2.1.1.min.js') }}
      {{ HTML::script('bootstrap/js/bootstrap.js') }}

      <link href='http://fonts.googleapis.com/css?family=Questrial|Dosis|ABeeZee|Poiret+One|Quicksand|Source+Code+Pro|Nunito|Varela+Round|Actor|Milonga|Anonymous+Pro' rel='stylesheet' type='text/css'>

      <!-- endbuild -->
      <script src="bower_components/modernizr/modernizr.js"></script>
  </head>
  
  <body>
        @include('_partials.nav_top')

        <!-- CONTENT { -->
        @yield('content')
        <!-- } CONTENT -->

        <hr />
        <footer style="text-align: center">
          <p>&copy; Altenia, 2014</p>
          <p>{{ Lang::get('site.legal') }} | {{ Lang::get('site.about') }}</p>
        </footer>

  </body>
</html>
