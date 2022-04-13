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
$param_mid = $_POST["mid"];   // [필수] 가맹점 ID
$param_userId = $_POST["userId"];  // [필수] 가맹점 고객 ID - (SEED 암호화 대상필드)
$param_ci	= $_POST["ci"];		// [옵션] 가맹점 고객 CI - (SEED 암호화 대상필드)
$param_userNm = $_POST["userNm"];  // [필수] 고객실명 - (URL Encoding 대상필드)
$param_hNum = $_POST["hNum"];   // [옵션] 고객 휴대폰번호 - (SEED 암호화 대상필드)
$param_hCorp = $_POST["hCorp"];  // [옵션] 휴대폰 통신사 
$param_birthDay = $_POST["birthDay"];  // [필수] 고객 생년월일(yyyymmdd) - (SEED 암호화 대상필드)
$param_socialNo2 = $_POST["socialNo2"]; // [옵션] 주민번호 뒤 첫자리
$param_frnrYn = $_POST["frnrYn"]; // [옵션] 외국인여부(Y:외국인,N:내국인)
$param_returnUrl = $_POST["returnUrl"]; // [필수] 회원가입 결과전달 URL - (URL Encoding 대상필드)

// signature 파라미터
$param_signature = "";

// 회원가입요청 URL
$requestURL = $requestDomain . "/stdwpay/su/memreg"; // 상용계
//-------------------------------------------------------
// 2. 암호화 대상 필드 Seed 암호화  
//-------------------------------------------------------
// Seed  암호화
$param_userId = encrypt_SEED($param_userId, $g_SEEDKEY, $g_SEEDIV);
$param_ci = encrypt_SEED($param_ci, $g_SEEDKEY, $g_SEEDIV);
$param_hNum = encrypt_SEED($param_hNum, $g_SEEDKEY, $g_SEEDIV);
$param_birthDay = encrypt_SEED($param_birthDay, $g_SEEDKEY, $g_SEEDIV);

// URL Encoding
$param_userNm = urlencode($param_userNm);
$param_returnUrl = urlencode($param_returnUrl);

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
$srcStr = $srcStr . "&userId=" . $param_userId;
$srcStr = $srcStr . "&ci=" . $param_ci;
$srcStr = $srcStr . "&userNm=" . $param_userNm;
$srcStr = $srcStr . "&hNum=" . $param_hNum;
$srcStr = $srcStr . "&hCorp=" . $param_hCorp;
$srcStr = $srcStr . "&birthDay=" . $param_birthDay;
$srcStr = $srcStr . "&socialNo2=" . $param_socialNo2;
$srcStr = $srcStr . "&frnrYn=" . $param_frnrYn;
$srcStr = $srcStr . "&returnUrl=" . $param_returnUrl;
$srcStr = $srcStr . "&hashKey=" . $g_HASHKEY;

$param_signature = hash("sha256", $srcStr);
?>

<!DOCTYPE html>
<html>
<head>
	<title>WPAY 표준  회원가입 요청</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body { background-color: #efefef;}
		body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
		table, img {border:none}
	</style>
</head>


<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 >
<form id="SendMemregForm_id" name="SendMemregForm" method="POST" >
	<!-- <br/><b>mid</b> : 가맹점 ID -->
	<input  type="hidden" name="mid" id="mid" value="<?php echo $g_MID ?>"  />	
	<!-- <br/><b>userId</b> : 가맹점 고객 ID -->
	<input  type="hidden" name="userId" id="userId" value="<?php echo $param_userId ?>" />
	<!-- <br/><b>returnUrl</b> : 회원가입 결과전달 URL -->
	<input  type="hidden" name="returnUrl" id="returnUrl" value="<?php echo $param_returnUrl ?>"  />
	<!-- <br/><b>ci</b> : 고객의 CI -->
	<input  type="hidden" name="ci" id="ci"  value="<?php echo $param_ci ?>" >
	<!-- <br/><b>userNm</b> : 고객실명 -->
	<input  type="hidden" name="userNm" id="userNm" value="<?php echo $param_userNm ?>" >
	<!-- <br/><b>hNum</b> : 고객 휴대폰번호 -->
	<input  type="hidden" name="hNum" id="hNum" value="<?php echo $param_hNum ?>" >
	<!-- <br/><b>hCorp</b> : 휴대폰 통신사('SKT', 'KTF', 'LGT', 'SKR':SKT알뜰폰, 'LGR':LGT알뜰폰, 'KTR':KT알뜰폰) -->
	<input  type="hidden" name="hCorp" id="hCorp" value="<?php echo $param_hCorp ?>" >
	<!-- <br/><b>birthDay</b> : 고객 생년월일(yyyymmdd) -->
	<input  type="hidden" name="birthDay" id="birthDay" value="<?php echo $param_birthDay ?>" >
	<!-- <br/><b>socialNo2</b> : 주민번호 뒤 첫자리 -->
	<input  type="hidden" name="socialNo2" id="socialNo2" value="<?php echo $param_socialNo2 ?>" >
	<!-- <br/><b>frnrYn</b> : 외국인여부(Y:외국인,N:내국인) -->
	<input  type="hidden" name="frnrYn" id="frnrYn" value="<?php echo $param_frnrYn ?>" >
	<!-- <br/><b>signature</b> : HashValue -->
	<input  type="hidden" name="signature" id="signature" value="<?php echo $param_signature ?>" >
	<input  type="hidden" name="srcStr" id="srcStr" value="<?php echo $srcStr ?>" >
	
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



<script>
	goWpay();
	function goWpay() {
		var sendfrm = document.getElementById("SendMemregForm_id");
		sendfrm.action = "<?php echo $requestURL ?>";
		sendfrm.submit();
	}
</script>