#!/bin/bash
composer install
cp .env.example .env
mkdir storage && chmod -R 777 storage
cd storage && mkdir logs && chmod -R 777 logs
mkdir framework && chmod -R 777 framework
cd framework && mkdir sessions views cache && chmod -R 777 sessions views cache
