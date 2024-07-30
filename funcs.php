<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
function db_conn(){
    try {
        $db_name = 'gokiko_gsmil2'; //データベース名
        $db_id = 'gokiko'; //アカウント名
        $db_pw = 'gEHLqyvs-3_v'; //パスワード：MAMPは‘root’
        $db_host = 'mysql654.db.sakura.ne.jp'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQL Error:" . $error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name) {
    header("Location: " . $file_name);
    exit();
}

// ログインチェク処理 loginCheck()
function loginCheck()
{
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
        header('Location: login.php');
        exit('login error');
    }
    
    //session_idを変更して保存しなおす　なりすまし対策
    session_regenerate_id();
    $_SESSION['chk_ssid'] = session_id();
}



?>