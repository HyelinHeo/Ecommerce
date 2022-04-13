<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/volume.html")) {
            echo "<script>location.href='./".$lang."/volume.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/volume.html';</script>";//기본값 세팅=>한국어
          }
?>