# Sapling skeleton

A blank [Sapling](https://github.com/Phil-Venter/sapling-core) app.

```sh
composer create-project sapling/skeleton:dev-main my-app
cd my-app
composer serve
```

`/ping` answers `pong`. Add your actions and commands to `app/`, and read the [Sapling guides](https://github.com/Phil-Venter/sapling-core/blob/main/README.md#guides) to go further.

## Docker

The `Dockerfile` runs the app on [FrankenPHP](https://frankenphp.dev). Build it, then run it with your key and a volume for the database at `/data`:

```sh
docker build -t my-app .
docker run -d -p 80:80 -e APP_KEY=... -v my-app-data:/data --name my-app my-app
docker exec my-app php bin/console migrations:run
```

Run one container per volume, since two can't share a SQLite file safely. Behind a host's proxy, such as Fly or Render, add `'trusted_proxies' => ['*']` to `config.php`. To serve HTTPS yourself, set `SERVER_NAME` to your domain.
