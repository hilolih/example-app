# laravel勉強

## Mysqlコマンド

### databaseの指定

    > use example_app;

### table構造の確認

    > show columns from tweets;

## sailのインストール

git cloneした先のプロジェクトのルートで以下を実行する。

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs


## Eloquentモデル

テーブル名の指定がない場合、対応するテーブルはクラス名のスネークケースAND複数形のテーブルと
マッチする。

Tweetというクラス名のModelはtweetsというtableに対応する。

また、複合主キーには対応していない。

### テーブル名のひもづけ(P62)

    protected $table = 'tweet';

### 主キーのひもづけ(P62)

    protected $primaryKey = 'tweet_id';

### auto_increment不要(P62)

    public $auto_increment = false;

## dd(P67)

dump,dieの頭文字。その場で処理を中断して、変数の内容などを出力してくれる。

## bladeのディレクティブ(P70)

'@foreach'みたいな。公式に説明あり。


## FormRequest(P72)

artisanコマンドから作成できる。画面からリクエストされたデータをバリデーションするために使う。
authorizedメソッドはユーザー情報を判別して、リクエストを認証できるかを判定させることができる。
artisanコマンドで作成したときはreturn falseになっているので、return trueに変更する

rulesメソッドはリクエストされる値を検証する（例：'tweet' => required|max:140)。

## PUT(P85)

PUTメソッドはPOSTと同様にリソースの作成や更新を意味する。
POSTとは違い、「べき等」処理である

## 依存性の注入（Dependency Injection）(P102)

クラス内で使うインスタンスをクラス外から受け取る（注入する）こと。
= インスタンス化したオブジェクトをクラスの外側から入れる（注入する）

    public function __construct(ClassB $classB)
    {
        $this->classB = $classB;
    }


## Laravelのサービスコンテナ(P107)

1. クラスの依存関係の管理
2. 依存性の注入

コンストラクタやメソッドの引数で設定された型宣言を自動的に判断し、
それに対応するクラスをインスタンス化し、自動でそのインスタンスを注入してくれる。

### DIコンテナ（P108)

DIをするLaravelのサービスコンテナのように
コンストラクタやメソッドの引数に型宣言を記述することで、それに
対応するクラスなどを判別し、インスタンス化したオブジェクトを設定する仕組み

TweetServiceのように、処理を別のクラスに切り出していくアプローチ
→  各クラスにおいて、直接クラスに依存しない状態にすることができる。

### クラスの依存性の管理(P110)

各状況に応じたインスタンスの生成を行い、「依存性の注入」を行う

## breezeのCSSが読み込まれない(P112)

sail npm run devを行ってもCSSが読み込まれなかったが、
braveブラウザのセキュリティを切ったり、再読み込みをしているうちに正常に表示されるようになった。原因不明


## ミドルウェアの登録(P115)

app/Http/Kernel.phpに作成したミドルウェアを登録する。
アプリケーション全体に作用させたい場合はグローバルミドルウェア($middleware)として登録する。
特定のルートに対して作用させたい場合は、ルートミドルウェア($routeMiddleware)として登録する。

## ミドルウェアの用途

### コントローラーより前に処理を挟みたいケース(P116)

* メンテナンスモードのときに、すべてのアクセスをリダイレクトする
* ログインしているユーザーのみにアクセスを制限する
* 特定のIPアドレスからのみアクセスできるようにアクセスを制限する
* ユーザーからのリクエストされたデータに一律で変換を追加する

### コントローラーより後に処理を挟みたいケース(P117)

* すべてのHTTPレスポンスに必ず特定のレスポンスヘッダをつけるようにする
* すべてのHTTPレスポンスに付随するCookieを暗号化する

### コントローラーの前後に処理を挟みたいケース(P117)

* 処理の実行時間を計測してログとして出力する


## ガード(P118)

ユーザーがログインしているかどうかを制御する機能

## 例外(P120)
アプリケーションでCatchされないものはすべて、 app/Exceptions/Handler.phpでCatchする。


## tweetsテーブルにidカラムを追加（p127)

    % sail artisan make:migration add_user_id_to_tweets

## Seederにユーザーを追加

すでにあるつぶやきにuser_idを入れる必要があるため。
UserのFactoryクラスがすでにあるのは、breezeをインストールしたときに作られているっぽい。

作ったUsersSeederクラスをDatabaseSeederクラスに登録して、migrate:freshコマンドでDBを更新する。

    % sail artisan migrate:fresh --seed


## ORMの1:M表現(P133)

モデル同士を紐づけることができる $this->hasMany(Tweet::class)みたいなかんじで。
ひもづけたモデル同士は、互いを呼び出すことができる

例）Tweetしたユーザー名: $tweet->user->name

## Laravel Mix(P143) →  Viteへ

純粋なjavascriptライブラリなので、Laravel以外でも使える
Webpackを手軽に使えるようにしているライブラリ。

Laravelのver9からはデフォルトがviteに置き換わった。
手元のlaravelもver9だったので、以降、viteの説明に置き換える。

### webpack.min.js(P145)

設定は、vite.config.jsに記述されている

### ビルド

    % sail npm run build
    
    > build
    > vite build
    
    vite v3.1.8 building for production...
    ✓ 59 modules transformed.
    public/build/manifest.json             0.25 KiB
    public/build/assets/app.e5b50b80.css   22.27 KiB / gzip: 4.74 KiB
    public/build/assets/app.2896b7a8.js    129.09 KiB / gzip: 46.80 KiB

### sail npm run watch(P147)

実行しておくと、assetが変更されると自動で再ビルドがはしる。
viteの場合は、refresh: trueとなっていてすでに有効。sail npm run devを実行しておくと
同様に再ビルドが走るらしい。

### Tailwind CSS

デフォルトでインストール済み。

P148 とapp.cssの少し記載が違う。

    @tailwind base;
    @tailwind components;
    @tailwind utilities;


### キャッシュパスティング(P149)

クライアントのブラウザキャッシュを再ビルド時にクリアするしくみ。
viteでは

    @vite(['resources/css/app.css', 'resources/js/app.js'])

をbladeにセットするだけでよさそう。

## bladeのコンポーネント(P150)

### 匿名コンポーネント

resorces/views/componentsに作成したbladeファイルを呼び出すことができる

### tailwind cssのmax-w-screen-wmが有効にならない

よくわからないが、h2タグを入れたらちゃんと表示されるようになった。
その後h2タグを消しても問題なし。キャッシュと思うことにする。

    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">つぶやきアプリ</h2>
        <x-tweet.form.post></x-tweet.form.post>
    </x-layout.single>

sail npm run buildをしないと、新しいCSSは読み込まれない。その後ブラウザを読み直す必要あり。

### クラスベースコンポーネント

コンポーネント自体で特殊な処理を行いたい場合


## MailHog(P178)

sail環境にプリインストール済み。開発時は、パスワードリセット時のメールなども
http://localhost:8025にメールがとぶ(config/mail.php, .env)


## メールのスタイルをカスタマイズ(P191)

vendor:publishコマンドで、フレームワークのソースコードの一部をプロジェクトにコピーして、改変する

    $ sail artisan vendor:publish --tag=laravel-mail


## Jobの実行 (P196)

sail artisan tinkerでJobを実行すると日本語がSJISで出力されて文字化けする

### Queue

デフォルトでは"sync”が選択されているので、同期実行。
envのQUEUE_CONNECTIONをdatabaseに変更する。
キュー設定の記述があるconfig/queue.phpにはdatabaseのほかにsqsもあった。
AWSに直接jobを投げることも可能か


## ImageFactoryの$this->faker->image()が動作しない

P226のダミー画像を作成するfakerが動作しない。
https://via.placeholder.comというサイトにcurlで取得しにいくようになっていたが
サイト側（cloudfare?）の仕様変更でcurlではアクセスできなくなっていた。
imagemagickでダミー画像をつくり、ファイルコピーするようにライブラリを手動で修正した。

    % convert -size 1000x1000 xc:pink pink.png
    % cp -p pink.png storage/app/public/images 

ライブラリを直接編集したため、gitで管理されていない。注意が必要。

143行目あたりから。
    // save file
    // if (function_exists('curl_exec')) {
    //     // use cURL
    //     $fp = fopen($filepath, 'w');
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_FILE, $fp);
    //     $success = curl_exec($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
    //     fclose($fp);
    //     curl_close($ch);

    //     if (!$success) {
    //         unlink($filepath);

    //         // could not contact the distant URL or HTTP error - fail silently.
    //         return false;
    //     }
    // } elseif (ini_get('allow_url_fopen')) {
    //     // use remote fopen() via copy()
    //     $success = copy($url, $filepath);

    //     if (!$success) {
    //         // could not contact the distant URL or HTTP error - fail silently.
    //         return false;
    //     }
    $pink_jpg = $dir . DIRECTORY_SEPARATOR . "pink.png";
    $success = copy($pink_jpg, $filepath);

    if (!$success) {
        return new \RuntimeException('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()');
    }

追記：P247のsail testで失敗するので、ファイルは元に戻した。上記修正ファイルはvendor/fakerphp/faker/src/Faker/Provider/Image.php.nocurlとしてバックアップ。

## P228 Eager Loading

with()をつけて、Tweet取得時にまとめてImageも取得する（app/Services/TweetService.php)

    return Tweet::with('images')->orderBy('created_at', 'DESC')->get();

## P234 alpineで画像が拡大されるが、右下にずれる

ちゃんと読んでいなかった。

    CSS反映のためにsail npm run developmentを実行しましょう

### ?

そんなパラメータはないと怒られる

    sail npm run devlopment

画像が縮小表示されず、そもそもおかしい

    sail npm run dev

正しい表示になるが、フォアグラウンドで動き続けるのでじゃま

    npm run dev

やっぱりこれが正解。

    % sail npm run build


## P237 DBファサードを利用してトランザクションを作成

use()は関数外で定義した変数を利用する際に使用します。

    DB::transaction(function () use ($userId, $content, $images) { ... });



## P247 sail test

現状は全てのデータが消える

## P256, P261 DB_DATABASEをコメントアウトする

テキストと項目数が少し違う。以下をコメントアウトしないと、P261のテストに通らない


    <!--<env name="DB_DATABASE" value="testing"/>-->
