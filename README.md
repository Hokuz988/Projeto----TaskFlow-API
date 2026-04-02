# TaskFlow

<div align="center">

![TaskFlow Logo](https://img.shields.io/badge/TaskFlow-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

**Sistema de Gerenciamento de Projetos e Tarefas**

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)
[![Code Style](https://img.shields.io/badge/Code%20Style-Laravel-FF2D20?style=for-the-badge)](https://laravel.com/docs/contributions#code-style)

</div>

## 📋 Sobre o Projeto

O TaskFlow é uma aplicação web completa para gerenciamento de projetos e tarefas, desenvolvida com o framework Laravel. O sistema permite que usuários criem projetos, organizem tarefas, atribuam etiquetas e gerenciem equipes de forma eficiente e intuitiva.

### 🚀 Funcionalidades Principais

- **📁 Gestão de Projetos**: Crie, edite e organize projetos em um único lugar
- **✅ Sistema de Tarefas**: Gerencie tarefas com status, prioridades e prazos
- **🏷️ Etiquetas Personalizadas**: Categorize tarefas com etiquetas flexíveis
- **🔌 API RESTful**: Integração completa via API para aplicações externas
## 🛠️ Stack Tecnológico

### Backend
- **Framework**: Laravel 12.0
- **Linguagem**: PHP 8.4
- **Banco de Dados**: MySQL 8.0
- **ORM**: Eloquent ORM
- **Autenticação**: Laravel Sanctum
- **Validação**: Laravel Validator
- **Filas**: Laravel Queues

### Infraestrutura
- **Conteinerização**: Docker & Docker Compose
- **Servidor Web**: PHP Built-in Server
## 📁 Estrutura do Projeto

```
taskflow/
├── src/                    # Código fonte da aplicação Laravel
│   ├── app/
│   │   ├── Http/          # Controllers, middleware e requests
│   │   │   ├── Controllers/
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── TaskController.php
│   │   │   │   ├── TagController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Middleware/
│   │   │   └── Requests/
│   │   ├── Models/        # Modelos de dados (Project, Task, Tag, User)
│   │   ├── Services/      # Lógica de negócio e serviços
│   │   ├── Providers/     # Service providers
│   │   └── Exceptions/    # Manipulação de exceções
│   ├── config/            # Arquivos de configuração
│   ├── database/          # Migrations, seeds e factories
│   │   ├── migrations/
│   │   ├── seeders/
│   │   └── factories/
│   ├── routes/            # Definição de rotas (web, api, console)
│   ├── resources/         # Views, assets e linguagens
│   │   ├── views/
│   │   ├── js/
│   │   └── lang/
│   ├── storage/           # Arquivos de storage
│   ├── tests/             # Testes automatizados
│   └── public/            # Arquivos públicos
├── docker-compose.yaml    # Configuração dos contêineres
├── Dockerfile            # Configuração do contêiner PHP
└── README.md             # Este arquivo
```

## 🚀 Instalação e Configuração

### Pré-requisitos

- **Docker**: 20.10+ 
- **Docker Compose**: 2.0+
- **Git**: 2.30+
- **Memória RAM**: Mínimo 2GB (recomendado 4GB)
- **Espaço em Disco**: Mínimo 5GB disponível

### Requisitos Opcionais

- **PHP**: 8.4+ (para desenvolvimento local sem Docker)
- **Composer**: 2.0+
- **Node.js**: 18+ (para build de assets)
- **MySQL Client**: Para acesso direto ao banco

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone <URL-DO-REPOSITORIO>
   cd taskflow
   ```

2. **Inicie os contêineres Docker**
   ```bash
   docker-compose up -d
   ```

3. **Instale as dependências**
   ```bash
   docker-compose exec php composer install
   ```

4. **Configure o ambiente**
   ```bash
   docker-compose exec php cp .env.example .env
   docker-compose exec php php artisan key:generate
   ```

5. **Execute as migrações do banco de dados**
   ```bash
   docker-compose exec php php artisan migrate
   ```

6. **Acesse a aplicação**
   - **Aplicação Web**: http://localhost:8000
   - **API Base URL**: http://localhost:8000/api
   - **Banco de Dados**: localhost:3306
   - **Usuário**: laravel
   - **Senha**: laravel

### Configuração Adicional

#### Para Desenvolvimento Local

Se preferir desenvolver sem Docker:

1. **Instale as dependências locais**
   ```bash
   composer install
   npm install
   ```

2. **Configure o ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure o banco de dados**
   Edite o arquivo `.env` com suas credenciais MySQL

4. **Execute as migrações**
   ```bash
   php artisan migrate
   ```

5. **Inicie o servidor**
   ```bash
   php artisan serve
   ```

## 📖 Documentação da API

### Visão Geral

A API do TaskFlow segue os princípios RESTful e utiliza JSON para comunicação. Todos os endpoints requerem autenticação via token Bearer, exceto os endpoints públicos.

### Base URL
```
http://localhost:8000/api
```

### Formato de Resposta

```json
{
    "success": true,
    "data": {
        // dados da resposta
    },
    "message": "Operação realizada com sucesso",
    "meta": {
        "total": 100,
        "per_page": 15,
        "current_page": 1,
        "last_page": 7
    }
}
```

### Endpoints Principais

#### Autenticação
- `POST /api/auth/login` - Autenticar usuário
- `POST /api/auth/logout` - Deslogar usuário
- `POST /api/auth/register` - Registrar novo usuário
- `GET /api/auth/me` - Obter dados do usuário autenticado

#### Projetos
- `GET /api/projects` - Listar todos os projetos
- `POST /api/projects` - Criar novo projeto
- `GET /api/projects/{id}` - Exibir projeto específico
- `PUT /api/projects/{id}` - Atualizar projeto
- `DELETE /api/projects/{id}` - Excluir projeto
- `GET /api/projects/{id}/statistics` - Estatísticas do projeto

#### Tarefas
- `GET /api/projects/{project}/tasks` - Listar tarefas de um projeto
- `POST /api/projects/{project}/tasks` - Criar nova tarefa
- `GET /api/projects/{project}/tasks/{task}` - Exibir tarefa específica
- `PUT /api/projects/{project}/tasks/{task}` - Atualizar tarefa
- `DELETE /api/projects/{project}/tasks/{task}` - Excluir tarefa
- `PATCH /api/projects/{project}/tasks/{task}/status` - Alterar status da tarefa
- `PATCH /api/projects/{project}/tasks/{task}/priority` - Alterar prioridade da tarefa

#### Etiquetas
- `GET /api/tags` - Listar todas as etiquetas
- `POST /api/tags` - Criar nova etiqueta
- `GET /api/tags/{id}` - Exibir etiqueta específica
- `PUT /api/tags/{id}` - Atualizar etiqueta
- `DELETE /api/tags/{id}` - Excluir etiqueta
- `POST /api/tasks/{task}/tags` - Associar etiqueta à tarefa
- `DELETE /api/tasks/{task}/tags/{tag}` - Remover etiqueta da tarefa

#### Usuários
- `GET /api/users` - Listar usuários (admin)
- `GET /api/users/{id}` - Exibir perfil de usuário
- `PUT /api/users/{id}` - Atualizar perfil
- `GET /api/users/{id}/projects` - Projetos do usuário
- `GET /api/users/{id}/tasks` - Tarefas atribuídas ao usuário

### Exemplos de Uso

#### Criar um Projeto
```bash
curl -X POST http://localhost:8000/api/projects \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Novo Projeto",
    "description": "Descrição do projeto",
    "start_date": "2024-01-01",
    "end_date": "2024-12-31"
  }'
```

#### Listar Tarefas de um Projeto
```bash
curl -X GET "http://localhost:8000/api/projects/1/tasks?status=pending&priority=high" \
  -H "Authorization: Bearer {token}"
```

### Autenticação

A API utiliza Laravel Sanctum para autenticação. Inclua o token no header:

```
Authorization: Bearer {seu-token}
```

## 🧪 Testes

### Tipos de Testes

- **Unit Tests**: Testes unitários para modelos e serviços
- **Feature Tests**: Testes de funcionalidades completas
- **API Tests**: Testes específicos para endpoints da API
- **Browser Tests**: Testes de integração com navegador

### Executando Testes

#### Todos os Testes
```bash
docker-compose exec php php artisan test
```

#### Testes Específicos
```bash
# Testes unitários apenas
docker-compose exec php php artisan test --testsuite=Unit

# Testes de funcionalidade
docker-compose exec php php artisan test --testsuite=Feature

# Teste específico
docker-compose exec php php artisan test tests/Feature/ProjectTest.php

# Testes com filtro
docker-compose exec php php artisan test --filter="Project"
```

#### Cobertura de Código
```bash
# Gerar relatório de cobertura
docker-compose exec php php artisan test --coverage

# Cobertura em formato HTML
docker-compose exec php php artisan test --coverage-html=reports/coverage
```

### Boas Práticas de Testes

- Mantenha testes independentes
- Use factories para dados de teste
- Teste casos de sucesso e falha
- Mantenha cobertura acima de 80%
- Use nomes descritivos para testes

## 🔧 Comandos Úteis

### Desenvolvimento
```bash
# Iniciar servidor de desenvolvimento
docker-compose exec php php artisan serve --host=0.0.0.0

# Executar filas em segundo plano
docker-compose exec php php artisan queue:work --daemon

# Monitorar filas
docker-compose exec php php artisan queue:listen

# Limpar cache
docker-compose exec php php artisan cache:clear
docker-compose exec php php artisan config:clear
docker-compose exec php php artisan route:clear
docker-compose exec php php artisan view:clear

# Otimizar para produção
docker-compose exec php composer dump-autoload --optimize
docker-compose exec php php artisan config:cache
docker-compose exec php php artisan route:cache
```

### Banco de Dados
```bash
# Criar nova migration
docker-compose exec php php artisan make:migration create_projects_table

# Criar modelo com migration
docker-compose exec php php artisan make:model Project -m

# Criar controller
docker-compose exec php php artisan make:controller ProjectController --api

# Executar migrações
docker-compose exec php php artisan migrate

# Reverter última migration
docker-compose exec php php artisan migrate:rollback

# Resetar banco de dados
docker-compose exec php php artisan migrate:fresh

# Popular banco de dados
docker-compose exec php php artisan db:seed

# Fresh seed
docker-compose exec php php artisan migrate:fresh --seed
```

### Debug e Monitoramento
```bash
# Ver logs em tempo real
docker-compose exec php php artisan log:tail

# Limpar logs
docker-compose exec php php artisan log:clear

# Ver rotas registradas
docker-compose exec php php artisan route:list

# Ver configuração
docker-compose exec php php artisan config:show

# Status da aplicação
docker-compose exec php php artisan about
```

---

<div align="center">

[⬆ Voltar ao topo](#taskflow)

</div>
