@extends('layouts.adminPanelLayout')

<!--
********************************************************************
                              Head
********************************************************************
 -->
@section('head')
<style>
    .wrapper3 { /* overWriting adminPanel wrapper3 css */
    border-bottom: 0px;
  }
</style>
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
    <h1>Edit Announcement</h1>
</div>
<!--
********************************************************************
                    Main Wrapper for Form Divs
********************************************************************
 -->

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 well">

<!--
********************************************************************
                      Announcement Div
********************************************************************
-->

    <div id="attatchment" class="col-md-4 col-sm-12 col-xs-12">
      @if($announcement->filetype=='0')
      <span style="color:red">No file or image uploaded</span>
      @endif
      @if($announcement->filetype=='1')
  <img src={{ asset('storage/myAssets/announcement/'.$announcement->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
<br>
<b>Current Image</b><form style="margin-top:15px;" action="{{'/delete-announcement-image/'.$announcement->id}}" method="post">
    {{csrf_field()}} {{method_field('DELETE')}}
    <button type="submit" class="btn btn-danger">Delete Image</button>
</form>
<br />
  <span style="color:red">No file uploaded</span>
@endif



      @if($announcement->filetype=='2')
      <span style="color:red">No image uploaded</span>
      <br />
<a class="btn btn-default" href={{ asset('storage/myAssets/announcement/'.$announcement->filepath) }} download={{$announcement->title}} >Currently Uploaded File</a>
<form style="margin-top:15px;" action="{{'/delete-announcement-file/'.$announcement->id}}" method="post">
    {{csrf_field()}} {{method_field('DELETE')}}
    <button type="submit" class="btn btn-danger">Delete File</button>
</form>
@endif



@if($announcement->filetype=='3')
<img src={{ asset('storage/myAssets/announcement/'.$announcement->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
<br>
<b>Current Image</b>
<form style="margin-top:15px;" action="{{'/delete-announcement-image/'.$announcement->id}}" method="post">
    {{csrf_field()}} {{method_field('DELETE')}}
    <button type="submit" class="btn btn-danger">Delete Image</button>
</form>
<br>
<a class="btn btn-default" href={{ asset('storage/myAssets/announcement/'.$announcement->filepath) }} download={{$announcement->title}}>Currently Uploaded File</a>
<form style="margin-top:15px;" action="{{'/delete-announcement-file/'.$announcement->id}}" method="post">
    {{csrf_field()}} {{method_field('DELETE')}}
    <button type="submit" class="btn btn-danger">Delete File</button>
</form>
@endif

</div>

<!--
********************************************************************
                      Announcement Form
********************************************************************
-->
<div id="editForm" class="col-md-8 col-sm-12 col-xs-12">
                            <form class="form-horizontal" method="POST" action="{{'/edit-announcement/'.$announcement->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="form-group">
							<label for="announcementTitle" class="col-md-4 control-label"><span style="color:red">*</span> Title</label>
							<div class="col-md-6">
								<input id="announcementTitle" type="text" class="form-control" name="announcementTitle" value="{{$announcement->title}}" required>
                            </div>
						</div>

						<div class="form-group">
							<label for="announcementDetails" class="col-md-4 control-label">Details</label>
							<div class="col-md-6">
								<textarea rows="5" id="announcementDetails" class="form-control" name="announcementDetails">{{$announcement->description}}</textarea>
							</div>
						</div>

            <div class="form-group">
            <label for="uploadAnnouncementImage" class="col-md-4 control-label">Image</label>
            <div class="col-md-7 imageupload panel panel-default">
<div class="file-tab panel-body">
    <label class="btn btn-default btn-file">
        <span>Browse</span>
        <!-- The file is stored here. -->
        <input type="file" name="imageFile">
    </label>
    <button type="button" class="btn btn-default">Remove</button>
</div>
</div>
</div>

<div class="form-group">
<label for="uploadAnnouncementFile" class="col-md-4 control-label">File</label>
<div class="col-md-6 fileupload panel panel-default">
<div class="file-tab panel-body">
<label class="btn btn-default btn-file">
<span>Browse</span>
<!-- The file is stored here. -->
<input type="file" name="announcementFile">
</label>
</div>
</div>
</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit Announcement
								</button>
							</div>
						</div>
					</form>
</div>
</div>

@endsection

@section('script')
  <script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>
<script>

    // Image Upload
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();

    $(document).ready(function() {
        $('.file-upload').file_upload();
    });

</script>
@endsection
