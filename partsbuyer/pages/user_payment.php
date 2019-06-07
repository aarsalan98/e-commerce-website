<?php
    session_start();
    include('../config/dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:user_login_page.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Partsbuyer</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />


    <!--     inserted     -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

    <style type="text/css">
      tr td{
        padding-top:-10px!important;
        border: 1px solid #000;
      }
      @media print {
          .btn-print {
            display:none !important;
          }
      }
    </style>


</head>
<body class="index-page sidebar-collapse">
    <div class="wrapper"><br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>       <?php
                                 include('../config/dbconn.php');

                                 $query=mysqli_query($dbconn,"SELECT * FROM `users` WHERE user_id='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_array($query);
                                 $cid=$row['user_id'];
                                 echo $row['firstname'];
                                ?>'s Checking Out!
                      </h2>
                      <hr color="orange">

                <div class="col-md-12">
                <br>

                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">



    <center>

    <?php
    $user_id = $_SESSION['id'];

	include('../config/dbconn.php');
    $query=mysqli_query($dbconn,"SELECT * FROM `users` WHERE user_id='".$_SESSION['id']."'");
    $row=mysqli_fetch_array($query);
    $firstname=$row['firstname'];
    $middlename=$row['middlename'];
    $lastname=$row['lastname'];
    $email=$row['email'];
    $contact=$row['contact'];



$query = mysqli_query($dbconn,"SELECT * FROM order_details WHERE user_id='$user_id' AND order_id=''") or die (mysqli_error());
$row3 = mysqli_fetch_array($query);
$count = mysqli_num_rows($query);
$prod_id=$row3['prod_id'];
$qty= $row3['prod_qty'];

$query2=mysqli_query($dbconn,"SELECT * FROM products WHERE prod_id='$prod_id'") or die (mysqli_error());
$row2=mysqli_fetch_array($query2);
$prod_qty=$row2['prod_qty'];


 mysqli_query($dbconn,"UPDATE products SET prod_qty = prod_qty - $qty WHERE prod_id ='$prod_id' AND prod_qty='$prod_qty'");


$cart_table = mysqli_query($dbconn,"SELECT sum(total) FROM order_details WHERE user_id='$user_id' AND order_id=''") or die(mysqli_error());
       $cart_count = mysqli_num_rows($cart_table);

        while ($cart_row = mysqli_fetch_array($cart_table)) {
// once the user has cheked out on the payment screen it will show the user tracking number, address, total, and tax.
           $total = $cart_row['sum(total)'];
           $date = date("Y-m-d H:i:s");
           $tax=$total * 0.12;
           $track_num= $user_id.$user_id+1000;
           $shipaddress=$_POST['shipaddress'];
           $city=$_POST['city'];
           $ship_add=$shipaddress .' '. $city;
           echo '********* Your tracking number: '.$track_num.' | ';
           echo 'Total: £'.$total.' | ';
           echo 'Tax: £'.$tax.' | ';
           echo 'Shipping Address: '.$ship_add.' *********';
           // once the order has gone through it will store the informatoin in the database.
           $query = "INSERT INTO `order` (`user_id`, `track_num`, `firstname`, `middlename`, `lastname`, `email`, `contact`, `shipping_add`, `order_date`, `status`, `totalprice`, `tax`)
                   VALUES ('$user_id','$track_num','$firstname','$middlename','$lastname','$email','$contact','$ship_add','$date','Pending','$total','$tax')";
                   $result = mysqli_query($dbconn,$query);
                   if ($result) {
                       echo "New record created successfully";
                   } else {
                       echo "Error: " . $query . "<br>" . $dbconn->error;
                   }

 mysqli_query($dbconn,"UPDATE order_details SET order_id=order_id+1 WHERE user_id='$user_id' AND order_id=''")or die(mysqli_error());
mysqli_query ($dbconn,"UPDATE order_details SET total_qty =$prod_qty - $qty WHERE prod_id ='$prod_id' AND total_qty='' ");


}

?>

        <hr color="orange">
        <br><br>
        <h3>Payment type will be  <b>made when collecting your item</b></h3>
        <h3>Please do not forget to bring your invoice</h3><br>
        <h5>PartsBuyer</h5>

     <button type="button" class="btn btn-warning btn-round" onclick = "window.print()"><span class="now-ui-icons ui-1_check"></span> Print</button>
     <a href="user_index.php"><button type="button" class="btn btn-success btn-round"><span class="now-ui-icons ui-1_check"></span> Back to Homepage</button></a>

    </center>

</div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
<br><br><br><br>
<footer class="footer" data-background-color="black">

            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>


</html>
