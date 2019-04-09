<?php
$first_bit = $this->uri->segment(1);
$form_location = base_url().$first_bit.'/submit_login';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url();?>css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>css/jumbotron.css" rel="stylesheet">

   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
<div class="row">
  <div class="col-md-4 col-md-offset-4">
      <form class="form-signin" action="<?=$form_location;?>" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputText" class="sr-only">username or address</label>
          <input type="text" name="username" value="<?=$username;?>" id="inputText" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" name="pword" id="inputPassword" class="form-control" placeholder="Password" required>
          <?php
          if ($first_bit == "youraccount") { ?>
          
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" value="remember-me"> Remember me
          </label>
        </div>
        <?php
      }
      ?>
        <button name="submit" value="Submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
</div>
</div>
    </div> <!-- /container -->

    <!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo base_url();?>adminfiles/jquery-3.2.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
