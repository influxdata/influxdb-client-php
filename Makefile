.DEFAULT_GOAL := help

help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  start-server   	to start the InfluxDB server"
	@echo "  stop-server    	to stop the InfluxDB server"
	@echo "  test           	to perform unit tests"
	@echo "  coverage       	to perform unit tests with code coverage"
	@echo "  coverage-show  	to show the code coverage report"
	@echo "  generate-sources	to generate API sources from swagger.yml"
	@echo "  generate-sources	to generate API sources from swagger.yml"
	@echo "  deps           	to installs the project dependencies"
	@echo "  dshell           	to start Docker Shell for Local Development"

# Docker Shell for Local Development
dshell:
	@docker-compose run --entrypoint=bash --rm php

deps:
	@composer install

generate-sources:
	@scripts/generate-sources.sh

test: start-server
	@docker-compose run php composer run test

coverage: start-server
	@docker-compose run php composer run test-coverage

coverage-show:
	open build/coverage-report/index.html

start-server:
	@docker-compose up -d influxdb_v2
	@scripts/influxdb-onboarding.sh ||:

stop-server:
	@docker-compose stop influxdb_v2
