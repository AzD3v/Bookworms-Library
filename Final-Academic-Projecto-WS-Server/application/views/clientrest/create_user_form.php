<?php echo form_open("Clientrest/validate_user_form",'role="form" class="form-horizontal"');?>

<div class="row">
    <div class="col col-lg-12">
        <h2>Criação de novo utilizador</h2>
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
            <?php echo form_label('Nome', 'inputNome', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('inputNome', set_value('inputNome'), 'class="form-control"');?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Email', 'inputEmail' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('inputEmail', set_value('inputEmail'), 'class="form-control"');?>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Fact', 'inputFact' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?php echo form_input('inputFact', set_value('inputFact'), 'class="form-control"');?>
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
