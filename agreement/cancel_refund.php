<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/cancel_refund.html")) {
            echo "<script>location.href='./".$lang."/cancel_refund.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/cancel_refund.html';</script>";//기본값 세팅=>한국어
          }
?>

