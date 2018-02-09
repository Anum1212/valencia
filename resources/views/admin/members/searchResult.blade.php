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
    <h1>Search Result</h1>
</div>
<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchForm" id="searchForm">
    <form action="/searchSender" method="POST" role="search">
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
                         Unread Messages Table
********************************************************************
 -->
<!--
********************************************************************
                          Table Heading
********************************************************************
 -->
<div id="messageTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">

    <div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
        <h4>These are all the messages i could find admin ({{count($searchResults)}})</h4>
    </div>
    @if(!empty($searchResults))
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchResults as $searchResult)
            <tr>
                    <td data-column="Title"><b>Name:</b> {{$searchResult->name}}
                    <br>
                    @if ($searchResult->status==0)
                    <b>Status:</b> Not Displayed on site
                    @endif
                    @if ($searchResult->status==1)
                    <b>Status:</b> Displayed on site
                    @endif
                    @if ($searchResult->type==1)
                    <b>Upload Type:</b> Managment Committe
                    @endif
                    <br> @if ($searchResult->type==2)
                    <b>Member Type:</b> Focal Member
                    @endif
                    <br>
                    added on : {{\Carbon\Carbon::parse($searchResult->created_at)->format('d/m/Y')}}
                    </td>
                    <td data-column="Actions">
                    <a href="{{'/edit-member/'.$searchResult->type. '/' .$searchResult->id}}" class="btn btn-info" title="Edit">View / Edit</a>
                    @if ($searchResult->status==0)
                    <form style="margin-top:15px;" action="{{'/enable-member/'.$searchResult->type. '/' .$searchResult->id}}" method="post">
                        {{csrf_field()}} {{method_field('PUT')}}
                        <button type="submit" class="btn btn-warning">Enable Member</button>
                    </form>
                    @endif

                    @if ($searchResult->status==1)
                    <form style="margin-top:15px;" action="{{'/disable-member/'.$searchResult->type. '/' .$searchResult->id}}" method="post">
                        {{csrf_field()}} {{method_field('PUT')}}
                        <button type="submit" class="btn btn-warning">Disable Member</button>
                    </form>
                    @endif
                    <form style="margin-top:15px;" action="{{'/delete-announcement/'.$searchResult->type. '/' .$searchResult->id}}" method="post">
                        {{csrf_field()}} {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

@section('script')
@endsection
