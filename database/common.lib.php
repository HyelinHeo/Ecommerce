<?php 

/*************************************************************************
**
**  SQL 관련 함수 모음
**
*************************************************************************/

// DB 연결
function sql_connect($host, $user, $pass)
{
    global $g4;
		global $g_dbconn;

    $conn = null;
		
		if( $g_dbconn != null ) {
			/* check if server is alive */
			if ($g_dbconn->ping()) {
				$conn = $g_dbconn;
			} else {
				$g_dbconn = null;
			}
		}

		if( $g_dbconn == null ) {
	    $conn =  mysqli_connect($host, $user, $pass);
	    
	    if (mysqli_connect_errno())
	  	{
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  	}
		}

		return $conn;		
}

function save_sql_connect($connection)
{
		global $g_dbconn;
		
		if( $g_dbconn  == null ) {
			$g_dbconn = $connection;
		} else {
			if( $connection != $g_dbconn ) {
				$g_dbconn = $connection;
			}
		}
}

function get_sql_connect()
{
		global $g_dbconn;
		
		return $g_dbconn;
}

// DB 선택
function sql_select_db($db)
{
    global $g4;

    if (strtolower($g4['charset']) == 'utf-8') mysqli_query(get_sql_connect(), " set names utf8 ");
    else if (strtolower($g4['charset']) == 'euc-kr') mysqli_query(get_sql_connect(), " set names euckr ");
    return mysqli_select_db(get_sql_connect(), $db);
}


// mysql_query 와 mysql_error 를 한꺼번에 처리
function sql_query($sql, $error=TRUE)
{
    if ($error)
        $result = mysqli_query(get_sql_connect(), $sql); //or die("<br>Query : ".$sql."<br>Error No : " . mysqli_errno(get_sql_connect()) . "  " .  mysqli_error(get_sql_connect()) . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = mysqli_query(get_sql_connect(), $sql);
    return $result;
}

function sql_procedure($sql, $error=TRUE) {
    if ($error)
        $result = mysqli_multi_query(get_sql_connect(), $sql); //or die("<br>Query : ".$sql."<br>Error No : " . mysqli_errno(get_sql_connect()) . "  " .  mysqli_error(get_sql_connect()) . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = mysqli_multi_query(get_sql_connect(), $sql);
    return $result;
}


// 쿼리를 실행한 후 결과값에서 한행을 얻는다.
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    //$row = @sql_fetch_array($result) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    $row = sql_fetch_array($result);
    return $row;
}


// 결과값에서 한행 연관배열(이름으로)로 얻는다.
function sql_fetch_array($result)
{
		$row = null;
		
		if( $result != null ) 
	    $row = mysqli_fetch_assoc($result);
	    
    return $row;
}

function real_escape_string($string)
{
		$ret = "";
		
		if( $string != null ) 
	    $ret = mysqli_real_escape_string(get_sql_connect(), $string);
	    
    return $ret;
}

function insert_id()
{
    return mysqli_insert_id(get_sql_connect());
}

// $result에 대한 메모리(memory)에 있는 내용을 모두 제거한다.
// sql_free_result()는 결과로부터 얻은 질의 값이 커서 많은 메모리를 사용할 염려가 있을 때 사용된다.
// 단, 결과 값은 스크립트(script) 실행부가 종료되면서 메모리에서 자동적으로 지워진다.
function sql_free_result($result)
{
    return mysqli_free_result($result);
}

function sql_password($value)
{
    // mysql 4.0x 이하 버전에서는 password() 함수의 결과가 16bytes
    // $row = sql_fetch(" select password('$value') as pass ");
    $row = sql_fetch(" select SHA1('$value') as pass ");
    return $row['pass'];

}


// PHPMyAdmin 참고
function get_table_define($table, $crlf="\n")
{
    global $g4;

    // For MySQL < 3.23.20
    $schema_create .= 'CREATE TABLE ' . $table . ' (' . $crlf;

    $sql = 'SHOW FIELDS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $schema_create .= '    ' . $row['Field'] . ' ' . $row['Type'];
        if (isset($row['Default']) && $row['Default'] != '')
        {
            $schema_create .= ' DEFAULT \'' . $row['Default'] . '\'';
        }
        if ($row['Null'] != 'YES')
        {
            $schema_create .= ' NOT NULL';
        }
        if ($row['Extra'] != '')
        {
            $schema_create .= ' ' . $row['Extra'];
        }
        $schema_create     .= ',' . $crlf;
    } // end while
    sql_free_result($result);

    $schema_create = preg_replace('/,' . $crlf . '$/', '', $schema_create);

    $sql = 'SHOW KEYS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $kname    = $row['Key_name'];
        $comment  = (isset($row['Comment'])) ? $row['Comment'] : '';
        $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';

        if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) {
            $kname = "UNIQUE|$kname";
        }
        if ($comment == 'FULLTEXT') {
            $kname = 'FULLTEXT|$kname';
        }
        if (!isset($index[$kname])) {
            $index[$kname] = array();
        }
        if ($sub_part > 1) {
            $index[$kname][] = $row['Column_name'] . '(' . $sub_part . ')';
        } else {
            $index[$kname][] = $row['Column_name'];
        }
    } // end while
    sql_free_result($result);

    while (list($x, $columns) = @each($index)) {
        $schema_create     .= ',' . $crlf;
        if ($x == 'PRIMARY') {
            $schema_create .= '    PRIMARY KEY (';
        } else if (substr($x, 0, 6) == 'UNIQUE') {
            $schema_create .= '    UNIQUE ' . substr($x, 7) . ' (';
        } else if (substr($x, 0, 8) == 'FULLTEXT') {
            $schema_create .= '    FULLTEXT ' . substr($x, 9) . ' (';
        } else {
            $schema_create .= '    KEY ' . $x . ' (';
        }
        $schema_create     .= implode($columns, ', ') . ')';
    } // end while

    if (strtolower($g4['charset']) == "utf-8")
        $schema_create .= $crlf . ')';
    else
        $schema_create .= $crlf . ')';

    return $schema_create;
} // end of the 'PMA_getTableDef()' function


// 경고메세지를 경고창으로
function alert($msg='', $url='')
{
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

	//header("Content-Type: text/html; charset=$g4[charset]");
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
	echo "<script type='text/javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        goto_url($url);
    exit;
}
// 메타태그를 이용한 URL 이동
// header("location:URL") 을 대체
function goto_url($url)
{
    echo "<script type='text/javascript'> location.replace('$url'); </script>";
    exit;
}
?>