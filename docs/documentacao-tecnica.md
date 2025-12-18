# Documentação Técnica

## 1. Estrutura do Banco de Dados e Relacionamentos

O sistema utiliza um banco de dados relacional **MySQL**, denominado **`lista_de_tarefas`**.  
A estrutura é composta por duas tabelas principais: **`usuarios`** e **`tarefas`**.

---

### 1.1. Tabela `usuarios`

Armazena as informações de autenticação e identificação dos usuários do sistema.

| Coluna | Tipo de Dado | Restrições                  | Descrição                                |
| ------ | ------------ | --------------------------- | ---------------------------------------- |
| id     | INT          | PRIMARY KEY, AUTO_INCREMENT | Identificador único do usuário.          |
| nome   | VARCHAR(100) | NOT NULL                    | Nome completo do usuário.                |
| email  | VARCHAR(100) | NOT NULL, UNIQUE            | E-mail do usuário, utilizado para login. |
| senha  | VARCHAR(255) | NOT NULL                    | Senha do usuário armazenada como hash.   |

> 🔐 A senha deve ser armazenada de forma segura utilizando hash, conforme implementado no `AuthController`.

---

### 1.2. Tabela `tarefas`

Armazena os dados referentes às tarefas criadas pelos usuários.

| Coluna        | Tipo de Dado                  | Restrições                       | Descrição                                     |
| ------------- | ----------------------------- | -------------------------------- | --------------------------------------------- |
| id            | INT                           | PRIMARY KEY, AUTO_INCREMENT      | Identificador único da tarefa.                |
| usuario_id    | INT                           | NOT NULL, FOREIGN KEY            | Referência ao usuário proprietário da tarefa. |
| titulo        | VARCHAR(255)                  | NOT NULL                         | Título da tarefa.                             |
| descricao     | TEXT                          | NULL                             | Descrição detalhada da tarefa.                |
| status        | ENUM('pendente', 'concluida') | DEFAULT 'pendente'               | Estado atual da tarefa.                       |
| data_criacao  | TIMESTAMP                     | DEFAULT CURRENT_TIMESTAMP        | Data e hora de criação da tarefa.             |
| data_limite   | DATE                          | NULL                             | Data limite para conclusão da tarefa.         |
| atualizado_em | TIMESTAMP                     | NULL ON UPDATE CURRENT_TIMESTAMP | Data da última atualização do registro.       |

---

### 1.3. Relacionamento entre as Tabelas

O relacionamento entre as tabelas segue o modelo **Um para Muitos (1:N)**:

- Um usuário pode possuir **várias tarefas**;
- Uma tarefa pertence a **apenas um usuário**.

A chave estrangeira **`usuario_id`** na tabela `tarefas` garante a integridade referencial.  
A restrição **`ON DELETE CASCADE`** foi aplicada, garantindo que, ao excluir um usuário, todas as suas tarefas associadas sejam automaticamente removidas.

---

## 2. Descrição das Principais Funções, Classes e Scripts PHP

A aplicação segue um padrão de organização inspirado no **MVC (Model-View-Controller)**, promovendo separação de responsabilidades e melhor manutenção do código.

---

### 2.1. Scripts de Entrada e Roteamento

- **`public/index.php`**

  - Atua como **Front Controller** da aplicação;
  - Define o caminho base (`APP_PATH`);
  - Inicia a sessão;
  - Inclui as classes essenciais (`Router`, `AuthController`, `TarefaController`);
  - Define todas as rotas HTTP (GET e POST);
  - Executa o método `run()` do roteador.

- **`app/core/Router.php`**
  - Classe responsável por mapear:
    - URI da requisição (`$_SERVER['REQUEST_URI']`);
    - Método HTTP (`$_SERVER['REQUEST_METHOD']`);
  - Tipos de ações:
    - **String** (ex: `login.php`): carrega diretamente uma View;
    - **Array** (ex: `['TarefaController', 'listar']`): instancia o Controller e executa o método correspondente.

---

### 2.2. Classes de Controle (Controllers)

#### AuthController

Arquivo: `app/controllers/AuthController.php`  
Responsável pela autenticação de usuários.

- `handleCadastro()`  
  Processa o formulário de cadastro, valida os dados e registra um novo usuário.

- `handleLogin()`  
  Valida as credenciais do usuário e inicia a sessão.

- `handleLogout()`  
  Encerra a sessão ativa do usuário.

---

#### TarefaController

Arquivo: `app/controllers/TarefaController.php`  
Responsável pelo gerenciamento das tarefas (CRUD).

- `listar()`  
  Carrega o Dashboard (`dashboard.php`) com as tarefas do usuário.

- `listarAjax()`  
  Endpoint AJAX responsável por retornar apenas o HTML da lista de tarefas (`componentes/listar_tarefas.php`).

- `salvarTarefa()`
- `atualizarTarefa()`
- `concluirTarefa()`
- `reabrirTarefa()`
- `deletarTarefa()`

Esses métodos alteram o estado das tarefas no banco de dados, delegando as operações ao `TarefaModel`.

---

### 2.3. Classes de Modelo (Models)

- **`app/models/User.php`**

  - Modelo da tabela `usuarios`;
  - Contém métodos para criação e busca de usuários.

- **`app/models/TarefaModel.php`**
  - Modelo da tabela `tarefas`;
  - Implementa as operações CRUD, como:
    - `listarTarefas`
    - `salvarTarefa`
    - `concluirTarefa`
    - `reabrirTarefa`
    - `deletarTarefa`

---

## 3. Funcionamento das Requisições AJAX

A aplicação utiliza **AJAX** na tela de Dashboard para evitar recarregamentos de página e melhorar a experiência do usuário.

| Ação            | Método HTTP | Rota               | Controller / Método                | Descrição                                                                 |
| --------------- | ----------- | ------------------ | ---------------------------------- | ------------------------------------------------------------------------- |
| Busca / Filtro  | GET         | `/tarefa/listar`   | `TarefaController::listarAjax`     | Atualiza dinamicamente a lista de tarefas com base nos filtros aplicados. |
| Concluir Tarefa | POST        | `/tarefa/concluir` | `TarefaController::concluirTarefa` | Altera o status da tarefa para **concluída**.                             |
| Excluir Tarefa  | POST        | `/tarefa/excluir`  | `TarefaController::deletarTarefa`  | Remove a tarefa do sistema.                                               |
| Reabrir Tarefa  | POST        | `/tarefa/reabrir`  | `TarefaController::reabrirTarefa`  | Altera o status da tarefa para **pendente**.                              |

O código JavaScript responsável por essas requisições está localizado em:


app/views/layout/footer.php

