<?php

// include_once("../supportboard/include/functions.php");
// include_once("../supportboard/custom/functions.php");
$prevPage = $_SERVER['HTTP_REFERER'];
$id=$_GET["id"];
$user_id=$_GET["user_id"];
// $department_id=$_GET["d_id"];
$lang=$_GET["lang"];
$email=$_GET["email"];
$email=urldecode($email);
$group=$_GET["group"];
$name=explode("@", $email);
$name=$name[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shipney Chat</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link href="../styles/main.css" rel="stylesheet" type="text/css" />
        <!-- <script src="../supportboard/js/min/jquery.min.js"></script>
        <script id="sbinit" src="../supportboard/js/main.js"></script> -->
        <script>

            window.GitpleConfig = {
            appCode: '6rL6ohW5svQquHnO2PmKgrF12A3ur3', // 워크스페이스 `설정 > 브랜드별 설정 > 연동` 메뉴에서 앱코드 복사
            userLang: '<?=$lang?>'
            };

            !function(){function e(){function e(){var e=t.contentDocument,a=e.createElement("script");a.type="text/javascript",a.async=!0,a.src=window[n]&&window[n].url?window[n].url+"/inapp-web/gitple-loader.js":"https://app.gitple.io/inapp-web/gitple-loader.js",a.charset="UTF-8",e.head&&e.head.appendChild(a)}var t=document.getElementById(a);t||((t=document.createElement("iframe")).id=a,t.style.display="none",t.style.width="0",t.style.height="0",t.addEventListener?t.addEventListener("load",e,!1):t.attachEvent?t.attachEvent("onload",e):t.onload=e,document.body.appendChild(t))}var t=window,n="GitpleConfig",a="gitple-loader-frame";if(!window.Gitple){document;var i=function(){i.ex&&i.ex(arguments)};i.q=[],i.ex=function(e){i.processApi?i.processApi.apply(void 0,e):i.q&&i.q.push(e)},window.Gitple=i,t.attachEvent?t.attachEvent("onload",e):t.addEventListener("load",e,!1)}}();
            Gitple('boot', {
                    id: '<?=$user_id?>', // [필수] 상담고객 식별 ID
                    name: '<?=$name?>',
                    email: '<?=$email?>',
                    group: '<?=$group?>',
                    userFields: { 
                        language: '<?=$lang?>'
                    }
                });
        </script>
    </head>
    <body>

    <?php
    echo("<script language='javascript'>Gitple('open');</script>");
    // $user_key=$_GET["u_id"];
    // $department_id=$_GET["d_id"];
    // $lang=$_GET["lang"];
    // global $user_id;
    // $first_name="ShipneyUser";
    // $last_name='#' . rand(0, 99999);
    // if(isset($user_key)){
    //     $result=sb_search_user_key($user_key);
    //     if(count($result)>0){
    //         for ($i=0; $i<count($result); $i++) {
    //             $result = $result[$i];
    //             if(sb_login('','',$result["id"],$result["token"])){
    //                 echo '<script>console.log("logged in! '.$result["first_name"].' , '.$result["last_name"].'");</script>';
    //             }
    //         }
    //     }
    //     else{
    //         $settings=[ "profile_image" => "", "first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => "", "user_type" => "user", "department" => "" ];
    //         $settings_extra=[ "phone"=> [ $phone, "Phone"], "shipney_user_key"=> [ $user_key, "Shipney User Key"], "browser_language"=> [ $lang, "Language"]];
    //         sb_add_user_and_login($settings,$settings_extra);
    //     }
    // }
    // else{
    //     $settings=[ "profile_image" => "", "first_name" => "", "last_name" => "", "email" => "", "password" => "", "user_type" => "", "department" => "" ];
    //     sb_add_user_and_login($settings,[]);
    // }
    // $current_user = sb_get_active_user();
    // $user_id = $current_user['id'];

    // echo '<input type="hidden" name="user_id" id="user_id" value="'.$user_id.'">';
    // echo '<input type="hidden" name="department_id" id="department_id" value="'.$department_id.'">';
    ?>
    </body>
</html>