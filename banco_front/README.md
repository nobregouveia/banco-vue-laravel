#### Banco da Capgemini #### 

#### Instalação ####
------------------------------
1. Clonar o repositório;
2. Acessar a raiz do projeto 'cd banco_front';
3. Executar `yarn` para instalar as depenências (Preferêncialmente deve-se usar 'yarn' --#(https://yarnpkg.com/getting-started/install);
------------------------------

#### Configuração ####
------------------------------
4. Copiar o arquivo '.env'


cp .env.example .env


5. Executar `yarn serve` para iniciar o servidor


#### Compilar e minificar para produção ####

Executar `yarn build`

#### Listar arquivos ####

Executar `yarn lint`


#### Estrutura de pastas ####


└── public
└── src
    ├── assets/ # itens, imagens e icones usados na aplicação
    ├── components/ # componentes compartilháveis em toda aplicação
    ├── router/ # configurações das rotas
    ├── services/ # configuração de serviços utilizados
    ├── styles/ # variáveis de configurações
    ├── views/ # páginas da aplicação


#### Variáveis de ambiente: ####


VUE_APP_API_SERVER=http://127.0.0.1:8000/api


#### Descrição das variáveis: ####

`VUE_APP_API_SERVER`= informar url do back-end