<!DOCTYPE html>
<html>
  <head>
    @include('partials.error')
@include('partials.message')

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="{{ asset('css/adminPanel.css') }}" rel="stylesheet">
<!--
********************************************************************
                              Head
********************************************************************
 -->
    @section('head')
    @show
  </head>


<!--
********************************************************************
                               Body
********************************************************************
-->
  <body>

    <!--
    ********************************************************************
                                   NavBar
    ********************************************************************
    -->

  <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">PECHS Admin</a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="/admin">Home</a></li>

                      <!-- Announcements -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Announcements<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="/admin">Add Announcement </a>
                          </li>
                          <li>
                            <a href="/view-all-announcements">View Announcements </a>
                          </li>
                        </ul>
                    </li>

                    <!-- Images -->
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Images<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="/admin">Add Images </a>
                        </li>
                        <li>
                          <a href="/view-all-achievement-images">View Achievement Images </a>
                        </li>
                        <li>
                          <a href="/view-all-ongoing-images">View Project Images </a>
                        </li>
                        <li>
                          <a href="/view-all-gallery-images">View Gallery Images </a>
                        </li>
                        <li>
                          <a href="/view-all-slider-images">View Main Slider Images </a>
                        </li>
                      </ul>
                    </li>

                    <!-- Circulars -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Circulars<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="/admin">Add Circulars </a>
                          </li>
                          <li>
                            <a href="/view-all-circular">View Circulars </a>
                          </li>
                        </ul>
                    </li>

                    <!-- Members -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Members<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="/admin">Add Members </a>
                          </li>
                          <li>
                            <a href="/view-all-commitee-member">View Committe Members </a>
                          </li>
                          <li>
                            <a href="/view-all-focal-member">View Focal Members </a>
                          </li>
                        </ul>
                    </li>

                      <li><a href="/view-all-messages">View Messages</a></li>
                                                                          <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>

<!--
********************************************************************
                       Main Page Wrapper
********************************************************************
 -->
<div id="mainPageWrapper" class="container-fluid">

<!--
********************************************************************
                           Header
********************************************************************
 -->
    @section('body')
    @show

</div>
    @section('script')
    @show
  </body>
</html>
