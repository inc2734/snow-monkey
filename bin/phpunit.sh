#!/usr/bin/env bash

if [ -e /tmp/wordpress-tests-lib -a -e /tmp/wordpress-tests-lib/includes/functions.php ]; then

  themedir=$(pwd)
  if [ ! -e resources/style.css ]; then
    echo 'Current directory is not a theme.'
    echo $(pwd)
    exit 1
  fi

  cd ${themedir};
  resources/vendor/bin/phpunit --configuration= ${themedir}/phpunit.xml
  exit 0
fi

dir=$(cd $(dirname $0) && pwd)
bash "${dir}/wpphpunit.sh"
