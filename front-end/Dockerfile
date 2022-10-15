FROM node:16.17.0

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install nginx -y
COPY ./etc/nginx/sites-enabled/default /etc/nginx/sites-enables/default
RUN service nginx stop -d
RUN service nginx start -d
