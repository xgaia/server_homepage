<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-7 col-sm-6">
            <h3>Sign up</h3>

    <?php if ($form) { ?>

        <form class="form-signin" action="index.php?page=signup" method="POST">
            <fieldset>
                <label for="username">Username</label><br>
                <div id='username-div'><input id='username' class="form-control" type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /></div><br>
     
                <label for="password">Password<span class="small"> (8 characters min)</span></label><br>
                <div id='password-div'><input id='password' class="form-control" type="password" name="password"></div><br>
     
                <label for="password2">Password<span class="small"> (Check)</span></label><br>
                <div id='password-div2'><input id='password2' class="form-control" type="password" name="password2" /></div><br>
     
                <label for="email">Email adress</label><br>
                <div id='email-div'><input id='email' class="form-control" type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /></div><br>
     
                <input id='submit-button' class="btn btn-success" type="submit" name="submit" value="Submit"><br><br>
                <p>(Click <a href="index.php?page=login">here</a> if you have an account)</p>
            </fieldset>
        
        </form>
     

     
    <?php    }
    if (isset($message)) { ?>
            <div class="alert alert-dismissible alert-<?=$class?>">
                <?=$message?>
            </div>
    <?php } ?>

<div id='textjq'></div>
<script src="static/js/signup.js"></script>
