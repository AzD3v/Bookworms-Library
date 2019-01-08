<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 13-12-2018
 * Time: 14:45
 */

?>

<div class="row">
    <div class="col-lg-6">
        <?php file_put_contents(FCPATH . 'upload/movie_poster.jpg', base64_decode($photo)); ?>
        <img src="<?php echo base_url('upload/movie_poster.jpg'); ?>" class="img-fluid">
    </div>
    <div class="col-lg-6">
        <table class="table">
            <tr>
                <th>Título</th>
                <td><?php echo $title; ?></td>
            </tr>
            <tr>
                <th>Ano</th>
                <td><?php echo $year; ?></td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td><?php echo $description; ?></td>
            </tr>
            <tr>
                <th>Género</th>
                <td><?php echo $genders; ?></td>
            </tr>
            <tr>
                <th>Classificação</th>
                <td><?php echo $rating; ?></td>
            </tr>
            <tr>
                <th>Criado por</th>
                <td><?php echo $nome; ?></td>
            </tr>
            <tr>
                <th>Ficha completa</th>
                <td><?php echo anchor('https://www.imdb.com/title'.$imdb_id,'IMDB', 'target="_new"') ?></td>
            </tr>
        </table>
    </div>
</div>