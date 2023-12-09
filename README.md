## 概要
- これはDockerを利用したローカル開発用のWebサーバーです
- WebサーバーにNGINX、バックエンドにPHP(php-fpm)が利用されています。

### 注意点
- PHPやNGINXの開発環境での学習用を想定しています
    - 動画学習サイト用のコンテンツです
- NGINXの設定やPHPファイルの変更をすぐに確認できるように、あえてローカルのファイルをmountしています  
(あえてイメージは作っていない）

## 使い方

### ダウンロード
```
git clone https://github.com/yuasys/docker-web-server-02-sandbox.git
```

起動や停止は、以下でディレクトリを移動してから行ってください。
```
cd docker-web-server-02-sandbox
```

### 起動
```
docker compose up -d
```
※注意 dockerのバージョンが古い場合は`docker-compose up -d`（ハイフンを入れる）

起動後、以下のURLにアクセスして動作を確認できます。  
http://localhost:8082

※注意 ホスト側のポートが重複しないように適宜変更すること。その場合は、先にdocker-compose.ymlのポート設定は変更して、それに合わせてブラウザで呼び出すポート番号を指定する。

```bash
vi /work/docker-web-server-02-sandbox/docker-compose.yml

(省略)

services:
  nginx:
    image: nginx:1.19.6
    ports:
      - "8082:80"    ###この行を編集する 例："8083:80"

(省略)

```

※注意 VPSなどクラウド上のDocker環境で開発している場合はlocalhostの部分を適宜読み替えてください  
      例：http://xxx.xxxxx.xxx:8082

### 状態確認

```
docker compose ps
```
StateがUpになっていたらOKです。


### コンテナの中に入って操作する

コンテナが動いているときに以下で、それぞれのコンテナの中で操作することができます。

```
docker compose exec nginx /bin/bash
```

```
docker compose exec php-fpm /bin/bash
```
※ `exec` の後に指定する `nignx` や `php-fpm` はサービス名です。 サービス名は `docker-compose ps --services` で表示できます。

終了するには以下を実行してください

```
exit
```


### 停止

```
docker compose down
```

## 構成

### 構成図

Docker Desktop for Windows/Mac の利用を想定した場合、以下の構成になります

```
  +-- Docker Desktop(VM) --------------+
  |                                    |
  |  +-------+       +--------------+  |
  |  | NGINX | ----> | PHP(php-fpm) |  |
  |  +-------+       +--------------+  |
  |   nginx:80        php:9000         |
  |      A                             |
  |      |                             |
  +------+-----------------------------+
         | localhost:8080
         |
     +--------+
     | Client |
     +--------+
```

Clientから http://localhost:8080 でアクセスするとWebページが表示されます。

### ファイル構成

```
$ tree
.
├── README.md
├── code                     // code/ 作成したプログラムファイルを配置するディレクトリです
│   ├── index.php
│   ├── internal             // code/internal/ 直接アクセスされる必要がないファイルを配置するディレクトリです
│   │   ├── README.md
│   │   └── base.tpl.php
│   └── style.css
├── containers               // conteiners/ 作成されるコンテナに配置するファイルを配置しています
│   └── nginx
│       └── etc
│           └── nginx
│               └── conf.d
│                   └── default.conf
└── docker-compose.yml
```


### NGINX

設定ファイルは、以下のファイルを削って書き直しています。  
https://github.com/nginx/nginx/blob/release-1.19.1/conf/nginx.conf  
参考にしてみてください。 

設定を変更したら以下のコマンドでコンテナを再起動してください。
```
docker-compose restart nginx
```

### PHP

`./code`ディレクトリ以下にPHPファイル、HTMLファイル、CSSファイルを置くと動かすことができます。  
`base.tpl.php`のように、外部からアクセスされたくないファイルは`internal`ディレクトリ以下に配置すると、直接アクセスできなくなります。  
外部に公開しないものは、`internal`以下にファイルを作成してください。  
