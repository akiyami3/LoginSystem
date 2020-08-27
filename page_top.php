<?php
echo "<!DOCTYPE html>\n";
echo '<html lang="ja">'."\n";
echo "<head>\n";
    echo '<meta http-equiv="Content-Type" content="text/html; charset=YTF-8">'."\n";
    echo "<title>トップページ</title>\n";
    echo "</head>\n";
        echo "<body>\n";
$link = pg_connect("host=localhost  dbname=ensyu user=ensyu password=min7a7akay0shi");

if (!$link) {
              print('エラーが発生しました。'.pg_last_error());
}

try {
    session_start();//セッションを開始
    $data_date = date("Y-m-d H:i:s");
    /**********************
    データベースへの接続開始
    ***********************/
//s1857202テーブルから取得
    $name = pg_query('SELECT * FROM s1857202');

    session_start();//セッションを開始

    for($i=0;$i < pg_num_rows($name);$i++){
        $rows = pg_fetch_array($name, NULL, PGSQL_ASSOC);
        if(($rows['name'] == $_POST['v1'] && $rows['passwd'] == $_POST['v2'] or $_SESSION['s1857202'] == true)){//IDとパスワードが一致 or 認証済みの場合
            $_SESSION['name'] = $rows['name'];//セッション変数セット
            if($_SESSION['s1857202'] !== true){//認証済み の場合
                //　s1857202_accessテーブルへ追追加                                                                                                                                                       
                $sql = "INSERT INTO s1857202_access (time, name, page) VALUES ('$data_date', '".$_SESSION["name"]."', 'ログインページ')";
                $result_flag = pg_query($sql);
                if (!$result_flag) {
                    die('INSERTクエリーが失敗しました。'.pg_last_error());
                }
                $_SESSION['s1857202'] = true;//セッション変数セット
            }
            //　s1857202_accessテーブルへ追加        
            $data_date = date("Y-m-d H:i:s");
            $sql = "INSERT INTO s1857202_access (time, name, page) VALUES ('$data_date', '".$_SESSION["name"]."', 'トップページ')";
            $result_flag = pg_query($sql);
            if (!$result_flag) {
                die('INSERTクエリーが失敗しました。'.pg_last_error());
            }
            
            echo "<center>\n";
            echo '<table width="60%">'."\n";
            echo "<tr>\n";
            echo "<td>\n";
                echo "<center>\n";
                echo '<h1><font size="7">秋山のトップページ</font></h1>'."\n";
                echo "</center>\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
                echo $_SESSION['name']."さん、こんにちは。現在時刻:".date('Y/m/d H:i:s', strtotime($data_date))."\n";
                /*echo "<br />";
                    echo "<br />";
                echo "<br />";*/
            echo "</td>\n";
            echo "</tr>\n";    
            echo "<tr>\n";
            echo "<td align=right>\n";
                echo "<br />";
                echo '<a href="access.php"><font size="6">このページにアクセスした人一覧</font></a>'."\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td>\n";/*
                            echo "<br />";*/
                echo "<br />";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
            echo '<a href="access.php"><font size="6">このページにアクセスした人一覧</font></a>'."\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td>\n";/*
                            echo "<br />";*/
                echo "<br />";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
                echo '<a href="other_members.php"><font size="6">他のメンバーのページ一覧</font></a>'."\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
            //                echo "<br />";
                echo "<br />";
                echo "<br />";
                echo '<a href="logout.php"><button type="button" style="width:100px;height:50px">ログアウト</button>'."\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "</table>\n";
            break;
            echo "</center>\n";
        }
        
        if($i == 6){//認証失敗の場合
            //　s1857202_accessテーブルへ追追加                                                                                                                                                            
            $sql = "INSERT INTO s1857202_access (time, name, page) VALUES ('$data_date', '".$_SESSION["name"]."', 'ログインページ')";
            $result_flag = pg_query($sql);
            if (!$result_flag) {
                die('INSERTクエリーが失敗しました。'.pg_last_error());
            }
            echo "ログイン失敗です。\n";
            echo "<br />";
            echo '<a href= "login.php" >ログインページに戻る</a>'."\n";
            echo "<br />";
        }
    }
    if (!$name) {
        die('クエリーが失敗しました。'.pg_last_error());
    }
    
}catch (PDOException $e) {
    print('接続失敗:' . $e->getMessage());
    die();
  }
pg_close($link);

echo "</body>\n";
echo "</html>\n";
?>