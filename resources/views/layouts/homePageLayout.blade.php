<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PECHS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link href="{{ asset('css/pechs.css') }}" rel="stylesheet">
<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
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
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<!--
********************************************************************
                               NavBar
********************************************************************
-->

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">PECHS Housing Society</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#topPart">Home <span class="sr-only">(current)</span></a></li>
              <li><a href="#announcementDiv">News</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li>
                    <a onclick="javascript:showDiv('aboutValencia');" href="#aboutValencia">About Valenica </a>
                  </li>
                  <li>
                    <a onclick="javascript:showDiv('committe');" href="#committe">Managment Committe </a>
                  </li>
                  <li>
                    <a onclick="javascript:showDiv('focal');" href="#focal">Focal Members </a>
                  </li>
                  <li>
                    <a onclick="javascript:showDiv('achievements');" href="#achievements">Achievements </a>
                  </li>
                  <li>
                    <a onclick="javascript:showDiv('projects');" href="#projects">OnGoing Projects </a>
                  </li>
                  <li>
                    <a onclick="javascript:showDiv('gallery');" href="#gallery">Gallery </a>
                  </li>
                  <li>
                    <a href="storage/myAssets/valenciaMap.jpg" target="_blank">Map </a>
                  </li>
                  <li>
                    <a onclick="javascript:showDiv('contactUs');" href="#contactUs">Contact Us </a>
                  </li>
                </ul>
              </li>
              <li><a href="#circulars">Circulars</a></li>
                                      <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
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
 @include('partials.error')
@include('partials.message')
    @section('body')

    @show
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
// Add smooth scrolling to all links
$("a").on('click', function(event) {

  // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {
    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 800, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  } // End if
});
});
</script>

  @section('script')
    @show
  </body>
</html>
