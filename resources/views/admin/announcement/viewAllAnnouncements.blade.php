@extends('layouts.adminPanelLayout')

<!--
********************************************************************
                              Head
********************************************************************
 -->
@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection

<!--
********************************************************************
                              Body
********************************************************************
 -->
@section('body')

<!--
********************************************************************
                          Page Title
********************************************************************
 -->

<div id="pageTitle" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1>Announcements</h1>
</div>

<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchForm" id="searchForm">
  <form action="/searchAnnouncement" method="POST" role="search" target="_blank">
    {{ csrf_field() }}
    <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Search for Announcement"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
      </button>
      </span>
    </div>
  </form>
</div>
<!--
********************************************************************
                         Enabled Announcements Table
********************************************************************
 -->

<!--
********************************************************************
                          Table Heading
********************************************************************
 -->
<div id="announcementTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">

<div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
     <h2>Activated Announcements</h2>
</div>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($enabledAnnouncements as $enabledAnnouncement)
    <tr>
      <td data-column="Title">{{$enabledAnnouncement->title}}</td>
      <td data-column="Actions">
        <a href="{{'/edit-announcement/'.$enabledAnnouncement->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
                <form style="margin-top:15px;" action="{{'/disable-announcement/'.$enabledAnnouncement->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Disable</button>
                </form>
                <form style="margin-top:15px;" action="{{'/delete-announcement/'.$enabledAnnouncement->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $enabledAnnouncements->appends(['disabledTable' => $disabledAnnouncements->currentPage()])->links() }}

<!--
********************************************************************
                          Heading
********************************************************************
 -->

<div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
     <h2>Deactivated Announcements</h2>
</div>


<!--
********************************************************************
                           Disabled Announcement Table
********************************************************************
 -->
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach ($disabledAnnouncements as $disabledAnnouncement)
    <tr>
      <td data-column="Title">{{$disabledAnnouncement->title}}</td>
      <td data-column="Actions">
        <a href="{{'/edit-announcement/'.$disabledAnnouncement->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
        <form style="margin-top:15px;" action="{{'/enable-announcement/'.$disabledAnnouncement->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Enable</button>
        </form>
        <form style="margin-top:15px;" action="{{'/delete-announcement/'.$disabledAnnouncement->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $disabledAnnouncements->appends(['enabledTable' => $enabledAnnouncements->currentPage()])->links() }}
</div>
@endsection

@section('script')

@endsection
