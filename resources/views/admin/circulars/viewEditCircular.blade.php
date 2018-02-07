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
    <h1>Edit Circular</h1>
</div>
<!--
********************************************************************
                    Main Wrapper for Form Divs
********************************************************************
 -->

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 well">


<!--
********************************************************************
                      Circular Div
********************************************************************
-->
    <div id="currentFile" class="col col-md-4 col-sm-12 col-xs-12">
        <a class="btn btn-default" href={{ asset('storage/myAssets/circulars/'.$circular->filepath) }} download= {{$circular->title}} >Download Currently Uploaded File</a>
</div>
<!--
********************************************************************
                      Circular Form
********************************************************************
-->
    <div id="editForm" class="col col-md-8 col-sm-12 col-xs-12">
                            <form class="form-horizontal" method="POST" action="{{'/edit-circular/'.$circular->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="form-group">
							<label for="circularTitle" class="col-md-4 control-label"><span style="color:red">*</span> Title</label>
							<div class="col-md-6">
								<input id="circularTitle" type="text" class="form-control" name="circularTitle" value="{{$circular->title}}"required style="margin-bottom:15px;">
                            </div>
                            </div>
                            <div class="form-group">
                           <label for="uploadCircularFile" class="col-md-4 control-label"><span style="color:red">*</span> File</label>
                            <div class="col-md-6 fileupload panel panel-default">
                <div class="file-tab panel-body">
                    <label class="btn btn-default btn-file">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="circularFile">
                    </label>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Save Changes
								</button>
							</div>
						</div>
					</form>
</div>
</div>

@endsection

@section('script')

@endsection
