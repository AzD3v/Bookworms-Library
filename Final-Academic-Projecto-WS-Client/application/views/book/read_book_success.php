<?php echo form_open("book/setRead",'role="form" class="form-horizontal"'); ?>

<link rel="stylesheet" href="../../../assets/css/geral.css">

<div class="row">
    <div class="col col-lg-12">
        <h5><?php echo $message; ?></h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p class="text-center">
            <button type="submit" class="btn btn-primary">I read more books</button>
        </p>
    </div>
</div>


<?php echo form_close();?>