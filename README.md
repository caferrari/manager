# Manager

[![Build Status](https://travis-ci.org/secom-tocantins/manager.png?branch=master)](https://travis-ci.org/secom-tocantins/manager)
[![Dependency Status](https://www.versioneye.com/user/projects/51a4d198063e450002012a75/badge.png)](https://www.versioneye.com/user/projects/51a4d198063e450002012a75)

Gerênciador Integrado de Órgão Público

## Dependências

Este projeto possui as seguintes dependências:

 * Postgres >= 9.1
 * PHP >= 5.4
 * Git

## Configurando uma maquina para desenvolvimento no Ubuntu

Instale as dependências:

```sh
sudo apt-get install postgresql php5-cli php5-curl php5-pgsql php5-intl curl git
```

### Configuração do Postgres

Edite o arquivo

```sh
sudo nano /etc/postgresql/9.1/main/pg_hba.conf
# (Substitua o 9.1 para a versão que você instalou do postgres)
```

Na linha que contêm o seguinte host:

```sh
host    all             all             127.0.0.1/32            md5
```

Altere o password para trust, ficando assim:

(Lembre-se que está configuração é para desenvolvimento e testes)

```sh
host    all             all             127.0.0.1/32            trust
```

Em seguida reinicie o postgres

```sh
sudo service postgresql restart
```

E a instalação está pronta


### Instalando o projeto

Clone o projeto do github para sua maquina:

```sh
git clone git://github.com/secom-tocantins/manager.git
```

Agora entramos na pasta do projeto utilizamos o make para configurar tudo

```sh
cd manager
make setup
```

Aguarde o composer atualizar e instalar as dependências e estará tudo pronto.

### Testando o projeto

Para rodar a suite de testes do PHPUnit, utilize o seguinte comando na pasta do projeto:

```sh
make test
```

### Para rodar o projeto vamos utilizar o servidor built-in do PHP

```sh
make server
```

