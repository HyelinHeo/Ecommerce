<?php
$start_time_str="09:00:00";
$end_time_str="18:00:00";
$now_str=date("Y-m-d H:i:s");
$now_str= new DateTime($now_str);
$now_str->setTimezone(new DateTimeZone('KST'));

// $now_str=new \DateTime($now_str, new \DateTimeZone('KST'));
$now_str=$now_str->format('H:i:s');
$start_time=strtotime($start_time_str);
$end_time=strtotime($end_time_str);
$now=strtotime($now_str);

$start_diff=($now-$start_time)/3600;
$end_diff=($now-$end_time)/3600;

$runClass="";
$onClickCommon="";
$onClickTech="";
$isOnline="";
$running_date1="";
$running_date2="";
$running_time="";
$service_name1="";
$service_name2="";
$service_desc="";
if($lang==$default_lang){
    $running_date1="월-금";
    $running_date2="주말 및 공휴일";
    $running_time="휴무";
    $service_name1="실시간 문의";
    $service_name2="이메일 문의";
    $service_desc="채팅상담 서비스";
}else{
    $running_date1="Mon-Fri";
    $running_date2="Weekends and holidays";
    $running_time="Closed";
    $service_name1="Real-time inquiries.";
    $service_name2="Email inquiry.";
    $service_desc="Chatting service.";
}
if($start_diff>=0 && $end_diff<0){
    $runClass="run";
    if($lang==$default_lang){
        $isOnline="(온라인)";
    }else{
        $isOnline="(online)";
    }
    // $onClickCommon="'../chat/chat_window.php?u_id=$user_key&d_id=1&lang=$lang'";
    // $onClickTech="'../chat/chat_window.php?u_id=$user_key&d_id=2&lang=$lang'";
    $onClickCommon="'../chat/chat_window.php?user_id=$user_id&lang=$lang&email=$email&group=common'";
    $onClickTech="'../chat/chat_window.php?user_id=$user_id&lang=$lang&email=$email&group=tech'";
}else{
    $runClass="end";
    if($lang==$default_lang){
        $isOnline="(오프라인)";
    }else{
        $isOnline="(offline)";
    }
    $onClickCommon="";
    $onClickTech="";
}
?>

<div class="container">
    <div>
        <div class="support_div">
            <h4><?=$service_name1?></h4>
            <div class="support_div_div">
                <div class='support_block'>
                    <div class="img_email"></div>
                    <p class="common"><a href="mailto:support@shipney.com?subject=<?=$service_name1?>" >support@shipney.com</a></p>
                </div>
                <div class='support_block'>
                    <div class="img_time"></div>
                    <div class="common">
                        <div class="grid_container">
                            <p class="running_date"><?=$running_date1?></p>
                            <p class="running_time">09:00-18:00</p>
                        </div>
                        <div class="grid_container">
                            <p class="running_date"><?=$running_date2?></p>
                            <p class="running_time"><?=$running_time?></p>
                        </div>
                    </div>
                    
                </div>
                <hr>
                <div class='support_block chat_btn' OnClick="location.href =<?=$onClickCommon?>" data-department-id="1">
                    <div class="img_live-chat"></div>
                    <p class="common <?= $runClass?>"><?=$service_desc.$isOnline?></p>
                </div>
            </div>
        </div>
        <div class="support_div">
            <h4><?=$service_name2?></h4>
            <div class="support_div_div">
                <div class='support_block'>
                    <div class="img_email"></div>
                    <p class="common"><a href="mailto:support@shipney.com?subject=<?=$service_name2?>" >support@shipney.com</a></p>
                </div>
                <!-- <div class='support_block'>
                    <div class="img_time"></div>
                    <div class="common">
                        <div class="grid_container">
                            <p class="running_date"><?=$running_date1?></p>
                            <p class="running_time">09:00-18:00</p>
                        </div>
                        <div class="grid_container">
                            <p class="running_date"><?=$running_date2?></p>
                            <p class="running_time"><?=$running_time?></p>
                        </div>
                    </div>
                    
                </div>
                <hr>
                <div class='support_block'>
                    <p class="common"><?=$tech_service_desc?></p>
                </div> -->
            </div>
        </div>
    </div>
</div>