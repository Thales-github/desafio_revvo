# Thales Vitor Oliveira Cirino - Desafio Revvo

Aperte CTRL + SHIFT + V para melhor visualização

Este projeto é uma API REST desenvolvida em **PHP 8** e **MySQL**, permitindo o gerenciamento de cursos e seus anexos.

## 📌 Requisitos

- **PHP 8** ou superior
- **MySQL** (banco de dados)

## 📖 Funcionalidades

- **CRUD de Cursos** (Criar, Listar, Atualizar, Deletar)
- **CRUD de Anexos** (Cada curso pode ter um anexo)

## 📜 Documentação

A documentação da API pode ser encontrada em:  
`documentacao/`

## 🔒 Segurança

O sistema de roteamento conta com algumas medidas de segurança, como:

- **Limite de tamanho para arquivos** (evita uploads muito grandes)
- **Proteção contra tipos de arquivos falsos** (impede que arquivos com extensões alteradas burlem as regras)
- **Tratamento de rotas inexistentes** (impede acesso a rotas inválidas)

## 🚀 Como rodar o projeto

1. Configure o ambiente com **PHP 8** e **MySQL**
2. Importe o banco de dados necessário: `documentacao/bd/scripts.sql`
3. Configure a conexão no arquivo de configuração: `classes/bd/conexao.php`
4. Utilizei no desenvolvimento o Insomnia Rest para testar a api, mas caso o seu cliente http seja outro eu deixei imagens com os exemplos de chamada da api também em `documentacao/api/`
5. A url base para chamar as rotas da API é: `localhost/desafio-revvo/`
5. Inicie o servidor e comece a usar a API!

## 📖 Funcionalidades

- **CRUD de Cursos**:  
  Permite criar, listar, atualizar e deletar cursos.
- **CRUD de Anexos**:  
  Cada curso pode ter um anexo.

---
📌 *Desenvolvido para o desafio Revvo por Thales Vitor Oliveira Cirino*
