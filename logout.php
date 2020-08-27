<?php
echo "<!DOCTYPE html>\n";
echo '<html lang="ja">'."\n";
echo "<head>\n";
    echo '<meta http-equiv="Content-Type" content="text/html; charset=YTF-8">'."\n";
    echo "<title>ログイン情報</title>\n";
    echo "</head>\n";
        echo "<body>\n";
$link = pg_connect("host=localhost  dbname=ensyu user=ensyu password=min7a7akay0shi");

if (!$link) {
              print('エラーが発生しました。'.pg_last_error());
}

try {
    session_start();//セッションを開始
    if ($_SESSION['s1857202'] == true) {
        $data_date = date("Y-m-d H:i:s");
        //**********************                                                       
        //データベースへの接続開始                                                      
        //***********************/
        
        //s1857202_accessテーブルへ追加
        $sql = "INSERT INTO s1857202_access (time, name, page) VALUES ('$data_date', '".$_SESSION["name"]."', 'ログアウトページ')";
        $result_flag = pg_query($sql);
        if (!$result_flag) {
            die('INSERTクエリーが失敗しました。'.pg_last_error());
        }
        echo "<center>\n";
        echo '<table width="60%">'."\n";        
        echo "<tr>\n";
        echo "<td>\n";
        echo "<center>\n";
            echo '<h1><font size="7">秋山のログアウトページ</font></h1>'."\n";
        echo "</center>\n";
        echo "</td>\n";
        echo "</tr>\n";    
        echo "<tr>\n";
        echo "<td align=right>\n";
            echo $_SESSION['name']."さん、こんにちは。現在時刻：".date('Y/m/d H:i:s', strtotime($data_date))."\n";
        echo "</td>\n";
        echo "</tr>\n";    
            unset($_SESSION['s1857202']);//セッション変数アンセット
            unset($_SESSION['name']);//セッション変数アンセット
            session_destroy();//セッション破壊
            echo "<tr>\n";
        echo "<td align=right>\n";
            echo "<br />";
            echo '<a href= "login.php"><font size="6">ログインページに戻る</font></a>'."\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>\n";
        echo "<br />";
        echo '<a href= "page_top.php"><font size="6">テスト用リンク</font></a>'."\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "</center>\n";
    }else{
        echo "ログアウト画面表示できません";
        echo "<br />";
        echo '<a href= "login.php" >ログインページに戻る</a>'."\n";
        echo "<br />";
    }
} catch (PDOException $e) {
    print('接続失敗:' . $e->getMessage());
    die();
}
pg_close($link);

echo "</body>\n";
echo "</html>\n";
?>

