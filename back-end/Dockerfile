FROM ubuntu:focal

RUN apt-get update && \
    apt-get autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install packages
COPY provision.sh /tmp/provision.sh
RUN chmod +x /tmp/provision.sh