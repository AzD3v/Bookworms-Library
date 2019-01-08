<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 04-01-2019
 * Time: 21:19
 */

echo form_open("Users/validateUserEdition",'role="form" class="form-horizontal"');

foreach ($user as $user_to_edit) {

	$user_to_edit_name = $user_to_edit['name'];
	$user_to_edit_email = $user_to_edit['email'];
	$user_to_edit_birthdate = $user_to_edit['birthdate'];
	$user_to_edit_status = $user_to_edit['status'];
	$user_to_edit_name = $user_to_edit['name'];

}

?>

<link rel="stylesheet" href="../../../assets/css/geral.css">

<br><br>
<h2 class="text-center mt-10">Edit User</h2>

<div class="row">
	<div class="col-lg-12">
		<?php echo validation_errors();?>
	</div>
</div>

	<?php echo form_label('User Profile', 'inputProfile', array('class' => 'col-lg-3 control-label'));
	$options = array(
		'1'         => 'Admin',
		'2'         => 'User',
	);

	?>
		<?php echo form_dropdown('inputProfile', $options);?>

<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php
			$opts = 'class="form-control" placeholder="'. $user_to_edit_name .'"';
			echo form_label('Name', 'inputName', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputName', set_value('inputName'), $opts);?>
			</div>
		</div>
</div>

<div class="col-lg-6">
	<div class="form-group row">
			<?php
			$opts = 'class="form-control" placeholder="'. $user_to_edit_email .'"';
			echo form_label('Email', 'inputEmail' ,array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputEmail', set_value('inputEmail'), $opts);?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php
			$opts = 'class="form-control" placeholder="'. $user_to_edit_birthdate .'"';
			echo form_label('Birthdate', 'inputBirthdate', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputBirthdate', set_value('inputBirthdate'), $opts);?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
			<?php
			$opts = 'class="form-control" placeholder="'. $user_to_edit_status .'"';
			echo form_label('Status', 'inputStatus', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputStatus', set_value('inputStatus'), $opts);?>
			</div>
		</div>
	</div>

<div class="row">
	<div class="col-lg-12">
		<p class="text-center">
			<button type="submit" class="btn btn-success">Edit User!</button>
		</p>
	</div>
</div>

<?php echo form_close(); ?>
