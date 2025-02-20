# Retificando...

# DevOps Challenge - Desafio SRE

Este repositório documenta todo o processo de criação do ambiente utilizando Docker, para executar uma aplicação PHP conectada a um banco de dados MySQL. O objetivo é facilitar para que pessoa possa seguir estas instruções e recriar o ambiente com facilidade.

## Tecnologias Utilizadas
- Docker
- Apache + PHP
- MySQL
- AWS EC2 (Opcional, se desejar rodar na nuvem)

## Passo a Passo

### 1.Criando uma Instância EC2 na AWS

Passos para criar a instância EC2:

Acesse o Console AWS: https://aws.amazon.com/pt/console/

Vá para AWS Console

Faça login na sua conta AWS

Navegue até o EC2:

No painel de serviços, procure por EC2 e clique para abrir

Inicie uma nova instância:

Clique no botão Launch Instance

Escolha um nome para sua instância (ex: desafio-sre-devops)

Escolha a imagem do sistema operacional:

Selecione a opção Ubuntu Server 22.04 LTS

Escolha o tipo de instância:

Selecione a opção t2.micro (gratuito no nível AWS Free Tier)

Configurar chave SSH:

Crie uma nova chave SSH ou selecione uma existente

Baixe o arquivo .pem e guarde-o com segurança

Configurar as regras de segurança:

Permita SSH (porta 22) para acessar a instância

Permita HTTP (porta 80) para acesso ao site

Permita porta 8080 para rodar a aplicação no Apache

Permita porta 3306 para acesso ao MySQL (opcional)

Lançar a instância:

Revise as configurações e clique em Launch Instance

Aguarde a instância iniciar

Acesse a instância via SSH:

No terminal, execute: 

ssh -i sua-chave.pem ubuntu@IP_DA_INSTANCIA

Agora sua instância EC2 está pronta para receber a configuração do ambiente Docker!

### 2. Instalar o Docker
Se o Docker ainda não estiver instalado, execute:
```bash
sudo apt update
sudo apt install -y docker.io
sudo systemctl enable docker
sudo systemctl start docker
```

### 3. Clonar o Repositório
```bash
git clone https://github.com/seu-usuario/desafio-sre-devops.git
cd desafio-sre-devops
```

### 4. Criar e Configurar o Container do MySQL

#### Criar o Dockerfile para o MySQL
Dentro da pasta `mysql/`, crie o `Dockerfile` com o seguinte conteúdo:
```Dockerfile
FROM mysql:5.7
ENV MYSQL_ROOT_PASSWORD=metroid (a senha da sua escolha)
ENV MYSQL_DATABASE=sre_desafio (o nome do banco de dados da sua escolha) 
COPY init.sql /docker-entrypoint-initdb.d/
```

#### Criar o script SQL de inicialização (`init.sql`)
Crie um arquivo `mysql/init.sql` com o seu conteúdo, segue exemplo:
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
INSERT INTO usuarios (nome, email) VALUES
('Vitor', 'vitor@gmail.com'),
('Ana', 'ana@gmail.com'),
('Michael', 'michaelmcavalcante@gmail.com'),
('Maxwell', 'maxwellwolf@hotmail.com'),
('Lina', 'linamikemax@gmail.com'),
('Warley', 'warleym.araujo@gmail.com');
```

#### Criar o container do MySQL
```bash
cd mysql
docker build -t custom-mysql .
docker run -d --name container-mysql -e MYSQL_ROOT_PASSWORD=metroid -e MYSQL_DATABASE=sre_desafio -p 3306:3306 custom-mysql
```

### 5. Criar e Configurar o Container do Apache + PHP

#### Criar o Dockerfile para o Apache
Dentro da pasta `apache/`, crie o `Dockerfile` com o seguinte conteúdo:
```Dockerfile
FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY index.php /var/www/html/
```

#### Criar o `index.php`
Crie um arquivo `apache/index.php` com o seu conteúdo, segue exemplo:
```php
<?php
$servername = "container-mysql";
$username = "root";
$password = "metroid";
$dbname = "sre_desafio";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM usuarios");
?>
<!DOCTYPE html>
<html>
<head>
    <title>DevOps Challenge - Desafio SRE</title>
</head>
<body>
    <h2>Lista de Usuários</h2>
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["nome"] ?></td>
            <td><?= $row["email"] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
```

#### Criar o container do Apache + PHP
```bash
cd ../apache
docker build -t custom-apache .
docker run -d --name apache-container --link container-mysql -p 8080:80 custom-apache
```

### 6. Acessar a Aplicação
No navegador, acesse:
```
http://<IP-DA-SUA-EC2>:8080
```
Se estiver rodando localmente:
```
http://localhost:8080
```

Se os passos foram seguidos corretamente, a sua Página/aplicação Web será exibida na tela com dados do seu banco MySQL. 🚀

## Nota
 Caso encontre problemas, verifique os logs dos containers:
```bash
docker logs container-mysql
docker logs apache-container
```
## 📌 Página em constante atualização

![Página Web sujeita a alteração](https://github.com/user-attachments/assets/1d9de7db-791e-489a-b963-2deceeae38e1)
