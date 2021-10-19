# test_laravel

## 環境構築のやり方

### clone
コマンドプロンプトで，xampp/htdocsのディレクトリを開き，以下のコマンドを実行する．

    git clone 

### Composer インストールをインストール
プロジェクトに移動

    cd projectName
    
ライブラリインストール

    composer install
    
.envファイルを作成(.env.exampleをcopy)

    copy .env.example .env 
    
アプリケーションキー(APP_KEY)を設定する

    php artisan key:generate

## xamppを立ち上げて表示する

[http://localhost/](http://localhost/)
