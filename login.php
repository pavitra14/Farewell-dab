<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 12:16 PM
 */
include('./includes/functions.php');
if(logged_in()){
    header('Location: front.html');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo LTE;?>plugins/iCheck/square/blue.css">
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

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        /* MESSAGES */

        .hidethis {
            cursor: pointer;
        }

        .msg-info,
        .msg-atten,
        .msg-ok,
        .msg-error {
            margin: 3px 0;
            padding: 10px 10px 10px 40px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
        }

        .msg-info {
            background: #ADC2F7 6px center no-repeat;
            border: 1px solid #6D94F7;
            color: #03C;
        }

        .msg-atten {
            background: #FAE673 6px center no-repeat;
            border: 1px solid #FEBD63;
            color: #C60;
        }

        .msg-ok {
            background: #AEE893 6px center no-repeat;
            border: 1px solid #8EC46C;
            color: #060;
        }

        .msg-error {
            background: #F4B8B5 6px center no-repeat;
            border: 1px solid #C94042;
            color: #900;
        }
        /* END OF MESSAGES */
        .site-wrapper {
            display: table;
            width: 100%;
            height: 100%;
            /* For at least Firefox */
            min-height: 100%;
            background: rgba(48, 53, 70, 0.5);
            box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="site-wrapper">
    <div class="login-box">
    <!--    <div class="login-logo">-->
    <!--        FarewellDab-->
    <!--    </div>-->
        <?php
        if ( $_POST[ 'submitL' ] == "1") {
            login( $_POST[ 'user' ], $_POST[ 'pass' ]);
        }
        ?>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in</p>
            <p>
                <?php echo messages();?>
            </p>
            <form action="" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" name="user" class="form-control" placeholder="Username" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="pass" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4 pull-left">
                        <button type="button" class="btn btn-warning btn-block btn-flat" name="submitR" onclick="location.href='register.html'" value="1">Register!</button>
                    </div>
                    <div class="col-xs-4 pull-right">
                        <button type="submit" class="btn btn-danger btn-block btn-flat" name="submitL" value="1">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <a href="#" onclick="alert('Feature will be available soon!');">I forgot my password</a>
            </form>


            <br>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>
<!-- jQuery 3 -->
<script src="<?php echo LTE;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo LTE;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo LTE;?>plugins/iCheck/icheck.min.js"></script>
<script src="assets/js/manup.js"></script>

</body>
</html>

