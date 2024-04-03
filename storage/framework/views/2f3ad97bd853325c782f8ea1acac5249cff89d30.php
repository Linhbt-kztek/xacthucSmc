<?php 
	header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=".$name."_".$guid."_".date('Ymd_his').".xls");  //File name extension was wrong
    header("Pragma: no-cache");
    header("Expires: 0");
    ob_end_clean();
	ob_flush();
?>
<table border="1">
	<thead>
		<tr>
			<th width="5%" valign="middle" align="center">STT</th>
			<th width="15%" valign="middle" align="center">Serial</th>
			<th width="35%" valign="middle" align="center">Value QR Code</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($item[0]); ?></td>
			<td><?php echo e($item[1]); ?></td>
			<td><?php echo e($item[2]); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>