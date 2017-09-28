#!/bin/sh

echo 'Getting latest changes from git...';
git pull

echo 'Updating Composer...';
composer self-update

echo 'Updating packages...';
composer update --no-dev

echo 'Dumping autoload...';
composer dump-autoload

echo 'Updating packages...';
yarn

echo 'Compiling files...';
gulp build