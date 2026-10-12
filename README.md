# HidroControl

Sistema web de monitoramento de uma usina hidrelétrica, desenvolvido como projeto acadêmico para aplicar conceitos de **PHP, Programação Orientada a Objetos (POO), HTML, CSS e controle de acesso por sessões**.

## Sobre o projeto

O HidroControl é uma aplicação que simula o acompanhamento das condições operacionais de uma usina hidrelétrica por meio de um painel de monitoramento.

O sistema apresenta informações sobre o nível do reservatório, a vazão de água, a potência gerada e as condições das turbinas. Também identifica situações que exigem atenção, como temperaturas elevadas e níveis inadequados do reservatório.

O projeto tem como objetivo demonstrar como conceitos de desenvolvimento web e orientação a objetos podem ser aplicados à representação de um cenário industrial.

## Funcionalidades

* **Autenticação:** tela de login para acesso ao sistema.
* **Controle de sessão:** restrição de acesso ao painel para usuários não autenticados.
* **Monitoramento da usina:** exibição de indicadores operacionais.
* **Monitoramento das turbinas:** apresentação da temperatura e do estado de funcionamento.
* **Verificação de temperatura:** classificação das condições térmicas em normal, atenção ou crítica.
* **Verificação do nível do reservatório:** identificação de níveis baixos, normais ou elevados.
* **Alertas operacionais:** apresentação de situações que precisam de verificação.
* **Interface responsiva:** adaptação do painel a diferentes tamanhos de tela.
* **Encerramento de sessão:** funcionalidade para sair do sistema com segurança.

> **Observação:** os indicadores operacionais são simulados para fins didáticos. O sistema não está conectado a sensores ou equipamentos físicos de uma usina.

## Tecnologias utilizadas

* **PHP:** lógica da aplicação e implementação das classes.
* **Programação Orientada a Objetos (POO):** organização do sistema em classes e objetos.
* **HTML5:** estrutura das páginas.
* **CSS3:** estilização da interface e responsividade.
* **Sessões PHP:** controle de acesso e autenticação.
* **Visual Studio Code:** ambiente de desenvolvimento.

## Estrutura do projeto

```text
hidrocontrol/
├── class/
│   ├── operadorclass.php
│   ├── turbinaclass.php
│   └── usinaclass.php
├── css/
│   └── style.css
├── src/
│   ├── icon.png
│   ├── index.png
│   ├── login.png
│   └── logo.png
├── index.php
├── login.php
├── logout.php
└── README.md
```

### Organização das classes

* **Operador:** representa o profissional responsável pela operação das turbinas.
* **Turbina:** representa uma turbina da usina, armazenando informações como nome, temperatura, estado de funcionamento e operador responsável.
* **Usina:** representa a usina hidrelétrica, armazenando seus indicadores operacionais e o conjunto de turbinas.

## Como executar o projeto

### Pré-requisitos

* PHP instalado ou um ambiente de desenvolvimento como o Laragon.
* Navegador web atualizado.

### Executando com o PHP

1. Baixe ou clone este repositório.

2. Abra a pasta do projeto no Visual Studio Code.

3. Abra o terminal na pasta raiz do projeto.

4. Execute o comando:

   ```bash
   php -S localhost:8000
   ```

5. Acesse a página de login pelo endereço:

   `http://localhost:8000/login.php`

6. Entre com as credenciais configuradas no código do projeto.

### Executando com o Laragon

1. Coloque a pasta `hidrocontrol` no diretório `www` do Laragon.
2. Inicie o servidor Apache.
3. Acesse o projeto pelo endereço local correspondente à configuração do Laragon.
4. Abra a página `login.php`.

## Acesso de demonstração

Caso as credenciais de demonstração originais ainda estejam configuradas no arquivo `login.php`, utilize:

* **Matrícula:** `1025`
* **Senha:** `123456`

Essas credenciais são destinadas exclusivamente ao ambiente acadêmico de demonstração. Não utilize credenciais fixas em aplicações reais.

## Objetivos de aprendizagem

Este projeto permite praticar:

* Criação e organização de classes em PHP.
* Definição de atributos privados, construtores e métodos.
* Relacionamento entre objetos.
* Organização do código em arquivos separados.
* Uso de condicionais para classificação de indicadores.
* Manipulação de arrays de objetos.
* Controle de acesso com sessões PHP.
* Integração entre PHP, HTML e CSS.
* Desenvolvimento de interfaces para monitoramento de informações.

## Limitações

O HidroControl é um protótipo acadêmico. Os dados são simulados, e o sistema não realiza controle físico das turbinas, leitura de sensores, persistência em banco de dados ou autenticação integrada a uma base de usuários.

## Autoria

Projeto acadêmico desenvolvido para estudos de Desenvolvimento de Sistemas Web e Programação Orientada a Objetos.

## Licença

Este projeto foi desenvolvido para fins educacionais. Caso deseje permitir seu uso, modificação e distribuição por terceiros, defina uma licença apropriada para o repositório.
