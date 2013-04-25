VERSION	   = 0.1.13
SHELL		:= $(shell which bash)
.SHELLFLAGS = -c

.SILENT: ;			   # no need for @
.ONESHELL: ;			 # recipes execute in same shell
.NOTPARALLEL: ;		  # wait for this target to finish
.EXPORT_ALL_VARIABLES: ; # send all vars to shell
default: help-default;   # default target
Makefile: ;			  # skip prerequisite discovery

help-default help:
	@echo "======================================================="
	@echo "					Options"
	@echo "======================================================="
	@echo "          test: Execute TDD tests"
	@echo "         setup: Configure the project in this machine"
	@echo "        server: Execute with php webserver"
	@echo ""

test:
	vendor/bin/phpunit --configuration tests/phpunit.xml

server:
	php -S 127.0.0.1:8080 -t public/

setup:
	curl -sS https://getcomposer.org/installer | php
	php composer.phar install --dev --prefer-dist
	-psql -h 127.0.0.1 -c 'create database manager_test;' -U postgres
	-psql -h 127.0.0.1 -c 'create database manager_dev;' -U postgres
	cp config/autoload/doctrine_orm.local.php.dist  config/autoload/doctrine_orm.local.php
	php vendor/bin/doctrine-module orm:schema-tool:create
