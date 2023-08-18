# Use a imagem oficial do PHP com a versão desejada
FROM php:8.1.0-cli

# Diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Instale as extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Instale as dependências do sistema para o Dompdf
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev

# Instale as extensões PHP necessárias para o Dompdf
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Copie o código-fonte do seu projeto para o diretório de trabalho
COPY . .

# Instale as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Exponha a porta 8000 para acessar o servidor web
EXPOSE 8000

# Inicie o servidor PHP embutido
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
