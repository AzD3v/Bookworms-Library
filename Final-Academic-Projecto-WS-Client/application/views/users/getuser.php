<link rel="stylesheet" href="../../../assets/css/geral.css">

<div class="page-header">
    <h1 class="text-center mb-5">List of all Bookworms users</h1>
</div>

<table class="table table-dark">

    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
        </tr>
    </thead>

    <tbody>

    <?php

        foreach($users as $user) {

    ?>

    <tr>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
    </tr>

    <?php } ?>

    </tbody>
</table>

<?php echo form_open("users/validateSpecificUserSearch/",'role="form" class="form-horizontal"');?>

<?php echo form_input('idSpecificUser', set_value('idSpecificUser'));?>

<button type="submit" class="btn btn-success">SEARCH SPECIFIC USER</button>

<?php echo form_close();?>
