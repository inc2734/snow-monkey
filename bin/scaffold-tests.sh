#!/usr/bin/env bash

set -e;

themedir=$(pwd)
theme=$(basename $themedir)
if [ ! -e resources/style.css ]; then
  echo 'Current directory is not a theme.'
  echo $(pwd)
  exit 1
fi

if [[ $(pwd) =~ ^.+/wp-content/themes/([^/]+) ]]; then
  themedir=${BASH_REMATCH[0]}
	theme=${BASH_REMATCH[1]}
else
  echo 'Current directory is not a theme.'
	echo $(pwd)
  exit 1;
fi

phar extract -f $(which wp) "$themedir/bin/wp.phar">/dev/null 2>&1
wpclidir="$themedir/bin/wp.phar$(which wp)"

if [ ! -e "$themedir/bin" ]; then
	echo "$themedir/bin is not exsists."
  exit 1;
fi

cp -f "$wpclidir/templates/install-wp-tests.sh" "$themedir/bin/install-wp-tests.sh"

cp -f "$wpclidir/templates/phpunit.xml.dist" "$themedir/phpunit.xml"

if [ ! -e "$themedir/tests" ]; then
	mkdir "$themedir/tests"
else
  echo "$themedir/tests is alerady exsists."
fi

if [ ! -e "$themedir/tests/bootstrap.php" ]; then
  cp -f "$wpclidir/templates/plugin-bootstrap.mustache" "$themedir/tests/plugin-bootstrap.mustache"
  sed -e "s/require dirname( dirname( __FILE__ ) ) \. '\/{{plugin_slug}}\.php';/register_theme_directory( dirname( __FILE__ ) . '\/\.\.\/\.\.\/' ); switch_theme('$theme\/resources'); search_theme_directories();/g" "$themedir/tests/plugin-bootstrap.mustache">"$themedir/tests/bootstrap.php"
  rm -f "$themedir/tests/plugin-bootstrap.mustache"
else
  echo "$themedir/tests/bootstrap.php is alerady exsists."
fi

if [ ! -e "$themedir/tests/test-sample.php" ]; then
  cp -f "$wpclidir/templates/plugin-test-sample.mustache" "$themedir/tests/test-sample.php"
else
  echo "$themedir/tests/test-sample.php is alerady exsists."
fi

rm -rf "$themedir/bin/wp.phar"
echo "done!"
