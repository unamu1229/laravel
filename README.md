# docker machine の場合
コンテナ内からバーチャルボックスの共有フォルダの問題でstorageのパーミッションを変更できない。
なので、Mac側からパーミッションを変更する。
chmod -R 777 storage


# composer を root ユーザーで実行できない
www のユーザーを作成し、www ユーザーでcomposer を実行する。


# sessions ディレクトリ以下に生成されるファイルにアクセスできない。
file_put_contents(/var/www/html/laravel/storage/framework/sessions/3lJRmDQB8ls8GUbpX0bUzCVKTbbRvVStEqA6afRo): failed to open stream: Permission denied
原因は ファイルのユーザーとパーミッションの設定により、apacheからアクセスできないから。
## ファイルのユーザ・グループ・パーミッション
```
-rw-r--r-- 1 www ftp
```
wwwユーザーの umask を 000 にしても -rw-r--r-- のファイルが生成され、
パーミッションの視点からは問題解決できない。
## apache を www で動かし、ユーザの視点から解決する。
www のユーザーを apache の グループに追加する
```
$ gpasswd -a www apache
$ id www
```
httpd.confの User を www に Grop を ftp に変更する。
```
\# User apache
\# Group apache
User www
Group ftp
```
変更内容の反映。
```
$ systemctl restart httpd
```
