<h1> Web Recipes API </h1>

![marca](https://user-images.githubusercontent.com/41764882/229312173-a887326f-9ac8-4534-b65b-6f592143278e.png)

# 🛠️ Modelo Entidade Relacionamento
![DiagramaERReceitasWeb](https://user-images.githubusercontent.com/41764882/229311979-99cd28c9-e8ce-4ed9-b821-7e8b8e9647cf.png)

# 🛠️ Collection
- Collection com as rotas para serem importadas no Postman, estão em arquivo na raiz do projeto.

# :hammer: Funcionalidades do projeto

- `Funcionalidades`: Foram implementadas todas as funcionalidades exigidas no documento do teste.

# 🛠️ Abrir e rodar o projeto

Requisitos:
- Composer
- PHP
- Mysql

Executar os seguintes comandos no terminal:

- git clone https://github.com/BrunoBencke/Web_Recipes_API.git

- composer install

- Ajustar arquivo .env do projeto conforme conexão do banco de dados DB_DATABASE, DB_USERNAME, DB_PASSWORD (Subi o .env junto para facilitar, mas normalmente esse arquivo mantemos no .gitignore)

- Criar database web_recipes

- php artisan migrate

- php artisan serve

O e-mail e senha padrão para obter o token de acesso a aplicação são:
admin@admin.com
ReceitasWeb*.
(senha possui ponto no final).
