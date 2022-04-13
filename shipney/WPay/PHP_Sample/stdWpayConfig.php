<?php

header('Content-type: text/html');

// Request Domain
$requestDomain = "https://stgwpay.inicis.com";

// 가맹점 ID(가맹점 수정후 고정)
$g_MID = "INIWPAYTST";

// 가맹점에 제공된 암호화 키(고정값)
$g_HASHKEY = "F3149950A7B6289723F325833F588INI";
$g_SEEDKEY = "FzLYqYNDjk/n+FTIGAD/ng==";
$g_SEEDIV =  "WPAYINIWPAYTST00";

// 공통 파라미터
$titleBarColor 			= "#eeeeee";
$tiltleBarBiImgUrl 		= "https://wpay.inicis.com:443/stdwpay/mobile/images/common/logo_header_wpay.png";
$content 				= "가맹점에서 간편하게 클릭한번으로<br>구매 가능한 결제서비스 입니다.";
$authBtnColor 			= "#333333";
$authBtnTextcolor 		= "#ffffff";
$clauseDetailUrl 		= "https://wpay.inicis.com:443/stdwpay/common/html/agreeA1.jsp";
$clausePersonInfoUrl 	= "https://wpay.inicis.com:443/stdwpay/common/html/agreeA5.jsp";
$passwdInfoText 		= "5만원 이상 상품 구매시<br>지금 설정한 6자리 비밀번호를 입력합니다.";
$passwdReInfoText 		= "비밀번호 확인을 위하여<br>한번 더 입력해주세요.";
$secuKeypadPinType 		= "A";
$cardBenefitBtnColor 	= "#f7931e";
$cardBenefitTextColor 	= "#ffffff";
$secuKeypadCardType 	= "A";
$cancelInfoText 		= "WPAY 회원탈퇴이며,<BR>WPAY 회원 및 결제 정보는 삭제됩니다.<BR>(이니시스 회원 자격과는 무관합니다.)";
$closeBtnType 			= "A";
$closeBtnUrl			= "";

?>