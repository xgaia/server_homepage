<?php
session_start();

//url
$url= "http://".$_SERVER['HTTP_HOST'];
//$url=substr($url,0,-1);

//parse config.ini
$arrayIni=parse_ini_file("config.ini.php");
//echo "<br><br><br>";print_r($arrayIni);echo "<br>";
$sql_host=$arrayIni['sql_host'];
$sql_user=$arrayIni['sql_user'];
$sql_password=$arrayIni['sql_password'];
$sql_database=$arrayIni['sql_database'];

//database connexion
try{
  $db = new PDO('mysql:host='.$sql_host.';dbname='.$sql_database.';charset=utf8', ''.$sql_user.'', ''.$sql_password.'',
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e){
  die('Erreur : ' . $e->getMessage());
}

//name (hostname of server if not define in ini)
if (isset($arrayIni['nameServer'])) {
  $nameServer=$arrayIni['nameServer'];
}else{
  $nameServer=shell_exec('hostname');
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?=$nameServer?></title>
<link rel="icon" type="image/png" href="static/favicon.png"/>

<!--css boostrap-->
<link rel="stylesheet" href="static/bootstrap-3.3.6-dist/css/bootstrap.css" media="screen">
<!--css booswatch-->
<link rel="stylesheet" href="static/bootswatch.css" media="screen">
<!--jQuery-->
<script src="static/jquery-2.2.4.js"></script>
<!--javascript bootstrap-->
<script src="static/bootstrap-3.3.6-dist/js/bootstrap.js"></script>

</head>
<body>


<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">

      <a href="./" class="navbar-brand"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> <?=$nameServer?></a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
      </button>
      <ul class="nav navbar-nav">
      <?php if (!empty($_SESSION['id'])) { ?>
        <li class="active"><a href="?page=tools"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Tools<span class="sr-only"></span></a></li>
        <?php if ($_SESSION['admin'] > 0) { ?>
        <li class="active"><a href="?page=admin"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Admin<span class="sr-only"></span></a></li>
        <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="?page=logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
        </ul>
        <?php } ?>
    </div>

</div>
<br><br>






<?php


if (!empty($_GET['page']) && is_file('view/'.$_GET['page'].'.php')){
    include 'model/'.$_GET['page'].'.php';
    include 'view/'.$_GET['page'].'.php';
}else{
    include 'model/home.php';
    include 'view/home.php';
}


?>
</body>
</html>
