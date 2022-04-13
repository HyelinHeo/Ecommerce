<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectionException;

use Dompdf\Helpers;

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

require_once ('KISA_SEED_CBC.php');
require_once ('INILib.php');

/**
 * Class PaymentController
 * @package App\Http\Controllers\API
 */
class PaymentAPIController extends Controller
{
    private $shipney_url = "http://www.shipney.com";
    private $shipney_ipaddress = "192.168.0.1";
    private $shpiney_store_name = "Shiptrender";

    private $payment_mid = "INIpayTest";

    private $payment_request_url = "https://mobile.inicis.com/smart/payment/";
    //private $payment_return_my_url = "http://222.108.161.27/public/api/paymentresult?api_token=";
    private $payment_return_my_url = "https://www.shipney.com/shipney/public/api/paymentresult";

    private $payment_api_key_normal = "ItEQKi3rY7uvDS8l";
    private $payment_refund_url = "https://iniapi.inicis.com/api/v1/refund";
    private $payment_receipt_url = "https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noMethod=1&noTid=";

    private $payment_wpay_mid = "INIWPAYTST";
    //private $payment_return_wpay_url = "https://www.shipney.com/shipney/public/api/wpayresult";
    private $payment_return_wpay_url = "https://www.shipney.com/shipney/WPay/PHP_Sample/stdWpayMemReturn.php";
    private $payment_wpay_requestDomain = "https://stgwpay.inicis.com";
    private $payment_wpay_mem_url = "/stdwpay/su/memreg"; // 상용계

    // 가맹점에 제공된 암호화 키(고정값)
    private $wpay_HASHKEY = "F3149950A7B6289723F325833F588INI";
    private $wpay_SEEDKEY = "FzLYqYNDjk/n+FTIGAD/ng==";
    private $wpay_SEEDIV =  "WPAYINIWPAYTST00";

    // 공통 파라미터
    private $wpay_titleBarColor 	= "#eeeeee";
    private $wpay_tiltleBarBiImgUrl = "https://wpay.inicis.com:443/stdwpay/mobile/images/common/logo_header_wpay.png";
    private $wpay_content 			= "가맹점에서 간편하게 클릭한번으로<br>구매 가능한 결제서비스 입니다.";
    private $wpay_authBtnColor 		= "#333333";
    private $wpay_authBtnTextcolor 	= "#ffffff";
    private $wpay_clauseDetailUrl 	= "https://wpay.inicis.com:443/stdwpay/common/html/agreeA1.jsp";
    private $wpay_clausePersonInfoUrl 	= "https://wpay.inicis.com:443/stdwpay/common/html/agreeA5.jsp";
    private $wpay_passwdInfoText 	= "5만원 이상 상품 구매시<br>지금 설정한 6자리 비밀번호를 입력합니다.";
    private $wpay_passwdReInfoText 	= "비밀번호 확인을 위하여<br>한번 더 입력해주세요.";
    private $wpay_secuKeypadPinType = "A";
    private $wpay_cardBenefitBtnColor 	= "#f7931e";
    private $wpay_cardBenefitTextColor 	= "#ffffff";
    private $wpay_secuKeypadCardType 	= "A";
    private $wpay_cancelInfoText 		= "WPAY 회원탈퇴이며,<BR>WPAY 회원 및 결제 정보는 삭제됩니다.<BR>(이니시스 회원 자격과는 무관합니다.)";
    private $wpay_closeBtnType 	    = "A";
    private $wpay_closeBtnUrl		= "";


    /** @var  PaymentRepository */
    private $paymentRepository;
    /** @var  UserRepository */
    private $userRepository;
    /** @var  PaymentRepository */
    private $paymentMethodRepository;

    public function __construct(PaymentRepository $paymentRepo, UserRepository $userRepo, PaymentMethodRepository $paymentMethodRepo)
    {
        $this->paymentRepository = $paymentRepo;
        $this->userRepository = $userRepo;
        $this->paymentMethodRepository = $paymentMethodRepo;
    }

    /**
     * Display a listing of the Payment.
     * GET|HEAD /payments
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->paymentRepository->pushCriteria(new RequestCriteria($request));
            $this->paymentRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $payments = $this->paymentRepository->all();

        return $this->sendResponse($payments->toArray(), 'Payments retrieved successfully');
    }

    /**
     * Display the specified Payment.
     * GET|HEAD /payments/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Payment $payment */
        if (!empty($this->paymentRepository)) {
            $payment = $this->paymentRepository->findWithoutFail($id);
        }

        if (empty($payment)) {
            return $this->sendError('Payment not found');
        }

        return $this->sendResponse($payment->toArray(), 'Payment retrieved successfully');
    }

    public function byMonth()
    {
        $payments = [];
        if (!empty($this->paymentRepository)) {
            $payments = $this->paymentRepository->orderBy("created_at",'asc')->all()->map(function ($row) {
                $row['month'] = $row['created_at']->format('M');
                return $row;
            })->groupBy('month')->map(function ($row) {
                return $row->sum('price');
            });
        }
        return $this->sendResponse([array_values($payments->toArray()),array_keys($payments->toArray())], 'Payment retrieved successfully');
    }

    private function makePaymentReturnMyUrl($api_token) 
    {
        //$return_url = $this->payment_return_my_url.$api_token;
        $return_url = $this->payment_return_my_url;

        return $return_url;
    }

    /**
     * GET|HEAD / paymentSystemInfo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentSystemInfo(Request $request)
    {
        $user = null;
        $userId = $request->get("user_id") ?? ''; 
        $orderNo = $request->get("order_no") ?? '';   // 주문번호임 아이디 아님
        $price = $request->get("price") ?? ''; 
        $goodname = $request->get("goodname"); 
        //$goodname = iconv('utf-8', 'euc-kr', $request->get("goodname"));

        if(($orderNo == null || strlen($orderNo) < 1) || 
            ($userId == null || strlen($userId) < 1) ||
            ($price == null || strlen($price) < 1)
            ) {
            return $this->sendError('Invalid Param');
        }

        try {
            $user = $this->userRepository->findWithoutFail($userId);
            if (empty($user)) {
                return $this->sendError('User not found['.$userId."]");
            }

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }
        
        
        $PaymentReqData = "<html>";
//        $PaymentReqData = "<html><meta http-equiv='Content-Type' content='text/html; charset=euc-kr'/>";
        $PaymentReqData = $PaymentReqData."<body onload='document.f.submit();'>";
        $PaymentReqData = $PaymentReqData."<form id='f' name='f' method='POST' accept-charset='euc-kr' action='".$this->payment_request_url."'>";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_INI_PAYMENT' value='CARD' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_MID' value='".$this->payment_mid."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_OID' value='".$orderNo."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_AMT' value='".$price."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_GOODS' value='".$goodname."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_UNAME' value='".$user->name."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_NEXT_URL' value='".$this->makePaymentReturnMyUrl($user->api_token)."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_HPP_METHOD' value='2' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_MOBILE' value='".$user->phone."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_EMAIL' value='".$user->email."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_MNAME' value='".$this->shpiney_store_name."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_QUOTABASE' value='1' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='P_NOTI' value='".$userId."' />";
        $PaymentReqData = $PaymentReqData."</form>";
        $PaymentReqData = $PaymentReqData."</body>";
        $PaymentReqData = $PaymentReqData."</html>";

        /*
        $PaymentReqData = "P_INI_PAYMENT=CARD";
        $PaymentReqData = $PaymentReqData."&P_MID=".$this->payment_mid;
        $PaymentReqData = $PaymentReqData."&P_OID=".$orderNo;
        $PaymentReqData = $PaymentReqData."&P_AMT=".$price;
        $PaymentReqData = $PaymentReqData."&P_GOODS=".$goodname;
        $PaymentReqData = $PaymentReqData."&_UNAME=".$user->name;
        $PaymentReqData = $PaymentReqData."&P_NEXT_URL=".$this->makePaymentReturnMyUrl($user->api_token);
        $PaymentReqData = $PaymentReqData."&P_HPP_METHOD=2";
        $PaymentReqData = $PaymentReqData."&P_MOBILE=".$user->phone;
        $PaymentReqData = $PaymentReqData."&P_EMAIL=".$user->email;
        $PaymentReqData = $PaymentReqData."&P_MNAME=".$this->shpiney_store_name;
        $PaymentReqData = $PaymentReqData."&P_NOTI=".$userId;
        */    
        $result['type'] = "web";
        $result['url'] = $this->payment_request_url;
        $result['formdata'] = $PaymentReqData;

        return $this->sendResponse($result, "paymentInfo result");
    }

    public function makeResultScript($resultcode, $paymentId, $paymentTid, $resultmsg) 
    {
        /*
        $javascript = "<script>";
        $javascript = $javascript.'window.addEventListener("flutterInAppWebViewPlatformReady", function(event){
            window.flutter_inappwebview.callHandler("paymentresult", '.$resultcode.',"'.$resultmsg.'");
        });';

        $javascript = $javascript."</script>"; 
        */

        $javascript = "<html><head><script type='text/javascript'>";
        $javascript = $javascript."function sendBak() {";
        $javascript = $javascript."paymentresult.postMessage('".$resultcode."|".$paymentId."|".$paymentTid."|".$resultmsg."');";
        $javascript = $javascript."}";
        $javascript = $javascript."</script></head>";
        $javascript = $javascript."<body onload='sendBak();'></body></html>";
        return $javascript;
    }

    public function paymentresult(Request $request)
    {
        $javascript = "";

        $resultCode = $request['P_STATUS'] ?? "248";
        $paymentId = "na";
        $paymentTid = "na";
        $resultMsg = "";

        if($resultCode == "00") {
            $billingResult = null;

            try {
                $userId = $request['P_NOTI'] ?? '';
                $payrequest['P_MID'] = $this->payment_mid;
                $payrequest['P_TID'] = $request['P_TID'] ?? '';
                $payrequest['P_REQ_URL'] = $request['P_REQ_URL'] ?? '';
    
                if($payrequest['P_TID'] != '' && $payrequest['P_REQ_URL'] != '') {
                    $billingResult = $this->doPayment($userId, $payrequest);

                    if($billingResult != null) {
                        $resultCode = $billingResult['P_STATUS'];
                        $paymentId = $billingResult['payment_id'];
                        $paymentTid = $billingResult['P_TID'];
                        $resultMsg = iconv('euc-kr', 'utf-8', $request['P_RMESG1']);
                    } else {
                        $resultCode = "2048";
                        $resultMsg = "Internal System Error (".$resultCode.")";
                    }
                } else {
                    $resultCode = "512";
                    $resultMsg = "Internal System Error (".$resultCode.")";
                }
            } catch (ValidatorException $e) {
                $resultCode = "1024";
                $resultMsg = "Internal System Error (".$resultCode.")";
            }
        } else {
            if($resultCode == "248") {
                $resultMsg = "Internal System Error (".$resultCode.")";
            } else {
                $resultMsg = iconv('euc-kr', 'utf-8', $request['P_RMESG1']);
            }
        }

        $javascript = $this->makeResultScript($resultCode, $paymentId, $paymentTid, $resultMsg);

        return $this->sendResponseRaw($javascript, 200, ['Content-Type', 'text/html;charset=utf-8']);
    }
    
    public function doPayment($userId, $request)
    {
        try{
            $client = new HttpClient([
                'headers' => [
                    'content' => "application/json", 
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=euc-kr',
                    ]
                ]);
                
            $response = $client->post($request['P_REQ_URL'], 
                array(
                    'form_params' => array(
                        'P_MID' => $request['P_MID'],
                        'P_TID' => $request['P_TID'])
                )
            );
            
            if($response->getStatusCode() == 200) {
                parse_str($response->getBody(),$billingResult );
    
                $billingResult['user_id'] = $userId;
                
                $savePaymentResult = $this->savePayment($billingResult);

                if($savePaymentResult != null) {
                    $billingResult['payment_id'] = $savePaymentResult['id'];
                }
    
                return $billingResult;
            }
        } catch(ClientException $e) {

        } catch(RequestException $e) {

        } catch(ConnectionException $e) {
        } catch(Throwable $e) {

        }

        return null;
    }
    
    public function savePayment($request) 
    {
        $payment['user_id'] = $request['user_id'] ?? '';
        $payment['orderno'] = $request['P_OID'] ?? '';

        $resultMsg = $request['P_RMESG1'] ?? '';
        if($resultMsg != '') {
            $payment['resultMsg'] = iconv('euc-kr', 'utf-8', $resultMsg);
        }

        $payment['resultCode'] = $request['P_STATUS'] ?? '';
        $payment['tid'] = $request['P_TID'] ?? '';
        $payment['payType'] = $request['P_TYPE'] ?? '';
        $payment['authDate'] = $request['P_AUTH_DT'] ?? '';
        $payment['authNum'] = $request['P_AUTH_NO'] ?? '';
        $payment['price'] = $request['P_AMT'] ?? '';

        $userName = $request['P_UNAME'] ?? '';
        if($userName != '') {
            $payment['userName'] = iconv('euc-kr', 'utf-8', $userName);
        }

        $payment['extraData'] = $request['P_NOTI'] ?? '';

        $payType = $request['P_TYPE'] ?? '';

        if($payType == "CARD") {
            $payment['cardCode1'] = $request['P_CARD_ISSUER_CODE'] ?? '';
            $payment['cardCode2'] = $request['P_FN_CD1'] ?? '';

            $cardCompName = $request['P_FN_NM'] ?? '';
            if($cardCompName != '') {
                $payment['cardCompName'] = iconv('euc-kr', 'utf-8', $cardCompName);
            }
            $payment['cardNum'] = $request['P_CARD_NUM'] ?? '';
            $payment['cardPrtc'] = $request['P_CARD_PRTC_CODE'] ?? '';
            $payment['cardCorpFlag'] = $request['CARD_CorpFlag'] ?? '';
            $payment['cardCheckFlag'] = $request['P_CARD_CHECKFLAG'] ?? '';
        }
        //$payment['allData'] = $request['P_AMT'];

        try {
            $result = $this->paymentRepository->create(
                $payment
            );

            return $result;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function savePaymentMethod($request) 
    {
        $method_token = str_random(60);
        $payment_method['user_id'] = $request['user_id'];
        $payment_method['method_token'] = $method_token;
        $payment_method['pg'] = $request['pg'];
        $payment_method['billkey'] = $request['billkey'];
        $payment_method['authkey'] = $request['authkey'];
        $payment_method['card_code'] = $request['card_code'];
        $payment_method['card_num'] = $request['card_num'];
        $payment_method['card_kind'] = $request['card_kind'];
        $payment_method['check_flag'] = $request['check_flag'];

        try {
            $result = $this->paymentMethodRepository->create(
                $payment_method
            );

            return $method_token;
        } catch (ValidatorException $e) {
            return null;
        }
    }

    
    private function makeHashDataForCancelPayment($type, $paymethod, $timestamp, $clientIp, $tid) 
    {
        $bytes = $this->payment_api_key_normal.$type.$paymethod.$timestamp.$clientIp.$this->payment_mid.$tid;

        return hash("sha512", $bytes);
    }

    private function makeHashDataForCancelPartialPayment($type, $paymethod, $timestamp, $clientIp, $tid, $price, $remain) 
    {
        $bytes = $this->payment_api_key_normal.$type.$paymethod.$timestamp.$clientIp.$this->payment_mid.$tid.$price.$remain;

        return hash("sha512", $bytes);
    }

    public function cancelPayment($canceldata, $reason)
    {
        $cancel_error = "none";
        $orderno = $canceldata['orderno'];
        $type = $canceldata['type'];

        $timestamp = date("YmdHis");

        $payment = Payment::where('orderno',$orderno)->first();

        //$payment = $this->paymentRepository->findWithoutFail($id);
        if (empty($payment)) {
            return null;
        }

        try{
            $client = new HttpClient([
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
                    ]
                ]);
                
            $response = null;

            if($type == "all") {
                $hashData = $this->makeHashDataForCancelPayment("Refund", $payment->payType, $timestamp, $this->shipney_ipaddress, $payment->tid);
                $response = $client->post($this->payment_refund_url, 
                array(
                    'form_params' => array(
                        'type' => 'Refund',
                        'paymethod' => $payment->payType,
                        'timestamp' => $timestamp,
                        'clientIp' => $this->shipney_ipaddress,
                        'mid' => $this->payment_mid,
                        'tid' => $payment->tid,
                        'msg' => $reason,
                        'hashData' => $hashData,
                        )
                    )
                );
            } else if($type == "partial") {
                $price = $canceldata['price'] ?? '';
                $remain = $canceldata['remain'] ?? '';

                if(strlen($price) > 0 && strlen($remain) > 0) {
                    $hashData = $this->makeHashDataForCancelPartialPayment("PartialRefund", $payment->payType, $timestamp, $this->shipney_ipaddress, $payment->tid, $price, $remain);
                    $response = $client->post($this->payment_refund_url, 
                    array(
                        'form_params' => array(
                            'type' => 'PartialRefund',
                            'paymethod' => $payment->payType,
                            'timestamp' => $timestamp,
                            'clientIp' => $this->shipney_ipaddress,
                            'mid' => $this->payment_mid,
                            'tid' => $payment->tid,
                            'msg' => $reason,
                            'price' => $price,
                            'confirmPrice' => $remain,
                            'hashData' => $hashData,
                            )
                        )
                    );
                } else {
                    $cancel_error = "cancel price error";
                }
            } else {
                $cancel_error = "cancel type error";
            }

            if($response != null) {
                if($response->getStatusCode() == 200) {
                    $cancelResult = json_decode($response->getBody(), true);
    
                    $saveCancelResult = $this->saveCancelAll($payment->id, $type, $cancelResult, $cancel_error);
    
                    return $saveCancelResult;
                } else {
                    $cancel_error = "network error";
                    //return $response->getStatusCode();
                }
            }
        } catch(ClientException $e) {
            $cancel_error = "ClientException error";
        } catch(RequestException $e) {
            $cancel_error = "RequestException error";
        } catch(ConnectionException $e) {
            $cancel_error = "ConnectionException error";
        } catch(Throwable $e) {
            $cancel_error = "unknown error";
        }

        $this->saveCancelAll($payment->id, $cancelResult);

        return null;
    }
    
    public function saveCancelAll($id, $type, $request, $error) 
    {
        if($error == "none") {
            if($type == "all") {
                $cancelPayment['cancelResultCode'] = $request['resultCode'] ?? '';
                $cancelPayment['cancelResultMsg'] = $request['resultMsg'] ?? '';
                $cancelPayment['cancelDate'] = $request['cancelDate'] ?? '';
                $cancelPayment['cancelTime'] = $request['cancelTime'] ?? '';
                $cancelPayment['cancelNum'] = $request['cshrCancelNum'] ?? '';
            } else if($type == "partial") {
                $cancelPayment['prtcResultCode'] = $request['resultCode'] ?? '';
                $cancelPayment['prtcResultMsg'] = $request['resultMsg'] ?? '';
                $cancelPayment['tid'] = $request['tid'] ?? '';
                $cancelPayment['prtcTid'] = $request['prtcTid'] ?? '';
                $cancelPayment['prtcPrice'] = $request['prtcPrice'] ?? '';
                $cancelPayment['prtcRemains'] = $request['prtcRemains'] ?? '';
                $cancelPayment['prtcCnt'] = $request['prtcCnt'] ?? '';
                $cancelPayment['prtcType'] = $request['prtcType'] ?? '';
                $cancelPayment['prtcDate'] = $request['prtcDate'] ?? '';
                $cancelPayment['prtcTime'] = $request['prtcTime'] ?? '';
            }
        } else {
            $cancelPayment['cancelResultMsg'] = $error;
        }

        try {
            $result = $this->paymentRepository->update($cancelPayment, $id);

            return $result;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function paymentreceipt(Request $request)
    {
        $tid = $request['TID'] ?? "0";

        if($tid == "0") {
            return $this->sendError('receipt not found');
        }

        $result['url'] = $this->payment_receipt_url.$tid;

        return $this->sendResponse($result, "receipt result");
    }

    
    /**
     * GET|HEAD / paymentSystemInfo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function wpaySystemInfo(Request $request)
    {
        $user = null;
        $userId = $request->get("user_id") ?? ''; 
        $orderNo = $request->get("order_no") ?? '';   // 주문번호임 아이디 아님
        $price = $request->get("price") ?? ''; 
        $goodname = $request->get("goodname"); 
        //$goodname = iconv('utf-8', 'euc-kr', $request->get("goodname"));

        if(($orderNo == null || strlen($orderNo) < 1) || 
            ($userId == null || strlen($userId) < 1) ||
            ($price == null || strlen($price) < 1)
            ) {
            return $this->sendError('Invalid Param');
        }

        try {
            $user = $this->userRepository->findWithoutFail($userId);
            if (empty($user)) {
                return $this->sendError('User not found['.$userId."]");
            }

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }
        
        //-------------------------------------------------------
        // 1. 파라미터 설정
        //-------------------------------------------------------
        // 입력 파라미터
        $param_mid = $this->payment_wpay_mid;   // [필수] 가맹점 ID
        $param_userId = $user->email;//$userId;  // [필수] 가맹점 고객 ID - (SEED 암호화 대상필드)
        $param_ci	= "";		// [옵션] 가맹점 고객 CI - (SEED 암호화 대상필드)
        $param_userNm = "";  // [필수] 고객실명 - (URL Encoding 대상필드)
        $param_hNum = "";   // [옵션] 고객 휴대폰번호 - (SEED 암호화 대상필드)
        $param_hCorp = "";  // [옵션] 휴대폰 통신사 
        $param_birthDay = "";  // [필수] 고객 생년월일(yyyymmdd) - (SEED 암호화 대상필드)
        $param_socialNo2 = ""; // [옵션] 주민번호 뒤 첫자리
        $param_frnrYn = ""; // [옵션] 외국인여부(Y:외국인,N:내국인)
        $param_returnUrl = $this->payment_return_wpay_url; // [필수] 회원가입 결과전달 URL - (URL Encoding 대상필드)

        // signature 파라미터
        $param_signature = "";

        // 회원가입요청 URL
        $requestURL =$this->payment_wpay_requestDomain.$this->payment_wpay_mem_url; // 상용계
    
        //-------------------------------------------------------
        // 2. 암호화 대상 필드 Seed 암호화  
        //-------------------------------------------------------
        // Seed  암호화
        $param_userId = encrypt_SEED("12345", $this->wpay_SEEDKEY, $this->wpay_SEEDIV);
        //return $this->sendResponse($param_userId, "wpaySystemInfo result");

        $param_ci = encrypt_SEED($param_ci, $this->wpay_SEEDKEY, $this->wpay_SEEDIV);
        $param_hNum = encrypt_SEED($param_hNum, $this->wpay_SEEDKEY, $this->wpay_SEEDIV);
        $param_birthDay = encrypt_SEED($param_birthDay, $this->wpay_SEEDKEY, $this->wpay_SEEDIV);

        // URL Encoding
        $param_userNm = urlencode($param_userNm);
        $param_returnUrl = urlencode($param_returnUrl);

        //공통 CSS Parameter URL Encoding
        $titleBarColor 			= urlencode($this->wpay_titleBarColor);
        $tiltleBarBiImgUrl 		= urlencode($this->wpay_tiltleBarBiImgUrl);
        $content 				= urlencode($this->wpay_content);
        $authBtnColor 			= urlencode($this->wpay_authBtnColor);
        $authBtnTextcolor 		= urlencode($this->wpay_authBtnTextcolor);
        $clauseDetailUrl 		= urlencode($this->wpay_clauseDetailUrl);
        $clausePersonInfoUrl 	= urlencode($this->wpay_clausePersonInfoUrl);
        $passwdInfoText 		= urlencode($this->wpay_passwdInfoText);
        $passwdReInfoText 		= urlencode($this->wpay_passwdReInfoText);
        $secuKeypadPinType 		= urlencode($this->wpay_secuKeypadPinType);
        $cardBenefitBtnColor 	= urlencode($this->wpay_cardBenefitBtnColor);
        $cardBenefitTextColor 	= urlencode($this->wpay_cardBenefitTextColor);
        $secuKeypadCardType 	= urlencode($this->wpay_secuKeypadCardType);
        $cancelInfoText 		= urlencode($this->wpay_cancelInfoText);
        $closeBtnType 			= urlencode($this->wpay_closeBtnType);
        $closeBtnUrl 			= urlencode($this->wpay_closeBtnUrl);

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
        $srcStr = $srcStr . "&hashKey=" . $this->wpay_HASHKEY;

        $param_signature = hash("sha256", $srcStr);

        //$PaymentReqData = "<html>";
        $PaymentReqData = "<html><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>";
        $PaymentReqData = $PaymentReqData."<body onload='document.f.submit();'>";
        $PaymentReqData = $PaymentReqData."<form id='f' name='f' method='POST'action='".$requestURL."'>";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='mid' id='mid' value='".$param_mid."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='userId' id='userId' value='".$param_userId."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='returnUrl' id='returnUrl' value='".$param_returnUrl."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='ci' id='ci' value='".$param_ci."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='userNm' id='userNm' value='".$param_userNm."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='hNum' id='hNum' value='".$param_hNum."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='hCorp' id='hCorp' value='".$param_hCorp."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='birthDay' id='birthDay' value='".$param_birthDay."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='socialNo2' id='socialNo2' value='".$param_socialNo2."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='frnrYn' id='frnrYn' value='".$param_frnrYn."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='signature' id='signature' value='".$param_signature."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='srcStr' id='srcStr' value='".$srcStr."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='titleBarColor' id='titleBarColor' value='".$titleBarColor."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='tiltleBarBiImgUrl' id='tiltleBarBiImgUrl' value='".$tiltleBarBiImgUrl."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='content' id='content' value='".$content."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='authBtnColor' id='authBtnColor' value='".$authBtnColor."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='authBtnTextcolor' id='authBtnTextcolor' value='".$authBtnTextcolor."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='clauseDetailUrl' id='clauseDetailUrl' value='".$clauseDetailUrl."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='clausePersonInfoUrl' id='clausePersonInfoUrl' value='".$clausePersonInfoUrl."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='passwdInfoText' id='passwdInfoText' value='".$passwdInfoText."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='passwdReInfoText' id='passwdReInfoText' value='".$passwdReInfoText."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='secuKeypadPinType' id='secuKeypadPinType' value='".$secuKeypadPinType."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='cardBenefitBtnColor' id='cardBenefitBtnColor' value='".$cardBenefitBtnColor."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='cardBenefitTextColor' id='cardBenefitTextColor' value='".$cardBenefitTextColor."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='secuKeypadCardType' id='secuKeypadCardType' value='".$secuKeypadCardType."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='cancelInfoText' id='cancelInfoText' value='".$cancelInfoText."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='closeBtnType' id='closeBtnType' value='".$closeBtnType."' />";
        $PaymentReqData = $PaymentReqData."<input type='hidden' name='closeBtnUrl' id='closeBtnUrl' value='".$closeBtnUrl."' />";
        $PaymentReqData = $PaymentReqData."</form>";
        $PaymentReqData = $PaymentReqData."</body>";
        $PaymentReqData = $PaymentReqData."</html>";

	    $result['type'] = "web";
        $result['url'] = $this->payment_request_url;
        $result['formdata'] = $PaymentReqData;

        return $this->sendResponse($result, "wpaySystemInfo result");
    }

    public function wpayresult(Request $request)
    {
        $javascript = "";

        $resultCode = $request['P_STATUS'] ?? "248";
        $paymentId = "na";
        $paymentTid = "na";
        $resultMsg = "";

        if($resultCode == "00") {
            $billingResult = null;

            try {
                $userId = $request['P_NOTI'] ?? '';
                $payrequest['P_MID'] = $this->payment_mid;
                $payrequest['P_TID'] = $request['P_TID'] ?? '';
                $payrequest['P_REQ_URL'] = $request['P_REQ_URL'] ?? '';
    
                if($payrequest['P_TID'] != '' && $payrequest['P_REQ_URL'] != '') {
                    $billingResult = $this->doPayment($userId, $payrequest);

                    if($billingResult != null) {
                        $resultCode = $billingResult['P_STATUS'];
                        $paymentId = $billingResult['payment_id'];
                        $paymentTid = $billingResult['P_TID'];
                        $resultMsg = iconv('euc-kr', 'utf-8', $request['P_RMESG1']);
                    } else {
                        $resultCode = "2048";
                        $resultMsg = "Internal System Error (".$resultCode.")";
                    }
                } else {
                    $resultCode = "512";
                    $resultMsg = "Internal System Error (".$resultCode.")";
                }
            } catch (ValidatorException $e) {
                $resultCode = "1024";
                $resultMsg = "Internal System Error (".$resultCode.")";
            }
        } else {
            if($resultCode == "248") {
                $resultMsg = "Internal System Error (".$resultCode.")";
            } else {
                $resultMsg = iconv('euc-kr', 'utf-8', $request['P_RMESG1']);
            }
        }

        $javascript = $this->makeResultScript($resultCode, $paymentId, $paymentTid, $resultMsg);

        return $this->sendResponseRaw($javascript, 200, ['Content-Type', 'text/html;charset=utf-8']);
    }
    
}
