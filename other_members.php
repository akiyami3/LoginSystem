<?php
echo "<!DOCTYPE html>\n";
echo '<html lang="ja">'."\n";
echo "<head>\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset=YTF-8">'."\n";
echo "<title>メンバーページ</title>\n";
echo '<style type="text/css">'."\n";//cssを適応                                           
echo "<!--\n";
echo "p {margin-left: 50%}\n";//右寄せ
echo "-->\n";
echo "</style>\n";
echo "</head>\n";
echo "<body>\n";

$link = pg_connect("host=localhost  dbname=ensyu user=ensyu password=min7a7akay0shi");

if (!$link) {
              print('エラーが発生しました。'.pg_last_error());
}

session_start();//セッションを開始
if($_SESSION['s1857202'] == true){//認証済みであった場合
    try {
        $data_date = date("Y-m-d H:i:s");
        /**********************                                                    
        データベースへの接続開始                                                       
        ***********************/
        //s1857202_accessテーブルへ追加
        $sql = "INSERT INTO s1857202_access (time, name, page) VALUES ('$data_date', '".$_SESSION["name"]."', 'メンバーサイト一覧ページ')";
        $result_flag = pg_query($sql);
        if (!$result_flag) {
            die('INSERTクエリーが失敗しました。'.pg_last_error());
        }
        echo "<center>\n";
        echo '<table width="60%">'."\n";
            echo "<tr>\n";
            echo "<td>\n";
            echo "<center>\n";
                echo '<h1><font size="7">秋山のメンバーページ</font></h1>'."\n";
            echo "</center>\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
                echo $_SESSION['name']."さん、こんにちは。現在時刻:".date('Y/m/d H:i:s', strtotime($data_date))."\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
                echo "<br />\n";
                echo '<table border="1" width="60%">'."\n";
                    echo "<tr>\n";
                    echo "<th><u>氏名</u></th>\n";
                    echo "<th><u>ユーザ名</u></th>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                    echo '<td><a href="https://atarime.cs.tohoku-gakuin.ac.jp/~itosyo/login.php">伊藤　翔太君</a></td>'."\n";
                    echo "<td>itosyo</td>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                    echo '<td><a href="https://atarime.cs.tohoku-gakuin.ac.jp/~koyamato/page_login.php" >小高　大和君</a></td>'."\n";
                    echo "<td>koyamayo</td>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                     echo '<td><a href="https://atarime.cs.tohoku-gakuin.ac.jp/~itodai/page_login.php">伊藤　大輝君</a></td>'."\n";
                     echo "<td>itodai</td>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                     echo '<td><a href="https://atarime.cs.tohoku-gakuin.ac.jp/~sasanatsu/page_login.php">佐々木　夏輝君</a></td>'."\n";
                     echo "<td>sasanatsu</td>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                     echo '<td><a href="https://atarime.cs.tohoku-gakuin.ac.jp/~nakadai/page_login.php">中川　大輔君</a></td>'."\n";
                     echo "<td>nakadai</td>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                    echo '<td><a href="https://atarime.cs.tohoku-gakuin.ac.jp/~nakatoya/page_login.php">中塚　瞳矢君</a></td>'."\n";
                    echo "<td>nakatoya</td>\n";
                echo "</tr>\n";
            echo "</table>\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>\n";            
            //リンク
        echo "<br />\n";
        echo "<br />\n";
            echo '<a href= "page_top.php" ><font size="6">トップページに戻る</font></a>'."\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>\n";
            //ログアウトボタン
            echo "<br />\n";
            echo '<a href="logout.php"><button type="button" style="width:100px;height:50px">ログアウト</button>'."\n";
        echo "</td>\n";
        echo "</tr>\n";
    echo "</table>\n";
    echo "</center>\n";
    
} catch (PDOException $e) {
    print('接続失敗:' . $e->getMessage());
    die();
}
}else{//未承認の場合
    echo "ログインしてください";
    echo "<br />";
    echo '<a href= "login.php" >ログインページに戻る</a>'."\n";
    echo "<br />";    
}
pg_close($link);

echo "</body>\n";
echo "</html>\n";
?>
