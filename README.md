# glass_book
### 開発環境
- xampp v3.3.0
- apache v2.4.48
- laravel v8.64.0
- php v8.0.10

# 環境構築のやり方
まず初めにcomposerをインストールする．

「**Linux（レンタルサーバー）にComposerを入れる**」はやらなくて大丈夫です．

[composerのインストール](https://laraweb.net/surrounding/1669/)

## clone
コマンドプロンプトを開いて以下のコマンドを入力し，htdocsフォルダを開く．
        
    cd C://xampp/htdocs
        
リポジトリをcloneする．

    git clone https://github.com/takatoshiinaoka/glass_book.git

## Composer インストールをインストール
プロジェクトに移動

    cd glass_book
    
ライブラリインストール

    composer install
    
.envファイルを作成(.env.exampleをcopy)

    copy .env.example .env 
    
アプリケーションキー(APP_KEY)を設定する

    php artisan key:generate

# xamppを立ち上げて表示する

[http://localhost/glass_book/public/](http://localhost/glass_book/public/)

# その他コマンド
### Git のコマンド

自分が作業するブランチは，(名前\_space)ブランチである．そこで作業をする時は，まず初めに，以下のコマンドを打って，メインブランチを自分のブランチにマージする．そこから作業を始めてください．

     git pull origin main
        
laravel server

     php artisan serve
  
マイグレーションを実行するとテーブルが作成される．以下のコマンドを実行する．
     
     php artisan migrate
 エラーになる場合はマイグレーションファイルの内容が間違っていることが多い．修正して以下のコマンドを実行する
 
     php artisan migrate:fresh
        
### ルーティングとコントローラの作成
コントローラとルーティングを作成する．今回のコントローラ名はTweetControllerとする．

--resourceをつけることで，よく使用する処理（代表的な CRUD 処理）を一括して作成することができる．

    php artisan make:controller TweetController --resource
    
    
    
    
