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
