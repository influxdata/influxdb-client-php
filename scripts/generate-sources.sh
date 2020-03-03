#!/usr/bin/env bash

SCRIPT_PATH="$( cd "$(dirname "$0")" || exit ; pwd -P )"

rm -rf "${SCRIPT_PATH}"/../generated

# Generate client
cd "${SCRIPT_PATH}"/ || exit
docker run --rm -it \
  -v "${PWD}":/code \
  -v "${PWD}/../generated":/generated \
  -v "${PWD}/.m2":/root/.m2 \
  -w /code \
  maven:3.6-slim mvn org.openapitools:openapi-generator-maven-plugin:generate

#### sync generated php files to src

# delete old sources
rm -f "${SCRIPT_PATH}"/../src/InfluxDB2/API/*
rm -f "${SCRIPT_PATH}"/../src/InfluxDB2/Model/*

#cp -r "${SCRIPT_PATH}"/../generated/lib/ApiException.php "${SCRIPT_PATH}"/../src/InfluxDB2
cp -r "${SCRIPT_PATH}"/../generated/lib/ObjectSerializer.php "${SCRIPT_PATH}"/../src/InfluxDB2

#mkdir -p "${SCRIPT_PATH}"/../src/InfluxDB2/API
#cp -r "${SCRIPT_PATH}"/../generated/lib/API/*.php "${SCRIPT_PATH}"/../src/InfluxDB2/API

mkdir -p "${SCRIPT_PATH}"/../src/InfluxDB2/Model
cp -r "${SCRIPT_PATH}"/../generated/lib/Model/WritePrecision.php "${SCRIPT_PATH}"/../src/InfluxDB2/Model
cp -r "${SCRIPT_PATH}"/../generated/lib/Model/Query.php "${SCRIPT_PATH}"/../src/InfluxDB2/Model
cp -r "${SCRIPT_PATH}"/../generated/lib/Model/Dialect.php "${SCRIPT_PATH}"/../src/InfluxDB2/Model
cp -r "${SCRIPT_PATH}"/../generated/lib/Model/ModelInterface.php "${SCRIPT_PATH}"/../src/InfluxDB2/Model

rm -rf "${SCRIPT_PATH}"/../generated
