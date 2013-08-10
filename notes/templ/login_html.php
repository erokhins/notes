<!DOCTYPE html>
<html>
  <head>
    <title>Notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
    <link href="<?=$rootFolder?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?=$rootFolder?>css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
    <link href="<?=$rootFolder?>css/my.css" rel="stylesheet" media="screen">
  </head>
  <body>


	<?if(isset($_GET['error'])) {?>
		<div class = "text-center text-danger" style="padding-top:15px;">Wrong login or password</div>
	<?}?>
	
  <form class="authorize well text-center" style="width:247px;margin-left:auto;margin-right:auto" action="<?=$rootFolder?>req.php" method="post">
	<div class="control-group">
		<label class="control-label" for="inputEmail">Login:</label>
		<div class="controls">
			<input type="text" name="login" id="inputEmail" placeholder="Login">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Password:</label>
		<div class="controls">
			<input type="password" name="password" id="inputPassword" placeholder="Password">
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			
			<button type="submit" class="btn btn-success">Sign in</button>
		</div>
	</div>
  </form>
        <!-- JavaScript plugins (requires jQuery) -->
    <script src="<?=$rootFolder?>js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$rootFolder?>js/bootstrap.min.js"></script>

    <!-- Optionally enable responsive features in IE8 -->
    <script src="<?=$rootFolder?>js/respond.js"></script>
  </body>
</html>
