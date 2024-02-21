#!/bin/

# pingコマンドを実行する
ping -c 2 182.236.10.243 > null

# ステータスコードを取得する
status=$?

# 結果を出力する
echo ${status}
