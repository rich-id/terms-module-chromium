FROM richcongress/php:8.1

USER root
RUN apt update --allow-unauthenticated --allow-insecure-repositories \
    && apt install -y chromium \
    && rm -rf /var/lib/apt/lists/*

USER application
