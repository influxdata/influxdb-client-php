FROM php:7.1-cli AS dev

COPY --from=composer /usr/bin/composer /usr/bin/
