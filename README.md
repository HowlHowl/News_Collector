# Coletor de Notícias do Mercado Financeiro

Implementação de uma aplicação web capaz de coletar notícias jornalísticas 
sobre empresas brasileiras disponibilizadas no portal https://www.reuters.com/finance.

As notícias coletadas serão armazenadas em um banco de dados, que futuramente será utilizado 
como requisito parcial para implementação do meu Trabalho de Conclusão de Curso para o curso 
de Ciência da Computação no Instituto Federal de Brasília (IFB).

## Ferramentas utilizadas
- Linguagem de programação: PHP 8.0
- Laravel: Framework para o desenvolvimento de sistemas web que utilizam o padrão Model View Controller (MVC).

## Status do projeto
1. Criação do script responsável por interagir com a API do portal, requisitando o código HTML 
de cada uma das páginas web contendo notícias sobre as empresas selecionadas.
2. Filtragem do código HTML das notícias coletadas, a fim de extrair apenas os atributos desejados de cada 
notícia: Título, corpo, data de publicação e código da empresa.
3. Criação das migrações para população do banco de dados com os dados coletados.

## Dificuldades Encontradas
- Decifrar exatamente como funciona a API do Reuters.
- Coletar notícias publicadas há muito tempo no portal.
