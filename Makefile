.DEFAULT_GOAL := help

help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  start-server   	to start the InfluxDB server"
	@echo "  stop-server    	to stop the InfluxDB server"
	@echo "  test           	to perform unit tests"
	@echo "  coverage       	to perform unit tests with code coverage"
	@echo "  coverage-show  	to show the code coverage report"
	@echo "  deps           	to installs the project dependencies"
	@echo "  dshell           	to start Docker Shell for Local Development"
	@echo "  release           	to release client with version specified by VERSION property . make release VERSION=1.5.0"

# Docker Shell for Local Development
dshell:
	@docker-compose run --entrypoint=bash --rm php

deps:
	@composer install

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

release:
	$(if $(VERSION),,$(error VERSION is not defined. Pass via "make release VERSION=1.5.0"))
	@echo Tagging $(VERSION)
	git checkout master
	git pull
	sed -i '' -e "s/VERSION = '.*'/VERSION = '$(VERSION)'/" src/InfluxDB2/Client.php
	git commit -am "chore(release): release influxdb-client-php-$(VERSION)"
	git tag $(VERSION)
	sed -i '' -e "s/VERSION = '.*'/VERSION = 'dev'/" src/InfluxDB2/Client.php
	git commit -am "chore(release): prepare for next development iteration"
	git push origin --tags
	git push origin master
