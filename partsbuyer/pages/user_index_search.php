<?php
    session_start();

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
    <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet"/>

    <link href="../assets/style.css" rel="stylesheet"/>
    <!--     inserted     -->

</head>

<body class="index-page sidebar-collapse">
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
                        <a class="nav-link" href="" onclick="scrollToDownload()">
                            <i class="now-ui-icons users_circle-08"></i>
                            <p>
                                <?php
                                 include('../config/dbconn.php');
                                 $query=mysqli_query($dbconn,"SELECT * FROM `users` WHERE user_id='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_array($query);
                                 echo ''.$row['firstname'].'';
                                ?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_products.php">
                            <i class="now-ui-icons files_paper"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="scrollToDownload()">
                            <i class="now-ui-icons shopping_cart-simple"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="scrollToDownload()">
                            <i class="now-ui-icons files_box"></i>
                            <p>Transactions</p>
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
        <div class="page-header clear-filter" filter-color="orange">


                <div class="container">
                    <div class="content-center brand">

                        <br><br>
                        <h3>WELCOME TO PARTSBUYER ALL YOUR PARTS IN ONE PLACE</h3>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                    <br>
                    <div class="col-md-12">
                        <h2 class="title">Products</h2>
                        <div class="typography-line">
                            <p>
                            View our fantastic range of products below.
                            </p>
                        </div>
                        <br>


                        <center>
                        <label><b>Search Product: &nbsp</b></label>
                                <form method="POST" action="user_index_search.php" >
                                    <input type="image" title="Search" src="../assets/img/search.png" alt="Search" />
                                    <input type="text" name="search" class="search-query" placeholder="Enter product name">
                                </form>
                        </center>
                    </div>
                    <br><hr color="orange">

                    <div class="tab-pane  active" id="">
                        <ul class="thumbnails">
                            <?php
                            if (isset($_POST['search'])){

                            $search=$_POST['search'];

                            $query="SELECT * FROM products WHERE category LIKE '%$search%' OR prod_name LIKE '%$search%' OR prod_desc LIKE '%$search%'";
                            $result = mysqli_query($dbconn,$query);
                            while($res=mysqli_fetch_array($result)){
                                $prod_id=$res['prod_id'];
                            ?>

                            <div class="row-sm-3">
                                <div class="thumbnail">
                                    <?php if($res['prod_pic1'] != ""): ?>
                                    <img src="../uploads/<?php echo $res['prod_pic1']; ?>" width="300px" height="200px">
                                    <?php else: ?>
                                    <img src="../uploads/default.png" width="300px" height="200px">
                                    <?php endif; ?>
                                <div class="caption">
                                  <h5><b><?php echo $res['prod_name'];?></b></h5>
                                  <h6><a class="btn btn-success btn-round" title="Click for more details!" href="user_product_details.php?prod_id=<?php echo $res['prod_id'];?>"><i class="now-ui-icons gestures_tap-01"></i>View</a><medium class="pull-right">£<?php echo $res['prod_price']; ?></medium></h6>
                                </div>

                                </div>
                              <hr color="orange">
                              </div>

                                <?php }?>
                            <?php }?>

                        </ul>
                    </div>




        </div>
    </div>
</div>
        <footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="" target="_blank">
                                HND Graded Unit
                            </a>
                        </li>

                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>


</html>
