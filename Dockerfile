# Dockerfile - Container PHP para Laravel
FROM php:8.3-cli
 
# Instala dependências do sistema e extensões PHP necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
 
# Instala o Composer (gerenciador de dependências PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
WORKDIR /var/www/html
 
# Copia o código do projeto para dentro da imagem
COPY . .
 
# Instala as dependências do projeto (vendor/)
RUN composer install --no-interaction --optimize-autoloader || true
 
EXPOSE 8000
 
# Sobe o servidor embutido do Laravel, acessível de fora do container
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
 