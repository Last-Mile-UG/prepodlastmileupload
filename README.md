## Local setup

This project uses [Docker](https://docs.docker.com/install/)
and [Docker Compose](https://docs.docker.com/compose/install/).
Ensure you have both installed.

#### Setup steps

**1. .env file deployment**
Copy `.env.dist` file into `.env` file. Update parameters if needed.
This will prepare env variables required for installation

**2. Environment setup**
Run `docker-compose up -d` within project's root directory.

This will deploy all necessary containers to run application

**3. Application setup**
Run `.docker/update.sh` to build all the project's dependencies.
This will install composer dependencies, runs migrations, clears env,
builds assets and updates Laravel plugin assets.

**4. Application shutdown**
To shutdown application and deployed environment run `docker-compose down`
within project's root directory

## Run application
After setup is finished your application can be reached from the localhost:
[http://localhost:8011] - the main application entrypoint.

## Useful scripts
`.docker` directory contains some useful scripts:

**Aggregated scripts:**

- `build-app.sh` will build all the backend deps and run's migrations
- `update-ide-plugin.sh` will update meta and helpers for Laravel plugin.

Basically `.docker/update.sh` is the aggregation of these above scripts
and you should run it each time when updating from `master`.

**Proxy scripts:**

- `composer.sh` Proxy to `composer` executable, you can call with any valid composer arguments and options
- `artisan.sh` Proxy to Laravel's `artisan` executable, you can call with any valid artisan arguments and options

## Module management
Laravel is not providing a module management feature by default.
To utilize advantages of modulear architecture we created a
simple module manager (`App\Module\ModuleManager`).

To add a new custom module you need to create directory under `./module` directory (see autoloading section below)
and place a `[Namespace]\Module` class in the root. We recommend tou to use `src` for code sources and other folders for misc.

`Module` class can provide several interfaces called `features`. See `App\\Module\\Feature` namespace for reference.

Also each module should be an instance of Laravel's `ServiceProvider` to be able
for custom `register` and `boot` actions.

After you have created your new module register it within `./config/modules.php` config.
Registering module is the same as for `ZF2`-like projects. Order of modules within config does matter.

#### Modules autoloading

To have your modules structured please settle them into `./module` directory only.
Each module MUST reside in it's own folder inside the `./module`.

Each module should be `PSR-4` compliant and be register at `./composer.json` file within `psr-4` section.
Once you have added a new module into `./composer.json` file
get autoloading files generated via command `.docker/composer.sh dump-autoload`.

## Laravel plugin

To have all the autocompletion advantages with Laravel facades & models you need Laravel plugin installed.

**Installation:**

- Go to Plugins settings
- Search for `Laravel Plugin`
- Install it with PHPStorm and reload your IDE

**Usage:**

Run `.docker/update-ide-plugin.sh`

## Application debugging with XDebug

In order to use XDebug setup within app container you should have Docker version `>=18.03-ce`
because of special hosts forwarding variable `host.docker.internal` become available only with this version.

#### PHPStorm IDE configuration:

**Remote server:**

- Host: `localhost`
- Port: `8011`
- Path mappings: `[local project root] > /var/www/app`

**Debug configuration:**

- PHP Web Page
- Start URL: `/`
- Server: *choose server defined previously*

Now you are all set and ready to debug application as usual.

## Direct database access

Access to the database can be obtained through the standard DB connection on `localhost` at port `13306`

## Initial data

**Creating first admin:**

Run `.docker/artisan.sh user:create:admin` and follow the instructions.
Once first user is created you can login into system.
