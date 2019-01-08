<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BookWorms | Admin Area</title>

	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #2980b9;
			margin: 40px;
			font: 16px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
			word-wrap: break-word;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #fff;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 30px;
			font-weight: normal;
			margin: auto;
			padding: 30px;
			text-align: center;
			text-transform: uppercase;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 16px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		h3, p, hr {
			color: #fff;
		}

	</style>
</head>
<body>

<div id="body">
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-1">Welcome to BookWorms!</h1>
		</div>
	</div>

	<div class="container">
		<h3>addBook_post</h3>
		<p><strong>Parameters: </strong>name - required; author - required; description - required; isbn - required;
			reader_id - required; cover - optional</p>
		<p><strong>Type of data: </strong>name - string; author - string; description - text; isbn - string;
			reader_id - int; cover - longtext</p>
		<p><strong>HTTP Method: </strong>POST</p>
		<p><strong>Method Return: </strong>Message of add book success</p>
	</div>

	<hr>

	<div class="container">
		<h3>getBooks_get</h3>
		<p><strong>Parameters: </strong>id_user - optional, it depends on objective. If an ID is not given, all approved books
		are returned. If the user is an admin, it returns all approved and unapproved books</p>
		<p><strong>Type of data: </strong>id_user - int</p>
		<p><strong>HTTP Method: </strong>GET</p>
		<p><strong>Method Return: </strong>List of books</p>
	</div>

</div>

</body>
</html>
