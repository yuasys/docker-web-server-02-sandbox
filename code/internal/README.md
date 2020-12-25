# `internal` ディレクトリについて

## 概要
このディレクトリ以下には、直接アクセスできないようになっています。

## NGINXの設定方法

`/etc/nginx/conf.d/default.conf` には以下のように設定しています。

```
    location ~ /internal {
        internal;
    }
```
