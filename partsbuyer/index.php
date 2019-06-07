<?php
include('config/dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />


    <!--     inserted     -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
    <link href="assets/style.css" rel="stylesheet"/>
    <!--     inserted     -->

</head>

<body class="index-page sidebar-collapse">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
        <div class="container">

            <div class="navbar-translate">
                <a href="index.php" class="navbar-brand" rel="tooltip"  data-placement="bottom" target="">
                    PartsBuyer
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                    <span class="navbar-toggler-bar bar4"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="pages/user_login_page.php" class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Login</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="pages/admin_login_page.php" class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Admin Panal</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="pages/user_signup.php" class="nav-link" onclick="scrollToDownload()">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Sign up</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="scrollToDownload()">
                            <i class="now-ui-icons shopping_cart-simple"></i>
                            <p>Shopping Cart</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper">
        <div class="page-header clear-filter" filter-color="black">


                <div class="container">
                    <div class="content-center brand">

                        <br><br>

                        <h1>WELCOME TO PARTSBUYER ALL YOUR PARTS IN ONE PLACE.</h1>
                        <h2>TO BUY PRODUCTS YOU MUST LOG IN</h2>
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


                        <div style="text-align: center;">
                        <label><b>Search Product: &nbsp</b></label>
                                <form method="POST" action="index_search.php" >
                                    <input type="text" name="search" class="search-query" placeholder="Enter product name">
                                </form>
                        </div>
                    </div>
                    <br><hr color="orange">



  <div class="tab-pane  active" id="">
    <ul class="thumbnails">
    <?php
    //getting product information from database and displaying it.
    $query = "SELECT * FROM products ORDER BY prod_name ASC";
    $result = mysqli_query($dbconn,$query);
    while($res = mysqli_fetch_array($result)) {
        $prod_id=$res['prod_id'];

?>
    <div class="row-sm-3">
        <div class="thumbnail">
            <?php if($res['prod_pic1'] != ""): ?>
            <img src="uploads/<?php echo $res['prod_pic1']; ?>" width="300px" height="200px">
            <?php else: ?>
            <img src="uploads/default.png" width="300px" height="200px">
            <?php endif; ?>
        <div class="caption">
          <h5><b><?php echo $res['prod_name'];?></b></h5>
          <h6><a class="btn btn-success btn-round" title="Click for more details!" href="pages/product_details.php?prod_id=<?php echo $res['prod_id'];?>"><i class="now-ui-icons gestures_tap-01"></i>View</a><medium class="pull-right">£ <?php echo $res['prod_price']; ?></medium></h6>
        </div>

        </div>
      <hr color="orange">
      </div>

<?php }?>

      </ul>
  </div>



    </div>
</div>
        <footer class="footer" data-background-color="black">
            <div class="container">

            </div>
        </footer>
    </div>
</body>


</html>
