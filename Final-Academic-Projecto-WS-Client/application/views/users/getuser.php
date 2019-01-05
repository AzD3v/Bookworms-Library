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