#!/bin/bash

DIR="$( dirname "${BASH_SOURCE[0]}" )"

/bin/bash -c "$DIR/build-app.sh"
/bin/bash -c "$DIR/update-ide-plugin.sh"
