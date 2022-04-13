<?php 
include_once("../common.php");
$type = (isset($_GET["type"]) && $_GET["type"]) ? $_GET["type"] : 'shipping';
$lang = (isset($_GET["lang"]) && $_GET["lang"]) ? $_GET["lang"] : 'en';
if(strtolower($lang) == "ko"){
	$lang = "ko";
}else{
	$lang = "en";
}

$sql = "SELECT *
		FROM `common_shipping_info`
        WHERE type = '$type' and language = '$lang' AND active = '1';";

$shipping_info = sql_fetch($sql);

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title>Common Shipping Info</title>
    <link type="text/css" rel="stylesheet" href="css/common.css">
    <link type="text/css" rel="stylesheet" href="css/pop.css">
    <link type="text/css" rel="stylesheet" href="css/template.css">
    <script type="text/JavaScript" src="https://code.jquery.com/jquery-1.7.min.js"></script>
</head>

<body style="margin:4px;">
    <?=$shipping_info['content']?>
</body>