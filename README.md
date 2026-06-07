# 💰 CONTROLE-FINANCEIRO
Sistema web de controle financeiro pessoal focado em gestão de investimentos, desenvolvido em PHP puro com MySQL.

-----------------------------------------------------------

## 📋 Sobre o Projeto

O **CONTROLE-FINANCEIRO** permite que o usuário acompanhe sua carteira de investimentos de forma simples e organizada, registrando ativos, compras, dividendos recebidos e visualizando relatórios e gráficos de desempenho.

-----------------------------------------------------------

## ✨ Funcionalidades
- 📊 **Dashboard** com visão geral da carteira
- 📈 **Gráficos** de desempenho dos investimentos
- 🏦 **Ativos** — cadastro e gerenciamento de ações e outros ativos
- 🛒 **Compras** — registro de compras de ativos
- 💵 **Dividendos** — controle de dividendos recebidos
- 📄 **Relatórios** — geração de relatórios financeiros
- 👤 **Usuários** — autenticação, registro e gerenciamento de conta

-----------------------------------------------------------
## 🛡️ Segurança

O projeto implementa boas práticas de segurança, incluindo:
- **Proteção CSRF** em todos os formulários
- **Content Security Policy (CSP)** com nonces dinâmicos
- **Cookies seguros** com flags `HttpOnly` e `SameSite`
- Validação e sanitização de entradas
-----------------------------------------------------------

## 🗂️ Estrutura de Pastas

```
CONTROLE-FINAN/
│
├── classes/          # Classes PHP (lógica de negócio)
├── css/
│   └── style.css     # Estilização global (tema escuro com acentos dourados)
├── js/               # Scripts JavaScript
├── partials/         # Componentes reutilizáveis (header, footer, nav)
├── seguranca/        # Utilitários de segurança (CSRF, CSP)
│
├── index.php         # Dashboard principal
├── login.php         # Página de login
├── registro.php      # Cadastro de usuário
├── logout.php        # Encerramento de sessão
├── editar_usuario.php
├── ativos.php
├── compras.php
├── dividendos.php
├── grafico.php
├── relatorio.php
├── usuarios.php
└── functions.php     # Funções auxiliares globais
```

-----------------------------------------------------------

## 🎨 Interface

- Tema **dark** com acentos em **dourado**
- Estilização centralizada em um único arquivo `css/style.css`
- Layout responsivo

-----------------------------------------------------------

## 🚀 Como Executar

### Pré-requisitos

- PHP 7.4+
- MySQL / MariaDB
- Servidor web (Apache via XAMPP, WAMP ou similar)

### Passos

1. Clone o repositório para a pasta do servidor (ex: `htdocs/` no XAMPP)
   ```bash
   git clone https://github.com/Gigi-comp/controle-financeiro.git
   ```

2. Configure o banco de dados:
   ```bash
   cp classes/Database.example.php classes/Database.php
   ```
   Abra o `classes/Database.php` e preencha com suas credenciais:
   ```php
   private $host = 'localhost';
   private $port = '3306';
   private $db   = 'nome_do_seu_banco';
   private $user = 'seu_usuario';
   private $pass = 'sua_senha';
   ```

3. Crie o banco de dados no MySQL (via phpMyAdmin ou CLI) e importe o arquivo `.sql` com a estrutura das tabelas

4. Acesse via navegador: `http://localhost/CONTROLE-FINAN`

-----------------------------------------------------------

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Uso |
|---|---|
| PHP | Backend e lógica da aplicação |
| MySQL | Banco de dados |
| HTML/CSS | Interface |
| JavaScript | Interatividade e gráficos |
| XAMPP | Ambiente de desenvolvimento local |

---

## 👩‍💻 Autora

Gislaine Rodrigues