FROM node:12.22-buster-slim

LABEL maintainer="Sonnet"

RUN apt-get update && apt-get install -y build-essential libpng-dev \
    && rm -rf /var/lib/apt/lists/*