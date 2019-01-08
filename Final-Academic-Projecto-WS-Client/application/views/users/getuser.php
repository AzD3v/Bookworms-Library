<link rel="stylesheet" href="../../../assets/css/geral.css">

<div class="page-header">
    <h1 class="text-center mb-5">List of all Bookworms users</h1>
</div>

<table class="table table-hover table-bordered">

    <thead>
        <tr>
            <th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Edit User</th>
        </tr>
    </thead>

    <tbody>

    <?php

	   if (isset($users))
	   {
		   
	   foreach ($users as $user) {

    ?>

    <tr>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
		<td>
			<a class="btn btn-info"
			   href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/users/edituserform/id_user/<?php $user['id']; ?>">
				Edit User
			</a>
		</td>
    </tr>

    <?php } }?>

    </tbody>
</table>

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

<button type="submit" class="btn btn-success">SEARCH SPECIFIC USER</button>

<?php echo form_close();?>
