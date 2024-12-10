#!/bin/bash
php artisan migrate
npx update-browserslist-db@latest
npm run build
php artisan key:generate
php artisan storage:link
# php artisan optimize:clear
# php artisan optimize
# php artisan view:cache
php artisan queue:work
php artisan serve --host=192.168.1.60
