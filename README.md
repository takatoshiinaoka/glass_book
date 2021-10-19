# test_laravel

# 環境構築のやり方
まず初めにcomposerをインストールする．

[composerのインストール](https://laraweb.net/surrounding/1669/)

## clone
コマンドプロンプトで，xampp/htdocsのディレクトリを開き，以下のコマンドを実行する．

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
