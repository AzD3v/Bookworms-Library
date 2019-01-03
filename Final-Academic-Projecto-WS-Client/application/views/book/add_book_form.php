<?php echo form_open_multipart("Bookworms/validateNewBook",'role="form" class="form-horizontal"');?>

	<div class="row">
		<div class="col col-lg-12">
			<h2 class="text-center mb-5">Insert a new book</h2>
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
				<?php echo form_label('Book Name', 'bookName', array('class' => 'col-lg-3 control-label'));?>
				<div class="col-lg-9">
					<?php echo form_input('bookName', set_value('bookName'),
						'class="form-control" placeholder="Insert here the name of the book you want to insert"');?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
				<?php echo form_label('Book Author', 'bookAuthor', array('class' => 'col-lg-3 control-label'));?>
				<div class="col-lg-9">
					<?php echo form_input('bookAuthor', set_value('bookAuthor'),
						'class="form-control" placeholder="Stephen King"');?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
				<?php echo form_label('Book Genre ID', 'bookGenreId',
					array('class' => 'col-lg-3 control-label'));?>
				<div class="col-lg-9">
					<?php echo form_input('bookGenreId', set_value('bookGenreId'),
						'class="form-control" placeholder="Enter here the book\'s genre ID"');?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
				<?php echo form_label('Book Description', 'bookDescription', array('class' => 'col-lg-3 control-label'));?>
				<div class="col-lg-9">
					<?php
					$data = array(
						'class'		  => 'form-control',
						'name'        => 'bookDescription',
						'id'          => 'bookDescription',
						'value'       => set_value('bookDescription'),
						'placeholder' => 'Insert here a concise book description',
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
				<?php echo form_label('ISBN (International Standard Book Number) of the book', 'bookIsbn',
					array('class' => 'col-lg-3 control-label'));?>
				<div class="col-lg-9">
					<?php echo form_input('bookIsbn', set_value('bookIsbn'),
						'class="form-control" placeholder="Enter here the ISBN of the book"');?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
				<?php echo form_label('Who is registering this book?', 'bookRegister',
					array('class' => 'col-lg-3 control-label'));?>
				<div class="col-lg-9">
					<?php echo form_input('bookRegister', set_value('bookRegister'),
						'class="form-control" placeholder="Enter your name here :)"');?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<?php $name = 'bookCover'; ?>
				<?php echo form_label('Book Cover', $name, array('class' => 'col-xs-6 col-lg-3 control-label')); ?>
				<div class="col-xs-6 col-lg-9">
					<?php
					$value = set_value($name);
					$opts = 'class="form-control" id="' . $name . '" placeholder="Book Cover" ';
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
				<button type="submit" class="btn btn-primary">Register book!</button>
			</p>
		</div>
	</div>

<?php echo form_close();?>
