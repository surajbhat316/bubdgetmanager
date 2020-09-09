<?php
  require_once "pdo.php";
  session_start();
  
  if (isset($_POST['title']) && isset($_POST['from']) && isset($_POST['to']) &&
   isset($_POST['people']) && isset($_POST['budget']) ) {


    // code...

    $sql = "INSERT INTO budget (b_name, amount, no_of_people,start_date, end_date, user_id)
    VALUES(:name,:amount,:num,:sdate,:edate, :uid)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':name' =>$_POST['title'],
                          ':amount' =>$_POST['budget'] ,
                        ':num' =>$_POST['people'] ,
                      ':sdate' =>$_POST['from'] ,
                    ':edate' =>$_POST['to'],
                  ':uid' => $_SESSION['val']));

    $sql2 = "SELECT b_id FROM budget WHERE b_name = :name";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute( array(':name' => $_POST['title'] ));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sql8 = "INSERT INTO remaining (b_id, amount, rem_amt)
    VALUES(:B_ID,:Amount,:rem_amt)";
    $stmt8 = $pdo->prepare($sql8);
    $stmt8->execute(array(':B_ID' =>$row['b_id'],
                          ':Amount' =>$_POST['budget'] ,
                        ':rem_amt' =>$_POST['budget'] ));

    for($x=1;$x<=$_SESSION['people'];$x=$x+1){
      $sql1 = "INSERT INTO shares (b_id, p_name) VALUES(:bid, :pname)";
      $stmt1 = $pdo->prepare($sql1);
      $stmt1->execute(array(':bid' => $row['b_id'],
                            ':pname' => $_POST["$x"]));
    }
    $_SESSION['success'] = "Event created";
    header('Location: main.php');
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
    <title>Template</title>
    <style media="screen">
    #button{
      background-color: white;
      color:black;
    }
      #button:hover{
        background-color: grey;
        color: white;
      }
    </style>
  </head>
  <body>
    <div class="row offset-sm-4 m-xs-1">
      <div class="col-12 col-sm-6 shadow-lg p-3 mb-5 bg-white rounded ">
        <div class="card">
            <h3 class="card-header bg-primary text-white">Create a new Plan</h3>
          <div class="row">
            <div class="col-12 col-sm-12">
                <form method="post">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="from">From</label>
                      <input type="date" name="from" class="form-control" id="from">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="to">To</label>
                      <input type="date" name="to" class="form-control" id="to">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-8">
                      <label for="budget">Initial Budget</label>
                      <input type="text" name="budget" class="form-control" value="<?php
                        echo $_SESSION['budget'];
                      ?>" readonly="readonly">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="budget">No of people</label>
                      <input type="text" name="people" class="form-control" value="<?php
                        echo $_SESSION['people'];
                      ?>" readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <?php
                    for($x=1;$x<=$_SESSION['people'];$x=$x+1){
                      echo "Person $x\n";
                      echo "<input type='text'class='col-12 col-md-12 p-1 m-2' name ='$x' placeholder='Person $x Name'  >";
                      echo "\n";
                    }
                    ?>
                  </div>

                  <div class="form-row">
                    <div class="">
                      <button id="button" type="submit" class="btn btn-primary col-sm-12">Submit</button>
                    </div>
                  </div>
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
