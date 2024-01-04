# Dr.Place - Projeto para cadastro de imóveis

O projeto não foi finalizado, o cliente me contratou na época em 2018 para desenvolver essa plataforma, mas ele acabou cancelando durante o desenvolvimento e não dei andamento. Mas da para ter uma ideia de como eu criei e desenvolvi.

A ideia era a plataforma Dr.Place ser acessada e o proprietário do imóvel fazer a negociação de venda ou aluguel do imóvel direto com o proprietário, teríamos alguns advogados parceiros na plataforma para ajudar esses usuários na negociação ou formulação de contratos e tramites jurídicos e demais assuntos.

Pode ser que algumas funcionalidades não esteja funcionando 100%, mas cadastrei um imóvel de teste e um artigo para a plataforma ser navegável.

Para acessar a área administrativa, usa o /admin e o /painel é a area do usuário para cadastrar e gerenciar os imóveis, se quiser pode criar uma nova conta e fazer novos cadastros, essa base de dados é de teste.

Denis, qualquer dúvida ou se quiser que eu explique alguma parte do porque eu fiz desta maneira ou coisas do tipo pode me chamar.

## Instalação

Com o docker instalado, executar o comando:

```bash
docker-compose up -d
```

Depois instalar as dependencias utilizando o composer, usando o comando:

```bash
docker exec imo-drplace composer install
```

O banco de dados está em um servidor externo, os dados de acesso estão no arquivo application/config/database.php (se você quiser rodar o dump para executar o banco localmente).

## Dados de Acesso

E-mail: andre@andrewd.com.br

Senha: 123