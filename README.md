
# API Users & Addresses

API RESTful para gerenciamento de  **usuários**,  **perfis**  e  **endereços**, construída com  **Laravel**  e  **PHP 8.4**.

## 🛠 Tecnologias

-   PHP 8.4.1
    
-   Laravel (API REST)
    
-   SQLite (desenvolvimento)
    
-   Composer 2.8.12
    

## ✅ Pré-requisitos

-   PHP 8.4.1 instalado
    
-   Composer 2.8.12 instalado

## 🚀 Como rodar o projeto



$ `git clone https://github.com/wagnercafee/api-users-adresses.git `

$ `cd api-users-adresses `

$ `bash run.sh` 

## 🔧 O que o  `run.sh`  faz

-   Copia  `.env.example`  para  `.env`
    
-   Gera a  `APP_KEY`  (`php artisan key:generate`)
    
-   Cria o banco sqlite (`touch  database/database.sqlite`)

-   Instala dependências (`composer install`)
    
-   Executa migrations (`php artisan migrate`)
    
-   Roda seeders (`php artisan db:seed`)
    
-   Sobe o servidor de desenvolvimento (`php artisan serve`)
    

## 🌐 URL da API

`http://localhost:9000`
