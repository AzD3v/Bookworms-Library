<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 02-01-2019
 * Time: 14:49
 */

echo form_open("Book/validate_user_form",'role="form" class="form-horizontal"');?>

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
			<?php echo form_label('Password', 'inputPassword' ,array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputFact', set_value('inputFact'), 'type="password" class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('Type of user', 'inputType' ,array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputType', set_value('inputType'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('Birth Day', 'inputBirth' ,array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputBirth', set_value('inputBirth'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-primary">Add new user!</button>
		</p>
	</div>
</div>

<?php echo form_close(); ?>
