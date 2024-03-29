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
    <title>PartsBuyer</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />


    <!--     inserted     -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

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
                                ?>'s Shopping Cart
                      </h2>
                      <a class="btn btn-primary btn-round" href="user_index.php"><i class="now-ui-icons shopping_basket"></i> &nbsp Shop more items</a>
                      <hr color="orange">

                <div class="col-md-12">
                <br>

                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">





      <?php
        $user_id = $_SESSION['id'];

        $query3=mysqli_query($dbconn,"SELECT * FROM order_details WHERE user_id='$user_id' AND order_id=''") or die (mysql_error());
        $count2=mysqli_num_rows($query3);
      ?>


<?php



                                    if (isset($_POST['submit'])) {

                                        $order_id=$_GET['order_id'];
                                        $prod_qty = $_POST['prod_qty'];
                                        $total = $_POST['prod_qty']*$_POST['total'];

                                        date_default_timezone_set('Asia/Manila');
                                        $date = date("Y-m-d H:i:s");

                         mysqli_query($dbconn,"UPDATE order_details SET
                          prod_qty='$prod_qty',total='$total' WHERE order_details_id='$order_id'")
                     or die(mysqli_error());
                                            ?>

                                              <script type="text/javascript">
                                                alert("Quantity Updated");
                                                window.location= "user_cart.php";
                                            </script>


                                            <?php
                                    }
                                    ?>

<form method="post">

  <h5>[ <small><?php echo $count2;?> </small>] types of item.</h5>

  <button type="submit" name="submit" class="btn btn-success btn-round">Update</button>


  <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th width="100">Quantity</th>
                  <th width="100">Price(£)</th>
                  <th width="100">Total(£)</th>
        </tr>
              </thead>
              <tbody>
                <?php
                      $user_id = $_SESSION['id'];
                      $order_id=$_GET['order_id'];

                $query=mysqli_query($dbconn,"SELECT * FROM order_details WHERE order_details_id='$order_id'") or die (mysqli_error());
                $row=mysqli_fetch_array($query);
                $count=mysqli_num_rows($query);
                $prod_id=$row['prod_id'];
                $query2=mysqli_query($dbconn,"SELECT * FROM products WHERE prod_id='$prod_id'") or die (mysqli_error());
                $row2=mysqli_fetch_array($query2);
                $prod_qty=$row2['prod_qty'];

                ?>
        <tr>


                  <td> <img width="150" height="100" src="../uploads/<?php echo $row2['prod_pic1'];?>" alt=""/></td>
                  <td><b><?php echo $row2['prod_name'];?></b><br><br>
                          <?php $string=$row2['prod_desc'];?></td>
          <td>
      <div class="input-append">
      <?php
  echo "<select class='btn btn-warning btn-round dropdown-toggle' size='1' name='prod_qty' id='prod_qty'>";
$i=1; $prod_qty=$prod_qty;
while ($i <= $prod_qty ){
    echo "<option value=".$i.">".$i."</option>";
    $i++;
}
echo "</select>";
?>

     </div>


          </td>
                  <td><?php  echo $row2['prod_price']; ?></td>
                  <td><?php echo $row['total']; ?></td>
              <input type="hidden" name="total" value="<?php echo $row2['prod_price'];?>">
                </tr>


        </tbody>
            </table>




  <a href="user_cart.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel </a>

</form>







                        </div>
                    </div>
                </div>
            </div>
        </div>
<br><br><br><br>
<footer class="footer" data-background-color="black">

        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>

</html>
