<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-7 col-sm-6">
    	<h3>Login</h3>

	<form class="form-signin" action="index.php?page=login" method="POST">
		<fieldset>
			<label for="login">Username or Email adress</label><br>
			<input class="form-control" type="text" name="login" id="login" value="<?php if(isset($_POST['login'])){echo htmlentities($_POST['login'], ENT_QUOTES, 'UTF-8');} ?>" /><br>
 
			<label for="password">Password</label><br>
			<input class="form-control" type="password" name="password"><br>
 
			<input class="btn btn-success" type="submit" name="submit" value="Submit"><br><br>
			<p>(Click <a href="index.php?page=signup">here</a> if you don't have an account)</p>
		</fieldset>
	
	</form>

<?php
if (isset($message)) { ?>
<br><br><div class="alert alert-dismissible alert-danger "><?=$message?></div>
<?php } ?>

    
    </div>
  </div>
</div>

<script src="static/js/login.js"></script>