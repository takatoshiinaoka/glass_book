# test_laravel

# 環境構築のやり方
まず初めにcomposerをインストールする．

**Linux（レンタルサーバー）にComposerを入れる**はやらなくて大丈夫です．

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
