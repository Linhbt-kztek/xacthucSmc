@extends('backend.layouts.main')
@section('title', 'Thêm giải thưởng')
@section('content')
<section class="content-header">
  <h1>
    Thêm giải thưởng
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.winning.index')}}">Danh sách giải thưởng</a></li>
    <li class="active">Thêm giải thưởng</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@include('backend.component.winning.add')
		</div>
	</div>
</section>
@stop