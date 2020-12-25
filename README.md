## 概要
- これはDockerを利用したWebサーバーです
- NGINXとPHPで動いています

### 注意点
- PHPやNGINXの開発環境での学習用を想定しています
    - 動画学習サイト用のコンテンツです
- NGINXの設定やPHPファイルの変更をすぐに確認できるように、あえてローカルのファイルをmountしています

## 使い方
### ダウンロード
```
git clone https://github.com/masa0221/docker-web-server-sandbox.git
```

起動や停止は、以下でディレクトリを移動してから行ってください。
```
cd docker-web-server-sample
```

### 起動
```
docker-compose up -d
```

起動後、以下のURLにアクセスして動作を確認できます。  
http://localhost:8080

### 状態確認
```
docker-compose ps
```
StateがUpになっていたらOKです。


### コンテナの中に入って操作する
コンテナが動いているときに以下で、それぞれのコンテナの中で操作することができます。
```
docker-compose exec nginx /bin/bash
```

```
docker-compose exec php-fpm /bin/bash
```

終了するには以下を実行してください
```
exit
```


### 停止
```
docker-compose down
```

## 構成
### 構成図

```
  +-- Docker Host ---------------------+
  |                                    |
  |  +-------+       +--------------+  |
  |  | NGINX | ----> | PHP(php-fpm) |  |
  |  +-------+       +--------------+  |
  |  Port:80         Port:9000         |
  |      A                             |
  |      |                             |
  +------+-----------------------------+
Port:8080|
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
│   │   └── base.tpl.html
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

### PHP
`./code`ディレクトリ以下にPHPファイル、HTMLファイル、CSSファイルを置くと動かすことができます。  
`base.tpl.html`のように、外部からアクセスされたくないファイルは`internal`ディレクトリ以下に配置すると、直接アクセスできなくなります。  
外部に公開しないものは、`internal`以下にファイルを作成してください。  
