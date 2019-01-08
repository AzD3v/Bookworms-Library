<?php echo form_open("book/validate_setOwned",'role="form" class="form-horizontal"');?>

<link rel="stylesheet" href="../../../assets/css/geral.css">

<div class="row">
    <div class="col col-lg-12">
        <h2>Own a Book!</h2>
        <br>
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
			<?php echo form_label('IdUser', 'inputIdUser', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputIdUser', set_value('inputIdUser'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
        <?php echo form_label('Book', 'inputBook' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <select name ="inputBook">
                    <?php
                        foreach($books as $b) 
                        {
                            echo '<option value="'.$b['id'].'">'.$b['name'].'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p class="text-center">
            <br>
            <button type="submit" class="btn btn-primary">Own Book</button>
        </p>
    </div>
</div>


<?php echo form_close();?>
