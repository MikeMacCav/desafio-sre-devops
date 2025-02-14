FROM ubuntu:latest

# Atualiza os pacotes e instala Apache, PHP e extensões necessárias
RUN apt update && apt install -y apache2 php libapache2-mod-php php-mysql

# Copia os arquivos da aplicação para o servidor web
COPY index.php /var/www/html/

# Expõe a porta 80 para acesso HTTP
EXPOSE 80

# Mantém o Apache em execução
CMD ["apachectl", "-D", "FOREGROUND"]
