# review-laravel-contact-form(お問い合わせフォーム\_復習)

- 学習内容：Laravel + MySQL + Fortify 連携
- 作成時期：2026年5月
- 練習テーマ：CRUD / 認証 / 検索機能 / バリデーション

## 環境構築

Dockerビルド

1. git clone git@github.com:hirata784/review-laravel-contact-form.git
2. DockerDesktopアプリを立ち上げる
3. cd review-laravel-contact-form
4. docker compose up -d --build

＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集して下さい。

Laravel環境構築

1. docker compose exec php bash
2. composer install
3. cp .env.example .env
4. .envに以下の環境変数を変更する

```text
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

## テストユーザー

ログイン画面で以下の情報をご利用ください。

- Name：テスト太郎
- Email：taro@example.com
- Password：taro1234

## 使用技術

- PHP 7.4.9
- Laravel 8.83.29
- MySQL 8.0.26

## ER図

![画像](https://private-user-images.githubusercontent.com/183846226/608929535-cd78c7c8-349d-4396-94b3-1bd759e5203c.png?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3ODE2NjIwNDAsIm5iZiI6MTc4MTY2MTc0MCwicGF0aCI6Ii8xODM4NDYyMjYvNjA4OTI5NTM1LWNkNzhjN2M4LTM0OWQtNDM5Ni05NGIzLTFiZDc1OWU1MjAzYy5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjYwNjE3JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI2MDYxN1QwMjAyMjBaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT1lMjVjNmEwZGE0YTQ3ZWMzNmU2YTkyNzBiNzgzZGI2YTVmNzcwMzE3MDY0ZmVmZDllMDgzYTJlYWY0YTBkOTcxJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZyZXNwb25zZS1jb250ZW50LXR5cGU9aW1hZ2UlMkZwbmcifQ.DkrC-1dsAAAtrmfVKWO4LIbVEzdklAzm3eEjgbYAeJ4)

## URL

- 開発環境：http://localhost/
- ログイン画面：http://localhost/login
- phpMyAdmin：http://localhost:8080/
