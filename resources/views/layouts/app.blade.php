<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="test for zero2one">
  <meta name="author" content="Jackson">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{config("app.name", "Fullstacktest")}}</title>

  <script src="{{ mix('js/app.js') }}" defer></script>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{mix('css/app.css')}}">

</head>

<body id="page-top">
  
  @include('navigation.navbar')
  <div class="container-fluid p-0" id='contacts-vue'>
    @yield('content')
  </div>

  <script type="text/x-template" id="modal-template">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container">

            <div class="modal-header">
              <slot name="header">
                default header
              </slot>
            </div>

            <div class="modal-body">
              <slot name="body">
                  
              </slot>
            </div>

            <div class="modal-footer">
              <slot name="footer">
                
              </slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </script>

</body>

</html>
