<?php
    session_start();
    include('../config/dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:admin_login_page.php');
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
                      <h2>Customer Orders</h2>
                      <a class="btn btn-primary btn-round" href="admin_panel.php"><i class="now-ui-icons arrows-1_minimal-left"></i> &nbsp Back to index</a>
                      <hr color="orange">

                <div class="col-md-12">
                <br>

                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">








<?php
                                      include('../config/dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM `order` ORDER BY `order_date` ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>

                                <br>
                                <br>
                                <table id="" class="table table-condensed table-striped">
                                    <tr>
                                      <th>Invoice number</th>
                                      <th>Customer</th>
                                      <th>Order date</th>
                                      <th>Shipping Address</th>
                                      <th>Contact</th>
                                      <th>Email</th>
                                      <th>Total price(£)</th>
                                      <th>Tax(£)</th>
                                      <th>Status</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {
                                              echo "<tr>";
                                                echo "<td>".$res['track_num']."</td>";
                                                echo "<td>".$res['firstname'].' '.$res['middlename'].' '.$res['lastname']."</td>";
                                                echo "<td>".$res['order_date']."</td>";
                                                echo "<td>".$res['shipping_add']."</td>";
                                                echo "<td>".$res['contact']."</td>";
                                                echo "<td>".$res['email']."</td>";
                                                echo "<td>".$res['totalprice']."</td>";
                                                echo "<td>".$res['tax']."</td>";
                                                echo "<td>".$res['status']."</td>";
                                              echo "</tr>";
                                            }
                                          } else { echo "no results";}?>
                                </table><br><br><br><br>




                        </div>
                    </div>
                </div>
            </div>
        </div>
<br><br><br><br>
<footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
                    <ul>

                </div>
            </div>
        </footer>
    </div>
</body>


</html>
