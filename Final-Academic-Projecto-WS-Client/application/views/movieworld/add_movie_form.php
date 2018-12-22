<?php echo form_open_multipart("Movieworld/validateNewMovie",'role="form" class="form-horizontal"');?>
<!-- Multipart é para garantir o envio de ficheiros -->

<div class="row">
    <div class="col col-lg-12">
        <h2 class="text-center mb-5">Adicionar um novo filme</h2>
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
            <?php echo form_label('Title', 'movieTitle', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('movieTitle', set_value('movieTitle'),
                    'class="form-control" placeholder="Insert here the name of the movie"');?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Movie Year', 'movieYear', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('movieYear', set_value('movieYear'),
                    'class="form-control" placeholder="Ex: 2010-11-15"');?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Movie Description', 'movieDescription', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php
                $data = array(
                    'class'		  => 'form-control',
                    'name'        => 'movieDescription',
                    'id'          => 'movieDescription',
                    'value'       => set_value('movieDescription'),
                    'placeholder' => 'Insert here a concise movie description',
                    'rows'        => '10',
                    'cols'        => '30',
                );
                echo form_textarea($data);
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('IMDb ID of the Movie', 'movieImdbId',
                array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('movieImdbId', set_value('movieImdbId'),
                    'class="form-control" placeholder="Enter here the IMDb ID of the movie"');?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('User ID', 'movieUserId',
                array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('movieUserId', set_value('movieUserId'),
                    'class="form-control" placeholder="Enter here your ID"');?>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <?php echo form_label('Genre ID', 'movieGenreId',
                    array('class' => 'col-lg-3 control-label'));?>
                <div class="col-lg-9">
                    <?php echo form_input('movieGenreId', set_value('movieGenreId'),
                        'class="form-control" placeholder="Enter here the movie genre ID"');?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php $name = 'userfile'; ?>
                <?php echo form_label('Anexo', $name, array('class' => 'col-xs-6 col-lg-3 control-label')); ?>
                <div class="col-xs-6 col-lg-9">
                    <?php
                        $value = set_value($name);
                        $opts = 'class="form-control" id="' . $name . '" placeholder="Anexo" ';
                        echo form_upload($name, $value, $opts);
                    ?>
                </div>
            </div>
        </div>
    </div>


<div class="row">
    <div class="col-lg-12">
        <p class="text-center">
            <br>
            <button type="submit" class="btn btn-primary">Add movie!</button>
        </p>
    </div>
</div>

<?php echo form_close();?>