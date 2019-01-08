<?php echo form_open("book/validate_rateBook",'role="form" class="form-horizontal"');?>

<link rel="stylesheet" href="../../../assets/css/geral.css">

<div class="row">
    <div class="col col-lg-12">
        <h2>Rate Book</h2>
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
                            echo '<option value="'.$b['id'].'">'.$b['title'].'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <?php echo form_label('Rating', 'inputRate' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
            <select name ="inputRate">
                    <option selected value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
            </select>
            </div>
        </div>
    </div>
</div>


<div class="row">
	<div class="col-lg-6">
		<div class="form-group row">
			<?php echo form_label('Date', 'inputDate' ,array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputDate', set_value('inputDate'), 'class="form-control" 
				placeholder="08-01-2019"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p class="text-center">
            <br>
            <button type="submit" class="btn btn-primary">Rate Book</button>
        </p>
    </div>
</div>


<?php echo form_close();?>
