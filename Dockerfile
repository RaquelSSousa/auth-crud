FROM php:8.2-apache

# Instala dependências do sistema necessárias
RUN apt-get update && apt-get install -y \ 
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP comuns
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Configura o diretório de trabalho
WORKDIR /var/www/html

# Dá permissão de escrita (ajuste conforme necessário)
RUN chown -R www-data:www-data /var/www/html

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Copia configuração customizada do Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf