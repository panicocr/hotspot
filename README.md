# Hotspot - Autocadastro no Captive Portal #

1. [Necessidade]()
2. [Ideia]()
3. [Instalação e Configuração]
4. [ChatGPT]()
5. [Bugs Conhecidos]()
6. [Features]()

## Necessidade ##
O projeto surgiu da ideia de um simples sistema de autocadastro para usuários visitantes da wifi. Não encontramos algo viável e simples no mercado, então criamos um sistema extremamente básico que atende as necessidades levantadas.
> Interface simples para autocadastro de usuário;
> 
> Registro de Login;
> 
> Redefinição de senha;

## Ideia ##
Sistema de Autocadastro criado com ChatGPT. Utiliza o Apache e Mysql. É usado em conjunto com PFSense FreeRadius e Captive Portal.
A ideia é simples e funcional.

![Diagrama](https://github.com/panicocr/hotspot2/blob/main/diagrama/Diagrama.png)

## Instalação e Configuração ##
### PFSense, Captive Portal e FreeRadius ###
## Páginas do Captive Portal PFSense ##
São 3 as páginas que vamos utilizar para o Captive Portal do PFSense.
Vamos ativar a opção para utilização dessas páginas customizadas.
Dentro das configurações do Captive Portal -- Configuration -- Captive Portal Configuration --

Alteradas as páginas conforme necessidade, basta configurará-las cada um
### VLAN ###
### Apache e MySQL ###
### Let's Encrypt ###

## Bugs Conhecidos ##
1. Campo Login (CPF) da tela de cadastro aceita CPF válido com mais caracteres.

## Features ##
1. Fazer tela de Logout.
2. Criptografia de Senha em BD.
