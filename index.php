<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['name']) && isset($_POST['email'])
     && isset($_POST['password'])) {
       if (strlen($_POST['email'] <12)) {
         $_SESSION['error']='Email too small';
       }
    // Data validation
    // if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
    //     $_SESSION['error'] = 'Missing data';
    //     header("Location: add.php");
    //     return;
    // }

    // if ( strpos($_POST['email'],'@') === false ) {
    //     $_SESSION['error'] = 'Bad data';
    //     header("Location: add.php");
    //     return;
    // }
    $sql2 = "SELECT * FROM USERS WHERE NAME = :NAME";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(':NAME' => $_POST['name']));
    $row1 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row1>0) {
      $_SESSION['error']= 'username already taken.. try with another name';
      header('Location:index.php');
      return;
    }
    $sql1 = "SELECT * FROM USERS WHERE EMAIL = :email";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
        ':email' => $_POST['email']));
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    if ($row1>0) {
      $_SESSION['error']= 'Email already exists.. try logging in';
      header('Location:index.php');
      return;
    }


    $sql = "INSERT INTO users (NAME, EMAIL, PASSWORD,PHONE)
              VALUES (:name, :email, :password, :phone)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':phone'=> $_POST['phone']));
    $_SESSION['success'] = 'Record Added';
    header( 'Location: login.php' ) ;
    return;
}

// Flash pattern
// if ( isset($_SESSION['error']) ) {
//     echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
//     unset($_SESSION['error']);
// }
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<title>i dont know</title><!--
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  	<!-- jQuery library -->
  	<script src="https://use.fontawesome.com/fefcf99aee.js"></script>
    <style>
        .navbar{
            background-color: #052749;
            color: aliceblue;
        }

        .jumbotron{
            border: 1px solid;
            width: 100%;
            height: 80vh;
            background-image: url('img/child.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;


        }
        .footer{
            background-color: #424242;
            color: white;
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
                    <li class="nav-item"><a class="nav-link" href="./about.php"><span class="fa fa-info fa-lg"></span> About</a></li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
       <div class="row">
         <div class="d-flex col-12 col-sm-6 mt-5 p-2 offset-sm-3 justify-content-center">
           <h2>We help you Control your budget</h2><br>
         </div>
         <div class="col-12 col-sm-6 offset-sm-4">
           <p style="font-size: 25px;">Start Now by Signing in or <a href="login.php">Login</a></p>
         </div>

       </div>
    </div>
    <?php
      if (isset($_SESSION['error'])) {
        echo $_SESSION["error"];
        unset($_SESSION['error']);
      }
     ?>
    <div class="row offset-sm-4 m-xs-1 mt-5">
      <div class="col-12 col-sm-6 shadow-lg p-3  mt-5 bg-white rounded ">
        <div class="card">
            <h3 class="card-header bg-primary text-white">Signup</h3>

          <div class="row ">
            <div class="col-12 col-sm-10 p-2">
              <form method="post">
                <div class="form-group">
                  <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name" required>
                  </div>
                <div class="form-group">
                  <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  id="password" name="password" value="" placeholder="Password"required>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="" placeholder="Enter phone"required >
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
      </div>
    </div>



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
