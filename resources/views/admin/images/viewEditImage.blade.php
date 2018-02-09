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
  @if($image->type=="1")
  <h1>Edit Achievement</h1>
  @endif
  @if($image->type=="2")
  <h1>Edit Ongoing Project</h1>
  @endif
  @if($image->type=="3")
  <h1>Edit Gallery</h1>
  @endif
  @if($image->type=="4")
  <h1>Edit Main Slider</h1>
  @endif
</div>
<!--
********************************************************************
                    Main Wrapper for Form Divs
********************************************************************
 -->

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 well">

<!--
********************************************************************
                       Image Div
********************************************************************
-->
    <div id="currentImage" class="col col-md-4 col-sm-12 col-xs-12">
@if($image->type=="1")
  <img src={{ asset('storage/myAssets/achievements/'.$image->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
@endif
@if($image->type=="2")
  <img src={{ asset('storage/myAssets/onGoingProjects/'.$image->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
@endif
@if($image->type=="3")
  <img src={{ asset('storage/myAssets/gallery/'.$image->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
@endif
@if($image->type=="4")
  <img src={{ asset('storage/myAssets/slider/'.$image->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
@endif
<br><b>Current Image</b>
</div>
<!--
********************************************************************
                       Form
********************************************************************
-->
<div id="editForm" class="col col-md-8 col-sm-12 col-xs-12">
                           <form class="form-horizontal" method="POST" action="{{'/edit-image/'.$image->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="form-group">
							<label for="imageTitle" class="col-md-4 control-label"><span style="color:red">*</span> Title</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="imageTitle" type="text" class="form-control" name="imageTitle" value="{{$image->title}}" required>
                            </div>
                            </div>
                            <div class="form-group">
                               <label for="uploadImageCategory" class="col-md-4 control-label"><span style="color:red">*</span> Upload Image to:</label>
                            <div class="col-md-6" style="margin-bottom:15px;">
                                 <select class="form-control" id="imageType" name="imageType">
                                   <option value="1" <?php if($image->type=="1") echo 'selected="selected"'; ?> >Achievement</option>
                                   <option value="2" <?php if($image->type=="2") echo 'selected="selected"'; ?> >OnGoing Project</option>
                                   <option value="3" <?php if($image->type=="3") echo 'selected="selected"'; ?> >Gallery</option>
                                   <option value="4" <?php if($image->type=="4") echo 'selected="selected"'; ?> >Main Slider</option>
                                 </select>
                                 </div>
                                 </div>
                                 <div class="form-group">
                            <label for="uploadImageFile" class="col-md-4 control-label"><span style="color:red">*</span> Image</label>
                            <div class="col-md-6 imageupload panel panel-default">
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
            <div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Save Changes
								</button>
        </div>
						</div>
					</form>
          added on : {{\Carbon\Carbon::parse($image->created_at)->format('d/m/Y')}}
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
