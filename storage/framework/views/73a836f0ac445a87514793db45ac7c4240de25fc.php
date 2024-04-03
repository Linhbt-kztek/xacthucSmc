
<?php $__env->startSection('title', 'Update Account'); ?>
<?php $__env->startSection('content'); ?>
<section class="content-header">
  <h1>
    Update Account
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.user.index')); ?>">Danh sách users</a></li>
    <li class="active">Update Account</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-0">

      <!-- Profile Image -->
      <!--
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo e(Auth::user()->introimage != '' ? asset(Auth::user()->introimage) : asset('backend/dist/img/user2-160x160.jpg')); ?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?php echo e(Auth::user()->fullname); ?></h3>

          <p class="text-muted text-center"><?php echo e(Auth::user()->email); ?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Phone:</b> <a class="pull-right"><?php echo e(Auth::user()->tel); ?></a>
            </li>
            <li class="list-group-item">
              <b>Address</b> <a class="pull-right"><?php echo e(Auth::user()->address); ?></a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#addAccount" data-toggle="tab">Update Account</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="addAccount">
            <form class="form-horizontal" action="<?php echo e(route('backend.user.pEdit', ['id'=>$model->id])); ?>" method="POST">
              <div class="form-group <?php echo e($errors->has('fullname') ? 'has-error' : ''); ?>">
                <label for="inputName" class="col-sm-2 control-label">Họ tên</label>
                <div class="col-sm-10">
                  <input type="text" name="fullname" class="form-control" id="inputName" value="<?php echo e($model->fullname); ?>" placeholder="Họ và tên">
                  <span class="help-block"><?php echo e($errors->first("fullname")); ?></span>
                </div>
              </div>
              <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                <label for="inputEmail" class="col-sm-2 control-label required">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo e($model->email); ?>" placeholder="Email">
                  <span class="help-block"><?php echo e($errors->first("email")); ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-sm-2 control-label">Số điện thoại</label>
                <div class="col-sm-10">
                  <input type="text" name="tel" class="form-control" id="tel" value="<?php echo e($model->tel); ?>" placeholder="Số điện thoại">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Địa chỉ</label>
                <div class="col-sm-10">
                  <input type="text" name="address" class="form-control" id="address" value="<?php echo e($model->address); ?>" placeholder="Địa chỉ">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Trạng thái</label>
                <div class="col-sm-10">
            			<select class="form-control" style="width: 50%" name="status">
            				<?php if($listStatus): ?>
            				<?php $__currentLoopData = $listStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            				<option value="<?php echo e($key); ?>" <?php echo e($model->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
            				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            				<?php endif; ?>
            			</select>
                </div>
              </div>
              
               <div class="form-group <?php echo e($errors->has('newPass') ? 'has-error' : ''); ?>">
                <label for="newPass" class="col-sm-2 control-label ">Mật khẩu mới</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPass" id="newPass" placeholder="Password">
                  <span class="help-block"><?php echo e($errors->first("newPass")); ?></span>
                </div>
              </div>
              <div class="form-group <?php echo e($errors->has('newPass_confirmation') ? 'has-error' : ''); ?>">
                <label for="newPass_confirmation" class="col-sm-2 control-label ">Nhập lại mật khẩu</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPass_confirmation" id="confirmdPass" placeholder="Password">
                  <span class="help-block"><?php echo e($errors->first("newPass_confirmation")); ?></span>
                </div>
              </div>
              
              <div class="form-group <?php echo e($errors->has('is_admin') ? 'has-error' : ''); ?>">
                <label for="address" class="col-sm-2 control-label required">Loại tài khoản</label>
                <div class="col-sm-10">
                  <select class="form-control" style="width: 50%" name="is_admin">
                    <?php if($type): ?>
                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php echo e($model->is_admin == $key ? 'selected' : ''); ?>><?php echo e($item); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                  <span class="help-block"><?php echo e($errors->first('is_admin')); ?></span>
                </div>
              </div>
              <div class="form-group hide">
                <label for="address" class="col-sm-2 control-label">Cấp quyền</label>
                <div class="col-sm-10">
                  <select class="form-control" style="width: 50%" name="role">
                    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>   
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>