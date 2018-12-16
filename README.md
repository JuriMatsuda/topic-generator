# topic-generator
  アドベントカレンダーでネタが思いつかない人向けに、qiitaの人気タグを取得してランダムに返すやつ。  
  そのタグで記事を書こう。

## 使い方
qiitaのアクセストークンが必要です。  
※ qiitaアカウントが必要です。  

自分のアイコンをクリックして、「設定」 >> 「アプリケーション」 >> 「新しくトークンを発行する」でトークンを取得できます。  
取得したトークンソースコードに埋め込めば動きます。  

```
$option = [
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer 個人用アクセストークン',
        'Content-Type: application/json',
    ],
];
```

phpコマンドでプログラムが動きます。
```
php index.php
```