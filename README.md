## back-task-manager

#### In order to build the backend

Have an SMTP account and provider. Ex: Sendgrid

Migrate the database

    php artisan migrate --seeds

##### Create a dotenv with the following data

```
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database
BCRYPT_ROUNDS=12
LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydb
DB_USERNAME=root
DB_PASSWORD=password
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=mailpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="example@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
VITE_APP_NAME="${APP_NAME}"
VUE_APP_URL=http://www.web-app.com
```

##### raise the server

    php artisan serve

##### raise queue listener

    php artisan queue:work database --queue=mails

##### To automatically load a superadmin user you can go to the browser or use postman on the following url: `http://www.api-url.com/setup`

It returns a json with 2 tokens, one of type super admin and another of type employee

All routes except login, reset password and websites are protected by the authentication system
