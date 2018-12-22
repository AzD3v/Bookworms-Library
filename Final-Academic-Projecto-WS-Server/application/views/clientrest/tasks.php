<?php

if (isset($tasks['message'])){
    header("location:http://localhost/WebService/ws/index.php/clientrest/gettask/" . $tasks['id']);
}

//var_dump($tasks);
?>

<div>
    <h1>List of Tasks</h1>
    <table class="table table-dark table-bordered table-hover">
        <thead>
        <tr>
            <td scope="col" >Name</td>
            <td scope="col" >comments</td>
            <td scope="col" >Start date</td>
            <td scope="col" >Due date</td>
            <td scope="col" >Schedule date</td>
            <td scope="col" >User to create</td>
            <td scope="col" >Execution</td>

        </tr>
        </thead>
        <tbody>
        <?php

        //var_dump($users);
        foreach ($tasks as $task){ ?>
            <tr>
                <td><?php echo  $task['name'] ?></td>
                <td><?php echo  $task['comments'] ?></td>
                <td><?php echo  $task['start_date'] ?></td>
                <td><?php echo  $task['due_date'] ?></td>
                <td><?php echo  $task['schedule_date'] ?></td>
                <td><?php echo  $task['create_user'] ?></td>
                <td><?php echo  $task['execution_user'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>