#!/usr/bin/env bash

set -ex;

if [[ "false" != "$TRAVIS_PULL_REQUEST" ]]; then
  echo "Not deploying pull requests."
  exit
fi

if [[ "master" != "$TRAVIS_BRANCH" ]]; then
  echo "Not on the 'master' branch."
  exit
fi

if [[ "7.1" != "$TRAVIS_PHP_VERSION" ]]; then
	echo "deploy only PHP 7"
	exit
fi

git clone -b release --quiet git@github.com:inc2734/snow-monkey.git release
cd release
ls | xargs rm -rf
ls -la
cd ../
rm -rf node_modules
npm install
rm -rf vendor
composer install --no-dev
cp -r resources/. release/
cd release
ls -la

if [ -z "$(git status --porcelain)" ]; then
  exit 0;
else
  git add -A
  git commit -m "[ci skip] release branch update from travis $TRAVIS_COMMIT"
  git push origin release
fi
