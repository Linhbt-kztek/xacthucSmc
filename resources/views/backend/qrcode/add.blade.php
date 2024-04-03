@extends('backend.layouts.main')
@section('title', 'In QRCode')
@section('content')
<section class="content-header">
  <h1>
    In QRCode 
    <small>Quản trị xuất code </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.qrcode.index')}}">Danh sách QRCode đã in</a></li>
    <li class="active">In QRCode</li> 
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form action="{{route('backend.qrcode.pAdd')}}" method="POST">
        {{csrf_field()}}
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="help">Lưu ý: những trường có (<span style="color: #f00">*</span>) là bắt buộc.</h3>
              <p style="color: #f00;">{{$errors->first()}}</p>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group {{$errors->has('company_id') ? 'has-error' : ''}}">
                        <label class="required" for="company_id">Chọn doanh nghiệp</label>
                        <select class="form-control" id="company_id" name="company_id" style="width: 50%;">
                          <option value="">--Chọn doanh nghiệp--</option>
                          @foreach($listCompany as $item)
                          <option value="{{$item->id}}" {{old('company_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                          @endforeach
                        </select>
                        <span class="help-block">{{$errors->first("company_id")}}</span>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group {{$errors->has('start') ? 'has-error' : ''}}">
                          <label class="required" for="start">Serial đầu</label>
                          <input type="number" class="form-control" name="start" id="start" placeholder="Số serial bắt đầu" value="{{old('start')}}">
                          <span class="help-block">{{$errors->first("start")}}</span>
                          <span id="spanstart" style="color: #f00;"></span>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group {{$errors->has('end') ? 'has-error' : ''}}">
                          <label class="required" for="end">Serial cuối</label>
                          <input type="number" class="form-control" name="end" id="end" placeholder="Số serial cuối" value="{{old('end')}}">
                          <span class="help-block">{{$errors->first("end")}}</span>
                          <span id="spanend" style="color: #f00;"></span>
                      </div>
                       <!-- /.form-group -->
                      <div class="form-group">
                          <label class="" for="note">Tên tiền tố trước mã tem  (tối đa 5 ký tự) </label>
                          <input type="text" class="form-control" name="prefix" id="prefix" rows="3"  placeholder="Nhập tiền tố (tối đa 5 ký tự)" maxlength="5">
                      </div>
                     
                      <div class="form-group">
                          <label class="" for="note">Độ rộng mã tem (mặc định là 8)  </label>
                          
                          
                          <input  name="seriallength" id="seriallength" class="form-control" type="number" min="1" max="8">
                         
                      </div>
                      
                      
                      <!-- /.form-group -->
                      
                      <!-- /.form-group -->
                      <div class="form-group">
                          <label class="" for="note">Tên đối tác (Ghi SMC hoặc AH)</label>
                          <textarea class="form-control" name="note" id="note" rows="3" required placeholder="Ghi chú"></textarea>
                      </div>
                      <!-- /.form-group -->
                      
                  </div>
                  <!-- /.col -->
              </div>
            <!-- /.row -->
          </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary mrg-10">Save</button>
                <button type="reset" class="btn btn-default mrg-10">Cancel</button>
              </div>
          </div>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript">
  $('#company_id').select2();
  $('#company_id').change(function(event) {
    if($(this).val() != '') {
      $.ajax({
        type: 'POST',
        url: '{{route('backend.qrcode.checkStart')}}',
        data: {company_id: $('#company_id').val(), type: 'get'},
        dataType: 'json',
        success: function(resp) {
          $('#start').attr('readonly', true);
          $('#start').val(resp._start);
        }
      });
    }
  });
  $('#start').change(function() {
    if($('#company_id').val() == '') {
      $('#start').val('');
      jAlert('Bạn chưa chọn doanh nghiệp nào', 'Thông báo');
      return false;
    } else if(parseInt($(this).val()) < 1) {
      $('#start').val('').focus();
      $('#spanstart').text('Serial đầu phải lớn hơn 0');
      return false;
    } else {
      $.ajax({
        type: 'POST',
        url: '{{route('backend.qrcode.checkStart')}}',
        data: {start: parseInt($(this).val()), company_id: $('#company_id').val()},
        dataType: 'json',
        success: function(resp) {
          if(resp.msg != '') {
            $('#start').val('').focus();
          }
          $('#spanstart').text(resp.msg);
        }
      });
    }
  });
  $('#end').change(function() {
    if($('#start').val() == '') {
      $('#end').val('');
      $('#start').focus();
      jAlert('Bạn chưa nhập serial đầu', 'Thông báo');
      return false;
    } else if(parseInt($('#start').val()) > parseInt($(this).val())) {
      $(this).val('').focus();
      $('#spanend').text('Serial cuối phải lớn hơn hoặc bằng serial đầu');
    } else {
      $('#spanend').text('');
    }
  });
</script>
@stop