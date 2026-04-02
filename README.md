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
- **👥 Gestão de Usuários**: Sistema de autenticação e perfis de usuário
- **🔌 API RESTful**: Integração completa via API para aplicações externas
- **📱 Interface Responsiva**: Design moderno que funciona em todos os dispositivos
- **🔍 Busca e Filtros**: Encontre projetos e tarefas rapidamente
- **📊 Relatórios**: Visualize o progresso e estatísticas dos projetos
- **🔔 Notificações**: Mantenha-se atualizado com as atividades do projeto
- **🌐 Multi-idioma**: Suporte para português e inglês

## 🛠️ Stack Tecnológico

### Backend
- **Framework**: Laravel 12.0
- **Linguagem**: PHP 8.4
- **Banco de Dados**: MySQL 8.0
- **ORM**: Eloquent ORM
- **Autenticação**: Laravel Sanctum
- **Validação**: Laravel Validator
- **Filas**: Laravel Queues

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS
- **JavaScript**: Vanilla JS + Alpine.js
- **Build Tools**: Vite

### Infraestrutura
- **Conteinerização**: Docker & Docker Compose
- **Servidor Web**: PHP Built-in Server
- **Cache**: Redis (opcional)
- **Testes**: PHPUnit
- **Quality Code**: Laravel Pint

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

#### Ambiente de Produção

Para implantação em produção:

1. **Otimize a aplicação**
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Configure variáveis de ambiente**
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - Configure URLs e credenciais reais

3. **Configure web server** (Nginx/Apache) para apontar para `public/`

## 📖 Documentação da API

### Visão Geral

A API do TaskFlow segue os princípios RESTful e utiliza JSON para comunicação. Todos os endpoints requerem autenticação via token Bearer, exceto os endpoints públicos.

### Base URL
```
http://localhost:8000/api/v1
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

## 🤝 Contribuindo

Contribuições são bem-vindas! Por favor, siga estes passos:

### Fluxo de Contribuição

1. **Fork o repositório**
   - Clique no botão "Fork" no GitHub
   - Clone seu fork localmente

2. **Crie uma branch para sua feature**
   ```bash
   git checkout -b feature/nova-funcionalidade
   ```

3. **Faça suas mudanças**
   - Siga os padrões de código do projeto
   - Adicione testes para novas funcionalidades
   - Documente mudanças relevantes

4. **Teste suas mudanças**
   ```bash
   # Execute todos os testes
   php artisan test
   
   # Verifique o estilo do código
   php artisan pint
   ```

5. **Commit suas mudanças**
   ```bash
   git commit -am 'feat: adiciona nova funcionalidade'
   ```

6. **Push para a branch**
   ```bash
   git push origin feature/nova-funcionalidade
   ```

7. **Abra um Pull Request**
   - Descreva claramente suas mudanças
   - Link para issues relacionadas
   - Aguarde revisão

### Diretrizes de Contribuição

- **Código**: Siga os padrões PSR-12 e as convenções do Laravel
- **Testes**: Mantenha cobertura de testes acima de 80%
- **Commits**: Use [Conventional Commits](https://www.conventionalcommits.org/)
- **Documentação**: Atualize README e comentários conforme necessário
- **Branches**: Use prefixos: `feature/`, `bugfix/`, `hotfix/`, `docs/`

### Tipos de Contribuições

- 🐛 **Bug Fixes**: Correção de erros
- ✨ **Features**: Novas funcionalidades
- 📝 **Documentation**: Melhorias na documentação
- 🎨 **Style**: Formatação e estilo de código
- ♻️ **Refactor**: Refatoração de código
- ⚡ **Performance**: Melhorias de performance
- ✅ **Tests**: Adição ou melhoria de testes

### Código de Conduta

Por favor, siga nosso [Código de Conduta](CODE_OF_CONDUCT.md) em todas as interações.

## 📝 Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

### O que a Licença MIT Permite

- ✅ Uso comercial
- ✅ Modificação
- ✅ Distribuição
- ✅ Uso privado
- ✅ Patente (com limitações)

### O que Exige

- ⚠️ Incluir a licença e copyright
- ⚠️ Os autores não são responsáveis por danos

## 🐛 Problemas e Sugestões

Encontrou um bug ou tem uma sugestão? Por favor:

1. **Verifique issues existentes**: [Issues](../../issues)
2. **Crie uma nova issue**: Use templates apropriados
3. **Forneça detalhes**: Inclua passos para reproduzir
4. **Seja descritivo**: Use títulos claros e descrições detalhadas

### Tipos de Issues

- 🐛 **Bug Report**: Erros e problemas
- ✨ **Feature Request**: Novas funcionalidades
- 📝 **Documentation**: Problemas na documentação
- ❓ **Question**: Dúvidas e esclarecimentos

## 📞 Contato

- **Projeto**: TaskFlow
- **Autor**: [Seu Nome]
- **Email**: [seu.email@exemplo.com]
- **LinkedIn**: [Seu LinkedIn]
- **GitHub**: [@seu-username](https://github.com/seu-username)

## 🙏 Agradecimentos

- A equipe **Laravel** pelo framework incrível
- Comunidade **PHP** pelas ferramentas e bibliotecas
- Todos os **contribuidores** que ajudam a melhorar o projeto

## 📊 Estatísticas do Projeto

![GitHub stars](https://img.shields.io/github/stars/username/taskflow?style=social)
![GitHub forks](https://img.shields.io/github/forks/username/taskflow?style=social)
![GitHub issues](https://img.shields.io/github/issues/username/taskflow)
![GitHub pull requests](https://img.shields.io/github/issues-pr/username/taskflow)

## 🚀 Roadmap

### Versão 1.0 (Atual)
- ✅ Gestão básica de projetos
- ✅ Sistema de tarefas
- ✅ Autenticação de usuários
- ✅ API RESTful
- ✅ Interface responsiva

### Versão 1.1 (Planejada)
- 🔄 Notificações em tempo real
- 🔄 Relatórios avançados
- 🔄 Integração com Slack
- 🔄 Upload de arquivos

### Versão 2.0 (Futura)
- 📋 Dashboard analítico
- 📋 Gestão de equipes
- 📋 Integração com calendários
- 📋 Mobile app

## 🔒 Segurança

### Medidas de Segurança Implementadas
- **Autenticação**: Tokens JWT via Laravel Sanctum
- **Validação**: Validação rigorosa de inputs
- **CSRF Protection**: Proteção contra ataques CSRF
- **SQL Injection**: Uso de ORM Eloquent
- **XSS Protection**: Escapamento automático de dados
- **Rate Limiting**: Limitação de requisições

### Boas Práticas de Segurança
- Senhas hasheadas com bcrypt
- Variáveis de ambiente para dados sensíveis
- Logs de auditoria
- Atualizações regulares de dependências

## 🌍 Internacionalização

O TaskFlow suporta múltiplos idiomas:
- 🇧🇷 Português (Brasil)
- 🇺🇸 Inglês
- 🇪🇸 Espanhol (planejado)

### Adicionando Novos Idiomas

1. Crie o arquivo de idioma em `resources/lang/{codigo}/`
2. Traduza as strings existentes
3. Adicione o código em `config/app.php`
4. Envie um Pull Request!

## 📈 Performance

### Métricas de Performance
- **Tempo de resposta**: < 200ms (média)
- **Uso de memória**: < 128MB (por requisição)
- **Cache**: Redis para consultas frequentes
- **CDN**: Assets otimizados

### Otimizações
- Lazy loading de relacionamentos
- Query optimization
- Asset minification
- Database indexing

## 🔄 CI/CD

### Pipeline de Deploy

1. **Build**: Testes automatizados
2. **Quality**: Análise de código estático
3. **Security**: Scan de vulnerabilidades
4. **Deploy**: Deploy automático em produção

### Ferramentas Utilizadas
- **GitHub Actions**: CI/CD
- **PHPUnit**: Testes automatizados
- **Laravel Pint**: Formatação de código
- **PHPStan**: Análise estática

## 📚 Recursos Adicionais

### Documentação
- [Documentação Oficial Laravel](https://laravel.com/docs)
- [Guia de Contribuição](CONTRIBUTING.md)
- [Código de Conduta](CODE_OF_CONDUCT.md)
- [Changelog](CHANGELOG.md)

### Tutoriais e Guias
- [Como começar](docs/getting-started.md)
- [Guia da API](docs/api-guide.md)
- [Deploy em Produção](docs/deployment.md)
- [Solução de Problemas](docs/troubleshooting.md)

### Comunidade
- [Discord](https://discord.gg/taskflow)
- [Forum](https://forum.taskflow.dev)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/taskflow)

---

<div align="center">

**Feito com ❤️ usando Laravel**

[⬆ Voltar ao topo](#taskflow)

</div>
