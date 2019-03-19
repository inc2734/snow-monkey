#!/usr/bin/env bash

set -e;

TMPDIR=${TMPDIR-/tmp}
TMPDIR=$(echo $TMPDIR | sed -e "s/\/$//")
WP_TESTS_DIR=${WP_TESTS_DIR-$TMPDIR/wordpress-tests-lib}
WP_CORE_DIR=${WP_CORE_DIR-$TMPDIR/wordpress/}

themedir=$(pwd)
if [ ! -e resources/style.css ]; then
  echo 'Current directory is not a theme.'
  echo $(pwd)
  exit 1
fi

cd ${themedir}

if [ -e ${themedir}/bin/install-wp-tests.sh ] || [ ! -e ${WP_TESTS_DIR}/includes/functions.php ]; then
  echo 'DROP DATABASE IF EXISTS wordpress_test;' | mysql -u root

  if [ -d ${WP_CORE_DIR} ]; then
    rm -fr ${WP_CORE_DIR}
  fi

  if [ -d ${WP_TESTS_DIR} ]; then
    rm -fr ${WP_TESTS_DIR}
  fi

  bash "${themedir}/bin/install-wp-tests.sh" wordpress_test root '' localhost latest;
  vendor/bin/phpunit --configuration=${themedir}/phpunit.xml.dist
else
  echo "${themedir}/bin/install-wp-tests.sh not found."
fi;
