<?php
require_once 'classes/view.php';
require_once 'classes/session.php';
require_once 'classes/database.php';
require_once 'header.html';
?>
<div class="page-header" id="banner">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Admin Login</h1>
        </div>
    </div>
</div>
<form class="form-signin" role="form" action="process.php" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <input type="text" name="userName" class="form-control" placeholder="User Name" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
<?php if(isset($login_failed)) { ?>
    <div class="alert alert-error" style="width: 300px;margin-left: auto;margin-right: auto;">
        Login Error!
    </div>
<?php } ?>
<?php require_once 'footer.html'; ?>