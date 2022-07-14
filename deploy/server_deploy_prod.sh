#!/bin/sh

set -e 

echo "Deploying application to production www.clime.app..." 

# Enter maintenance mode

(php artisan down) || true

    git fetch origin master

    git reset --hard origin/master 

    composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader

    npm install --production

    npm install -g modclean

    modclean -n default:safe,default:caution -r

    npm run prod

    php artisan migrate --force

    php artisan view:clear

    php artisan cache:clear

    php artisan config:clear

    php artisan route:clear

    php artisan optimize

# Exit maintenance mode

php artisan up 

echo "Application deployed!"