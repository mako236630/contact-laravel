# お問い合わせフォーム

Dokerビルド

・git clone git@github.com:mako236630/contact-laravel.git</br>
・docker-compose up -d --build
</br>
</br>
</br>
laravel環境構築</br>
・docker-compose exec php bash</br>
・composer install</br>
・cp .env.example .env 環境変数を適宜変更</br>
・php artisan key:generate</br>
・php artisan migrate</br>
・php artisan migrate:fresh --seed
</br>
</br>
</br>
開発環境</br>
・お問い合わせ画面　http://localhost/</br>
・ユーザー登録　http://localhost/register</br>
・phpMyadomin http://localhost:8080/
</br>
</br>
</br>
テスト用ログイン情報</br>
・php artisan db:seed</br>
・メールアドレス：test@example.com</br>
・パスワード：password123
</br>
</br>
</br>
使用技術</br>
・PHP 8.1.33</br>
・Laravel 8.83.8</br>
・MySQL 8.0.26</br>
・nginx 1.21.1
</br>
</br>
</br>
ER図

![ER図](erd.png)


