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
    <h1>{{$memberType}}</h1>
</div>
<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchForm" id="searchForm">
  <form action="/searchMember" method="POST" role="search" target="_blank">
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
<!--
********************************************************************
                          Heading
********************************************************************
 -->
<div id="membersTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">

  <div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
       <h2>Activated {{$memberType}} ({{count($enabledMembers)}}) </h2>
</div>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($enabledMembers as $enabledMember)
    <tr>
      <td data-column="Title">Name: {{$enabledMember->name}}
        <br />
        Type:
        @if($enabledMember->type =='1') Committe Member
        <br />
        Position:
        @if($enabledMember->position =='1') President
        @endif
        @if($enabledMember->position =='2') Vice President
        @endif
        @if($enabledMember->position =='3') Secretary
        @endif
        @if($enabledMember->position =='4') Joint Secretary
        @endif
        @if($enabledMember->position =='5') Finance Secretary
        @endif
        @if($enabledMember->position =='6') Executive Member
        @endif
        @endif
        @if($enabledMember->type =='2') Focal Member
        <br />
        Position: {{$enabledMember->position}}
         @endif
      </td>
      <td data-column="Actions" style="text-align:center;">
        <a href="{{'/edit-member/'.$enabledMember->type. '/' .$enabledMember->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
                <form style="margin-top:15px;" action="{{'/disable-member/'.$enabledMember->type. '/' .$enabledMember->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Disable</button>
                </form>
                <form style="margin-top:15px;" action="{{'/delete-member/' .$enabledMember->type. '/' .$enabledMember->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $enabledMembers->appends(['disabledTable' => $disabledMembers->currentPage()])->links() }}

<!--
********************************************************************
                          Heading
********************************************************************
 -->

 <div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
      <h2>deactivated {{$memberType}} ({{count($disabledMembers)}})</h2>
</div>


<!--
********************************************************************
                           Disabled Table
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
@foreach ($disabledMembers as $disabledMember)
    <tr>
      <td data-column="Title">{{$disabledMember->name}}</td>
      <td data-column="Actions">
        <a href="{{'/edit-member/'.$disabledMember->id}}" class="btn btn-info" title="Edit" >View / Edit</a>
        <form style="margin-top:15px;" action="{{'/enable-member/'.$disabledMember->type. '/' .$disabledMember->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Enable</button>
        </form>
        <form style="margin-top:15px;" action="{{'/delete-member/'.$disabledMember->type.'/'.$disabledMember->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $disabledMembers->appends(['enabledTable' => $enabledMembers->currentPage()])->links() }}
</div>
</div>
@endsection

@section('script')

@endsection
