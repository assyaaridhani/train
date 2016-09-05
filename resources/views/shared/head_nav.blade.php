<!-- @if (Auth::check())
    <li>{!! link_to('logout', 'Logout') !!}</li>
  @else
    <li>{!! link_to('login', 'Login') !!}</li>
  @endif
 -->
<div class="navbar navbar-fixed-top navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"/>
        <span class="icon-bar"/>
        <span class="icon-bar"/>
      </button>
      <a href="#" class = "navbar-brand">Deliocre Flash</a>
    </div>
    <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{!! url('articles') !!}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home </li></a>
        <li><a href="{!! url('gallery')!!}"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Gallery</li></a>
        <li><a href="#"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Articles </li></a>
        <li>{!! link_to('users/create', 'Signup') !!}</li>      
    </ul>
    </div>
  </div>
</div>

