FROM node:lts
LABEL authors="Bartosz Szymański"

ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /app
COPY . /app
RUN yarn

CMD yarn dev