<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/prohibited_items.html")) {
            echo "<script>location.href='./".$lang."/prohibited_items.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/prohibited_items.html';</script>";//기본값 세팅=>한국어
          }
?>