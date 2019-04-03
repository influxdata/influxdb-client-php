###
# Docker Targets
##
TARGET=v2.0.0-alpha.4

# Docker Shell for Local Development
dshell:
	@docker-compose run --entrypoint=ash --rm php

# This needs hard-coded to a version when the beta drops
generate-api-client:
	@rm -rf src/InfluxDB2Generated
	@docker container run --rm -it -v ${PWD}:/code -w /code openapitools/openapi-generator-cli:latest \
		generate \
			-i https://raw.githubusercontent.com/influxdata/influxdb/$(TARGET)/http/swagger.yml \
			-g php \
			-o /code/src/InfluxDB2Generated \
			--api-package ApiClient \
			--invoker-package InfluxDB2Generated

###
# Normal Targets
###
deps:
	@composer install

test:
	@./bin/phpspec run
	@./bin/phpunit
