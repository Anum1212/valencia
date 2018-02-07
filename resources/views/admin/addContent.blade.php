@extends('layouts.adminPanelLayout')

<!--
********************************************************************
                              Head
********************************************************************
 -->
@section('head')

@endsection

<!--
********************************************************************
                              Body
********************************************************************
 -->
@section('body')

<div id="header" class="col-md-12 col-sm-12 col-xs-12 ">

<div id="siteLogo">
<div class="col-lg- col-md-2 col-sm-4 col-xs-12">
<a href="/admin"><img src="storage/myAssets/PECHS-Logo.png" style="height:80px"></a>
</div>
</div>

<div id="adminPanel" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
<a href="/admin"><h1>Admin Panel</h1></a>
</div>
</div>

<!--
********************************************************************
                          Heading
********************************************************************
 -->

<div id="heading" class="col-md-12 col-sm-12 col-xs-12">
    <h1>What would you like to manage</h1>
</div>

<!--
********************************************************************
                    Main Wrapper for Form Divs
********************************************************************
 -->

<div id="managmentMenu" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!--
********************************************************************
                      Left Side Menu Items
********************************************************************
-->
<div id="leftSideMenu" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <!--
  ********************************************************************
                        Announcement Div
  ********************************************************************
  -->

      <div id="announcementWrapper" class="menuItem">
          <div class="menuItemHeading">
  <a id="announcement" onclick="javascript:showDiv('announcementDiv');" href="#announcementDiv">Announcement</a>
  </div>


  <div class="menuItemContent" id="announcementDiv" style="display: none;">

  <!--
  ********************************************************************
                        View All Announcements
  ********************************************************************
  -->
  <div class="oldUploadsButton">
      <a href="{{'/view-all-announcements'}}" class="btn btn-success">View Previous Announcements </a>
  </div>

  <!--
  ********************************************************************
                        Announcement Form
  ********************************************************************
  -->
  <div class="form">
                              <form class="form-horizontal" method="POST" action="/make-announcement" enctype="multipart/form-data">
                          {{ csrf_field() }}

                              <div class="form-group">
  							<label for="announcementTitle" class="col-md-4 control-label"><span style="color:red">*</span> Title</label>
  							<div class="col-md-6">
  								<input id="announcementTitle" type="text" class="form-control" name="announcementTitle" required>
                              </div>
  						</div>

  						<div class="form-group">
  							<label for="announcementDetails" class="col-md-4 control-label">Details</label>
  							<div class="col-md-6">
  								<textarea rows="5" id="announcementDetails" class="form-control" name="announcementDetails"></textarea>
  							</div>
  						</div>

<div class="form-group">
              <label for="uploadAnnouncementImage" class="col-md-4 control-label"> Image</label>
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
<label for="uploadAnnouncementFile" class="col-md-4 control-label"> File</label>
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
  									Make Announcement
  								</button>

  								</a>
  							</div>
  						</div>
  					</form>
  </div>
  </div>
  </div>

  <!--
  ********************************************************************
                        Image Upload Div
  ********************************************************************
  -->
  <div id="uploadImagesWrapper" class="menuItem">
  <div class="menuItemHeading">
      <a id="image" onclick="javascript:showDiv('imageDiv');" href="#imageDiv">Images</a>
  </div>
      <div class="menuItemContent" id="imageDiv" style="display: none;">

  <!--
  ********************************************************************
                        View uploaded images
  ********************************************************************
  -->
  <div class="oldUploadsButton">
     <a href="{{'/view-all-achievement-images'}}" class="btn btn-success" style="margin-bottom:10px;">View Uploaded Achievement Images </a>
     <a href="{{'/view-all-ongoing-images'}}" class="btn btn-success" style="margin-bottom:10px;">View Uploaded On Going Project Images </a>
     <a href="{{'/view-all-gallery-images'}}" class="btn btn-success" style="margin-bottom:10px;">View Uploaded Gallery Images </a>
     <a href="{{'/view-all-slider-images'}}" class="btn btn-success" style="margin-bottom:10px;">View Uploaded Main Slider Images </a>
  </div>

          <!--
  ********************************************************************
                        Image Upload Form
  ********************************************************************
  -->
  <div class="form">
                              <form class="form-horizontal" method="POST" action="/upload-image" enctype="multipart/form-data">
                          {{ csrf_field() }}

                              <div class="form-group">
  							<label for="imageTitle" class="col-md-4 control-label"><span style="color:red">*</span> Title</label>
  							<div class="col-md-6" style="margin-bottom:15px;">
  								<input id="imageTitle" type="text" class="form-control" name="imageTitle" required>
                              </div>
                              </div>
                              <div class="form-group">
                                 <label for="uploadImageCategory" class="col-md-4 control-label"><span style="color:red">*</span> Upload Image to:</label>
                              <div class="col-md-6" style="margin-bottom:15px;">
                                   <select class="form-control" id="imageType" name="imageType">
                                     <option value="1">Achievement</option>
                                     <option value="2">OnGoing Project</option>
                                     <option value="3">Gallery</option>
                                     <option value="4">Main Slider</option>
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
                          <input type="file" name="imageFile" required>
                      </label>
                      <button type="button" class="btn btn-default">Remove</button>
                  </div>
              </div>
              </div>
              <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
  								<button type="submit" class="btn btn-primary">
  									Upload Picture
  								</button>
          </div>
  						</div>
  					</form>
      </div>
  </div>
  </div>
  <!--
  ********************************************************************
                        Circular Upload Div
  ********************************************************************
  -->
  <div id="uploadCircularWrapper" class="menuItem">
  <div class="menuItemHeading">
          <a id="circular" onclick="javascript:showDiv('circularDiv');" href="#circularDiv">Circular</a>
  </div>
          <div class="menuItemContent" id="circularDiv" style="display: none;">

  <!--
  ********************************************************************
                        View uploaded Circulars
  ********************************************************************
  -->
  <div class="oldUploadsButton">
     <a href="{{'/view-all-circular'}}" class="btn btn-success">View Uploaded Circulars </a>
  </div>

  <!--
  ********************************************************************
                        Circular Form
  ********************************************************************
  -->
  <div class="form">
                              <form class="form-horizontal" method="POST" action="/upload-circular" enctype="multipart/form-data">
                          {{ csrf_field() }}

                              <div class="form-group">
  							<label for="circularTitle" class="col-md-4 control-label"><span style="color:red">*</span> Title</label>
  							<div class="col-md-6">
  								<input id="circularTitle" type="text" class="form-control" name="circularTitle" required style="margin-bottom:15px;">
                              </div>
                              </div>
                              <div class="form-group">
                             <label for="uploadCircularFile" class="col-md-4 control-label"><span style="color:red">*</span> File</label>
                              <div class="col-md-6 fileupload panel panel-default">
                  <div class="file-tab panel-body">
                      <label class="btn btn-default btn-file">
                          <span>Browse</span>
                          <!-- The file is stored here. -->
                          <input type="file" name="circularFile" required>
                      </label>
                  </div>
              </div>
              </div>
              <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
  								<button type="submit" class="btn btn-primary">
  									Upload Circular
  								</button>
  							</div>
  						</div>
  					</form>
          </div>
      </div>
  </div>
</div> <!-- Left Side Menu End-->

<!--
********************************************************************
                      Right Side Menu Items
********************************************************************
-->

<div id="rightSideMenu" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<!--
********************************************************************
                      Valenica Member Div
********************************************************************
-->
<div id="uploadMemberWrapper" class="menuItem">
<div class="menuItemHeading">
    <a id="member" href="#memberDiv" onclick="javascript:showDiv('memberDiv');" >Valencia Managment Members </a>
</div>
    <div class="menuItemContent" id="memberDiv" style="display: none;">

<!--
********************************************************************
                      View added members
********************************************************************
-->
<div class="oldUploadsButton">
   <a href="{{'/view-all-commitee-member'}}" class="btn btn-success" style="margin-bottom:10px;">View Existing Committe Members </a>
   <a href="{{'/view-all-focal-member'}}" class="btn btn-success" style="margin-bottom:10px;">View Existing Focal Members </a>
</div>

        <!--
********************************************************************
                       Add member Form
********************************************************************
-->
<div class="form">
                            <form class="form-horizontal" method="POST" action="/add-member" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="memberName" class="col-md-4 control-label"><span style="color:red">*</span> Name</label>
							<div class="col-md-6" style="margin-bottom:15px;">
                                <input id="memberName" type="text" class="form-control" name="memberName" required>
                            </div>
                            </div>
<div class="form-group">
                            <label for="memberType" class="col-md-4 control-label"><span style="color:red">*</span> Member Type</label>
                         <div class="col-md-6" style="margin-bottom:15px;">
                              <select class="form-control" id="memberType" name="memberType">
                                <option value="1">Managment Committe</option>
                                <option value="2">Focal Person</option>
                              </select>
                            </div>
                            </div>
        <!-- ***********************************************************************************************************
                                                              committe
             *********************************************************************************************************** -->
                            <div id="committe" class="form-group">
                               <label for="memberPosition" class="col-md-4 control-label"><span style="color:red">*</span> Position</label>
                            <div class="col-md-6" style="margin-bottom:15px;">
                                 <select class="form-control" id="memberPosition1" name="memberPosition1">
                                   <option value="1">President</option>
                                   <option value="2">Secretary</option>
                                   <option value="3">Vice President</option>
                                   <option value="4">Joint Secretary</option>
                                   <option value="5">Finance Secretary</option>
                                   <option value="6">Exective Member</option>
                                 </select>
                                 </div>
                                 </div>


            <!-- ***********************************************************************************************************
                                                                  focal
                 *********************************************************************************************************** -->
                                      <div id="focal" class="form-group">
                                      <label for="memberPosition" class="col-md-4 control-label"><span style="color:red">*</span> Position</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberPosition2" type="text" class="form-control" name="memberPosition2">
                            </div>
                            </div>

<div class="form-group">
                  <label for="memberContactNo" class="col-md-4 control-label"><span style="color:red">*</span> Contact Number</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberContactNo" type="text" class="form-control" name="memberContactNo" required autocomplete="off">
                            </div>
                            </div>
                            <div class="form-group">
							<label for="memberEmail" class="col-md-4 control-label"><span style="color:red">*</span> Email</label>
							<div class="col-md-6" style="margin-bottom:15px;">
								<input id="memberEmail" type="email" class="form-control" name="memberEmail" required>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="memberImage" class="col-md-4 control-label"><span style="color:red">*</span> Image</label>
                            <div class="col-md-6 imageupload panel panel-default">
                <div class="file-tab panel-body">
                    <label class="btn btn-default btn-file">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="imageFile" required>
                    </label>
                    <button type="button" class="btn btn-default">Remove</button>
                </div>
            </div>
            </div>
            <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Add Member
								</button>
        </div>
						</div>
					</form>
    </div>
</div>
</div>


<!--
********************************************************************
                      Messages Div
********************************************************************
-->
<div id="messageWrapper" class="menuItem">
<div class="menuItemHeading">
        <a id="circular" href="#messagesDiv"onclick="javascript:showDiv('messagesDiv');" >Messages</a>
</div>
        <div class="menuItemContent" id="messagesDiv" style="display: none;">

<!--
********************************************************************
                      View Messages
********************************************************************
-->
<div class="oldUploadsButton">
   <a href="{{'/view-all-messages'}}" class="btn btn-success" style="margin-bottom:20px;">View Messages </a>
</div>

    </div>
</div>
</div> <!-- Right Side Menu End-->

</div> <!-- Main wrapper for div forms  -->
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
    // Show Div
    function showDiv(selectedOne) {
        $('.menuItemContent').each(function(index) {
            if ($(this).attr("id") == selectedOne) {
                $(this).toggle(200);
            }
            else {
                $(this).hide(400);
            }
        });
    }

    // Image Upload
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();


</script>

@endsection
