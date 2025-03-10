FROM alpine:3.19

# Install dependencies
RUN apk update && apk add --no-cache \
    bash \
    cronie \
    tzdata \
    php82 \
    php82-phar \
    php82-ctype \
    php82-pdo \
    php82-pdo_mysql \
    php82-tokenizer \
    php82-xml \
    php82-dom \
    php82-openssl \
    php82-mbstring \
    php82-session \
    php82-fileinfo \
    php82-simplexml \
    curl

# Install Composer globally (do not use Alpine's Composer)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the time zone
ENV TZ=America/New_York
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Create the PHP symbolic link
RUN ln -sf /usr/bin/php82 /usr/bin/php

# Copy the ENTIRE project to the container
COPY . /var/www
WORKDIR /var/www

# Copy the crontab
COPY crontab /etc/crontabs/root

RUN chmod 0644 /etc/crontabs/root

RUN touch /var/log/cron.log

CMD ["crond", "-f"]
