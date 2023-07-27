
https://github.com/ryohei8/paper_bookmarker/assets/131762035/03d46cf7-9d46-4e7f-8750-811de15c356a
# paper_bookmarker アプリケーション

# 概要
paper_bookmarkerは、arxiv APIを利用したシンプルな論文検索＆ブックマークアプリケーションです。このアプリケーションを使用することで、興味のある論文を検索し、ブックマークして管理することができます。また、ブックマーク内の論文を検索したり、コメントを追加したりすることも可能です。



https://github.com/ryohei8/paper_bookmarker/assets/131762035/9f4df99c-e6ca-4c66-ac38-b1db3e68291f



# 主な機能
arxiv APIを利用した論文検索: キーワードや著者名などを使用してarxivの論文を検索できます。
論文のブックマーク: 興味のある論文をブックマークして保存できます。
ブックマーク内の検索: ブックマークした論文をタイトルや著者名で検索できます。
コメントの追加: ブックマークした論文にコメントを追加して、メモを残すことができます。

# インストール方法
以下の手順に従ってpaper_bookmarkerをインストールしてください。

リポジトリをクローンする:
```
bash
Copy code
git clone https://github.com/your_username/paper_bookmarker.git
cd paper_bookmarker
```

必要なパッケージをインストールする:
```
bash
Copy code
composer install
```

環境設定ファイルを作成する:
```
bash
Copy code
cp .env.example .env
```

アプリケーションキーを生成する:
```
bash
Copy code
php artisan key:generate
```

データベースをセットアップする:
データベースを作成し、.env ファイル内のデータベース関連の設定を正しく設定します。そして、以下のコマンドを実行します。
```
bash
Copy code
php artisan migrate
```

アプリケーションを起動する:
```
bash
Copy code
php artisan serve
```
これで、paper_bookmarkerアプリケーションが起動され、 http://localhost:8000 でアクセスできるようになります。

# 使用例
ホームページで論文の検索を行います。検索結果が表示されます。
興味のある論文をブックマークします。
ブックマークページで保存された論文を確認し、検索したりコメントを追加したりします。

# フレームワーク
このアプリケーションは、laravel 10 フレームワークを使用して開発されています。

# ライセンス
paper_bookmarkerはオープンソースプロジェクトであり、MITライセンスの下で利用可能です。
