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
  @if($member->type=="1")
  <h1>Edit Managment Committe Member</h1>
  @endif
  @if($member->type=="2")
  <h1>Edit Focal Member</h1>
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
                       Div
********************************************************************
-->
    <div id="currentImage" class="col col-md-4 col-sm-12 col-xs-12">
@if($member->type=="1")
  <img src={{ asset('storage/myAssets/MC/'.$member->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
@endif
@if($member->type=="2")
  <img src={{ asset('storage/myAssets/FP/'.$member->imgpath) }} style="height:250px; width:250px; margin-bottom:25px;">
@endif
<br><b>Current Image</b>
</div>
<!--
********************************************************************
                       Form
********************************************************************
-->
     <div id="editForm" class="col col-md-8 col-sm-12 col-xs-12">
                          <form class="form-horizontal" method="POST" action="{{'/edit-member/'.$member->type. '/' .$member->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="form-group">
							<label for="memberName" class="col-md-4 control-label"><span style="color:red">*</span> Name</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberName" type="text" class="form-control" name="memberName" value="{{$member->name}}" required>
                            </div>
                            </div>
                            <div class="form-group">
							<label for="memberType" class="col-md-4 control-label"><span style="color:red">*</span> Member Type</label>
                            <div class="col-md-6" style="margin-bottom:15px;">
                              <select class="form-control" id="memberType" name="memberType">
                                <option value="1" <?php if($member->type=="1") echo 'selected="selected"'; ?> >Managment Committe</option>
                                <option value="2" <?php if($member->type=="2") echo 'selected="selected"'; ?> >Focal Person</option>
                              </select>
                            </div>
                            </div>
        <!-- ***********************************************************************************************************
                                                              committe
             *********************************************************************************************************** -->
                            <div id="committe">
                              <div class="form-group">
                               <label for="memberPosition" class="col-md-4 control-label"><span style="color:red">*</span> Position</label>
                            <div class="col-md-6" style="margin-bottom:15px;">
                                 <select class="form-control" id="memberPosition1" name="memberPosition1">
                                   <option value="1"<?php if($member->position=="1") echo 'selected="selected"'; ?> >President</option>
                                   <option value="3"<?php if($member->position=="2") echo 'selected="selected"'; ?> >Secretary</option>
                                   <option value="2"<?php if($member->position=="3") echo 'selected="selected"'; ?> >Vice President</option>
                                   <option value="4"<?php if($member->position=="4") echo 'selected="selected"'; ?> >Joint Secretary</option>
                                   <option value="5"<?php if($member->position=="5") echo 'selected="selected"'; ?> >Finance Secretary</option>
                                   <option value="6"<?php if($member->position=="6") echo 'selected="selected"'; ?> >Exective Member</option>
                                 </select>
                                 </div>
                                 </div>
                                 </div>


            <!-- ***********************************************************************************************************
                                                                  focal
                 *********************************************************************************************************** -->
                                      <div id="focal">
                                        <div class="form-group">
                                      <label for="memberPosition" class="col-md-4 control-label"><span style="color:red">*</span> Position</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberPosition2" type="text" class="form-control" name="memberPosition2" value="{{$member->position}}">
                            </div>
                            </div>
                            </div>

<div class="form-group">
							<label for="memberContactNo" class="col-md-4 control-label"><span style="color:red">*</span> Contact Number</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberContactNo" type="text" class="form-control" name="memberContactNo" value="{{$member->contact}}" required>
                            </div>
                            </div>
                            <div class="form-group">
							<label for="memberEmail" class="col-md-4 control-label"><span style="color:red">*</span> Email</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberEmail" type="email" class="form-control" name="memberEmail" value="{{$member->email}}" required>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="memberImage" class="col-md-4 control-label"><span style="color:red">*</span> Image</label>
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
						</div>
					</form>
          added on : {{\Carbon\Carbon::parse($member->created_at)->format('d/m/Y')}}
</div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>

<script>
$(document).ready(function() {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
    //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#memberType").change(function () {
        toggleFields();
    });
        $('.file-upload').file_upload();
    });

    function toggleFields() {
    if ($("#memberType").val() == 1)
     {   $("#focal").hide();
        $("#focal").prop('required',false);
        $("#committe").show();
    }
    if ($("#memberType").val() == 2)
     {   $("#focal").show();
        $("#focal").prop('required',true);
        $("#committe").hide();
    }
}

    // Image Upload
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();


</script>

@endsection
