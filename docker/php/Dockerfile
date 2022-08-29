FROM php:8.1.8-apache

ARG USER_ID
ARG GROUP_ID

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y libzip-dev libpq-dev wget --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*;

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pgsql pdo_pgsql zip;

RUN wget https://getcomposer.org/download/2.3.10/composer.phar \
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer;

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

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

CMD ["apache2-foreground"]