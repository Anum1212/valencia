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

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div id="header" class="col-md-12 col-sm-12 col-xs-12 ">

  <div id="siteLogo">
  <div class="col-lg- col-md-2 col-sm-4 col-xs-12">
  <a href="/admin"><img src="/storage/myAssets/PECHS-Logo.png" style="height:80px"></a>
  </div>
  </div>

  <div id="adminPanel" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
  <a href="/admin"><h1>Admin Panel</h1></a>
  </div>
  </div>

<div class="form col-lg-5 col-lg-offset-3 col-md-5 col-md-offset-3 col-sm-12 col-xs-12">
  <form action="{{ route('admin.save.profile', $adminDetails->id) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{$adminDetails->name}}" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{$adminDetails->email}}" required>
    </div>
    <div class="form-group">
      <label for="password">Current Password</label>
      <input type="password" class="form-control" id="currentPassword" name="currentPassword" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="minimum length 6" autocomplete="off">
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit" name="submit" id="submit">Save Changes</button>
    </div>
  </form>
</div>

@endsection

@section('script')

  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  <script>

  $('#submit').click(function(e){
      if($('#currentPassword').val()!=""){
      $("#newPassword").prop('required', true);
    }
    else
    {
    $("#newPassword").prop('required', false);
    }
      });

</script>
@endsection
