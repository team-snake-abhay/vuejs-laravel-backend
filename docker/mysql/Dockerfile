FROM mysql:5.7.27

LABEL maintainer="Sonnet"

RUN ln -sf /usr/share/zoneinfo/Asia/Dhaka /etc/localtime

CMD ["--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci", "--skip-character-set-client-handshake"]
