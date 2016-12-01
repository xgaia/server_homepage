<!-- welcome message -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-7 col-sm-6">
      <h1>Welcome to the <?=$nameServer?> Server !</h1>
      <p><?=$welcomeMessage->getMessage()?></p>
    </div>
  </div>
</div>
<br>




<!-- disk space -->
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-7 col-sm-6">
    	<h4>Disk Space</h4>
    	<?=$bar?> <!-- see model/home.php section disk space -->
    </div>
  </div>
</div>

<br>

<!-- quote -->
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-7 col-sm-6">
    	<p><?=$quote?></p> <!-- see model/home.php section quote -->
    </div>
  </div>
</div>
