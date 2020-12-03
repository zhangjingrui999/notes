FROM hyperf/hyperf:7.4-alpine-v3.10-cli-v4.4

##
# ---------- env settings ----------
##
# --build-arg timezone=Asia/Shanghai
ARG timezone

ENV TIMEZONE=${timezone:-"Asia/Shanghai"} \
    COMPOSER_VERSION=2.0.7 \
    APP_ENV=prod

# update
RUN set -ex \
    # && apk update \
    # install composer
    && cd /tmp \
    && wget https://github.com/composer/composer/releases/download/${COMPOSER_VERSION}/composer.phar \
    && chmod u+x composer.phar \
    && mv composer.phar /usr/local/bin/composer \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer \
    # show php version and extensions
    && php -v \
    && php -m \
    #  ---------- some config ----------
    && cd /etc/php7 \
    # - config PHP
    && { \
        echo "upload_max_filesize=100M"; \
        echo "post_max_size=108M"; \
        echo "memory_limit=512M"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99-overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    # ---------- clear works ----------
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

#COPY . /app

WORKDIR /app

# Composer Cache
# COPY ./composer.* /opt/www/
#RUN composer install --no-dev --no-scripts

#RUN cd /app \
#    && composer install --no-dev \
#    && composer dump-autoload -o \
#    && php /app/bin/hyperf.php di:init-proxy

#EXPOSE 9501

#ENTRYPOINT ["php", "/app/bin/hyperf.php", "start"]