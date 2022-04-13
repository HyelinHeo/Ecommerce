<?php
include_once("../common.php");
$index = (isset($_GET["id"]) && $_GET["id"]) ? $_GET["id"] : NULL;
$sql = "SELECT * FROM `notice`
        WHERE id='$index';";
$notice = sql_fetch($sql);
$sql = "SELECT COUNT(*) FROM `notice`
        WHERE id='$index';";
$count = sql_fetch($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<title>공지사항</title>
<link rel="stylesheet" type="text/css" href="css/style.css">	

</head>

<body>
	
<header>
    <?php 
    if($count['COUNT(*)'] == 0)
    {
        echo '<div class="title" id="title">No data available in table.</div>';
    }else{   
    ?>
	<div class="title" id="title"><?= $notice['title'] ?></div>
	<div class="small"><?= $notice['updated_at'] ?></div>
    <?php 
    }
    ?>
</header>
	
<div class="substance">
	<!-- <img src="../home/assets/img/team/1.jpg">
	<img src="../home/assets/img/support/china.png"> -->
	<p><?= $notice['content'] ?></p>
</div>
<div class="gotop"><a href="#title"><img src="img/go_top.png"></a></div>
</body>
</html>
