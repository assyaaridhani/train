<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta name="_token" content="{{"csrf_token()"}}">
      <meta httpequiv="XUACompatible" content="IE=edge">
      <meta name="viewport" content="width=devicewidth, initialscale=1">
      <title>Delliocre</title>
      <script src="/assets/js/jquerry-1-11-1.js"></script>
      <script src="/assets/js/bootstrap.min.js"></script>
      <script src="/assets/js/masonry.pkgd.min.js"></script>
      <script src="/assets/materialDesign/js/material.js"></script>
      <script src="/assets/materialDesign/js/ripples.js"></script>
      <script src="/assets/js/custom.js"></script>
      <link href="/assets/css/bootstrap.css" rel="stylesheet" />
      <link href="/assets/css/custom.css" rel="stylesheet" />
      <link href="/assets/materialDesign/css/bootstrap-material-design.css" rel="stylesheet" />
      <link href="/assets/materialDesign/css/ripples.css" rel="stylesheet" />
      <link href="/assets/css/font-awesome.min.css" rel="stylesheet" />

      
     
    </head>
    <body style="padding-top:60px;">
      <!--bagian navigation-->
      @include('shared.head_nav')
      <!-- Bagian Content -->
      <div class="container clearfix">
        <div class="row row-offcanvas row-offcanvas-left ">
          <!--Bagian Kiri-->
          @include("shared.left_nav")

          <!--Bagian Kanan-->
          <div id="main-content" class="col-xs-12 col-sm-9 main pull-right">
            <div class="panel-body">
              @if (Session::has('error'))
                <div class="session-flash alert-danger">
                    {{Session::get('error')}}
                </div>
              @endif
              @if (Session::has('notice'))
                <div class="session-flash alert-info">
                    {{Session::get('notice')}}
                </div>
              @endif
              @yield("content")
            </div>
          </div>
        </div>
      </div>
    </body>
  </html>