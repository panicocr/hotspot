# Hotspot - Autocadastro no Captive Portal #

1. [Necessidade]()
2. [Ideia]()
3. [Instalação e Configuração]()
4. [ChatGPT]()
5. [Bugs Conhecidos]()
6. [Roadmap]()

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

![Diagrama](https://github.com/panicocr/hotspot2/blob/main/diagramas/Diagrama.png)

## Instalação e Configuração ##
### PFSense, Captive Portal e FreeRadius ###
## Páginas do Captive Portal PFSense ##
São 3 páginas que vamos utilizar para o Captive Portal do PFSense. Todas as páginas estão em um padrão. Para alterá-las basta mudar conforme sua necessidade.
Vamos ativar as opções para utilização dessas páginas customizadas.
> [!TIP]
> Todas as configurações devem ser feitar no Menu **Services** -- **Captive Portal**. Selecione o ecossistema de interesse para configuração.

```
Captive Portal -- Configuration -- Captive Portal Configuration -- Use custom captive portal page
```
![Diagrama](https://github.com/panicocr/hotspot2/blob/main/diagramas/CaptivePortal1.png)
Ative o campo.
```
Captive Portal -- Configuration -- HTML Page Contents -- Portal page contents
```
Adicione o arquivo _index.html_
```
Captive Portal -- Configuration -- HTML Page Contents -- Auth error page contents
```
Adicione o arquivo _error.html_
```
Captive Portal -- Configuration -- HTML Page Contents -- Logout page contents
```
Adicione o arquivo _logout.html_
Na aba 
> [!TIP]
> Dica para você fazer de prima.

Agora vamos traduzir os erros que são apresentados na tela de avisos e erros.

### VLAN ###
### Apache e MySQL ###
### Let's Encrypt ###

## Bugs Conhecidos ##
1. Campo Login (CPF) da tela de cadastro aceita CPF válido com mais caracteres.
2. Campo Login (CPF) da tela de cadastro aceita CPF com pontos.

## Roadmap ##
1. - [x] Fazer tela de Logout.
2. - [] Criptografia de Senha em BD.
3. - [] Fazer tela menor para ser mais compatível com celulares.
