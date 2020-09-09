<?php
  require_once "pdo.php";
  session_start();
  print_r($_SESSION['val']);
  // $_SESSION['user_id']=$_GET['user_id'];
  $stmt2 = $pdo->prepare('SELECT NAME FROM users WHERE USER_ID = :user_id');
  $stmt2->execute(array(':user_id' => $_SESSION['val'] ));
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  print_r($row2['NAME']);
  $myname = $row2['NAME'];
  $sql = 'SELECT  b_name, start_date, end_date, no_of_people, amount FROM budget,
   shares, users WHERE budget.b_id=shares.b_id GROUP BY b_name';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':uid' =>$_SESSION['val'] ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  // print_r($row);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<!--
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  	<!-- jQuery library -->
  	<script src="https://use.fontawesome.com/fefcf99aee.js"></script>

    <title>Home</title>
    <style media="screen">
    .navbar{
        background-color: #052749;
        color: aliceblue;
    }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="index.php"></a>

            <div class="collapse navbar-collapse" id="Navbar">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="#"><span class="fa fa-home fa-lg"></span> Home</a></li>
                    <li class="nav-item active"><a class="nav-link" href="./about.html"><span class="fa fa-info fa-lg"></span> About</a></li>
                    <li class="nav-item active"><a class="nav-link" href="./logout.php"><span class="fa fas fa-sign-out"></span> Log-out</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <p>--------------DONT SEE THIS----------------</p>
    <?php
    echo "Welcome \n";
    echo  $_SESSION['success'];
     ?>
     <h1>Welcome to the home page</h1>
     <h2>Your Plans</h2>
     <?php
		echo('<div class = "container-fluid table-responsive"><table border="1"class="mt-sm-5 table table-striped table-dark">'."\n");
		echo "<th>NAME</th>";
		echo "<th>Start</th>";
		echo "<th>End</th>";

    echo "<th>Details</th>";
		$stmt = $pdo->prepare('SELECT b_name, start_date, end_date, no_of_people, amount FROM budget,
     shares, users WHERE budget.user_id = :val AND shares.p_name = users.NAME AND shares.b_id = budget.b_id  GROUP BY b_name');
     $stmt->execute(array(':val' => $_SESSION["val"]));

		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

		    echo "<tr><td>";
		    echo(htmlentities($row['b_name']));
		    echo("</td><td>");
		    echo(htmlentities($row['start_date']));
		    echo("</td><td>");
		    echo(htmlentities($row['end_date']));


        echo("</td><td>");
      	echo('<a href="view.php?budget_name='.$row['b_name'].'">View</a>');
		    echo("</td>");
		    echo("</tr>\n");
		}


	?>

	</table>
  <h2>You are also a part of the following other plans</h2>
  <?php
  $stmt4 = $pdo->prepare('SELECT b_name, start_date, end_date, no_of_people, amount FROM budget,
   shares, users WHERE budget.user_id = users.USER_ID AND shares.p_name = :name2 AND shares.b_id = budget.b_id  GROUP BY b_name');
   $stmt4->execute(array(':name2' =>$myname));
  echo('<div class = "container-fluid table-responsive"><table border="1"class="mt-sm-5 table table-striped table-dark">'."\n");
  echo "<th>NAME</th>";
  echo "<th>Start</th>";
  echo "<th>End</th>";


  echo "<th>Details</th>";
  while ( $row4 = $stmt4->fetch(PDO::FETCH_ASSOC) ) {

      echo "<tr><td>";
	    echo(htmlentities($row4['b_name']));
	    echo("</td><td>");
	    echo(htmlentities($row4['start_date']));
	    echo("</td><td>");
	    echo(htmlentities($row4['end_date']));


      // echo("</td><td>");
	    // echo('<a href="view.php">View</a>');
      echo("</td><td>");
    	echo('<a href="view.php?budget_name='.$row4['b_name'].'">View</a>');
	    echo("</td>");
	    echo("</tr>\n");

	}

   ?>



    <a href="plans.php?user_id=":val>Create new plans </a>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  		 integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
  		  crossorigin="anonymous"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  		 integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
  		 crossorigin="anonymous"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  		 integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
  		  crossorigin="anonymous"></script>
  </body>
</html>
