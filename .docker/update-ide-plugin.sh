#!/bin/bash

DIR="$( dirname "${BASH_SOURCE[0]}" )"

echo "Generating IDE helpers"
/bin/bash -c "$DIR/artisan.sh ide-helper:generate"
/bin/bash -c "$DIR/artisan.sh ide-helper:models --nowrite"
/bin/bash -c "$DIR/artisan.sh ide-helper:meta"
