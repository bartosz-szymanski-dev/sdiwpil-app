FROM ubuntu

RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends php-cli && \
    apt-get autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install packages
ADD provision.sh /provision.sh
ADD supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN chmod +x /*.sh
RUN ./provision.sh
RUN update-alternatives --set php /usr/bin/php8.1
RUN apt install php-dev php-pear -y
RUN pecl channel-update pecl.php.net

EXPOSE 80 22 35729 9876
CMD ["/usr/bin/supervisord"]
WORKDIR /var/www/html
