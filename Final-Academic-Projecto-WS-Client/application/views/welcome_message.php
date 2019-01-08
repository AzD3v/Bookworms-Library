<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BookWorms | Welcome page</title>

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

	p.lead {
		font-size: 20px;
		color: #fff;
	}

    </style>
</head>
<body>

    <div id="body">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-1">Welcome to BookWorms!</h1>
				<p class="lead"> Methods links</p>
			</div>
		</div>
    </div>

    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/setOwned">Set Owned</a><br>
    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/setWished">Set Wished</a><br>
    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/setRead">Set Read</a><br>
    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/rateBook">Rate Book</a><br>
    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/getBooks">Get Books</a><br>
    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/addBook">Add Book</a><br>
    <a href="http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/book/addBook">Edit Book</a><br>
    

</body>
</html>
