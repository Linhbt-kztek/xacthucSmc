@extends('backend.layouts.main')
@section('title', 'Thêm sản phẩm')
@section('content')
<section class="content-header">
  <h1>
    Thêm sản phẩm
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.product.index')}}">Danh sách sản phẩm</a></li>
    <li class="active">Thêm sản phẩm</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@include('backend.component.product.add')
		</div>
	</div>
</section>
@stop