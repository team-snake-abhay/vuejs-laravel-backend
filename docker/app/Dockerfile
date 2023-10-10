FROM ubuntu:20.04

LABEL maintainer="Sonnet"

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y locales \
    && locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y software-properties-common \
    && add-apt-repository -y ppa:nginx/stable \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y curl git sqlite3 supervisor unzip zip ffmpeg \
    && apt-get install -y nginx php8.2-xdebug php8.2-bcmath php8.2-cli \
       php8.2-curl php8.2-fpm php8.2-gd php8.2-imap php8.2-mbstring \
       php8.2-mysql php8.2-redis php8.2-soap php8.2-sqlite3 php8.2-xml \
       php8.2-zip php8.2-common \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --version=2.2.6 --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get remove -y --purge software-properties-common \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY default /etc/nginx/sites-available/default

COPY php-fpm.conf /etc/php/8.2/fpm/php-fpm.conf

COPY php.ini /etc/php/8.2/fpm/php.ini

EXPOSE 80

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord"]
