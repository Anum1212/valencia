@extends('layouts.remainingSiteLayout')

<!--
********************************************************************
                       Main Page Wrapper
********************************************************************
 -->
<div id="mainPageWrapper" class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:100px;">

  <!--
  ********************************************************************
                         Announcement Div
  ********************************************************************
   -->

<div id="announcementDiv" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
  <!-- Image Div -->
  @if($announcement->filetype=='3' || $announcement->filetype=='1')
  <div id="announcementImage" class="section col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <img src={{ asset('storage/myAssets/announcement/'.$announcement->imgpath) }} />
  </div>

  @else
  <div id="announcementImage" class="section col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <img src="/storage/myAssets/news.jpg" />
</div>
  @endif
<div id="announcementDetails" class="col-lg-12 col-md-12 col-col-sm-12 col-xs-12">

  <hr />
  <!-- Title Div -->
  <div id="announcementTitle" class="section col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1><u>{{$announcement->title}}</u></h1>
  </div>

  <!-- Content Div -->
  <div id="announcementContent" class="section col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p>
      {{$announcement->description}}
    </p>
  </div>

  <!-- Attachment Div -->
  @if($announcement->filetype=='3' || $announcement->filetype=='2')
  <div id="announcementFile" class="section col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <a class="btn btn-primary" role="button" href={{ asset('storage/myAssets/announcement/'.$announcement->filepath) }} download={{$announcement->title}}> Download File </a>
  </div>
  @endif
</div>
</div>

<!--
********************************************************************
                       Right Side Announcement Carousel
********************************************************************
 -->
<div id="announcementCarouselDiv" class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2" >
  @if (!empty($update))
        <!-- large display carousel -->
        <div id="largeDisplayCarousel">
                  <div id="announcementLargeDisplayCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                  <div class="item active">
                      <div class="row">
                          <div class="col-md-12 carousel-contnet myText">
                            @if (!empty($update[0]))
                            <div id="individualAnnouncement" class="individualAnnouncement">
                              <p>{{$update[0]->title}}
                              <a href="/view-announcement-details/{{$update[0]->id}}">Read More</a>
                              </p>
                            </div>
                            @endif
                            @if (!empty($update[1]))
                            <div id="individualAnnouncement" class="individualAnnouncement">
                              <p>{{$update[1]->title}}
                              <a href="/view-announcement-details/{{$update[1]->id}}">Read More</a>
                              </p>
                            </div>
                            @endif
                            @if (!empty($update[2]))
                            <div id="individualAnnouncement" class="individualAnnouncement">
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
                            <div class="individualAnnouncement">
                              <p>{{$update[$i]->title}}
                              <a href="/view-announcement-details/{{$update[$i]->id}}">Read More</a>
                              </p>
                            </div>
                            @endif
                            @if($i+1 < count($update))
                            <div id="individualAnnouncement" class="individualAnnouncement">
                              <p>{{$update[$i+1]->title}}
                              <a href="/view-announcement-details/{{$update[$i+1]->id}}">Read More</a>
                              </p>
                            </div>
                            @endif
                            @if($i+2 < count($update))
                            <div class="individualAnnouncement">
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
              <a class="top carousel-control" data-target="#announcementLargeDisplayCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
              </a>
              <a class="bottom carousel-control" data-target="#announcementLargeDisplayCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
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
</div>

