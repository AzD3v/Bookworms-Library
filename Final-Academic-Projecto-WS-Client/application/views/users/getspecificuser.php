<link rel="stylesheet" href="../../../assets/css/geral.css">

<?php

if (isset($user))
{

	foreach ($user as $specific_user) {

?>

<div class="page-header">
    <h1 class="text-center mb-5">BOOKWORMS USER <?php echo $specific_user['name']; ?> INFORMATION</h1>
</div>

<table class="table table-hover table-bordered">

    <thead>
        <tr>
			<th scope="col">User Profile</th>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Birthdate</th>
			<th scope="col">Status</th>
        </tr>
    </thead>

    <tbody>

    <tr>
		<td>

			<?php $user_profile = $specific_user['id_profile'];

			if ($user_profile === 1)  {
				echo "Admin";
			} else {
				echo "User";
			}

			?>

		</td>
        <td><?php echo $specific_user['name']; ?></td>
		<td><?php echo $specific_user['email']; ?></td>
		<td><?php echo $specific_user['birthdate']; ?></td>
		<td><?php echo $specific_user['status']; ?></td>
	</tr>

	</tbody>

</table>

<?php } } ?>

<?php echo form_open("users/validateSpecificUserSearch/",'role="form" class="form-horizontal"'); ?>

	<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('id', 'inputIdSpecificUser', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputIdSpecificUser', set_value('inputIdSpecificUser'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<button type="submit" class="btn btn-success">CHECK SPECIFIC USER INFORMATION</button>

<?php echo form_close();?>

<p><?php echo anchor('users/getuser/', 'RETURN TO ALL USERS VIEW'); ?></p>
