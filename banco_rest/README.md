#### Banco da Capgemini ####

#### Instalação ####

1. Instalar as dependências do projeto via composer


1.1 composer install


2. Configurar o autoload


2.1 composer dump-autoload


#### Configuração ####

3. Copiar arquivo .env e gerar key


3.1 cp .env.example .env


3.2 php artisan key:generate


4. Configurar os dados de acesso ao banco

4.1
[DB_CONNECTION=sqlite]
[DB_FOREIGN_KEYS=true]

4.2 Criar o arquivo `database.sqlite` dentro da pasta /database

5. Iniciar as configurações para criação da estrutura do banco de dados:

5.1 php artisan migrate


6. Criar os dados de teste utilizando seeder

6.1 php artisan db:seed


#### Inicialização ####

7. Executar o sistema


7.1 php artisan serve


#### Ex.: ####

A conta padrão criada pela seeder é a seguinte:

********************************
{
    "nome": "Andre Gouveia",
    "password" : "1234",
    "numero_conta" : "321",
    "codigo_conta" : "08",
    "saldo" : 850,
    "agencia": "793"
}
*********************************



####  Padrão Utilizado ####

[PSR-2](http://www.php-fig.org/psr/psr-2/)

#### Distribuição ####

-> Controller
     -> Service 
        -> Repository 
            -> Model

