<?php

include_once("../config.php");
include_once("../common.php");
$prevPage = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shipney Chat</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <script src="../supportboard/js/min/jquery.min.js"></script>
        <link href="../styles/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background-color: #f7f7f7;">
        <?php
            global $default_lang;
            $default_lang="ko";
            global $user_id;
            global $lang;
            global $data_code;
            $user_id = (isset($_GET["id"]) && $_GET["id"]) ? $_GET["id"] : NULL;
            $lang = (isset($_GET["lang"]) && $_GET["lang"]) ? $_GET["lang"] : NULL;
            $data_code = (isset($_GET["data-code"]) && $_GET["data-code"]) ? $_GET["data-code"] : NULL;
            $email = (isset($_GET["email"]) && $_GET["email"]) ? $_GET["email"] : NULL;

            if(!isset($lang)){
                $lang=$default_lang;//default값
            }
            $lang = strtolower($lang);

            if(isset($data_code)){
                include_once("../faq/faq_container.php");
            }
            
            include_once("./chat_form.php");
        ?>
    </body>
</html>