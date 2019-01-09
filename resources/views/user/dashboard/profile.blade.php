@extends('user.layout.app')
 @section('contents')
 
    <section class="content-header">
      <h1>
        User Information
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">User Information</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <form action="{{route('user.edit')}}" method="POST">
        	@csrf
	         <!-- /.box-header -->
	         <div class="box-body">
	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Name</label>
	                <input type="text" class="form-control select2" name="name" value="{{Auth::user()->name}}">
	              </div>
	              <div class="form-group">
	                <label>Email</label>
	                <input type="email" name="email" class="form-control select2" name="email" value="{{Auth::user()->email}}">
	              </div>
	            </div>
	            <!-- /.col -->
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Email</label>
	                <input type="email" name="email" class="form-control select2" name="email" value="{{Auth::user()->email}}">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Address</label>
	                <input type="text" name="address" class="form-control select2"  value="{{Auth::user()->address}}">
	              </div>

	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	            <!-- /.col -->
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Country</label>
	                <input type="text" name="country" class="form-control select2"  value="{{Auth::user()->country}}">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Gender</label>
	                <input type="text"  class="form-control select2" name="gender" value="{{Auth::user()->gender}}">
	              </div>
	              
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	            <!-- /.col -->
	           
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	         </div>
	         <!-- /.box-body -->
	         <div class="box-footer">
	         <button type="submit">Submit</button>
	         </div>
	        </div>
      </form>
      <!-- /.box -->

    </section>
  
 @endsection