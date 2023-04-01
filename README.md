![logo](https://user-images.githubusercontent.com/41764882/228562002-29d5c16b-0a38-42d6-a953-8d85ad72a8ae.png)

<h1> Web Recipes API </h1>

# 🛠️ Modelo Entidade Relacionamento
![DiagramaERReceitasWeb](https://user-images.githubusercontent.com/41764882/229311979-99cd28c9-e8ce-4ed9-b821-7e8b8e9647cf.png)

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
