<?php
echo "<!DOCTYPE html>\n";
echo '<html lang="ja">'."\n";
echo "<head>\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset=YTF-8">'."\n";
echo "<title>アクセス一覧ページ</title>\n";
echo "</head>\n";
echo "<body>\n";

$link = pg_connect("host=localhost  dbname=ensyu user=ensyu password=min7a7akay0shi");

if (!$link) {
    print('エラーが発生しました。'.pg_last_error());
}

session_start();//セッションを開始
if($_SESSION['s1857202'] == true){//認証済みであった場合
    try {
        $data_date = date("Y-m-d H:i:s");//現在時刻を$data_dateに代入
        //***********************                                                           
        //データベースへの接続開始                                                          
        //***********************
        
        //　s1857202_accessテーブルへ追加
        $sql = "INSERT INTO s1857202_access (time, name, page) VALUES ('$data_date', '".$_SESSION["name"]."', 'アクセス一覧ページ')";
        $result_flag = pg_query($sql);
        
        if (!$result_flag) {
            die('INSERTクエリーが失敗しました。'.pg_last_error());
        }
        echo "<center>\n";
        echo '<table width="60%">'."\n";
        echo "<tr>\n";
        echo "<td>\n";
        echo "<center>\n";
            echo '<h1><font size="7">秋山のアクセス一覧ページ</font></h1>'."\n";
        echo "</center>\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>\n";
            echo $_SESSION['name']."さん、こんにちは。現在時刻:".date('Y/m/d H:i:s', strtotime($data_date))."\n";
        echo "</td>\n";
        echo "</tr>\n";
        
            //　s1857202_accessテーブルから取得
            $name = pg_query('SELECT * FROM s1857202_access');
            if (!$name) {
                die('クエリーが失敗しました。'.pg_last_error());
            }
            echo "<tr>\n";
            echo "<td>\n";
            echo "<center>\n";
                echo '<table border="1" width="100%">'."\n";
                    echo "<tr>";
                        echo "<th><u>日時</u></th>\n";
                        echo "<th><u>ユーザ名</u></th>\n";
                    echo "<th><u>ページ</u></th>\n";
                    echo "</tr>\n";
                
                for($i=0;$i < pg_num_rows($name);$i++){
            
                    $rows2 = pg_fetch_array($name, NULL, PGSQL_ASSOC);
                    echo "<tr>\n";            
                    echo "<td noWrap align=center>".date('Y/m/d', strtotime($rows2['time']));
                    echo "<br />";
                    echo date('H:i:s', strtotime($rows2['time']))."</td>\n";
                        if($rows2['name'] == ""){
                            echo "<td align=center>不明</td>\n";
                        }else{
                        echo "<td align=center>".$rows2['name']."</td>\n";
                        }
                        echo "<td align=center>".$rows2['page']."</td>\n";
                    echo "</tr>\n";
                }
                
                echo "</table>\n";
            echo "</center>\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
                //リンク
                echo '<a href= "page_top.php" ><font size="6">トップページに戻る</font></a>'."\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td align=right>\n";
                //ログアウトボタン                                                                     
                echo '<a href="logout.php"><button type="button" style="width:100px;height:50px">ログアウト</button>'."\n";    
            echo "</td>\n";
            echo "</tr>\n";
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
    