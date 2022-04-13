<?php
include "stdWpayConfig.php";
require_once ('./libs/KISA_SEED_CBC.php');
require_once ('./libs/INILib.php');
?>

<?php
//-------------------------------------------------------
// 1. 파라미터 설정
//-------------------------------------------------------

// 입력 파라미터
$param_mid			= $_POST["mid"];			// [필수] 가맹점 ID
$param_wpayUserKey	= $_POST["wpayUserKey"];	// [필수] 이니시스에서 발행한 wpayUserKey - (SEED 암호화 대상필드)
$param_ci			= $_POST["ci"];				// [필수] 가맹점 고객의 ci
$param_wtid			= $_POST["wtid"];			// [필수] 이니시스에서 발행한	WPAY 트랜잭션ID

// signature 파라미터
$param_signature	= "";

// 결제요청 URL
$requestURL = $requestDomain . "/stdwpay/apis/payreqappl";

//-------------------------------------------------------
// 2. 암호화 대상 필드 Seed 암호화  
//-------------------------------------------------------

// Seed  암호화
$param_wpayUserKey 	= encrypt_SEED($param_wpayUserKey, $g_SEEDKEY, $g_SEEDIV);
$param_ci 			= encrypt_SEED($param_ci, $g_SEEDKEY, $g_SEEDIV);

//-------------------------------------------------------
// 3. 위변조 방지체크를 위한 signature 생성
//   (순서주의:연동규약서 참고)
//-------------------------------------------------------

$srcStr = "";
$srcStr = "mid=" . $param_mid;
$srcStr = $srcStr . "&wpayUserKey=" . $param_wpayUserKey;
$srcStr = $srcStr . "&ci=" . $param_ci;
$srcStr = $srcStr . "&wtid=" . $param_wtid;
$srcStr = $srcStr . "&hashKey=" . $g_HASHKEY;


$param_signature = hash("sha256", $srcStr);

$resultCode = "";
$resultMsg = "";
$wtid = "";
$wpayUserKey = "";
$wpayToken = "";
$payMethod = "";
$bankCardCode = "";
$cardIsscoCode = "";
$bankCardNo = "";
$oid = "";
$goodsName = "";
$buyerName = "";
$buyerTel = "";
$buyerEmail = "";
$cardQuota = "";
$cardInterest = "";
$tid = "";
$applDate = "";
$applNum = "";
$applPrice = "";
$applCardNum = "";
$cardCheckFlag = "";
$partCancelCode = "";

//-------------------------------------------------------
// 4. 결제 승인요청
//-------------------------------------------------------
$sendParam = array(
"mid" => $param_mid,
"wpayUserKey" => $param_wpayUserKey,
"ci" => $param_ci,
"wtid" => $param_wtid,
"signature" => $param_signature
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $requestURL);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sendParam));

$responseData = curl_exec($ch);
if (curl_error($ch))
{
	exit('CURL Error('.curl_errno( $ch ).') '.curl_error($ch));
}
curl_close($ch);

$object = json_decode($responseData, true);

$resultCode = $object["resultCode"];
$resultMsg = urldecode($object["resultMsg"]);


if( $resultCode == "0000" ) {
	
	$wtid = $object["wtid"];
	$wpayUserKey = $object["wpayUserKey"];
	$wpayToken = $object["wpayToken"];
	$payMethod = $object["payMethod"];
	$bankCardCode = $object["bankCardCode"];
	$cardIsscoCode = $object["cardIsscoCode"];
	$bankCardNo = $object["bankCardNo"];
	$oid = $object["oid"];
	$goodsName = $object["goodsName"];
	$buyerName = $object["buyerName"];
	$buyerTel = $object["buyerTel"];
	$buyerEmail = $object["buyerEmail"];
	$cardQuota = $object["cardQuota"];
	$cardInterest = $object["cardInterest"];
	$tid = $object["tid"];
	$applDate = $object["applDate"];
	$applNum = $object["applNum"];
	$applPrice = $object["applPrice"];
	$applCardNum = $object["applCardNum"];
	$cardCheckFlag = $object["cardCheckFlag"];
	$partCancelCode = $object["partCancelCode"];
	
	/*
	* 가맹점 DB 처리 부분
	* ......
	* ........
	* ..........
	*/

} else {
	
	/*
	* 가맹점 오류 처리 부분
	* ......
	* ........
	* ..........
	*/
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>WPAY 표준  결제승인요청</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body { background-color: #efefef;}
		body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
		table, img {border:none}
	</style>
</head>

<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 >
	<div style="background-color:#f3f3f3;width:100%;font-size:13px;color: #ffffff;background-color: #000000;text-align: center">
		WPAY 표준 결제승인요청 결과
	</div>
<table width="520" border="0" cellspacing="0" cellpadding="0" style="padding:10px;" align="center">
		<tr>
			<td bgcolor="6095BC" align="center" style="padding:10px">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="padding:20px">

					<tr>
						<td >
							<span style="font-size:20px"><b>승인요청 결과 파라미터 정보</b></span><br/>
						</td>
					</tr>
					<tr >
						<td >
							<table>
								<tr>
									<td style="text-align:left;">
										
											<br/><b>************************ 결과 파라미터 ************************</b>
											<div style="border:2px #dddddd double;padding:10px;background-color:#f3f3f3;">
												
												<br/><b>resultCode</b>
												<br/><input style="width:100%;" name="resultCode" value="<?php echo $resultCode?>" >
											
												<br/><b>resultMsg</b>
												<br/><input style="width:100%;" name="resultMsg" value="<?php echo $resultMsg?>" >
											
												<br/><b>wtid</b>
												<br/><input style="width:100%;"  name="wtid" value="<?php echo $wtid?>" >
												
												<br/><b>wpayUserKey</b>
												<br/><input style="width:100%;"  name="wpayUserKey" value="<?php echo $wpayUserKey?>" >
												
												<br/><b>wpayToken</b>
												<br/><input style="width:100%;"  name="wpayToken" value="<?php echo $wpayToken?>" >
												
												<br/><b>payMethod</b>
												<br/><input style="width:100%;"  name="payMethod" value="<?php echo $payMethod?>" >
												
												<br/><b>bankCardCode</b>
												<br/><input style="width:100%;"  name="bankCardCode" value="<?php echo $bankCardCode?>" >
												
												<br/><b>cardIsscoCode</b>
												<br/><input style="width:100%;"  name="cardIsscoCode" value="<?php echo $cardIsscoCode?>" >
												
												<br/><b>bankCardNo</b>
												<br/><input style="width:100%;"  name="bankCardNo" value="<?php echo $bankCardNo?>" >
												
												<br/><b>oid</b>
												<br/><input style="width:100%;"  name="oid" value="<?php echo $oid?>" >
												
												<br/><b>goodsName</b>
												<br/><input style="width:100%;"  name="goodsName" value="<?php echo $goodsName?>" >
												
												<br/><b>buyerName</b>
												<br/><input style="width:100%;"  name="buyerName" value="<?php echo $buyerName?>" >
												
												<br/><b>buyerTel</b>
												<br/><input style="width:100%;"  name="buyerTel" value="<?php echo $buyerTel?>" >
												
												<br/><b>buyerEmail</b>
												<br/><input style="width:100%;"  name="buyerEmail" value="<?php echo $buyerEmail?>" >
												
												<br/><b>cardQuota</b>
												<br/><input style="width:100%;"  name="cardQuota" value="<?php echo $cardQuota?>" >
												
												<br/><b>cardInterest</b>
												<br/><input style="width:100%;"  name="cardInterest" value="<?php echo $cardInterest?>" >
												
												<br/><b>tid</b>
												<br/><input style="width:100%;"  name="tid" value="<?php echo $tid?>" >
												
												<br/><b>applDate</b>
												<br/><input style="width:100%;"  name="applDate" value="<?php echo $applDate?>" >
												
												<br/><b>applNum</b>
												<br/><input style="width:100%;"  name="applNum" value="<?php echo $applNum?>" >
												
												<br/><b>applPrice</b>
												<br/><input style="width:100%;"  name="applPrice" value="<?php echo $applPrice?>" >
												
												<br/><b>applCardNum</b>
												<br/><input style="width:100%;"  name="applCardNum" value="<?php echo $applCardNum?>" >
												
												<br/><b>cardCheckFlag</b>
												<br/><input style="width:100%;"  name="cardCheckFlag" value="<?php echo $cardCheckFlag?>" >
												
												<br/><b>partCancelCode</b>
												<br/><input style="width:100%;"  name="partCancelCode" value="<?php echo $partCancelCode?>" >
												
											</div>
											

									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
