<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 11-12-2018
 * Time: 14:12
 */

// echo "<pre>" . print_r($movies, TRUE); . "</pre>";

if (isset($movies['message'])) {
    header( "http://http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/movieworld/getmovie");
}

?>

<h1>List of movies</h1>
<table class="table table-dark table-bordered table-hover">
    <thead>

    <div class="row">
        <div class="col-lg-12">
            <?php echo validation_errors(); ?>
        </div>
    </div>

    <tr>
        <td scope="col" >Titulo</td>
        <td scope="col" >Ano</td>
        <td scope="col" >Descrição</td>
        <td scope="col" >Nome Utilizador</td>
        <td scope="col" >Tipo</td>
        <td scope="col" >Rating</td>
    </tr>
    </thead>
    <tbody>
    <?php

        // var_dump($movies);
        foreach ($movies as $movie){ ?>

    <tr>
        <td><?php echo  $movie['title'] ?></td>
        <td><?php echo  $movie['year'] ?></td>
        <td><?php echo  $movie['nome'] ?></td>
        <td><?php echo  $movie['description'] ?></td>
        <td><?php echo  $movie['genders'] ?></td>
        <?php } ?>
    </tr>
    </tbody>
</table>

