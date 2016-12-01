<!-- shutdown -->
<!-- TODO -->
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-7 col-sm-6">
    <h3>Admin page</h3>

    <h4>Users</h4>
	<table class="table table-striped table-hover ">
	  <thead>
	    <tr>
	      <th>id</th>
	      <th>Username</th>
	      <th>email</th>
	    </tr>
	  </thead>
	  <tbody>
	<?php foreach ($arrayFinal as $key => $value) { ?>
	    <tr <?=$value['class']?>>
	      <td><?=$value['id']?></td>
	      <td><span style="color:<?=$value['glyph_color']?>" class="glyphicon glyphicon-<?=$value['adminGlyph']?>" aria-hidden="true"></span> <?php if ($value['you'] == '' && ($value['admin'] < 1 || $_SESSION['admin'] == 2) ) { ?><a href='?page=user&amp;id=<?=$value['id']?>'><?php } ?><?=$value['username']?><?=$value['you']?><?php if ($value['you'] == '' && ($value['admin'] < 1 || $_SESSION['admin'] == 2) ) { ?></a><?php } ?><?php if($value['blocked'] == 1) { ?>   <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>   <?php } ?></td>
	      <td><?=$value['email']?></td>
	    </tr>
	<?php } ?>
	  </tbody>
	</table> 


    <h4>Shut down server</h4>
	<form method="post" action="index.php?page=admin">
		<p><button name='shutdown-button' class="btn btn-sm btn-primary" type="submit">Shutdown</button></p>
	</form>
	<p><font color="red"><?=$message?></font><p>
    </div>
  </div>
</div>
