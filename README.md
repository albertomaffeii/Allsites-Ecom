------------------------------------------------------------------------------------------
En
------------------------------------------------------------------------------------------
# ALLSITES Ecom
## Ecommerce System with Multi-Level Administration Panel

This is a complete Ecommerce System project developed in PHP 8.2.4 using Laravel framework version 10.15.0 and MySQL database version 10.4.28-MariaDB. The system includes an administration panel with support for multiple levels of hierarchy, allowing for more efficient and secure management of operations.

## Key Features

- Product registration with detailed information and images
- Management of product categories and subcategories
- Shopping cart and simplified checkout process
- Order system with history and delivery status
- Customer management with contact information
- User administration with different permission levels
- Reports and statistics for sales and inventory
- Integration with payment gateways

## Requirements

- PHP 8.2.4 or higher
- Laravel 10.15.0 or higher
- MySQL 10.4.28-MariaDB or higher

## Installation

1. Clone the repository to your development environment:

   git clone https://github.com/albertomaffeii/Allsites-Ecom.git

2. Access the project folder and install Composer dependencies:

   cd Allsites-Ecom
   composer install

3. Create a `.env` file from the `.env.example` file and configure the database information:

   cp .env.example .env

4. Generate an application key for the project:

   php artisan key:generate

5. Create the database in MySQL and run migrations to create the tables:

   php artisan migrate

6. Start the development server:

   php artisan serve

   php artisan migrate --seeder

7. Access the system through your browser at `http://localhost:8000`.

   An Administrator user will be created with login: admin@admin.com and password: senha123 .
   Log in with this user to start using the system. I recommend that you register the sections in this order: Categories, Brands, Colors, Products and Home Slider.



## How to Contribute

This project is open-source and open for contributions. If you find any bugs, have suggestions for improvement, or want to add new features, feel free to submit a Pull Request. All contributors will be properly credited.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for more details.

---

**Note:** This is an example project created for learning purposes and to demonstrate programming skills. It is not intended for production use and does not integrate with real payment or delivery services.

For more information about Laravel, visit [laravel.com](https://laravel.com/).

For more information about PHP, visit [php.net](https://www.php.net/).

For more information about MySQL, visit [mysql.com](https://www.mysql.com/).


------------------------------------------------------------------------------------------
PT-BR
------------------------------------------------------------------------------------------
# Allsites Econ
## Sistema de Ecommerce com Painel de Administração Multi Nível

Este é um projeto completo de Sistema de Ecommerce desenvolvido em PHP 8.2.4 utilizando o framework Laravel na versão 10.15.0 e o banco de dados MySQL na versão 10.4.28-MariaDB. O sistema inclui um painel de administração com suporte a múltiplos níveis de hierarquia, permitindo uma gestão mais eficiente e segura das operações.

## Funcionalidades Principais

- Cadastro de produtos com informações detalhadas e imagens
- Gerenciamento de categorias e subcategorias de produtos
- Carrinho de compras e processo de checkout simplificado
- Sistema de pedidos com histórico e status de entrega
- Gestão de clientes e suas informações de contato
- Administração de usuários com diferentes níveis de permissões
- Relatórios e estatísticas de vendas e estoque
- Integração com gateways de pagamento

## Requisitos

- PHP 8.2.4 ou superior
- Laravel 10.15.0 ou superior
- MySQL 10.4.28-MariaDB ou superior

## Instalação

1. Faça o clone do repositório para o seu ambiente de desenvolvimento:

git clone https://github.com/albertomaffeii/Allsites-Ecom.git

2. Acesse a pasta do projeto e instale as dependências do Composer:

cd Allsites-Ecom
composer install

3. Crie um arquivo `.env` a partir do arquivo `.env.example` e configure as informações do banco de dados:

cp .env.example .env

4. Gere uma chave de aplicação para o projeto:

php artisan key:generate

5. Crie o banco de dados no MySQL e execute as migrações para criar as tabelas:

php artisan migrate

6. Execute o servidor de desenvolvimento:

php artisan serve

php artisan migrate --seeder

7. Acesse o sistema através do seu navegador em `http://localhost:8000`.

Será criado um usuário Administrador com o login admin@admin.com e a senha Senha123. Faça o acesso com este usuário pra começar a utilizar o sistema.
Recomendo que cadastre as seções nesta ordem: Categorias, Marcas, Cores, Produtos e Home Slider.



## Como Contribuir

Este projeto é de código aberto e está aberto para contribuições. Se você encontrar algum bug, tiver alguma sugestão de melhoria ou quiser adicionar novas funcionalidades, sinta-se à vontade para enviar um Pull Request. Todos os colaboradores serão devidamente creditados.

## Licença

Este projeto é licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

**Nota:** Este é um projeto exemplo criado para fins de aprendizado e demonstração de habilidades em programação. Não é destinado para uso em produção e não possui integração com serviços reais de pagamento ou entrega.

Para mais informações sobre o Laravel, acesse [laravel.com](https://laravel.com/).

Para mais informações sobre o PHP, acesse [php.net](https://www.php.net/).

Para mais informações sobre o MySQL, acesse [mysql.com](https://www.mysql.com/).