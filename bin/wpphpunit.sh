#!/usr/bin/env bash

set -e;

WP_TESTS_DIR=${WP_TESTS_DIR-/tmp/wordpress-tests-lib}
WP_CORE_DIR=${WP_CORE_DIR-/tmp/wordpress/}

themedir=$(pwd)
if [ ! -e resources/style.css ]; then
  echo 'Current directory is not a theme.'
  echo $(pwd)
  exit 1
fi

cd ${themedir}

if [ -e ${themedir}/bin/install-wp-tests.sh ]; then
  echo 'DROP DATABASE IF EXISTS wordpress_test;' | mysql -u root

  if [ -e ${WP_CORE_DIR} ]; then
    rm -fr ${WP_CORE_DIR}
  fi

  if [ -e ${WP_TESTS_DIR} ]; then
    rm -fr ${WP_TESTS_DIR}
  fi

  bash "${themedir}/bin/install-wp-tests.sh" wordpress_test root '' localhost latest;
  resources/vendor/bin/phpunit --configuration= ${themedir}/phpunit.xml
else
  echo "${themedir}/bin/install-wp-tests.sh not found."
fi;
