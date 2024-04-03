@extends('backend.layouts.main')
@section('title', 'Thêm nhà phân phối')
@section('content')
<section class="content-header">
  <h1>
    Thêm nhà phân phối
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.partner.index')}}">Danh sách nhà phân phối</a></li>
    <li class="active">Thêm nhà phân phối</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
	      	@include('backend.component.partner.add')
		</div>
	</div>
</section>
<script type="text/javascript">
  $('#company_id').select2();
</script>
@stop