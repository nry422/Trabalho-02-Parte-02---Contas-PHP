# Contas a Pagar - CRUD com PHP e JSON

Sistema de gerenciamento de contas a pagar desenvolvido como exercício escolar.

## Tecnologias

- PHP (sem frameworks)
- HTML5 + Bootstrap 5 + Bootstrap Icons
- JSON como banco de dados local

## Funcionalidades

- Cadastrar, listar, editar e remover contas
- Validação de código duplicado em tempo real (sem recarregar a página)
- Tabela ordenada automaticamente por data de vencimento
- Datas vencidas destacadas em vermelho, data de hoje em negrito
- Total das contas calculado automaticamente no rodapé
- Modal de confirmação para remoção
- Alertas de feedback para cada operação

## Estrutura

```
/
├── index.php       # página principal com formulário e tabela
└── contas.json     # arquivo onde os dados são salvos
```

## Observações

- Não utiliza banco de dados nem AJAX
- Operações feitas via PHP puro com padrão PRG (Post/Redirect/Get)
- Validação de duplicidade feita no lado do cliente via JavaScript
