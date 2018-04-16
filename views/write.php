<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 10:48 PM
 */
$w = $_GET['w'];
//here $w can be the username
if(!logged_in()) {
    $_SESSION['error'] = "You need to login first.";
    $_SESSION['redirect'] = $w;
    header('Location: ../login.html');
    exit();
}
$w_details = getfromW($w);
$arr_details = $_SESSION['arr_details'];
if($w_details == null) {
    //illegal page access, return to home
    header('Location: index.html');
    exit();
}
//Details of the writer
$gravurl = gravatar($arr_details['email']);
$fullname = $arr_details['fname'] . ' ' . $arr_details['lname'];
$fname = $arr_details['fname'];
//details of the receiver
$w_gravurl = gravatar($w_details['email']);
$w_fullname = $w_details['fname'] . ' ' . $w_details['lname'];
$w_fname = $w_details['fname'];

//ids to identify the post
$from_id = $arr_details['u_id'];
$to_id = $w_details['u_id'];
$to_email = $w_details['email'];
$from_name = $fullname;
$to_fname = $w_fname;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$w_fullname?> | Write</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo LTE;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo LTE;?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo LTE;?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo LTE;?>dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo LTE;?>dist/css/skins/skin-black.css">
    <!-- Custom CSS sheet app.css -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Like button -->
    <script src="./assets/js/like.js"></script>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand"><b>Farewell</b>Dab</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Feed <span class="sr-only">(current)</span></a></li>
                        <li><a href="?profile=1">My Profile</a></li>
                        <?=ifAdmin()?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Having any difficulty?<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>Feel free to reach us at :</li>
                                <li><a href="mailto:me@pbehre.in?subject=FarewellDab%20Contact&body=">me@pbehre.in</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                        </div>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have [[X]] notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> This feature will be available soon.
                                            </a>
                                        </li>
                                        <!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?=$gravurl?>" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">Hey, <?=$fname?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?=$gravurl?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?=$fullname?>
                                        <small>Session: <?=$arr_details['session']?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <p>Your write up link - </p>
                                            <a href="<?=SITE_URL?>?w=<?=$arr_details['username']?>" target="_blank"><?=SITE_URL?>w?=<?=$arr_details['username']?></a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="row">
                                        <div class="col-sm-4 pull-left">
                                            <a href="?profile=1" class="btn btn-default btn-flat">Profile</a>
                                        </div>

                                        <div class="col-sm-4 pull-right">
                                            <a href="?logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Write!
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?=$w_gravurl?>" alt="User profile picture">

                            <h3 class="profile-username text-center"><?=$w_fullname?></h3>

                            <p class="text-muted text-center">Session: <?=$w_details['session']?></p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Posts</b> <a class="pull-right"><?=countPosts($to_id)?></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#write" data-toggle="tab">Write</a></li>
                            <li><a href="#dab" data-toggle="tab">Dab Board.</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="write">
                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?=$gravurl?>" alt="User Image">
                                        <span class="username">
                                            <a href="#"><?=$fullname?></a>
                                        </span>
                                        <span class="description">Give them a good farewell ;)</span>
                                    </div>
                                    <!-- /.user-block -->


                                    <form class="form-horizontal" id="write" method="post">
                                        <input type="hidden" name="from_id" value="<?=$from_id?>">
                                        <input type="hidden" name="to_id" value="<?=$to_id?>">
                                        <input type="hidden" name="to_email" value="<?=$to_email?>">
                                        <input type="hidden" name="from_name" value="<?=$from_name?>">
                                        <input type="hidden" name="to_fname" value="<?=$to_fname?>">
                                        <input type="hidden" name="msgPost" value="1">
                                        <div class="form-group margin-bottom-none">
                                            <div class="col-sm-12">
                                                <textarea name="msg" id="" cols="30" rows="6"
                                                          class="form-control input-sm" placeholder="Write here!" required="required"></textarea>
                                            </div>
                                            <div class="col-sm-3 pull-right">
                                                <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="dab">
                                <div id="feedContent">
                                    <?php
                                    echo getUserFeed($to_id, "write");
                                    ?>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->


                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 0.1.0
            </div>
            <strong>Copyright &copy; Made with &hearts; by <a href="https://pbehre.in">Pavitra</a>, Ritwik and Sakshi </strong>
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo LTE;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo LTE;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo LTE;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo LTE;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo LTE;?>dist/js/adminlte.min.js"></script>
<script src="assets/js/manup.js"></script>
<!-- Type Ahead search -->
<script src="./assets/js/typeahead.min.js"></script>
<script src="./assets/js/search.js"></script>
<script>
    function disableTextarea() {
        $('#write :input').prop("readonly", true);
    }
</script>
<?php
//a check to prevent the user to write for themselves.
if ($w_details['u_id'] == $arr_details['u_id']) {
    //you cannot write for yourself
    echo '<script>alert("You cannot write for yourself :( Share this link with others!");disableTextarea();</script>';
}
?>
</body>
</html>

