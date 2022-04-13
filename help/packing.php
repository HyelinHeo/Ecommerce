<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/packing.html")) {
            echo "<script>location.href='./".$lang."/packing.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/packing.html';</script>";//기본값 세팅=>한국어
          }
?>