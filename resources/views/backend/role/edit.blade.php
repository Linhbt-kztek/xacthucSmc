@extends('backend.layouts.main')
@section('title', 'Cập nhật nhóm quyền')
@section('content')
<section class="content-header">
  <h1>
    Cập nhật nhóm quyền
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.role.index')}}">Danh sách nhóm quyền</a></li>
    <li class="active">Cập nhật nhóm quyền</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" action="{{route('backend.role.pEdit',['id'=>$model->id])}}" method="POST">
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
					              	<label class="control-label col-md-3 col-sm-3 col-xs-12 required" for="name">Tên nhóm quyền</label>
					              	<div class="col-md-9 col-sm-9 col-xs-12">
						              	<input type="text" class="form-control" name="name" id="name" placeholder="Enter" value="{{$model->name}}" maxlength="255">
						              	<span class="help-block">{{$errors->first("name")}}</span>
					              	</div>
					            </div>
					            <!-- /.form-group -->
					     		<div class="form-group">
					                <label class="control-label col-md-3 col-sm-3 col-xs-12">Unselected Permission</label>
					                <div class="col-md-9 col-sm-9 col-xs-12">
					                  	<select id="unselected-per" class="form-control" multiple="multiple" style="height: 250px;">
						                    @foreach($per_unselected as $permission)
						                    <option value="{{$permission->name}}">{{$permission->description}}</option>
						                    @endforeach
					                  	</select>
					                </div>
				              	</div>
				               	<div class="form-group">
					                <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3 col-xs-12 text-center">
					                  	<button type="button" class="btn btn-danger btn-unselected-per"><i class="fa fa-angle-double-up"></i></button>
					                  	<button type="button" class="btn btn-success btn-selected-per"><i class="fa fa-angle-double-down"></i></button>
					                </div>
				               	</div>
				              	<div class="form-group {{$errors->has('permission') ? 'has-error' : ''}}">
					                <label class="control-label col-md-3 col-sm-3 col-xs-12 required">Selected Permission</label>
					                <div class="col-md-9 col-sm-9 col-xs-12">
					                  	<select id="selected-per" name="permission[]" class="form-control" multiple="multiple" style="height: 250px;">
						                    @foreach($per_selected as $permission)
						                    <option value="{{$permission->name}}" selected>{{$permission->description}}</option>
						                    @endforeach
				                  		</select>
					                </div>
					                <span class="help-block">{{$errors->first("permission")}}</span>
				              	</div>
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