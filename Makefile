# Docker Shell for Local Development
dshell:
	@docker-compose run --entrypoint=ash --rm php

# "Normal" / Local Targets

deps:
	@composer install

# This needs hard-coded to a version when the beta drops
generate-api-client:
	@openapi-generator generate \
		-i https://raw.githubusercontent.com/influxdata/influxdb/master/http/swagger.yml \
		-g php \
		-o /local/src/InfluxDB2Generated \
		--api-package ApiClient \
		--invoker-package InfluxDB2Generated
