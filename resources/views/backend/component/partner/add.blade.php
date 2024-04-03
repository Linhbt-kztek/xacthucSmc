<form id="form-partner" action="{{route('backend.partner.pAdd')}}" method="POST">
	{{csrf_field()}}
	<div class="box box-primary">
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
			    	<div class="form-group {{$errors->has('company_id') ? 'has-error' : ''}}">
			            <label class="required" for="company_id">Chọn doanh nghiệp</label>
			            <select class="form-control" id="company_id" name="company_id">
			            	<option value="">--Chọn doanh nghiệp--</option>
			                @foreach($listCompany as $item)
			                <option value="{{$item->id}}" {{(old('company_id') == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
			                @endforeach
			            </select>
			            <span class="help-block">{{$errors->first("company_id")}}</span>
			      	</div>
		      		@if(isset($guid))
		      		<input type="hidden" name="guid" value="{{$guid}}">
		      		@endif
			      	<!-- /.form-group -->
			        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
			          	<label class="required" for="name">Tên nhà phân phối</label>
			          	<input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Tên nhà phân phối" maxlength="255">
			          	<span class="help-block">{{$errors->first("name")}}</span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
			          	<label class="" for="email">Email</label>
			          	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email')}}" maxlength="150">
			          	<span class="help-block">{{$errors->first("email")}}</span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group {{$errors->has('tel') ? 'has-error' : ''}}">
			          	<label class="" for="tel">Số điện thoại</label>
			          	<input type="text" class="form-control" name="tel" id="tel" placeholder="Số điện thoại" value="{{old('tel')}}" maxlength="50">
			          	<span class="help-block">{{$errors->first("tel")}}</span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
			          	<label class="" for="address">Địa chỉ</label>
			          	<textarea class="form-control" name="address" rows="3" id="address" placeholder="Địa chỉ" maxlength="255">{{old('address')}}</textarea>
			          	<span class="help-block">{{$errors->first("address")}}</span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group">
                      	<label class="" for="note">Ghi chú</label>
                      	<textarea class="form-control" name="note" id="note" rows="3" placeholder="Ghi chú">{{old('note')}}</textarea>
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
	    	@if(isset($company) && $company->id != '')
        	<button type="button" class="btn btn-primary mrg-10" data-dismiss="modal">Close</button>
        	@else
        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
        	@endif
      	</div>
  	</div>
</form>
<script type="text/javascript">
	if($('select#company_id').length > 0) {
		$('#company_id').select2();
	}
</script>