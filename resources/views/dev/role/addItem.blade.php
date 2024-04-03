@extends('dev.layouts.main')
@section('title', 'Add New Role Item')
@section('content')
<section class="content-header">
  <h1>
    Add New Role Item
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dev.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('dev.role.indexItem')}}">List Role Item</a></li>
    <li class="active">Add New Role Item</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('dev.role.pAddItem')}}" method="POST">
				{{csrf_field()}}
				<div class="box box-default">
				    <div class="box-header with-border">
				      <h3 class="help">Lưu ý: những trường có (<span style="color: #f00">*</span>) là bắt buộc.</h3>

				      <div class="box-tools pull-right">
				        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				      </div>
				    </div>
				    <!-- /.box-header -->
				    <div class="box-body">
				      	<div class="row">
					        <div class="col-md-6">
					        	<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
					              	<label class="required" for="name">Name</label>
					              	<input type="text" class="form-control" name="name" id="name" placeholder="Enter">
					              	<span class="help-block">{{$errors->first("name")}}</span>
					            </div>
					            <!-- /.form-group -->
					     
					          	<div class="form-group">
				                  	<label class="required" for="description">Description</label>
				                  	<textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
				                </div>
					            <!-- /.form-group -->
					        </div>
					        <!-- /.col -->
					        <div class="col-md-6">
					        </div>
					        <!-- /.col -->
					  	</div>
				  	<!-- /.row -->
					</div>
				    <!-- /.box-body -->
				    <div class="box-footer text-ccenter">
			        	<button type="submit" class="btn btn-primary mrg-10">Save</button>
			        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
			      	</div>
				  </div>
			</form>
		</div>
	</div>
</section>
@stop