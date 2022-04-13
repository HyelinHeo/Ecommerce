<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/mobile.html")) {
            echo "<script>location.href='./".$lang."/mobile.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/mobile.html';</script>";//기본값 세팅=>한국어
          }
?>
