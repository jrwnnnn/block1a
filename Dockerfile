FROM php:8.2-apache
RUN apt-get update && apt-get install -y \ 
    libmariadb-dev \ 
    nodejs \ 
    npm \ 
  && docker-php-ext-install mysqli \ 
  && apt-get clean \ 
  && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html/
COPY package.json package-lock.json* ./
RUN npm install
COPY . .
RUN npm run build
EXPOSE 80