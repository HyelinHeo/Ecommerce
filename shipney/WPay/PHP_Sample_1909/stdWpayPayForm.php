<?php
include "stdWpayConfig.php";
?>

<?php
//****************************************************************************************************
//* WPAY 표준 결제 인증 정보 입력 페이지
//*****************************************************************************************************

$oid = $g_MID . "_" . date("YmdHis"); // 가맹점 주문번호(가맹점에서 직접 설정)

?>

<!DOCTYPE html>
<html>
<head>
	<title>WPAY 표준  결제인증요청 정보입력</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body { background-color: #efefef;}
		body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
		table, img {border:none}
	</style>
</head>
<script language="javascript">

<!--
function goNext(frm)
{
	var url = "stdWpayPayRequest.php";
	
	MakeNewWindow(frm, url);
}
	
function MakeNewWindow(frm, url) {
	var IFWin;
	var OpenOption = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=750,height=650,top=100,left=400,';
	IFWin = window.open('', 'IfWindow', OpenOption);
	
	frm.action = url;
	frm.target = "IfWindow";
	frm.method = "POST";
	frm.submit();

	IFWin.focus();
}
-->
</script>

<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15
	marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0>
	<form id="SendPayForm_id" name="SendPayForm_id" method="POST">

		<div
			style="padding: 10px; background-color: #f3f3f3; width: 100%; font-size: 13px; color: #ffffff; background-color: #000000; text-align: center">
			WPAY 표준 결제인증요청 샘플</div>

		<table width="650" border="0" cellspacing="0" cellpadding="0"
			style="padding: 10px;" align="center">
			<tr>
				<td bgcolor="6095BC" align="center" style="padding: 10px">
					<table width="100%" border="0" cellspacing="0" cellpadding="0"
						bgcolor="#FFFFFF" style="padding: 20px">

						<tr>
							<td>이 페이지는 WPAY 표준 결제인증요청을 위한 예시입니다.<br /> <br /> <br /> Form에
								설정된 모든 필드의 name은 대소문자 구분하며,<br /> 이 Sample은 결제인증요청을 위해서 설정된 Form으로
								테스트 / 이해를 돕기 위해서 모두 type="text"로 설정되어 있습니다.<br /> 운영에 적용시에는 일부
								가맹점에서 필요에 의해 사용자가 변경하는 경우를 제외하고<br /> 모두 type="hidden"으로 변경하여
								사용하시기 바랍니다.<br /> <br />
							<br />
							</td>
						</tr>
						<tr>
							<td>
								<!-- 결제요청 -->
								<button type="button" onclick="goNext(this.form);return false;"
									style="padding: 10px">결제인증요청</button>
							</td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<td style="text-align: left;"><br />
										<b>***** 필 수 *****</b>
											<div
												style="border: 2px #dddddd double; padding: 10px; background-color: #f3f3f3;">

												<br />
												<b>mid</b> : 가맹점 ID <br />
												<input class="input" style="width: 100%;color:gray;" name="mid" value="<?php echo $g_MID?>" readOnly><br />

												<br />
												<b>wpayUserKey</b> : 이니시스에서 발행한 wpayUserKey <br />
												<input class="input" style="width: 100%;" name="wpayUserKey"
													value="WP000000000000000001"><br />
													
												<br />
												<b>oid</b> : 가맹점 주문번호 <br />
												<input class="input" style="width: 100%;" name="oid" value="<?php echo $oid?>"><br />

												<br />
												<b>goodsName</b> : 상품명 <br />
												<input class="input" style="width: 100%;" name="goodsName"
													value="유기농쌀 10Kg"> <br />
												<b>goodsPrice</b> : 결제금액 <br />
												<input class="input" style="width: 100%;" name="goodsPrice" value="1000"><br />

												<br />
												<b>buyerName</b> : 구매자명 <br />
												<input class="input" style="width: 100%;" name="buyerName" value="홍길동"><br />

												<br />
												<b>buyerTel</b> : 구매자연락처 <br />
												<input class="input" style="width: 100%;" name="buyerTel" 	value="01023456789"> <br />
												
												<b>returnUrl</b> : 결제처리 결과전달 URL <br />
												<input class="input" style="width: 100%;color:gray;" name="returnUrl" 
												value="http://localhost/wpay_sample_php/stdWpayPayReturn.php" readOnly><br />

											</div> <br />
										<br /> <b>***** 옵션 *****</b>
											<div
												style="border: 2px #dddddd double; padding: 10px; background-color: #f3f3f3;">
												<br />
												<b>ci</b> : 고객의 ci <br />
												<input class="input" style="width: 100%;" name="ci"value=""><br />

												<b>buyerEmail</b> : 구매자이메일 <br />
												<input class="input" style="width: 100%;" name="buyerEmail"	value="wpay_test@inicis.com"> <br />

												<br />
												<b>flagPin</b> : 핀인증 여부(Y/null:핀인증 필수, N:이니시스 판단) <br />
												<input class="input" style="width: 100%;" name="flagPin" value="Y">
											</div> <br />
										<br />
										
										<br/><br/>
										<b>*****공통 파라미터*****</b>
											<div style="border:2px #dddddd double;padding:10px;background-color:#f3f3f3;">
											
											<br/><b>titleBarColor</b> : 타이틀바 색 (RGB값)
											<br/><input type="text" class="input" name="titleBarColor" id="titleBarColor" style="width:100%" value="<?php echo $titleBarColor ?>"></font>
			
											<br/><b>tiltleBarBiImgUrl</b> : 타이틀바 BI(OOPAY) 이미지 URL
											<br/><input type="text" class="input" name="tiltleBarBiImgUrl" id="tiltleBarBiImgUrl" style="width:100%" value="<?php echo $tiltleBarBiImgUrl ?>"></font>
											
											<br/><b>content</b> : 소개내용
											<br/><input type="text" class="input"  name="content" id="content" style="width:100%" value="<?php echo $content ?>"></font>
											
											<br/><b>authBtnColor</b> : 인증 버튼 색상(RGB값)
											<br/><input type="text" class="input" name="authBtnColor" id="authBtnColor" style="width:100%" value="<?php echo $authBtnColor ?>"></font>
												
											<br/><b>authBtnTextcolor</b> : 인증 버튼 TEXT 색상(RGB값)
											<br/><input type="text" class="input" name="authBtnTextcolor" id="authBtnTextcolor" style="width:100%" value="<?php echo $authBtnTextcolor ?>"></font>
					
											<br/><b>clauseDetailUrl</b> : 약관 세부 내용 페이지URL
											<br/><input type="text" class="input" name="clauseDetailUrl" id="clauseDetailUrl" style="width:100%" value="<?php echo $clauseDetailUrl ?>"></font>
												
											<br/><b>clausePersonInfoUrl</b> : 약관 개인 정보 내용 페이지URL
											<br/><input type="text" class="input" name="clausePersonInfoUrl" id="clausePersonInfoUrl" style="width:100%" value="<?php echo $clausePersonInfoUrl ?>"></font>
										
											<br/><b>passwdInfoText</b> : 비밀번호 설정 안내TEXT 내용
											<br/><input type="text" class="input" name="passwdInfoText" id="passwdInfoText" style="width:100%" value="<?php echo $passwdInfoText ?>"></font>
											
											<br/><b>passwdReInfoTextt</b> : 비밀번호 설정 한번더 안내 TEXT 내용
											<br/><input type="text" class="input" name="passwdReInfoText" id="passwdReInfoText" style="width:100%" value="<?php echo $passwdReInfoText ?>"></font>
											
											<br/><b>secuKeypadPinType</b> : 보안키패드(PIN) A, B, C TYPE
											<br/><input type="text" class="input" name="secuKeypadPinType" id="secuKeypadPinType" style="width:100%" value="<?php echo $secuKeypadPinType ?>"></font>
												
											<br/><b>cardBenefitBtnColor</b> : 카드혜택정보 버튼 색상(RGB값)
											<br/><input type="text" class="input" name="cardBenefitBtnColor" id="cardBenefitBtnColor" style="width:100%" value="<?php echo $cardBenefitBtnColor ?>"></font>
												
											<br/><b>cardBenefitTextColor</b> : 카드혜택정보 TEXT 색상(RGB값)
											<br/><input type="text" class="input" name="cardBenefitTextColor" id="cardBenefitTextColor" style="width:100%" value="<?php echo $cardBenefitTextColor ?>"></font>
											
											<br/><b>secuKeypadCardType</b> : 보안키패드(카드) A, B, C TYPE
											<br/><input type="text" class="input" name="secuKeypadCardType" id="secuKeypadCardType" style="width:100%" value="<?php echo $secuKeypadCardType ?>"></font>
											
											<br/><b>cancelInfoText</b> : 해지안내 TEXT
											<br/><input type="text" class="input" name="cancelInfoText" id="cancelInfoText" style="width:100%" value="<?php echo $cancelInfoText ?>"></font>
											
											<br/><b>closeBtnType</b> : 닫기버튼 A, B TYPE
											<br/><input type="text" class="input" name="closeBtnType" id="closeBtnType" style="width:100%" value="<?php echo $closeBtnType ?>"></font>

											<br/><b>closeBtnUrl</b> : 닫기버튼 Url
											<br/><input type="text" class="input" name="closeBtnUrl" id="closeBtnUrl" style="width:100%" value="<?php echo $closeBtnUrl ?>"></font>
												
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
