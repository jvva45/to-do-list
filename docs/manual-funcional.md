# Documentação Técnica — Lista de Tarefas (To-Do List)

## 1. Descrição Geral do Sistema

O sistema **Lista de Tarefas (To-Do List)** é uma aplicação web desenvolvida em **PHP**, utilizando uma arquitetura **MVC (Model-View-Controller) simplificada**.  
Seu principal objetivo é permitir que usuários autenticados gerenciem suas tarefas pessoais de forma eficiente.

A aplicação utiliza:

- **MySQL** para persistência de dados;
- **AJAX (via jQuery)** para proporcionar uma experiência de usuário mais dinâmica no Dashboard, permitindo busca e filtragem de tarefas sem recarregamento da página.

---

## 2. Telas Principais

| Tela          | Rota                     | Descrição                                                 |
| ------------- | ------------------------ | --------------------------------------------------------- |
| Login         | `/login`                 | Permite o acesso de usuários já cadastrados.              |
| Cadastro      | `/cadastro`              | Permite a criação de novas contas de usuário.             |
| Dashboard     | `/dashboard`             | Tela principal para visualizar, buscar e filtrar tarefas. |
| Nova Tarefa   | `/tarefa/nova`           | Formulário para inclusão de uma nova tarefa.              |
| Editar Tarefa | `/tarefa/editar?id={id}` | Formulário para edição dos dados de uma tarefa existente. |

---

## 3. Passo a Passo para Utilização

 Clonar o repositório

git clone https://github.com/jvva45/to-do-list.git
cd to-do-list
cd public
php -S localhost:8000

### 3.1. Acesso e Autenticação

1. **Cadastro**

   - Na tela de Login, clique no link para acessar a tela de Cadastro.
   - Preencha **nome**, **e-mail** e **senha** para criar uma nova conta.

2. **Login**
   - Utilize o e-mail e a senha cadastrados para acessar o sistema.
   - Após o login, o usuário é redirecionado automaticamente para o **Dashboard**.

---

### 3.2. Gerenciamento de Tarefas (Dashboard)

O **Dashboard** é o centro de controle do usuário.

#### 3.2.1. Criação de Tarefa

- Clique no botão **➕ Nova Tarefa**;
- Preencha:
  - **Título**
  - **Descrição**
  - **Data Limite**
- O status inicial da tarefa é **pendente**;
- Clique em **Salvar**.

---

#### 3.2.2. Busca e Filtro

- Utilize o campo de busca no topo da página para pesquisar tarefas por **título** ou **descrição**;
- A busca é dinâmica, realizada via **AJAX**;
- Utilize os botões de filtro:
  - **Pendentes**
  - **Concluídas**
  - **Todas**
- O filtro ativo recebe a classe CSS `active`.

---

#### 3.2.3. Ações Rápidas

Cada tarefa listada possui ícones de ação:

- ✅ **Concluir** (ícone de check):  
  Altera o status da tarefa para **concluída**.

- ✏️ **Editar** (ícone de lápis):  
  Redireciona para o formulário de edição da tarefa.

- 🔄 **Reabrir** (ícone de seta circular):  
  Disponível apenas para tarefas concluídas, altera o status para **pendente**.

- 🗑️ **Excluir** (ícone de lixeira):  
  Remove a tarefa permanentemente do sistema.

---

## 4. Instalação e Configuração Local

Para executar o projeto localmente, é necessário um ambiente compatível com **PHP** e **MySQL**.

---

### 4.1. Pré-requisitos

- **PHP 7.4** ou superior (recomendado);
- **MySQL**

#### 4.2.1. Estrutura de Arquivos

Descompacte o projeto mantendo a seguinte estrutura principal:

```text
to-do-list/
├── app/
├── database/
└── public/
```
