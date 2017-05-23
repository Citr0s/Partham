#!/bin/sh

echo 'Getting latest changes from git...';
git pull

echo 'Updating Composer...';
composer self-update

echo 'Updating packages...';
composer update

echo 'Dumping autoload...';
composer dump-autoload