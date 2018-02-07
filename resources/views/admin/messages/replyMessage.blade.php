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

<!--
********************************************************************
                          Page Title
********************************************************************
 -->

<div id="pageTitle" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1>Message</h1>
</div>

<!--
********************************************************************
                    Main Wrapper for Divs
********************************************************************
 -->

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 well">

<!--
********************************************************************
                      Sender Message Div
********************************************************************
-->
<!-- sender details -->
<div id="sender" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div id="senderName" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <p>
      Message by: <b>{{$message->name}}</b>
      <br />
      Email: <b>{{$message->senderEmail}}</b>
    </p>
  </div>

  <!-- view previous messages button -->
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <a href="/view-all-messages-of-specific-sender/{{$message->id}}" class="btn btn-default" target="_blank">View Previous Messages</a>
  </div>

  <!-- Sender Message -->
  <div id="senderMessage" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <p>
      {{$message->message}}
  </p>
</div>
</div>

<!--
********************************************************************
                      Admin Reply Form
********************************************************************
-->
<div id="adminReply" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <form class="form-horizontal" method="POST" action="{{'/reply-message/'.$message->id}}">
                        {{ csrf_field() }}

<!-- reply text box -->
						<div class="form-group">
							<label for="messageReply" class="col-md-4 control-label">Message Reply</label>
							<div class="col-md-6">
								<textarea rows="5" id="messageReply" class="form-control" name="messageReply" required></textarea>
							</div>
						</div>

<!-- send reply button -->
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Send Reply
								</button>
							</div>
						</div>
					</form>

          <!-- mark as read button -->
          @if($message->status=='0')
          <form style="margin-top:15px;" action="{{'/mark-as-read-message/'.$message->id}}" method="post">
                                      {{csrf_field()}} {{method_field('PUT')}}
                                      <button type="submit" class="btn btn-success">Mark as Read</button>
                                    </form>
                                    @endif

        <!-- mark as unread button -->
          @if($message->status=='1')
          <form style="margin-top:15px;" action="{{'/mark-as-unread-message/'.$message->id}}" method="post">
                                      {{csrf_field()}} {{method_field('PUT')}}
                                      <button type="submit" class="btn btn-success">Mark as UnRead</button>
                                    </form>
                                    @endif
</div>
</div>

@endsection

@section('script')

@endsection
