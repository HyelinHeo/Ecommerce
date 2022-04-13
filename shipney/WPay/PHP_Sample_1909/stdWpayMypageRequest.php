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
$param_mid				= $_POST["mid"];				// [필수] 가맹점 ID
$param_wpayUserKey		= $_POST["wpayUserKey"];		// [필수] 이니시스에서 발행한 wpayUserKey - (SEED 암호화 대상필드)
$param_cancelReturnUrl	= $_POST["cancelReturnUrl"];	// [필수] 해지처리 결과전달 URL - (URL Encoding 대상필드)

// signature 파라미터
$param_signature	= "";

// 결제요청 URL
$requestURL = $requestDomain . "/stdwpay/su/mypage";

//-------------------------------------------------------
// 2. 암호화 대상 필드 Seed 암호화  
//-------------------------------------------------------

// Seed  암호화
$param_wpayUserKey = encrypt_SEED($param_wpayUserKey, $g_SEEDKEY, $g_SEEDIV);

// URL Encoding
$param_cancelReturnUrl = urlencode($param_cancelReturnUrl);

//공통 CSS Parameter URL Encoding
$titleBarColor 			= urlencode($_POST["titleBarColor"]);
$tiltleBarBiImgUrl 		= urlencode($_POST["tiltleBarBiImgUrl"]);
$content 				= urlencode($_POST["content"]);
$authBtnColor 			= urlencode($_POST["authBtnColor"]);
$authBtnTextcolor 		= urlencode($_POST["authBtnTextcolor"]);
$clauseDetailUrl 		= urlencode($_POST["clauseDetailUrl"]);
$clausePersonInfoUrl 	= urlencode($_POST["clausePersonInfoUrl"]);
$passwdInfoText 		= urlencode($_POST["passwdInfoText"]);
$passwdReInfoText 		= urlencode($_POST["passwdReInfoText"]);
$secuKeypadPinType 		= urlencode($_POST["secuKeypadPinType"]);
$cardBenefitBtnColor 	= urlencode($_POST["cardBenefitBtnColor"]);
$cardBenefitTextColor 	= urlencode($_POST["cardBenefitTextColor"]);
$secuKeypadCardType 	= urlencode($_POST["secuKeypadCardType"]);
$cancelInfoText 		= urlencode($_POST["cancelInfoText"]);
$closeBtnType 			= urlencode($_POST["closeBtnType"]);
$closeBtnUrl 			= urlencode($_POST["closeBtnUrl"]);

//-------------------------------------------------------
// 3. 위변조 방지체크를 위한 signature 생성
//   (순서주의:연동규약서 참고)
//-------------------------------------------------------

$srcStr = "";
$srcStr = "mid=" . $param_mid;
$srcStr = $srcStr . "&wpayUserKey=" . $param_wpayUserKey;
$srcStr = $srcStr . "&cancelReturnUrl=" . $param_cancelReturnUrl;
$srcStr = $srcStr . "&hashKey=" . $g_HASHKEY;

$param_signature = hash("sha256", $srcStr);
?>

<!DOCTYPE html>
<html>
<head>
	<title>WPAY 표준  결제인증요청</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body { background-color: #efefef;}
		body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
		table, img {border:none}
	</style>
</head>


<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 >
<form id="SendPayForm_id" name="SendPayForm" method="POST" >
	
	<!-- <br/><b>mid</b> -->
	<br/><input type="hidden" name="mid" value="<?php echo $param_mid?>" >
		
	<!-- <br/><b>wpayUserKey</b> -->
	<br/><input type="hidden" name="wpayUserKey" value="<?php echo $param_wpayUserKey?>" >

	<!-- <br/><b>returnUrl</b> -->
	<br/><input type="hidden"   name="cancelReturnUrl" value="<?php echo $param_cancelReturnUrl?>" >

	<!-- <br/><b>signature</b> -->
	<br/><input type="hidden"  name="signature" value="<?php echo $param_signature?>" >
	
	<!-- CSS  -->
	<!-- <b>titleBarColor</b> : 타이틀바 색 (RGB값) -->
	<input type="hidden" name="titleBarColor" id="titleBarColor" style="width:100%" value="<?php echo $titleBarColor ?>"></font>
	<!-- CSS  -->
	<!-- <b>tiltleBarBiImgUrl</b> : 타이틀바 BI(OOPAY) 이미지 URL -->
	<input type="hidden" name="tiltleBarBiImgUrl" id="tiltleBarBiImgUrl" style="width:100%" value="<?php echo $tiltleBarBiImgUrl ?>"></font>
	<!-- <b>content</b> : 소개내용 -->
	<input type="hidden" name="content" id="content" style="width:100%" value="<?php echo $content ?>"></font>
	<!-- <b>authBtnColor</b> : 인증 버튼 색상(RGB값) -->
	<input type="hidden" name="authBtnColor" id="authBtnColor" style="width:100%" value="<?php echo $authBtnColor ?>"></font>
	<!-- <b>authBtnTextcolor</b> : 인증 버튼 TEXT 색상(RGB값) -->
	<input type="hidden" name="authBtnTextcolor" id="authBtnTextcolor" style="width:100%" value="<?php echo $authBtnTextcolor ?>"></font>
	<!-- <b>clauseDetailUrl</b> : 약관 세부 내용 페이지URL -->
	<input type="hidden" name="clauseDetailUrl" id="clauseDetailUrl" style="width:100%" value="<?php echo $clauseDetailUrl ?>"></font>
	<!-- <b>clausePersonInfoUrl</b> : 약관 개인 정보 내용 페이지URL -->
	<input type="hidden" name="clausePersonInfoUrl" id="clausePersonInfoUrl" style="width:100%" value="<?php echo $clausePersonInfoUrl ?>"></font>
	<!-- <b>passwdInfoText</b> : 비밀번호 설정 안내TEXT 내용 -->
	<input type="hidden" name="passwdInfoText" id="passwdInfoText" style="width:100%" value="<?php echo $passwdInfoText ?>"></font>
	<!-- <b>passwdReInfoTextt</b> : 비밀번호 설정 한번더 안내 TEXT 내용 -->
	<input type="hidden" name="passwdReInfoText" id="passwdReInfoText" style="width:100%" value="<?php echo $passwdReInfoText ?>"></font>
	<!-- <b>secuKeypadPinType</b> : 보안키패드(PIN) A, B, C TYPE -->
	<input type="hidden" name="secuKeypadPinType" id="secuKeypadPinType" style="width:100%" value="<?php echo $secuKeypadPinType ?>"></font>
	<!-- <b>cardBenefitBtnColor</b> : 카드혜택정보 버튼 색상(RGB값) -->
	<input type="hidden" name="cardBenefitBtnColor" id="cardBenefitBtnColor" style="width:100%" value="<?php echo $cardBenefitBtnColor ?>"></font>
	<!-- <b>cardBenefitTextColor</b> : 카드혜택정보 TEXT 색상(RGB값) -->
	<input type="hidden" name="cardBenefitTextColor" id="cardBenefitTextColor" style="width:100%" value="<?php echo $cardBenefitTextColor ?>"></font>
	<!-- <b>secuKeypadCardType</b> : 보안키패드(카드) A, B, C TYPE -->
	<input type="hidden" name="secuKeypadCardType" id="secuKeypadCardType" style="width:100%" value="<?php echo $secuKeypadCardType ?>"></font>
	<!-- <b>cancelInfoText</b> : 해지안내 TEXT -->
	<input type="hidden" name="cancelInfoText" id="cancelInfoText" style="width:100%" value="<?php echo $cancelInfoText ?>"></font>
	<!-- <b>closeBtnType</b> : 닫기버튼 A, B TYPE -->
	<input type="hidden" name="closeBtnType" id="closeBtnType" style="width:100%" value="<?php echo $closeBtnType ?>"></font>
	<!-- <b>closeBtnUrl</b> : 닫기버튼 URL -->
	<input type="hidden" name="closeBtnUrl" id="closeBtnUrl" style="width:100%" value="<?php echo $closeBtnUrl ?>"></font>
	
	<div id="lodingImg" style="position:absolute; left:45%; top:40%; dispaly:none;">
		<div class='loader'  style=""></div>
	</div>

</form>
</body>
</html>

<script language="javascript">
<!--
	goWpay();
	function goWpay() {
		var sendfrm = document.getElementById("SendPayForm_id");
		sendfrm.action = "<?php echo $requestURL?>";
		sendfrm.submit();
	}
-->
</script>
