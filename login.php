<?php
  require_once "pdo.php";
  session_start();
  if(isset($_POST['email'])&& isset($_POST['password'])){
    $sql = "SELECT * FROM users WHERE EMAIL=:email AND PASSWORD=:password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':email' => $_POST['email'] ,
                          ':password' => $_POST['password']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $var = $row['USER_ID'];
    $_SESSION['val'] = $var;
    if($row >0){
      $_SESSION['success'] = "login successfull\n". $_POST['email'];
      header("Location: main.php?user_id=".$var);
      return;
    }
    else{
      $_SESSION['error'] = "incorrcet username or password";
      header('Location: index.php');
      return;
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<title>Login</title><!--
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  	<!-- jQuery library -->
  	<script src="https://use.fontawesome.com/fefcf99aee.js"></script>
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
                     <li class="nav-item active"><a class="nav-link" href="./index.php"><span class="fa fa-home fa-lg"></span> Home</a></li>
                     <li class="nav-item"><a class="nav-link" href="./about.php"><span class="fa fa-info fa-lg"></span> About</a></li>

                 </ul>

             </div>
         </div>
     </nav>
     <?php
       if (isset($_SESSION['error'])) {
         // code...
         echo $_SESSION['error'];
         unset( $_SESSION['error']);
       }



      ?>
    <div class="row offset-sm-4 m-xs-1">
      <div class="col-12 col-sm-6 shadow-lg p-3 mt-5 bg-white rounded ">
        <div class="card">
            <h3 class="card-header bg-primary text-white">Login</h3>

          <div class="row ">
            <div class="col-12 col-sm-6">
              <form method="post">

                <div class="form-group">
                  <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter email" required>
                </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  id="password" name="password" value="" placeholder="Password" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary"><a style="text-decoraton: none; color:inherit;" href="index.php">Sign-up</a></button>
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
