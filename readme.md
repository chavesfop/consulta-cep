# Consulta CEP - Rodrigo Chaves
Esta API de consulta de CEP é um teste para processo seletivo.  
Funciona da seguinte maneira: consulta o CEP na tabela `cep_cache`, caso não encontre utiliza a API CEPManiaBR e insere na tabela `cep_cache`.

## Instalação
```
$ git clone https://github.com/chavesfop/consulta-cep
$ composer install
$ cp consulta-cep/.env.example consulta-cep/.env
$ vim consulta-cep/.env #neste momento ajuste as configurações de BD e insera um APP_KEY aleatório.
$ cd consulta-cep && php artisan migrate
```

## Todo
Consulta por `logradouro`, `localidade`, `uf` combinados.

# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
