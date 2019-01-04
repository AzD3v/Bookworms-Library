<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 04-01-2019
 * Time: 21:19
 */

echo form_open("Users/validateNewUser",'role="form" class="form-horizontal"');?>

<div class="row">
	<div class="col col-lg-12">
		<h2>Add new user</h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php echo validation_errors();?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('User Profile', 'inputProfile', array('class' => 'col-lg-3 control-label'));
			$options = array(
				'1'         => 'Admin',
				'2'         => 'User',
			);

			?>
			<div class="col-lg-9">
				<?php echo form_dropdown('inputProfile', $options);?>
			</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('Name', 'inputName', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputName', set_value('inputName'), 'class="form-control"');?>
			</div>
		</div>
</div>

<div class="col-lg-6">
	<div class="form-group row">
			<?php echo form_label('Email', 'inputEmail' ,array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputEmail', set_value('inputEmail'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('Password', 'inputPassword', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_password('inputPassword', set_value('inputPassword'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('Password Retype', 'inputPasswordRewrite', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_password('inputPasswordRetype', set_value('inputPasswordRetype'), ' class="form-control"');?>
			</div>
		</div>
	</div>
</div>
<!-- <div class="row">
<div class="col-lg-6">
<div class="form-group row">
	<?php echo form_label('Status', 'inputStatus', array('class' => 'col-lg-3 control-label'));?>
	<div class="col-lg-9">
		<?php echo form_input('inputStatus', set_value('inputStatus'), 'class="form-control"');?>
	</div>
</div>
</div> -->

<div class="row">
	<div class="col-lg-12">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-primary">Edit user!</button>
		</p>
	</div>
</div>

<?php echo form_close(); ?>
