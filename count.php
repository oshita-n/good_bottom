<?php
//カウンタを記録するファイル名；write enable属性を与えておくこと
 $CounterFile = 'mycounter.txt';
 
 //カウンタ・ファイルがあるかどうか調べ、無ければ作成する
 if (! file_exists($CounterFile)) {
     $fp = @fopen($CounterFile, 'w');
     fputs($fp, '0');
    fclose($fp);
     chmod($CounterFile, 0644);
 }

 
 //直前のカウンタ値を読み込む
$fp = @fopen($CounterFile, 'r');
$cnt = fgets($fp);                                                                   
fclose($fp);

$cnt++;
 
 //カウンタ値を書き戻す
$fp = @fopen($CounterFile, 'w');
flock($fp, LOCK_EX);         //ロックをかける
$s = sprintf("%d", $cnt);
fputs($fp, $s);
flock($fp, LOCK_UN);         //ロックを解除する
fclose($fp);
header ( "Location: http://" . $_SERVER['HTTP_HOST'] . "/count/form.php" );
exit;
?>