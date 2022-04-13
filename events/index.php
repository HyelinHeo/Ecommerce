<?php
include_once("../common.php");
$index = (isset($_GET["id"]) && $_GET["id"]) ? $_GET["id"] : NULL;
$sql = "SELECT * FROM `events`
        WHERE id='$index';";
$event = sql_fetch($sql);
$sql = "SELECT COUNT(*) FROM `events`
        WHERE id='$index';";
$count = sql_fetch($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<title>Event</title>
<link rel="stylesheet" type="text/css" href="css/style.css">	

</head>

<body style="margin:0;">

<body>

	
<div style="width:100%;">
	<?php 
    if($count['COUNT(*)'] == 0)
    {
        echo '<div class="title" id="title">No data available in table.</div>';
    }else{ 
    ?>
	<img src="<?=$event['image']?>" style="width:100%;">
	<div style="width:90%; padding:20px 5%; font-size: 14px;">
		<p><?=$event['content']?></p>
	</div>
    <?php 
    }
    ?>
</div>
</body>
</html>
