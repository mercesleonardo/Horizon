# Horizon

## Descrição

Aplicação usando uma API para gerenciar o Circuito Mundial de Surfe

## Pré-requisitos

- PHP 8.1 ou superior
- Composer
- Laravel 10
- Postman(opcional)
- VsCode(opcional)

## Instalação

1. Clone o repositório: git clone `https://github.com/mercesleonardo/Horizon`
2. Navegue até o diretório do projeto: `cd horizon`
3. Instale as dependências: `composer install`
4. Copie o arquivo `.env.example para .env: cp .env.example .env`
5. Gere a chave do aplicativo: `php artisan key:generate`
6. Inicie o servidor: `php artisan serve`

## Configuração do Banco de Dados

Antes de começar a usar o projeto, você precisa configurar o acesso ao banco de dados. Aqui estão os passos para fazer isso:

1. Abra o arquivo .env na raiz do projeto.
2. Procure pelas seguintes linhas:

- DB_CONNECTION=mysql - Substitua mysql pelo tipo do seu banco de dados.
- DB_HOST=127.0.0.1 - Substitua 127.0.0.1 pelo endereço do seu servidor de banco de dados.
- DB_PORT=3306 - Substitua 3306 pela porta do seu servidor de banco de dados.
- DB_DATABASE=homestead - Substitua homestead pelo nome do seu banco de dados.
- DB_USERNAME=homestead - Substitua homestead pelo seu nome de usuário do banco de dados.
- DB_PASSWORD=secret - Substitua secret pela sua senha do banco de dados.

3. Após a configuração, você pode rodar o comando: `php artisan migrate`

## Testando a API com Postman

1. **Instale o Postman**: Se você ainda não tem o Postman instalado, você pode baixá-lo do site oficial do Postman.

2. **Lista das rotas**: No VsCode rode o comando `php artisan route:list` para saber as rotas e os parâmetros.

3. **Selecione a requisição**: Você poderá incluir uma lista de requisições na barra lateral esquerda. Escolha na requisição que você deseja testar.

4. **Envie a requisição**: Depois de selecionar a requisição, clique no botão "Send" para enviar a requisição para a API. Você verá a resposta da API no painel à direita.

5. **Examine a resposta**: Você pode examinar a resposta da API no painel à direita. Isso inclui o status da resposta, os cabeçalhos da resposta e o corpo da resposta.

6. **Modifique a requisição**: Se necessário, você pode modificar a requisição e enviá-la novamente. Por exemplo, você pode alterar o método da requisição (GET, POST, etc.), adicionar parâmetros à URL, adicionar cabeçalhos à requisição, ou adicionar um corpo à requisição.

7. **Repita as etapas 3-6**: Repita as etapas 3-6 para cada requisição que você deseja testar.


## Licença

Este projeto está licenciado sob a licença MIT.

## Contato

Se você tiver alguma dúvida ou sugestão, sinta-se à vontade para entrar em contato:

- Email: `leonardokarvalho@gmail.com`
- LinkedIn: `https://www.linkedin.com/in/mercesleonardo/`


