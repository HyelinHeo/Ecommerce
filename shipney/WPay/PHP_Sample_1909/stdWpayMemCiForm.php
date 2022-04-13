<?php
include "stdWpayConfig.php";
?>

<?php
/****************************************************************************************************
* WPAY 표준 회원가입 정보 입력 페이지
*****************************************************************************************************/
?>

<!DOCTYPE html>
<html>
<head>
	<title>WPAY 표준 회원가입 정보입력</title>
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
	var url = "stdWpayMemCiRequest.php";
	
	MakeNewWindow(frm, url);
}
		
function MakeNewWindow(frm, url)
{
	var IFWin;
	var OpenOption = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=750,height=650,top=100,left=400,';
	IFWin = window.open('', 'IfWindow' ,OpenOption);

	frm.action = url;
	frm.target = "IfWindow";
	frm.method = "POST";
	frm.submit();

	IFWin.focus();
}
-->
</script>

<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0>
<form id="SendMemregCiForm_id" name="SendMemregForm" method="POST" >

	<div style="padding:10px;background-color:#f3f3f3;width:100%;font-size:13px;color: #ffffff;background-color: #000000;text-align: center">
		WPAY 표준 회원가입요청(Ci필수) 샘플
	</div>
	
	<table width="650" border="0" cellspacing="0" cellpadding="0" style="padding:10px;" align="center">
		<tr>
			<td bgcolor="6095BC" align="center" style="padding:10px">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="padding:20px">

					<tr>
						<td>
							이 페이지는 WPAY 표준 회원가입요청을 위한 예시입니다.<br/>
							<br/>

							<br/>
							Form에 설정된 모든 필드의 name은 대소문자 구분하며,<br/>
							이 Sample은 회원가입을 위해서 설정된 Form은 테스트 / 이해를 돕기 위해서 모두 type="text"로 설정되어 있습니다.<br/>
							운영에 적용시에는 일부 가맹점에서 필요에 의해 사용자가 변경하는 경우를 제외하고<br/>
							모두 type="hidden"으로 변경하여 사용하시기 바랍니다.<br/>

							<br/><br/>
						</td>
					</tr>
					<tr>
						<td >
							<!-- 결제요청 -->
							<button type="button" onclick="goNext(this.form);return false;" style="padding:10px">회원가입요청</button>
						</td>
					</tr>
					<tr>
						<td>
							<table >
								<tr>
									<td style="text-align:left;">
										
											<br/><b>***** 필 수 *****</b>
											<div style="border:2px #dddddd double;padding:10px;background-color:#f3f3f3;">

												<br/><b>mid</b> : 가맹점 ID
												<br/><input  class="input" style="width:100%;color:gray;" name="mid" id="mid" value="<?php echo $g_MID?>"  readOnly>
													
												<br/><b>userId</b> : 가맹점 고객 ID
												<br/><input  class="input" style="width:100%;" name="userId" id="userId" value="userid01" >
												
												<br/><b>ci</b> : 고객의 CI
												<br/><input  class="input" style="width:100%;" name="ci" id="ci"  value="gw4x4xIjD56TjdawQ51wE7F0W8pD/j1b12345VIDzxOc4DuBmb4YwhGdynWXYXrbmhTRf37PGjcJVdJAYSOpLQ==" >
												
												<br/><b>hNum</b> : 고객 휴대폰번호
												<br/><input  class="input" style="width:100%;" name="hNum" id="hNum" value="01023456789" >

												<br/><b>birthDay</b> : 고객 생년월일(yyyymmdd)
												<br/><input  class="input" style="width:100%;" name="birthDay" id="birthDay" value="19800101" >
												
												<br/><b>socialNo2</b> : 주민번호 뒤 첫자리
												<br/><input  class="input" style="width:100%;" name="socialNo2" id="socialNo2" value="1" >
												
												<br/><b>returnUrl</b> : 회원가입 결과전달 URL
												<br/><input  class="input" style="width:100%;color:gray;" name="returnUrl" id="returnUrl" value="http://222.108.161.27/wpay/PHP_Sample_1909/stdWpayMemCiReturn.php"  readOnly>

											</div>

											<br/><br/>
											<b>***** 옵션 *****</b>
											<div style="border:2px #dddddd double;padding:10px;background-color:#f3f3f3;">
																								
												<br/><b>userNm</b> : 고객실명
												<br/><input  class="input" style="width:100%;" name="userNm" id="userNm" value="홍길동" >

												<br/><b>hCorp</b> : 휴대폰 통신사
												<br/>('SKT', 'KTF', 'LGT', 'SKR':SKT알뜰폰, 'LGR':LGT알뜰폰, 'KTR':KT알뜰폰)
												<br/>
												<select  name="hCorp" id="hCorp" style="width:100%;" onchange="">
			                                        <option value="">통신사</option>
													<option value="SKT">SKT</option>
													<option value="KTF">KT</option>
													<option value="LGT">LGT</option>
													<option value="SKR">SKT 알뜰폰</option>
													<option value="KTR">KT 알뜰폰</option>
													<option value="LGR">LGT 알뜰폰</option>
			                                    </select>

											</div>

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
											<div>
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
