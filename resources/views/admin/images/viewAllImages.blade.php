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
  <h1>{{$imageType}}</h1>
</div>

<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchImage" id="searchForm">
  <form action="/searchImage" method="POST" role="search" target="_blank">
    {{ csrf_field() }}
    <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Search for image"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
      </button>
      </span>
    </div>
  </form>
</div>
<!--
********************************************************************
                         Enabled Table
********************************************************************
 -->

<!--
********************************************************************
                          Table Heading
********************************************************************
 -->
<div id="imageTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">

<div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
     <h2>Activated {{$imageType}} ({{count($enabledImages)}})</h2>
</div>
<div id="table" class="col-md-12 col-sm-12 col-xs-12">
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($enabledImages as $enabledImage)
    <tr>
      <td data-column="Title">Title: {{$enabledImage->title}}
        <br>
      added on : {{\Carbon\Carbon::parse($enabledImage->created_at)->format('d/m/Y')}}
    </td>
      <td data-column="Actions">
        <a href="{{'/edit-image/'.$enabledImage->type. '/' .$enabledImage->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
                <form style="margin-top:15px;" action="{{'/disable-image/'.$enabledImage->type. '/' .$enabledImage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Disable</button>
                </form>
                <form style="margin-top:15px;" action="{{'/delete-image/' .$enabledImage->type. '/' .$enabledImage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{ $enabledImages->appends(['disabledTable' => $disabledImages->currentPage()])->links() }}

<!--
********************************************************************
                          Table Heading
********************************************************************
 -->

<div id="heading" class="col-md-12 col-sm-12 col-xs-12">
     <h2>Deactivated {{$imageType}} ({{count($disabledImages)}})</h2>
</div>


<!--
********************************************************************
                           Disabled Table
********************************************************************
 -->
<div id="table" class="col-md-12 col-sm-12 col-xs-12">
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach ($disabledImages as $disabledImage)
    <tr>
      <td data-column="Title">Title: {{$disabledImage->title}}
        <br>
      added on : {{\Carbon\Carbon::parse($disabledImage->created_at)->format('d/m/Y')}}
    </td>
      <td data-column="Actions">
        <a href="{{'/edit-image/' .$disabledImage->type. '/'. $disabledImage->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
        <form style="margin-top:15px;" action="{{'/enable-image/'.$disabledImage->type. '/' .$disabledImage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Enable</button>
        </form>
        <form style="margin-top:15px;" action="{{'/delete-image/'.$disabledImage->type.'/'.$disabledImage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $disabledImages->appends(['enabledTable' => $enabledImages->currentPage()])->links() }}
</div>
</div>
@endsection

@section('script')

@endsection
