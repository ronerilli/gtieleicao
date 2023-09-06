FROM php:8.2.9

WORKDIR /opt/app/

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . .

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install exif
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install bcmath

CMD php artisan serve --host=0.0.0.0 --port=80