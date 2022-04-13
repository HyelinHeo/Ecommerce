<?php 
        $lang = $_GET['lang'];

        $lang = strtolower($lang);
        if (file_exists("./".$lang."/condition_carriage.html")) {
            echo "<script>location.href='./".$lang."/condition_carriage.html';</script>";
          }
          else {
            echo "<script>location.href='./kr/condition_carriage.html';</script>";//기본값 세팅=>한국어
          }
?>

