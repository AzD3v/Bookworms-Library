<?php

if (isset($users['message'])){
    header("location:http://localhost/WebService/ws/index.php/clientrest/getuser/" . $users['id']);
}
?>

<div>

        <h1>List of Users</h1>
        <table class="table table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <td scope="col" >Name</td>
                    <td scope="col" >Email</td>
                    <td scope="col" >Fact</td>
                </tr>
            </thead>
            <tbody>
            <?php

                foreach ($users as $user){ ?>
                <tr>
                    <td><?php echo  $user['name'] ?></td>
                    <td><?php echo  $user['email'] ?></td>
                    <td><?php echo  $user['fact'] ?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

</div>