<?php
  require_once "pdo.php";
  session_start();
  
  if(isset($_POST['budget']) && isset($_POST['people'])){

    $_SESSION['people'] = $_POST['people'];
    $_SESSION['budget'] = $_POST['budget'];
    header('Location: template.php');
    return;
  }

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
    <title>plans</title>
  </head>
  <body>



    <div class="row offset-sm-4 m-xs-1">
      <div class="col-12 col-sm-6 shadow-lg p-3 mb-5 bg-white rounded ">
        <div class="card">
            <h3 class="card-header bg-primary text-white">Create a new Plan</h3>
          <div class="row ">
            <div class="col-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <label for="budget">Initial Budget</label>
                    <input type="number" class="form-control" id="budget" name="budget" value="" placeholder="Enter initial budget">
                  </div>
                <div class="form-group">
                  <label for="people">No of people Sharing This budget</label>
                    <input type="number" class="form-control" id="people" name="people" value="" placeholder="Enter no of people">
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
