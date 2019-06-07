<?php
    session_start();

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

<body class="profile-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
        <div class="container">
            <div class="navbar-translate">

                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar4"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_panel.php" onclick="scrollToDownload()">
                            <i class="now-ui-icons users_circle-08"></i>
                            <p>
                                <?php
                                 include('../config/dbconn.php');
                                 $query=mysqli_query($dbconn,"SELECT * FROM `admin` WHERE user_id='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_array($query);
                                 echo 'Admin '.$row['firstname'].'';
                                ?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_products.php">
                            <i class="now-ui-icons files_paper"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">
                            <i class="now-ui-icons shopping_cart-simple"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" href="" onclick="scrollToDownload()">
                            <i class="now-ui-icons ui-1_lock-circle-open"></i>
                            <p>Logout</p>
                        </a>
                    </li>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


        <div class="wrapper">
            <div class="page-header page-header-small" filter-color="black">

                <div class="container">
                    <div class="content-center">

                        <h2 class="title">
                            <?php
                            include('../config/dbconn.php');
                            $query=mysqli_query($dbconn,"SELECT * FROM `admin` WHERE user_id='".$_SESSION['id']."'");
                            $row=mysqli_fetch_array($query);
                            echo ''.$row['firstname'].' '.$row['lastname'].'';
                            ?>
                        </h2>
                        <p class="category">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">

               <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <h4 class="title text-center">Administrator Dashboard</h4>
                        <div class="nav-align-center">
                            <ul class="nav nav-pills nav-pills-primary" role="tablist">


                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#products" role="tablist">
                                        <i class="now-ui-icons shopping_tag-content"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#supplier" role="tablist">
                                        <i class="now-ui-icons shopping_delivery-fast"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#user_accounts" role="tablist">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#admin_accounts" role="tablist">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content gallery">
                        <div class="tab-pane active" id="products" role="tabpanel">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="row collections">
                                    <br>
                                    <div class="row">
                                        <div align="center">
                                            <h3>Product Information</h3>
                                        </div>
                                    </div>
                                    <br>

                                      <?php
                                      include('../config/dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM products ORDER BY prod_name ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>

                                <br>
                                <br>
                                <table id="" class="table table-condensed table-striped">
                                    <tr>
                                      <th>Serial</th>
                                      <th>Product Name</th>
                                      <th>Description</th>
                                      <th>Cost(£)</th>
                                      <th>Price(£)</th>
                                      <th>Quantity</th>
                                      <th>Category</th>
                                      <th>Supplier</th>
                                      <th>Option</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {
                                              echo "<tr>";
                                                echo "<td>".$res['prod_serial']."</td>";
                                                echo "<td>".$res['prod_name']."</td>";
                                                echo "<td>".$res['prod_desc']."</td>";
                                                echo "<td>".$res['prod_cost']."</td>";
                                                echo "<td>".$res['prod_price']."</td>";

                                                $prod_qty=$res['prod_qty'];

                                                if ($prod_qty<=10){
                                                ?>
                                                 <td><span style="color:red;"><?php echo $res['prod_qty'];?> : Reorder!</span></td>
                                                 <?php
                                                }else{
                                               ?>
                                               <td><?php echo $res['prod_qty'];?></td>
                                               </ul>
                                               <?php }

                                                echo "<td>".$res['category']."</td>";
                                                echo "<td>".$res['supplier']."</td>";
                                                echo "<td><a href=\"product_add_qty.php?prod_id=$res[prod_id]\">Add Qty</a> | <a href=\"product_update.php?prod_id=$res[prod_id]\">Edit</a> | <a href=\"product_delete.php?prod_id=$res[prod_id]
                                                \" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                                              echo "</tr>";
                                            }
                                          }?>
                                </table>






                                <br><br>
                                <a class="btn btn-success btn-round" href="product_add.php"><i class="now-ui-icons ui-1_simple-add"></i> Add Product</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="supplier" role="tabpanel">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="row collections">
                                    <br>
                                    <div class="row">
                                        <div align="center">
                                            <h3>Supplier Information</h3>
                                        </div>
                                    </div>
                                    <br>

                                      <?php
                                      include('../config/dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM supplier ORDER BY supp_name ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>

                                <br>
                                <br>
                                <table id="" class="table table-condensed table-striped">
                                    <tr>
                                      <th>Supplier Name</th>
                                      <th>Address</th>
                                      <th>Contact</th>
                                      <th>Email</th>
                                      <th>Option</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {
                                              echo "<tr>";
                                                echo "<td>".$res['supp_name']."</td>";
                                                echo "<td>".$res['supp_address']."</td>";
                                                echo "<td>".$res['supp_contact']."</td>";
                                                echo "<td>".$res['supp_email']."</td>";
                                                echo "<td><a href=\"supplier_update.php?supp_id=$res[supp_id]\">Edit</a> | <a href=\"supplier_delete.php?supp_id=$res[supp_id]
                                                \" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                                              echo "</tr>";
                                            }
                                          }?>
                                </table>
                                <br><br>
                                <a class="btn btn-success btn-round" href="supplier_add.php"><i class="now-ui-icons ui-1_simple-add"></i> Add Supplier</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="user_accounts" role="tabpanel">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="row collections">
                                    <br>
                                    <div class="row">
                                        <div align="center">
                                            <h3>User Information</h3>
                                        </div>
                                    </div>
                                    <br>

                                      <?php
                                      include('../config/dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM users ORDER BY firstname ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>

                                <br>
                                <br>
                                <table class="table table-condensed table-striped">
                                    <tr>
                                      <th>First Name</th>
                                      <th>Middle Name</th>
                                      <th>Last Name</th>
                                      <th>Address</th>
                                      <th>Email</th>
                                      <th>Contact</th>
                                      <th>Option</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {
                                              echo "<tr>";
                                                echo "<td>".$res['firstname']."</td>";
                                                echo "<td>".$res['middlename']."</td>";
                                                echo "<td>".$res['lastname']."</td>";
                                                echo "<td>".$res['address']."</td>";
                                                echo "<td>".$res['email']."</td>";
                                                echo "<td>".$res['contact']."</td>";
                                                echo "<td><a href=\"user_delete.php?user_id=$res[user_id]
                                                \" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                                              echo "</tr>";
                                            }
                                          }?>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="admin_accounts" role="tabpanel">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="row collections">
                                    <br>
                                    <div class="row">
                                        <div align="center">
                                            <h3>Admin Information</h3>
                                        </div>
                                    </div>
                                    <br>

                                      <?php
                                      include('../config/dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM admin ORDER BY firstname ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>

                                <br>
                                <br>
                                <table class="table table-condensed table-striped">
                                    <tr>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Email</th>
                                      <th>Username</th>
                                      <th>Option</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {
                                              echo "<tr>";
                                                echo "<td>".$res['firstname']."</td>";
                                                echo "<td>".$res['lastname']."</td>";
                                                echo "<td>".$res['email']."</td>";
                                                echo "<td>".$res['username']."</td>";
                                                //echo "<td>".$res['password']."</td>";
                                                echo "<td><a href=\"admin_account_update.php?user_id=$res[user_id]\">Edit</a>";
                                              echo "</tr>";
                                            }
                                          }?>
                                </table>
                                <br><br>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer" data-background-color="black">
           <div class="container">


            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>

</html>
