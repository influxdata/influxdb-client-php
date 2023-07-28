#!/usr/bin/env bash

set -e

SCRIPT_PATH="$( cd "$(dirname "$0")" || exit ; pwd -P )"
cd "$SCRIPT_PATH"/..

echo "# Clone client and switch to branch for GH-Pages"
git clone git@github.com:influxdata/influxdb-client-php.git \
  && cd influxdb-client-php \
  && git checkout -B gh-pages

echo "# Remove old pages"
rm -r "$SCRIPT_PATH"/../influxdb-client-php/*

echo "# Copy new docs"
cp -Rf "$SCRIPT_PATH"/../docs/* "$SCRIPT_PATH"/../influxdb-client-php/

echo "# Copy CircleCI"
cp -R "${SCRIPT_PATH}"/../.circleci/ "$SCRIPT_PATH"/../influxdb-client-php/

echo "# Deploy site"
git add -f .
git commit -m "Pushed the latest Docs to GitHub pages [skip CI]"
git push -fq origin gh-pages
