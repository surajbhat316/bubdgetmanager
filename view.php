<?php
  require_once "pdo.php";
  session_start();
  //print_r($_SESSION['val']);
  $sqln ='SELECT * FROM budget WHERE b_name = :NAME';
  $stmtn= $pdo->prepare($sqln);
  $stmtn->execute(array(':NAME' =>$_GET['budget_name'] ));
  $rown = $stmtn->fetch(PDO::FETCH_ASSOC);
  //echo "<br>";

   //print_r($rown['b_id']);
   $_SESSION['b_id'] = $rown['b_id'];
  if (isset($_POST['title']) && isset($_POST['dateofexpense']) && isset($_POST['samount']) ) {
    $_SESSION['samount'] = $_POST['samount'];
    //print_r($_POST['samount']);
    $sqlq = 'INSERT INTO expenses(e_name,b_id,user_id,amount,dateed)
      VALUES(:e_name,:b_id,:user_id,:amount,:dated)';
    $stmt0 = $pdo->prepare($sqlq);
    $stmt0->execute(array(':e_name' => $_POST['title'] ,
                          ':b_id' => $rown['b_id']  ,
                        ':user_id' => $_SESSION['val'] ,
                      ':amount' => $_POST['samount'] ,
                    ':dated' => $_POST['dateofexpense']));
    $_SESSION['success']= 'records added';

    $sql7 = 'SELECT rem_amt FROM remaining WHERE b_id=:BID';
    $stmt7 = $pdo->prepare($sql7);
    $stmt7->execute(array(':BID' => $_SESSION['b_id']));
    $row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
    $_SESSION['rem_amt'] = $row7['rem_amt'];
    $_SESSION['success']= 'records added';
    header('Location:expenses.php');
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
     <title>View</title>
     <style media="screen">
       #button-row{
         margin: 0 auto;
       }
       #button-row button{
         font-size: 200$;
         background-color: grey;
       }
       #button-row button:hover{
         background-color: white;
         color: grey;
       }
     </style>
   </head>
   <body>
     <?php
     // print_r($_SESSION['val']);
     // echo "<br>";
     //  print_r($rown['b_id']);
       $sql ='SELECT * FROM budget WHERE b_name = :NAME';
       $stmt= $pdo->prepare($sql);
       $stmt->execute(array(':NAME' =>$_GET['budget_name'] ));
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       // print_r($row);
       echo "<br>";
       $sql2 = 'SELECT p_name FROM shares WHERE b_id = :bid';
       $stmt2 = $pdo->prepare($sql2);
       $stmt2->execute(array(':bid' => $row["b_id"] ));
       // print_r($stmt2);
       // $x=0;
       // while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
       //    print_r($row2['p_name']);
       //    echo "<br>";
       // }



      ?>
      <div class="row offset-sm-4 m-xs-1">
        <div class="col-12 col-sm-6 shadow-lg p-0 m-4 bg-white rounded ">
          <div class="card">
              <h3 class="card-header bg-primary text-white"><?php echo $row['b_name'];?><i class="fa fa-user d-grid ml-3"><?php echo " ". $row['no_of_people'] ?></i></h3>
              <div class="card-body">
                  <dl class="row">
                      <dt class="col-6">Budget</dt>
                      <dd class="col-6"><?php echo $row['amount']; ?></dd>
                      <dt class="col-6">Started</dt>
                      <dd class="col-6"><?php echo $row['start_date']; ?></dd>
                      <dt class="col-6">End Date</dt>
                      <dd class="col-6"><?php echo $row['end_date']; ?></dd>


                      <?php
                      $x=1;
                        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                          echo'<dt class="col-6 ml-4">Person';echo $x;echo '</dt>';
                           print_r($row2['p_name']);

                           $x=$x+1;
                        }

                      ?>

                  </dl>
              </div>
          </div>
      </div>
  </div>
  <div class="row ">
    <div id= "button-row" class="col-12 col-sm-3">
      <button class="btn btn-primary p-4" type="button" name="button"><a style="text-decoraton: none; color:inherit;" href="expenses.php?value=">Check Expenses</a></button>
    </div>

  </div>
  <div class="row offset-sm-4 m-xs-1">
    <div class="col-12 col-sm-6 shadow-lg p-0 m-4 bg-white rounded ">
      <div class="card">
          <h3 class="card-header bg-primary text-white">Add New expense</i></h3>
          <div class="card-body">

                <form method="post">
                  <div class="form-group">
                    <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" value="" placeholder="Enter Title" required>
                    </div>
                  <div class="form-group">
                    <label for="date">Enter Date</label>
                      <input type="date" class="form-control" id="date" name="dateofexpense" placeholder=""required>
                  </div>
                    <div class="form-group">
                      <label for="samount">Amount spent</label>
                      <input type="number" class="form-control"  id="samount" name="samount" value="" placeholder="Amount spent"required min="1">
                    </div>
                    <!-- <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="number" class="form-control" id="phone" name="phone" value="" placeholder="Enter phone" >
                    </div> -->
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
