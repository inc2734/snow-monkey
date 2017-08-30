#!/usr/bin/env bash

set -e

if [[ "false" != "$TRAVIS_PULL_REQUEST" ]]; then
  echo "Not deploying pull requests."
  exit
fi

if [[ "master" != "$TRAVIS_BRANCH" ]]; then
  echo "Not on the 'master' branch."
  exit
fi

if [[ "7" != "$TRAVIS_PHP_VERSION" ]]; then
	echo "deploy only PHP 7"
	exit
fi

git clone -b release --quiet git@github.com:inc2734/snow-monkey.git release
cd release
ls | xargs rm -rf
ls -la
cd ../
yarn install
yarn run gulp release
cd release
ls -la
yarn install
composer install --no-dev
rm -rf composer.json composer.lock package.json yarn.lock gulpfile.js node_modules .editorconfig .gitignore .travis.yml .travis
rm -rf vendor/inc2734/wp-basis/.gitignore
sed '/^node_modules/d' vendor/inc2734/wp-basis/.gitignore
echo node_modules/* >> vendor/inc2734/wp-basis/.gitignore
echo !node_modules/sass-basis >> vendor/inc2734/wp-basis/.gitignore

git add -A
git commit -m "[ci skip] release branch update from travis $TRAVIS_COMMIT"
git push origin release
