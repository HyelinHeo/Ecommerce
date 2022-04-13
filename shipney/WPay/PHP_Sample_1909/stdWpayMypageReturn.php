<?php
include "stdWpayConfig.php";
require_once ('./libs/KISA_SEED_CBC.php');
require_once ('./libs/INILib.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>WPAY 표준  해지결과</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body { background-color: #efefef;}
		body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
		table, img {border:none}
	</style>
</head>

<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 >
	<div style="background-color:#f3f3f3;width:100%;font-size:13px;color: #ffffff;background-color: #000000;text-align: center">
		WPAY 표준 결제 결과
	</div>
<?php
//-------------------------------------------------------------
// 1. 결과 파라미터 수신
//-------------------------------------------------------------
$param_resultCode	= $_GET["resultCode"];	// 결과코드
$param_resultMsg 	= $_GET["resultMsg"];	// 결과메세지 - (URL Encoding 대상필드)
$param_wtid 		= $_GET["wtid"];		// WPAY 트랜잭션 ID(이니시스에서 생성)
$param_wpayUserKey	= $_GET["wpayUserKey"];	// 이니시스에서 발행한 wpayUserKey  - (SEED 암호화 대상필드)
$param_signature 	= $_GET["signature"];	// Hash Value


//-------------------------------------------------------------
// 3. 결과 처리
//-------------------------------------------------------------
$srcStr = "";
$signature = "";

// 결과코드 성공(0000)인 경우
if(strcmp($param_resultCode, "0000") == 0){
	// signature 생성(순서주의:연동규약서 참고)
	$srcStr = "resultCode=".$param_resultCode;
	$srcStr = $srcStr . "&resultMsg=".$param_resultMsg;
	$srcStr = $srcStr . "&wtid=".$param_wtid;
	$srcStr = $srcStr . "&wpayUserKey=".$param_wpayUserKey;
	$srcStr = $srcStr . "&hashKey=".$g_HASHKEY;
	
	$signature = hash("sha256", $srcStr);
	
	if(strcmp($param_signature, $signature) != 0) {
		echo("<br/>");
		echo("#### 해지결과 signature 확인 실패 ####");
		echo("<pre>");
		echo("<br/>signature 확인 실패");
		echo("<br/>[" . $param_signature . "],[" . $signature . "]");
		echo("<br/>");
		print_r($_GET);
		echo("</pre>");
	}

	// URL Decoding 처리
	$param_resultMsg = urldecode($param_resultMsg);
	
	// Seed 복호화 처리
	$param_wpayUserKey 	= decrypt_SEED($param_wpayUserKey, $g_SEEDKEY, $g_SEEDIV);
	
	/*
	* 가맹점 DB 처리 부분
	* ......
	* ........
	* ..........
	*/
	
} else {
	// URL Decoding 처리
	$param_resultMsg = urldecode($param_resultMsg);

	echo("<br/>");
	echo("#### 해지결과 실패 ####");
	echo("<pre>");
	echo("<br/>resultCode : ".$param_resultCode);	
	echo("<br/>resultMsg : ".$param_resultMsg);	
	print_r($_GET);
	echo("</pre>");
}

?>

	<table width="520" border="0" cellspacing="0" cellpadding="0" style="padding:10px;" align="center">
		<tr>
			<td bgcolor="6095BC" align="center" style="padding:10px">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="padding:20px">

					<tr>
						<td >
							<span style="font-size:20px"><b>해지결과 파라미터 정보</b></span><br/>
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
												<br/><input  style="width:100%;" name="resultCode" value="<?php echo $param_resultCode?>" >

												<br/><b>resultMsg</b>
												<br/><input  style="width:100%;" name="resultMsg" value="<?php echo $param_resultMsg?>" >

												<br/><b>wtid</b>
												<br/><input  style="width:100%;" name="wtid" value="<?php echo $param_wtid?>" >

												<br/><b>wpayUserKey</b>
												<br/><input  style="width:100%;" name="wpayUserKey" value="<?php echo $param_wpayUserKey?>" >

												<br/><b>signature</b>
												<br/><input  style="width:100%;" name="signature" value="<?php echo $param_signature?>" >

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
</form>
</body>
</html>