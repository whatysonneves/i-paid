# WnIPaid

Você é desenvolvedor e tem vários sites para gerenciar? Às vezes seus clientes demoram muito para te pagar? Que tal usar uma solução pouco ortodóxa para controlar isso?
Eu desenvolvi um pequeno código em PHP e JavaScript para que você possa colocar um alerta no site do seu cliente quando ele estiver inadimplente :D

## Como funciona

O código é responsável por gerar um arquivo JavaScript com uma mensagem caso o cliente esteja em atraso.
1. Você hospeda o código no seu site e configura ele;
2. O site do cliente acessa o código no seu site;
3. O código identifica a _referer_ do site do cliente e valida se ele está em dias ou não.

## Como usar

É muito facil usar este código, basicamente ele funciona trabalhando em cima do arquivo `clients.json`, o domínio do cliente é a chave e o valor é se está em dias ou não, ou seja, caso o valor seja _false_ o cliente está em atraso, caso seja _true_ o cliente está em dias.

```json
{
	"alpha.com": true,
	"bravo.com": true,
	"charlie.com": false,
	"example.com": false
}
```

Dentro do site do cliente basta usar a _tag script_ lá no final, antes do `</body>`:

```html
<script language="javascript" type="text/javascript" src="//seusite.dev/i-paid/i-paid.php"></script>
```

## Aplicando ao meu site

Você pode fazer essa validação da forma que quiser. Por padrão, o código do arquivo `i-paid.php` faz a validação através do arquivo _json_. Mas você pode refatorar ele para que trabalhe melhor em seu site, em sua aplicação, no seu _framework_, etc...

## Evitando erros

Este código funciona como um JavaScript dinâmico, e alguns servidores/cliente são capazes de cachear o conteúdo do arquivo. Então se o conteúdo do seu script for cacheado no navegador do cliente, mesmo depois que você configurar que ele pagou, pode continuar exibindo a mensagem no site do cliente, o que não é bom. Para resolver isso, basta adicionar uma tag dinâmica no script no site do cliente:

```html
<script language="javascript" type="text/javascript" src="//seusite.dev/i-paid/i-paid.php?t=<?php echo time(); ?>"></script>
```

## Créditos

Agradeço ao [@DinhoPutz](https://twitter.com/DinhoPutz "@DinhoPutz") por me mostrar isso funcionando no site do [Mosteiro Pub](//mosteiropub.com.br/ "Mosteiro Pub").
