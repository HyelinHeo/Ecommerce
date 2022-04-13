<?php
include_once("../common.php");
$orderno = (isset($_GET["orderno"]) && $_GET["orderno"]) ? $_GET["orderno"] : NULL;
$lang = (isset($_GET["lang"]) && $_GET["lang"]) ? $_GET["lang"] : 'EN';
if(strtoupper($lang)=="KO"){
	$lang="KO";
}else{
	$lang="EN";
}
$image_checked = "img/checked.png";
$image_checked_off = "img/checked_off.png";
$class_checked = "on";
$class_checked_off = "off";
$isCanceled = false;
$attr=array(
	"title" => "Shipney Tracking",
	"shipping_state_reg" => "Registered",
	"shipping_state_pickup_done" => "Pickuped",
    "shipping_state_shipping_warehouse_wait" => "Wait warehousing",
	"shipping_state_shipping_warehouse_in" => "Warehousing",
    "shipping_state_shipping_warehouse_out" => "Release",
    "shipping_state_shipping_departure" => "Departure",
	"shipping_state_shipping_arrival" => "Arrival",
	"shipping_state_shipping_customs" => "Customs",
	"shipping_state_shipping_customs_clear" => "customs cleared",
	"shipping_state_shipping_delivery_start" => "Start delivery",
    "shipping_state_shipping_delivery_done" => "Done",
    "cancel" => "This is a canceled order.",
);
if($lang=="KO"){
	$attr['title'] = "Shipney 배송 추적";
	$attr['shipping_state_reg'] = "접수 완료";
	$attr['shipping_state_pickup_done'] = "픽업 완료";
	$attr['shipping_state_shipping_warehouse_wait'] = "입고 대기";
	$attr['shipping_state_shipping_warehouse_in'] = "입고 완료";
	$attr['shipping_state_shipping_warehouse_out'] = "출고 완료";
	$attr['shipping_state_shipping_departure'] = "항공 출발";
	$attr['shipping_state_shipping_arrival'] = "항공 도착";
	$attr['shipping_state_shipping_customs'] = "현지 통관 진행";
	$attr['shipping_state_shipping_customs_clear'] = "현지 통관 완료";
	$attr['shipping_state_shipping_delivery_start'] = "현지 배송 시작";
	$attr['shipping_state_shipping_delivery_done'] = "배송 완료";
	$attr['cancel'] = "취소 주문입니다.";
}
$sql = "SELECT 
		TRACKING.REG as REG,
		TRACKING.PICKUP_DONE as PICKUP_DONE,
		TRACKING.WAREHOUSE_WAIT as WAREHOUSE_WAIT,
		TRACKING.WAREHOUSE_IN as WAREHOUSE_IN,
		TRACKING.WAREHOUSE_OUT as WAREHOUSE_OUT,
		TRACKING.SHIPPING_DEPATURE as SHIPPING_DEPATURE,
		TRACKING.SHIPPING_ARRIVAL as SHIPPING_ARRIVAL,
		TRACKING.SHIPPING_CUSTOMS as SHIPPING_CUSTOMS,
		TRACKING.SHIPPING_CUSTOMS_CLEAR as SHIPPING_CUSTOMS_CLEAR,
		TRACKING.SHIPPING_DELIVERY_START as SHIPPING_DELIVERY_START,
		TRACKING.SHIPPING_DELIVERY_DONE as SHIPPING_DELIVERY_DONE,
		TRACKING.cancel as cancel,
		ORDERS.post_num as postnum,
		ORDERS.address1 as address1,
		ORDERS.address2 as address2,
		ORDERS.address3 as address3,
		ORDERS.address4 as address4,
		ORDERS.order_status_id as order_status_id,
		ORDERS.receiver_name as receiver_name,
		ORDERS.receiver_phone_digit as receiver_phone_digit,
		ORDERS.receiver_phone as receiver_phone
		FROM `tracking` as TRACKING
		JOIN `orders` as ORDERS ON TRACKING.orderno = ORDERS.orderno
        WHERE TRACKING.orderno = '$orderno';";

$tracking = sql_fetch($sql);
if($tracking['cancel'] == '1' || $tracking['order_status_id'] >= 15){
	$isCanceled = true;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Shipney</title>
	
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	
<header>
<?= $attr['title']?>
</header>
<div class="wrap">
	<div class="address">
		<div class="ic_map_point"><img src="img/map_point.png"></div>
		<div class="detail">
			<ul>
				<li><?= $tracking['receiver_name'].", +".$tracking['receiver_phone_digit'].") ".$tracking['receiver_phone']?></li>
				<li><?= $tracking['address3'].", ".$tracking['address4']?></li>
				<li><?= $tracking['address1'].", ".$tracking['address2']?></li>
				<li><?= $tracking['postnum']?></li>
			</ul>
		</div>
	</div>
	<hr>
	<?php 
	if($isCanceled){
	?>
	<div class="history">
		<div class="ic_history"><img src="img/cancel.png"></div>
		<p class="title on"><?= $attr['cancel'] ?></p>
	</div>
	<?php 
		}
	?>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 0 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 0 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_reg']?></div>
		<ul class="history_detail">
			<li><?= $tracking['REG']?></li><!-- id : 0 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 2 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 2 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_pickup_done']?></div>
		<ul class="history_detail">
			<li><?= $tracking['PICKUP_DONE']?></li><!-- id : 2 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 4 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 4 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_warehouse_wait']?></div>
		<ul class="history_detail">
			<li><?= $tracking['WAREHOUSE_WAIT']?></li><!-- id : 4 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 6 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 6 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_warehouse_in']?></div>
		<ul class="history_detail">
			<li><?= $tracking['WAREHOUSE_IN']?></li><!-- id : 6 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 7 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 7 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_warehouse_out']?></div>
		<ul class="history_detail">
			<li><?= $tracking['WAREHOUSE_OUT']?></li><!-- id : 7 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 8 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 8 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_departure']?></div>
		<ul class="history_detail">
			<li><?= $tracking['SHIPPING_DEPATURE']?></li><!-- id : 8 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 9 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 9 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_arrival']?></div>
		<ul class="history_detail">
			<li><?= $tracking['SHIPPING_ARRIVAL']?></li><!-- id : 9 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 10 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 10 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_customs']?></div>
		<ul class="history_detail">
			<li><?= $tracking['SHIPPING_CUSTOMS']?></li><!-- id : 10 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 11 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 11 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_customs_clear']?></div>
		<ul class="history_detail">
			<li><?= $tracking['SHIPPING_CUSTOMS_CLEAR']?></li><!-- id : 11 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 12 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 12 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_delivery_start']?></div>
		<ul class="history_detail">
			<li><?= $tracking['SHIPPING_DELIVERY_START']?></li><!-- id : 12 -->
		</ul>
	</div>
	<div class="history">
		<div class="ic_history"><img src=<?= $tracking['order_status_id'] >= 14 && !$isCanceled ? $image_checked : $image_checked_off ?>></div>
		<div class="title <?= $tracking['order_status_id'] >= 14 && !$isCanceled ? $class_checked : $class_checked_off ?>"><?= $attr['shipping_state_shipping_delivery_done']?></div>
		<ul class="history_detail last">
			<li><?= $tracking['SHIPPING_DELIVERY_DONE']?></li><!-- id : 14 -->
		</ul>
	</div>
</div>
	
</body>
</html>
