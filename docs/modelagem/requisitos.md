# Requisitos do Sistema

## Resumo

Este documento pretende apresentar os requisitos do sistema, que foram levantados a partir de entrevistas com o cliente
e com base no problema apresentado.

Esta é uma plataforma de ensino. Visando fornecer apoio ao ensino de matérias do ensino médio e fundamental. Com foco
principal na gamificação do ensino.
Fornecendo **ranking** de alunos, **medalhas** e **pontuações**.

O sistema deve permitir a criação de **disciplinas**. Cada disciplina deve conter **módulos** e **questionários**.
A plataforma deve poder ser acessada por alunos e professores. Os professores serão responsáveis por criar e gerenciar
os **módulos**, **lições** e **questionários** das **disciplinas**. Os alunos poderão acessar os módulos e atividades criadas pelos
professores.

## Estrutura organizacional do conteúdo

O sistema deve permitir a criação de **disciplinas**. Cada disciplina deve conter **módulos**, **lições** e **questionários**.
Os **módulos** devem conter **lições** e **questionários**. As **lições** devem conter conteúdo textual e/ou multimídia.

## Requisitos Funcionais

### RF01 - Cadastro de Usuário

O sistema deve permitir o cadastro de usuários. O cadastro deve conter os seguintes campos:

- Nome
- E-mail
- Senha
- Tipo de Usuário (Aluno, Professor ou Administrador)

### RF02 - Login

O sistema deve permitir o login de usuários. O login deve ser feito com e-mail e senha.

### RF03 - Cadastro de Disciplina

O sistema deve permitir o cadastro de disciplinas. O cadastro deve conter os seguintes campos:

- Nome
- Descrição
- Professor Responsável
- Área de Conhecimento
- Ano/Série

### RF04 - Cadastro de Módulo

O sistema deve permitir o cadastro de módulos. O cadastro deve conter os seguintes campos:

- Nome
- Descrição
- Disciplina

### RF05 - Cadastro de Questionário

O sistema deve permitir o cadastro de questionários. O cadastro deve conter os seguintes campos:

- Nome
- Descrição
- Módulo
- Perguntas
- Respostas

### RF05.1 - Cadastro de Perguntas

O sistema deve permitir o cadastro de perguntas.

Cada pergunta deve conter os seguintes campos:

- Enunciado
- Tipo de Pergunta (Múltipla Escolha, Verdadeiro ou Falso, Dissertativa)
- Respostas (para perguntas que não são dissertativas)
- Resposta Correta (para perguntas que não são dissertativas)
- Pontuação

As perguntas podem ser do tipo:

- Múltipla Escolha
    - Com uma única resposta correta
    - Com múltiplas respostas corretas
- Verdadeiro ou Falso
- Dissertativa

#### Múltipla Escolha

Para perguntas do tipo Múltipla Escolha, deve se aplicar as seguintes regras:

- 5 respostas exatamente

#### Verdadeiro ou Falso

Para perguntas do tipo Verdadeiro ou Falso, as respostas devem ser Verdadeiro ou Falso.
Criadas automáticamente pelo sistema. Sem possibilidade de alteração.

#### Dissertativa

Para perguntas do tipo Dissertativa, não é possível cadastrar respostas. A pontuação deve ser definida pelo professor somente
após a correção. A pontuação será atribuída na resposta do aluno.

### RF05.2 - Cadastro de Respostas

O sistema deve permitir o cadastro de respostas. As respostas devem conter os seguintes campos:

- Conteúdo

Não é necessário cadastrar respostas para perguntas do tipo Dissertativa e Verdadeiro ou Falso.

### RF05.3 - Seleceção de Respostas Corretas

O sistema deve permitir o cadastro de respostas corretas.

Para perguntas do tipo Múltipla Escolha com uma única resposta correta: a resposta correta deve ser selecionada dentre
as respostas cadastradas.

Para perguntas do tipo Múltipla Escolha com múltiplas respostas corretas: as respostas corretas devem ser selecionadas
dentre as respostas cadastradas.

Para perguntas do tipo Verdadeiro ou Falso: a resposta correta deve ser selecionada dentre as escolhas Verdadeiro ou
Falso.

### RF06 - Atualizar Pergunta

O sistema deve permitir a atualização de perguntas. Uma pergunta pode ser atualizada a qualquer momento.

Podem ser atualizados os seguintes campos:

- Para perguntas do tipo Múltipla Escolha:
    - Enunciado
    - Respostas:
        - Conteúdo
    - Resposta Correta
- Para perguntas do tipo Verdadeiro ou Falso:
    - Enunciado
    - Resposta Correta
- Para perguntas do tipo Dissertativa:
    - Enunciado

A atualização pode marcar a pergunta como anulada na **resposta** do aluno, caso a pergunta
seja considerada inválida.

A pergunta será considerada inválida automaticamente se:

- Houver alteração entre quais respostas são corretas e quais não são.

A pergunta será considerada inválida manualmente se:

- Seja considerada inválida pelo professor ou administrador.

A pergunta não deve ser excluída, apenas marcada como anulada.

### RF07 - Responder Questionário

O sistema deve permitir que os alunos respondam questionários. A resposta deve conter as respostas para cada pergunta
do questionário.

A pontuação do aluno deve ser calculada com base nas respostas corretas e na pontuação de cada pergunta. A pontuação
total do questionário deve ser guardada no sistema.






