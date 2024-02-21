<?php 

//外部コマンドを実行させてみる 例１
echo '<b>外部コマンド実行例01</b><br/>';
exec('ls', $out);
foreach ($out as $value) {
  # code...
  print($value);
  print("<br/>");
}

// 外部コマンド実行　例2
echo '<b>外部コマンド実行例02</b><br/>';
# pingコマンドを実行する
$output = exec("ping -c 1 182.236.10.243");

# ステータスコードを取得する
$status_code = substr($output, 0, 1);

# 結果を出力する
echo "ステータスコード：{$status_code}";