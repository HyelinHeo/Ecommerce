<?php
//==============================================================================
// 공통
//==============================================================================
$dbconfig_file = "dbConfig.php";
$dbLib_file = "common.lib.php";
$database_path="../database/";

include_once($database_path.$dbLib_file);

if (file_exists($database_path.$dbconfig_file))
{
    if (is_dir("$g4[path]/install")) 
    	die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('install 디렉토리를 삭제하여야 정상 실행됩니다.'); </script>");

    include_once($database_path.$dbconfig_file);
    $connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
    
    if( $connect_db != null ) {
    	save_sql_connect( $connect_db);
    }
    
    $select_db = sql_select_db($mysql_db);
    if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('DB 접속 오류'); </script>");
}
else
{
    //echo "<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'>";
    //echo <<<HEREDOC
    //<script type="text/javascript">
    //alert("DB 설정 파일이 존재하지 않습니다.\\n\\n프로그램 설치 후 실행하시기 바랍니다.");
   // location.href = "../install/";
    //</script>
//HEREDOC;
    //exit;
}
//unset($my); // DB 설정값을 클리어 해줍니다.

?>