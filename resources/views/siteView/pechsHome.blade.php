@extends('layouts.homePageLayout')

@section('head')
@endsection

@section('body')


                  <!-- POP UP -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">ALERT!!!!</h4>
  </div>
  <div class="modal-body">
    <p>The site is still under development.
      <br>
      <b><u>Implimented Functions</u></b>
      <br>
      <b>Admin part --></b>curd operations and ability to disable rather than permanetly delete certain content of
      <br>
      <b>1)</b>news updates
      <br>
      <b>2)</b>members
      <br>
      <b>3)</b>images(gallery, achievements, on going projects)
      <br>
      <b>4)</b>circulars
      <br>
      <b>5)</b>admin can reply to messages via email
      <br>
      <b>Front End --></b> fetching data from db for
      <br>
      <b>1)</b>Updates
      <br>
      <b>2)</b>about us(partial implimented)
      <br>
      <b>3)</b>User can send message to site admin
      <br>
      <b>4)</b>circulars can be downloaded
      <br>
      <b><u>Future Implimentations Include</u></b>
      <br>
      <b>1)</b>Admin can add/edit/delete carousel images
      <br>
      <b>2)</b>Fixing looks and asthetics of front page
      <br>
      <b>3)</b>Fixing crashes when requested varaible data missing
    </p>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>
                      <!-- MAIN PAGE -->
<div id="mainPageWrapper" class="container-fluid col col-md-12 col-sm-12 col-xs-12">
<!-- TOP PART CONTAINS(topCarousel) -->
<div id="topPart" class="col col-md-12 col-sm-12 col-xs-12">
  @if (!empty($slider))
<div id="topCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#topCarousel" data-slide-to="0" class="active"></li>
    @if(count($slider)>1)
    @for($i=1; $i<count($slider); $i++)
    <li data-target="#topCarousel" data-slide-to="{{$i}}"></li>
    @endfor
    @endif
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <div class="carousel-caption">
          <p>{{$slider[0]->title}}</p>
      </div>
      <img src={{ asset('storage/myAssets/slider/'.$slider[0]->imgpath) }} style="width:100%;">
  </div>
@if(count($slider)>1)
@for($i=1; $i<count($slider); $i++)
  <div class="item">
      <div class="carousel-caption">
          <h1>{{$slider[$i]->title}}</h1>
      </div>
      <img src={{ asset('storage/myAssets/slider/'.$slider[$i]->imgpath) }} style="width:100%;">
  </div>
@endfor
@endif
  </div>
  <!-- Left and right controls -->
  <a class="left carousel-control" data-target="#topCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" data-target="#topCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@else
<div id="topCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#topCarousel" data-slide-to="0" class="active"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src={{ asset('storage/myAssets/defaultSliderImage.jpg') }} style="width:100%;">
  </div>
  </div>
</div>
@endif
</div> <!-- Top Part End -->

<!-- MIDDLE PART CONTAINS(Announcement, aboutUs, circulars) -->
  <div id="middlePart" class="col col-md-12 col-sm-12 col-xs-12">
<!-- Announcement DIV -->

<!-- this span tag is used to make the link jump below the fixed nav -->
<span class="anchor" id="announcementDiv"></span>
<div class="middlePartSections">
  <div id="announcementHeading" class="middlePartHeadings">
    <p>
      News
    </p>
  </div>
    <div id="announcementContent" class="middlePartContents">
      <!-- Announcement Carousel -->

@if (!empty($update))
      <!-- large display carousel -->
      <div id="largeDisplayCarousel">
                <div id="announcementLargeDisplayCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-md-12 carousel-contnet myText">
                          @if (!empty($update[0]))
                          <div id="individualAnnouncement" class="individualAnnouncement col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p>{{$update[0]->title}}
                            <a href="/view-announcement-details/{{$update[0]->id}}">Read More</a>
                            </p>
                          </div>
                          @endif
                          @if (!empty($update[1]))
                          <div id="individualAnnouncement" class="individualAnnouncement col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p>{{$update[1]->title}}
                            <a href="/view-announcement-details/{{$update[1]->id}}">Read More</a>
                            </p>
                          </div>
                          @endif
                          @if (!empty($update[2]))
                          <div id="individualAnnouncement" class="individualAnnouncement col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p>{{$update[2]->title}}
                            <a href="/view-announcement-details/{{$update[2]->id}}">Read More</a>
                            </p>
                          </div>
                          @endif

                        </div>
                    </div>
                </div>
                @for ($i = 3; $i < count($update); $i=$i+3)
                <div class="item">
                    <div class="row">
                        <div class="col-md-12 carousel-contnet myText">
                          @if($i < count($update))
                          <div class="individualAnnouncement col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p>{{$update[$i]->title}}
                            <a href="/view-announcement-details/{{$update[$i]->id}}">Read More</a>
                            </p>
                          </div>
                          @endif
                          @if($i+1 < count($update))
                          <div id="individualAnnouncement" class="individualAnnouncement col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p>{{$update[$i+1]->title}}
                            <a href="/view-announcement-details/{{$update[$i+1]->id}}">Read More</a>
                            </p>
                          </div>
                          @endif
                          @if($i+2 < count($update))
                          <div class="individualAnnouncement col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p>{{$update[$i+2]->title}}
                            <a href="/view-announcement-details/{{$update[$i+2]->id}}">Read More</a>
                            </p>
                          </div>
                          @endif
                        </div>
                    </div>
                </div>
                @endfor

            </div>
            <a class="left carousel-control" data-target="#announcementLargeDisplayCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" data-target="#announcementLargeDisplayCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
      <!-- large display carousel end-->

      <!-- small display carousel -->
      <div id="smallDisplayCarousel">
        <div id="announcementSmallDisplayCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-md-12 carousel-contnet myText">
                            <div class="individualAnnouncement">
                              <p>{{$update[0]->title}}
                              <a href="/view-announcement-details/{{$update[0]->id}}">Read More</a>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
                @for ($i = 1; $i < count($update); $i++)
                <div class="item">
                    <div class="row">
                        <div class="col-md-12 carousel-contnet myText">
                          <div class="individualAnnouncement">
                            <p>{{$update[$i]->title}}
                            <a href="/view-announcement-details/{{$update[$i]->id}}">Read More</a>
                          </p>
                          </div>
                        </div>
                    </div>
                </div>
                @endfor

            </div>
            <a class="left carousel-control" data-target="#announcementSmallDisplayCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" data-target="#announcementSmallDisplayCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
      <!-- small display carousel end-->
      @endif
    </div>
</div> <!-- Announcement DIV END-->

<!-- About Us DIV -->
<!-- this span tag is used to make the link jump below the fixed nav -->
<span class="anchor" id="aboutUs"></span>
<div class="middlePartSections">
<div id="aboutUsHeading" class="middlePartHeadings">
  <p>
    About Us
  </p>
</div>
<div id="aboutUsContent" class="middlePartContents">
  <div id="aboutUsHexGrid">

  <ul id="hexGrid">
<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('aboutValencia');" href="#aboutValencia">
      <p>About<br>Valencia </p>
    </a>
  </div>
</li>

<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('committe');" href="#committe">
      <p>Managment<br>Committe</p>

    </a>
  </div>
</li>

<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('focal');" href="#focal">
      <p> Focal<br>Person </p>

    </a>
  </div>
</li>

<li class="hex">
  <div class="hexIn">
        <a class="hexLink" href={{ asset('storage/myAssets/valenciaMap.jpg') }} target="_blank" >
      <p> Map </p>
  </a>

    </a>
  </div>
</li>

<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('achievements');" href="#achievements">
      <p> Achievements </p>

    </a>
  </div>
</li>

<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('projects');" href="#projects">
      <p> OnGoing<br>Projects </p>
    </a>
  </div>
</li>

<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('gallery');" href="#gallery">
      <p> Gallery </p>

    </a>
  </div>
</li>


<li class="hex">
  <div class="hexIn">
    <a class="hexLink" onclick="javascript:showDiv('contactUs');" href="#contactUs">
      <p> Contact Us </p>

    </a>
  </div>
</li>

</ul>
</div>
</div>

<div id="aboutUsHiddenContent">
<!--
      *****************************************************
                    About Valencia
      *****************************************************
-->

  <div class="showBox" id="aboutValencia" style="display: none; padding: 0px 15px 0px 15px">
      <div class="aboutUsContentDetail well">
        <p>Valancia Cooperative Housing society is a gated community located on Defence Road adjacent to Wapda Town. It is named after the city Valencia, Spain. Valancia was planned in the 1990s and started construction under the funding from Mashreq Bank. It is notable for its well-landscaped boulevards connecting a balanced mix of single-family detached homes, community and shopping centers. Valancia also has an extensive system of paved pathways with grade separations over and under the boulevards. Valancia's residential areas are separated into Blocks. Each Block has its own dedicated green areas and play grounds. It has direct access from Khyaban-e-Jinnah and Defence Road. Valancia covers an area of about 1,000 acres (4.0 km2).</p>
      </div>
  </div>

<!--
      *****************************************************
                    Committe Members
      *****************************************************
-->

  <div class="showBox" id="committe" style="display: none;">
      <div class="aboutUsContentDetail">

<!--
  *****************************************************
              Higher Members
  *****************************************************
 -->
  @if (!empty($committe))
  <div id="higherLvlMembers" class="col col-md-12 col-sm-12 col-xs-12">
    <div id="firstLevel" class="col-md-12 col-sm-12 col-xs-12 levels">
      <div class="col-md-10 col-md-offset-3">
  @for($i=0; $i<count($committe); $i++)
  @if($committe[$i]->position=='1') <!-- 1 = President -->
  <div class="col col-md-4 col-sm-12 col-xs-12">
          <div class="card">
  <img src={{ asset('storage/myAssets/MC/'.$committe[$i]->imgpath) }}>
                  <h3>{{$committe[$i]->name}}</h3>
                  <p class="title">President</p>
                  <p>{{$committe[$i]->contact}}</p>
                  <p>{{$committe[$i]->email}}</p>
  </div>
      </div>
      @endif
      @endfor

@for($i=0; $i<count($committe); $i++)
      @if($committe[$i]->position=='2') <!-- 3 = Secretary -->
      <div class="col col-md-4 col-sm-6 col-xs-12">
        <div class="card">
          <img src={{ asset('storage/myAssets/MC/'.$committe[$i]->imgpath) }}>
          <h3>{{$committe[$i]->name}}</h3>
          <p class="title">Secretary</p>
          <p>{{$committe[$i]->contact}}</p>
          <p>{{$committe[$i]->email}}</p>
        </div>
      </div>
      @endif
@endfor
</div>
</div>

<div id="secondLevel" class="col-md-12 col-sm-12 col-xs-12 levels">
@for($i=0; $i<count($committe); $i++)
  @if($committe[$i]->position=='3') <!-- 2 = Vice President -->
  <div class="col col-md-4 col-sm-6 col-xs-12">
          <div class="card">
  <img src={{ asset('storage/myAssets/MC/'.$committe[$i]->imgpath) }}>
                  <h3>{{$committe[$i]->name}}</h3>
                  <p class="title">Vice President</p>
                  <p>{{$committe[$i]->contact}}</p>
                  <p>{{$committe[$i]->email}}</p>
  </div>
      </div>
      @endif
      @endfor

@for($i=0; $i<count($committe); $i++)
  @if($committe[$i]->position=='4') <!-- 4 = Joint Secretary -->
  <div class="col col-md-4 col-sm-6 col-xs-12">
          <div class="card">
  <img src={{ asset('storage/myAssets/MC/'.$committe[$i]->imgpath) }}>
                  <h3>{{$committe[$i]->name}}</h3>
                  <p class="title">Joint Secretary</p>
                  <p>{{$committe[$i]->contact}}</p>
                  <p>{{$committe[$i]->email}}</p>
  </div>
      </div>
      @endif
      @endfor

      @for($i=0; $i<count($committe); $i++)
  @if($committe[$i]->position=='5') <!-- 5 = Finance Secretary -->
  <div class="col col-md-4 col-sm-6 col-xs-12">
          <div class="card">
  <img src={{ asset('storage/myAssets/MC/'.$committe[$i]->imgpath) }}>
                  <h3>{{$committe[$i]->name}}</h3>
                  <p class="title">Finance Secretary</p>
                  <p>{{$committe[$i]->contact}}</p>
                  <p>{{$committe[$i]->email}}</p>
  </div>
      </div>
      @endif
      @endfor
      </div>
      </div>

  <div id="thirdLevel" class="col col-md-12 col-sm-12 col-xs-12 levels">
  @for($i=0; $i<count($committe); $i++)
  @if($committe[$i]->position=='6') <!-- 6 = Executive -->
  <div class="col col-md-3 col-sm-6 col-xs-12">
          <div class="card">
  <img src={{ asset('storage/myAssets/MC/'.$committe[$i]->imgpath) }}>
                  <h3>{{$committe[$i]->name}}</h3>
                  <p class="title">Executive</p>
                  <p>{{$committe[$i]->contact}}</p>
                  <p>{{$committe[$i]->email}}</p>
  </div>
      </div>
      @endif
      @endfor
      </div>
      @endif
  .</div>
  </div>


<!--
    *****************************************************
                  Focal Members
    *****************************************************
-->
  <div class="showBox" id="focal" style="display: none;">
  <div class="aboutUsContentDetail">

    @if (!empty($focal))
  <div id="focalMembers" class="col col-md-12 col-sm-12 col-xs-12">
  @for($i=0; $i<count($focal); $i++)
  <div class="col col-md-3 col-sm-6 col-xs-12">
  <div class="card">
<img src={{ asset('storage/myAssets/FP/'.$focal[$i]->imgpath) }}>
          <h3>{{$focal[$i]->name}}</h3>
          <p class="title">{{$focal[$i]->position}}</p>
          <p>{{$focal[$i]->contact}}</p>
          <p>{{$focal[$i]->email}}</p>
</div>


      </div>
      @endfor
      </div>
      @endif
     .</div>
  </div>

  <!--
      *****************************************************
                    Focal Members
      *****************************************************
  -->

  <div class="showBox" id="map" style="display: none;">
  <div class="aboutUsContentDetail"> <center></center><a href="storagestorage/myAssets/valenciaMap.jpg" target="_blank" ><img src="storagestorage/myAssets/valenciaMap.jpg"></a> </center></div>
  </div>

  <!--
      *****************************************************
                    Achievements
      *****************************************************
  -->

  <div class="showBox" id="achievements" style="display: none;">
  <div class="aboutUsContentDetail">
@if (!empty($achievement))
<!-- Achievements Carousel Start -->
    <div id="achievementsCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#achievementsCarousel" data-slide-to="0" class="active"></li>
        @if(count($achievement)>1)
        @for($i=1; $i<count($achievement); $i++)
        <li data-target="#achievementsCarousel" data-slide-to="{{$i}}"></li>
        @endfor
        @endif
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <div class="carousel-caption">
              <h1>{{$achievement[0]->title}}</h1>
          </div>
          {{--  <img src="/storagestorage/myAssets/achievements/{{$achievement[0]->imgpath}}" style="width:100%;">  --}}
          <img src={{ asset('storage/myAssets/achievements/'.$achievement[0]->imgpath) }} style="width:100%;">
      </div>
@if(count($achievement)>1)
@for($i=1; $i<count($achievement); $i++)
      <div class="item">
          <div class="carousel-caption">
              <h1>{{$achievement[$i]->title}}</h1>
          </div>
          <img src={{ asset('storage/myAssets/achievements/'.$achievement[$i]->imgpath) }} style="width:100%;">
      </div>
@endfor
@endif
      </div>
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#achievementsCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#achievementsCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
<!-- Achievement Carousel End -->
@endif
</div>
  </div>

  <!--
      *****************************************************
                    Projects
      *****************************************************
  -->
  <div class="showBox" id="projects" style="display: none;">
  <div class="aboutUsContentDetail">

@if (!empty($project))
    <!-- Projects Carousel Start -->
        <div id="projectsCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#projectsCarousel" data-slide-to="0" class="active"></li>
            @if(count($project)>1)
            @for($i=1; $i<count($project); $i++)
            <li data-target="#projectsCarousel" data-slide-to="{{$i}}"></li>
            @endfor
            @endif
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <div class="carousel-caption">
                  <h1>{{$project[0]->title}}</h1>
              </div>
              <img src={{ asset('storage/myAssets/onGoingProjects/'.$project[0]->imgpath) }} style="width:100%;">
          </div>
@if(count($project)>1)
@for($i=1; $i<count($project); $i++)
          <div class="item">
              <div class="carousel-caption">
                  <h1>{{$project[$i]->title}}</h1>
              </div>
              <img src={{ asset('storage/myAssets/onGoingProjects/'.$project[$i]->imgpath) }} style="width:100%;">
          </div>
@endfor
@endif
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#projectsCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#projectsCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    <!-- Projects Carousel End -->
@endif
  </div>
  </div>

<!--
    *****************************************************
                      Gallery
    *****************************************************
-->
  <div class="showBox" id="gallery" style="display: none;">
  <div class="aboutUsContentDetail">

@if (!empty($galleryImage))
      <!-- Gallery Carousel Start -->
          <div id="galleryCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#galleryCarousel" data-slide-to="0" class="active"></li>
              @if(count($galleryImage)>1)
              @for($i=1; $i<count($galleryImage); $i++)
              <li data-target="#galleryCarousel" data-slide-to="{{$i}}"></li>
              @endfor
              @endif
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <div class="carousel-caption">
                    <h1>{{$galleryImage[0]->title}}</h1>
                </div>
                <img src={{ asset('storage/myAssets/gallery/'.$galleryImage[0]->imgpath) }} style="width:100%;">
            </div>
@if(count($galleryImage)>1)
@for($i=1; $i<count($galleryImage); $i++)
            <div class="item">
                <div class="carousel-caption">
                    <h1>{{$galleryImage[$i]->title}}</h1>
                </div>
                <img src={{ asset('storage/myAssets/gallery/'.$galleryImage[$i]->imgpath) }} style="width:100%;">
            </div>
@endfor
@endif
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#galleryCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#galleryCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      <!-- Gallery Carousel End -->
@endif
      </div>
  </div>

  <!--
      *****************************************************
                    Contact Us
      *****************************************************
  -->
  <div class="showBox" id="contactUs" style="display: none;">
  <div class="aboutUsContentDetail">
    <form class="form-horizontal" method="POST" action="/contactUs">
{{ csrf_field() }}

    <div class="form-group">
<label for="name" class="col-md-4 control-label"><span style="color:red">*</span>Name</label>
<div class="col-md-6">
<input id="name" type="text" class="form-control" name="name" required>
    </div>

</div>

    <div class="form-group">
<label for="email" class="col-md-4 control-label"><span style="color:red">*</span>Email</label>
<div class="col-md-6">
<input id="email" type="email" class="form-control" name="email" required>
    </div>
</div>

<div class="form-group">
<label for="message" class="col-md-4 control-label">Your Message</label>
<div class="col-md-6">
<textarea rows="5" id="message" class="form-control" name="message" required></textarea>
</div>
</div>

<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">
Send Message
</button>

</a>
</div>
</div>
</form>


   </div>
  </div>
  </div>

</div> <!-- ABOUT US END -->

<!-- Circular DIV -->
<!-- this span tag is used to make the link jump below the fixed nav -->
<span class="anchor" id="circulars"></span>
<div class="middlePartSections" style="float:left; width:100%">
<div id="circularHeading" class="middlePartHeadings">
  <p>
    Circular
  </p>
</div>
<div id="circularContent" class="middlePartContents" style="float:left;">
  @if (!empty($circular))
  <div id="circularLeftList">
    <ul>
      @for($i=0; $i<count($circular); $i++)
      @if($i%2=='0')
      <li>
        <a href={{ asset('storage/myAssets/circulars/'.$circular[$i]->filepath) }} download={{$circular[$i]->title}}> {{$circular[$i]->title}} </a>
      </li>
      @endif
      @endfor
      </ul>
  </div>
  <div id="circularRightList">
    <ul>
      @for($i=0; $i<count($circular); $i++)
      @if($i%2!='0')
      <li>
        <a href={{ asset('storagestorage/myAssets/circulars/'.$circular[$i]->filepath) }}>{{$circular[$i]->title}}</a>
      </li>
      @endif
      @endfor
      </ul>
  </div>

  @endif
</div>
</div>
  </div> <!-- MIDDLE PART END -->

<!-- Bottom PART CONTAINS(Footer) -->
<div id="bottomPart" class="col col-md-12 col-sm-12 col-xs-12">
  <p>Laravel Practice Project <br />
    Made by <span style="color:red">Anum Amir (Student of BSSE)</span>
    <br>
    <a href="/documentation" target="_blank">Click To know more about the project</a></p>
</div>
<!-- Bottom PART END -->
</div>
@endsection

@section('script')
<script>

// $(window).load(function(){
// $('#myModal').modal('show');
//  });

    var url = window.location.hash;
    var hash = url.substring(url.indexOf("#") + 1);
        $('#'+hash).show();

    // Show Div
    function showDiv(selectedOne) {
        $('.showBox').each(function(index) {
            if ($(this).attr("id") == selectedOne) {
                $(this).toggle();
            }
            else {
                $(this).hide();
            }
        });
    }

</script>
@endsection
