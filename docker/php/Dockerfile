FROM php:8.1-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt-get update \
    && apt-get install -y libzip-dev libpq-dev --no-install-recommends;

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pgsql pdo_pgsql zip;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN if [ ${USER_ID:-0} -ne 0 ] && [ ${GROUP_ID:-0} -ne 0 ]; then \
    userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi  &&\
    groupadd -g ${GROUP_ID} www-data &&\
    useradd -l -u ${USER_ID} -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive \
              --from=33:33 ${USER_ID}:${GROUP_ID} \
            /home/www-data \
;fi

USER www-data
WORKDIR /var/www