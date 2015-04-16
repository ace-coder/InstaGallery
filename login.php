<?php
require_once 'db.php';

if (isset($_REQUEST['btnLogin'])) {
    $userName = $_REQUEST['txtUsername'];
    $password = $_REQUEST['txtPassword'];

    $dbAccess = new DBAccess();
    $rows = $dbAccess->get_where('users', '*', array('name' => $userName, 'password' => md5($password)));

//    print_r($rows);
    if (count($rows) > 0) {
        @session_start();
        $_SESSION['USER_NAME'] = $userName;
        $_SESSION['USER_ID'] = $rows[0]['id'];
        header('location:index.php');
    } else {
        $error = "Username and password did not match";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                <header class="login-cont-head">
                    <h3>Instagram</h3>
                </header>
                <div class="login-cont-body">
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="txtUsername" class="col-sm-4 control-label">Username:</label>
                            <div class="col-sm-8">
                                <input type="text" id="txtUsername" name="txtUsername" class="form-control" placeholder="Enter email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtPassword" class="col-sm-4 control-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="checkbox col-sm-offset-4 col-sm-8">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <a href="#" class="pull-left">Forgot your password?</a>
                        <button name="btnLogin" class="btn btn-primary pull-right" type="submit">Sign in</button>
                        <div class="clearfix"></div>
                        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                    </form>
                </div>
            </div>
        </div> <!-- /container -->
    </body>
</html>