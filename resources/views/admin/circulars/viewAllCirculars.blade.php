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
    <h1>Circulars</h1>
</div>

<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchForm" id="searchForm">
  <form action="/searchCircular" method="POST" role="search" target="_blank">
    {{ csrf_field() }}
    <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Search for message by"> <span class="input-group-btn">
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
 <div id="circularTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">

<!--
********************************************************************
                          Table Heading
********************************************************************
 -->

  <div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
     <h2>Activated Circulars ({{count($enabledCirculars)}})</h2>
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
      @foreach ($enabledCirculars as $enabledCircular)
    <tr>
      <td data-column="Title">{{$enabledCircular->title}}
        <br>
        added on : {{\Carbon\Carbon::parse($enabledCircular->created_at)->format('d/m/Y')}}
      </td>
      <td data-column="Actions">
        <a href="{{'/edit-circular/' .$enabledCircular->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
                <form style="margin-top:15px;" action="{{'/disable-circular/'.$enabledCircular->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Disable</button>
                </form>
                <form style="margin-top:15px;" action="{{'/delete-circular/'.$enabledCircular->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $enabledCirculars->appends(['disabledTable' => $enabledCirculars->currentPage()])->links() }}
</div>

<!--
********************************************************************
                         Enabled Table
********************************************************************
 -->
<div id="circularTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
  <!--
********************************************************************
                          Table Heading
********************************************************************
 -->
  <div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
    <h2>Deactivated Circulars ({{count($disabledCirculars)}})</h2>
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
@foreach ($disabledCirculars as $disabledCircular)
    <tr>
      <td data-column="Title">{{$disabledCircular->title}}
        <br>
        added on : {{\Carbon\Carbon::parse($disabledCircular->created_at)->format('d/m/Y')}}
      </td>
      <td data-column="Actions">
        <a href="{{'/edit-circular/'.$disabledCircular->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
        <form style="margin-top:15px;" action="{{'/enable-circular/' .$disabledCircular->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Enable</button>
        </form>
        <form style="margin-top:15px;" action="{{'/delete-circular/' .$disabledCircular->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $disabledCirculars->appends(['enabledTable' => $enabledCirculars->currentPage()])->links() }}
</div>
</div>
</div>

@endsection

@section('script')

@endsection
