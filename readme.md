# laravel勉強

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
