<?php echo form_open("Clientrest/validateNewTaskVal",'role="form" class="form-horizontal"');?>

<div class="row">
    <div class="col col-lg-12">
        <h2>Criação de nova tarefa</h2>
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
            <?php echo form_label('Nome', 'inputNome' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('inputNome', set_value('inputNome'), 'class="form-control"');?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Data', 'inputData' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('inputData', set_value('inputData'), 'class="form-control"');?>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Utilizador', 'inputUser' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('inputUser', set_value('inputUser'), 'class="form-control"');?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Descrição', 'inputComments' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php
                $data = array(
                      'class'		=> 'form-control',
                      'name'        => 'inputComments',
                      'id'          => 'inputComments',
                      'value'       => set_value('inputComments'),
                      'placeholder' => 'Comentários',
                      'rows'   		=> '10',
                      'cols'        => '30',
                );
                echo form_textarea($data);
                ?>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <p class="text-center">
            <br>
            <button type="submit" class="btn btn-primary">Criar Tarefa</button>
        </p>
    </div>
</div>


<?php echo form_close();?>
