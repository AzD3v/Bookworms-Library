<?php echo form_open("users/validate_addFriend/",'role="form" class="form-horizontal"');?>

<link rel="stylesheet" href="../../../assets/css/geral.css">

<div class="row">
    <div class="col col-lg-12">
        <h2>Add a Friend to your list!</h2>
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
			<?php echo form_label('Your Id', 'inputIdUser', array('class' => 'col-lg-3 control-label'));?>
			<div class="col-lg-9">
				<?php echo form_input('inputIdUser', set_value('inputIdUser'), 'class="form-control"');?>
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
        <?php echo form_label('Person you want to add as a friend', 'inputFriend' ,array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <select name ="inputFriend">
                    <?php
                        foreach($users as $u) 
                        {
                            echo '<option value='.$u['id'].'>'.$u['name'].'</option>';
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
            <button type="submit" class="btn btn-primary">Add Friend</button>
        </p>
    </div>
</div>


<?php echo form_close();?>
