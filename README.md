# Time API

[![Maintainability](https://api.codeclimate.com/v1/badges/cf99c95fad5e80d93d06/maintainability)](https://codeclimate.com/github/time-api/time-api/maintainability)

[![Test Coverage](https://api.codeclimate.com/v1/badges/cf99c95fad5e80d93d06/test_coverage)](https://codeclimate.com/github/time-api/time-api/test_coverage)


Time API will be a microservice API for storing time-related data, especially in time tracking applications. It handles timestamps as well as intervals and may be used for the following time tracking entities:

* clock-in/clock-out events (attendance, breaks etc.) ("Max left office on 16:20.")
* project-related time entries ("2 hours on project Foo")
* vacations, absences ("on vacation from 2019-09-01 until 2019-09-07")

Beyond that, Time API could also be used for any other time-based data:

* Bookings of cars, boats, apartments etc.
* Position tracking over time
* Project management: project phases, work items, milestone
* Calendar items

## Docker configuration

### Development

Time API comes with Docker Compose support. To build and run all needed containers in development, use the following commands:

~~~bash
$ docker-compose build
$ docker-compose up
~~~

Docker Compose will launch the following containers:

* `php` - PHP FPM 
* `nginx`- Nginx web server
* `mongo` - MongoDB
* `mongoexpress` - Web UI for MongoDB

The API is available at `http://localhost`

Note that both `docker-compose.yml` and `docker-compose.override.yml` are used by default.

### Production

To build and run containers in production mode (or to run final tests), docker-compose must only use the `docker-compose.yml` file.

~~~bash
$ docker-compose -f docker-compose.yml build
$ docker-compose -f docker-compose.yml up
~~~
