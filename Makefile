.PHONY: help
.DEFAULT_GOAL := help

help:
	@awk 'BEGIN {FS = ":.*##"; printf "Usage: make \033[36m<target>\033[0m\n"} /^[a-zA-Z0-9_-]+:.*?##/ { printf "  \033[36m%-46s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

dshell: ## Start Docker Shell for Local Development
	@docker-compose run --entrypoint=bash --rm php

deps: ## Installs the project dependencies
	@docker-compose run php composer install

test: start-server ## Perform unit tests
	@docker-compose run php composer run test

coverage: start-server ## Perform unit tests with code coverage
	@docker-compose run php composer run test-coverage

coverage-show: ## Show the code coverage report
	open build/coverage-report/index.html

start-server: ## Start the InfluxDB server
	@docker-compose up -d influxdb_v2
	@scripts/influxdb-onboarding.sh ||:

stop-server: ## Stop the InfluxDB serve
	@docker-compose stop influxdb_v2

release: ## Release client with version specified by VERSION property . make release VERSION=1.5.0
	$(if $(VERSION),,$(error VERSION is not defined. Pass via "make release VERSION=1.5.0"))
	@echo Tagging $(VERSION)
	git checkout master
	git pull
	sed -i -e "s/VERSION = '.*'/VERSION = '$(VERSION)'/" src/InfluxDB2/Client.php
	git commit -am "chore(release): release influxdb-client-php-$(VERSION)"
	git tag $(VERSION)
	sed -i -e "s/VERSION = '.*'/VERSION = 'dev'/" src/InfluxDB2/Client.php
	git commit -am "chore(release): prepare for next development iteration"
	git push origin --tags
	git push origin master

doc-generate: ## Generate documentation
	@docker-compose run doxygen

doc-publish: ## Publish documentation as GH-Pages
	$(MAKE) doc-generate
	@docker-compose run doc-publish
