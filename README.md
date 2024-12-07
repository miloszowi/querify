<p align="center"> 
<img src="https://github.com/miloszowi/querify/actions/workflows/app.yml/badge.svg" alt="pipeline status" />
</p>
<h1 align="center">Querify </h1>
<p align="center">Web application to serve production services demands.</p>


## Requirements
* PHP 8.3 or newer
* PostgreSQL 16 or newer
* RabbitMQ 3.*

## Quick Start
Clone the repository
```
$ git clone git@github.com:miloszowi/querify.git
```
run
```
$ docker/start
```
to setup everything at once - querify should be available on localhost.


## Running tests
Querify uses the following to analyse & test code:
- **phpspec** for unit testing
- **phpunit** for integration & functional tests
- **phpstan** for static code analysis
- **csfixer** for detecting code standards
- **deptrac** for architecture static code analysis

to run all of them at once:
```bash
$ docker/tests
```
or inside the container 
```bash
$ composer tests
```

for specific case, use one of those (inside a container):
```bash
$ composer phpspec
$ composer phpunit
$ composer phpstan
$ composer csfixer-check
$ composer deptrac
```



