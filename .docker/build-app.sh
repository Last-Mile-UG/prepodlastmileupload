#!/bin/bash

DIR="$( dirname "${BASH_SOURCE[0]}" )"

echo "Installing composer dependencies"
/bin/bash -c "$DIR/composer.sh install"

echo "Applying migrations"
/bin/bash -c "$DIR/artisan.sh migrate"

echo "Clearing env"
/bin/bash -c "$DIR/artisan.sh cache:clear"
/bin/bash -c "$DIR/artisan.sh clear-compiled"
/bin/bash -c "$DIR/artisan.sh config:cache"
