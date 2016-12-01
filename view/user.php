<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-7 col-sm-6">
    <h3>User <?=$results['username']?></h3>
    <form method="post" action="index.php?page=user&amp;id=<?=$results['id']?>">
        <?php if ($_SESSION['admin'] == 2) { ?>
		<input type="radio" name="admin" value="0" <?=$checkeduser?>> user<br>
		<input type="radio" name="admin" value="1" <?=$checkedadmin?>> admin<br>
		<br>
        <?php } ?>
        <input type="radio" name="blocked" value="0" <?=$checkedunblocked?>> Unblocked<br>
        <input type="radio" name="blocked" value="1" <?=$checkedblocked?>> Blocked<br>
        <br>
		<button name='update-button' class="btn btn-sm btn-success" type="submit">Update user</button>
	</form>
<br>
<?php if(isset($message)) { ?> <div class="alert alert-success col-sm-2" role="alert"> <?=$message?> <?php } ?></div>
