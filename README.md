# DevOps Challenge - Desafio SRE

Este projeto consiste na configuração de um ambiente DevOps utilizando Docker, MySQL, Apache e PHP para exibir uma lista de usuários armazenada no banco de dados.

## 📌 Passos da Configuração

### 1️⃣ Configuração da Instância na AWS
- Criei uma máquina virtual na AWS EC2 com **Ubuntu Server**.
- Acesso da máquina via SSH.

### 2️⃣ Instalação do Docker e Configuração dos Containers
- Instalei o Docker na máquina.
- Criei um container para o banco de dados **MySQL** e outro para o servidor **Apache/PHP**.
- Defini volumes persistentes para armazenar os dados.

### 3️⃣ Banco de Dados MySQL
- Criei um banco chamado **sre_desafio**.
- Criei a tabela `usuarios` e inseri alguns registros.
- Configurei a conexão entre o PHP e o MySQL usando a **rede interna do Docker**.

### 4️⃣ Configuração do Servidor Apache e PHP
- Criei um **arquivo index.php** para exibir os usuários cadastrados no banco de dados.
- Testei o funcionamento acessando **http://3.87.255.21:8080/index.php**. (Não é um IP elástico,ele muda conforme eu interrompo a instância EC2 e inicio novamente). 

### 5️⃣ Melhorias na Estilização
- Apliquei **CSS embutido** no arquivo **index.php** para tornar a página mais agradável e intuitiva.
- Melhorei a organização da tabela e adicionei cores.

## 📌 Tecnologias Utilizadas
- **AWS EC2** para hospedagem.
- **Docker** para gerenciamento dos serviços.
- **MySQL** como banco de dados.
- **Apache + PHP** para servir a aplicação.
- **HTML + CSS** para exibição dos dados.

## 📌 Como Acessar
1. Acesse o navegador e digite:  
   `http://3.87.255.21:8080/index.php`
2. A página exibirá uma tabela com a lista de usuários cadastrados.

## 📌 Página Web em constante atualização

![Página Web sujeita a alteração](https://github.com/user-attachments/assets/1d9de7db-791e-489a-b963-2deceeae38e1)
