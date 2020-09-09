<?php
  require_once "pdo.php";
  session_start();
  // $sql3 = 'SELECT amount FROM budget WHERE b_id = :b_Id';
  // $stmt3 = $pdo->prepare($sql3);
  // $stmt3->execute(array(':b_Id' => $_SESSION['b_id']));
  //
  // $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
  // $amount = $row3['amount'];
  // $rem_amt = $_SESSION['rem_amt'];

  $spent = $_SESSION['samount'];
  if (!isset($_SESSION['samount'])) {
    echo'Welcome';

  }
  $sqlz = 'SELECT rem_amt FROM remaining WHERE b_id = :b_iD';
  $stmtz = $pdo->prepare($sqlz);
  $stmtz->execute(array(':b_iD' => $_SESSION['b_id']));



  $rowz = $stmtz->fetch(PDO::FETCH_ASSOC);
  $left = $rowz['rem_amt']; //remaining amount

  $sql2 = 'SELECT b_name FROM budget WHERE b_id = :b_id';
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute(array(':b_id' => $_SESSION['b_id']));

  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  // print_r($row2);

  $sql ='SELECT SUM(amount), b_id FROM expenses where user_id = :uid  AND b_id = :bid';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':uid' => $_SESSION['val'] ,
                        ':bid' => $_SESSION['b_id']));

  $sql10 ='SELECT SUM(amount) FROM expenses WHERE b_id = :bi_d';
  $stmt10 = $pdo->prepare($sql10);
  $stmt10->execute(array(':bi_d' => $_SESSION['b_id']));
  $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);


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
     <title></title>
   </head>
   <body>
     <div class="container">
       <h1>Money Spent in <?php echo $row2['b_name']; ?></h1>
     </div>
     <?php
      echo('<div class = "container-fluid table-responsive"><table border="1"class="mt-sm-5 table table-striped table-dark">'."\n");
   		echo "<th>Spent</th>";
   		echo "<th>Budget ID</th>";
      echo "<th>Remaining Budget</th>";

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // print_r($row);
        if($left<$spent){
          echo "only".$left."is left";
          break;
        }
          echo "<tr><td>";
  		    echo(htmlentities($row['SUM(amount)']));
  		    echo("</td><td>");
  		    echo(htmlentities($row['b_id']));
  		    echo("</td>");
          // print_r($row['SUM(amount)']);
          $left = $left - $spent;
          print_r($left);
          echo("</td><td>");
          echo(htmlentities($left));
  		    echo("</td>");
          echo("</tr>\n");

          $sqr = 'UPDATE remaining SET rem_amt = :left  WHERE b_id = :B_id';
          $stmtr = $pdo->prepare($sqr);
          $stmtr->execute(array(':left' => $left ,':B_id' => $_SESSION['b_id'] ));

      }

      // $amount_left = $amount - $row['SUM(amount)'];

       ?>
       </table>

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
