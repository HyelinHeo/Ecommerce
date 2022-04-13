<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/privacy_policy.html")) {
            echo "<script>location.href='./".$lang."/privacy_policy.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/privacy_policy.html';</script>";//기본값 세팅=>한국어
          }
?>

