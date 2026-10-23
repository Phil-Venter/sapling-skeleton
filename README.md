# Sapling skeleton

A blank [Sapling](https://github.com/Phil-Venter/sapling-core) app.

```sh
composer create-project sapling/skeleton:dev-main my-app
cd my-app
composer serve
```

`/ping` answers `pong`, and `composer test` checks it. Add your actions and commands to `app/` and their tests to `tests/`. Read the [Sapling guides](https://github.com/Phil-Venter/sapling-core/blob/main/README.md#guides) to go further.

## Docker

The `Dockerfile` runs the app on [FrankenPHP](https://frankenphp.dev). Its settings come from a `.env` on the server with production values. Don't copy the one you work with, since its `APP_ENV=dev` turns on debug mode:

```sh
APP_ENV=production
APP_KEY=...
```

Write each line as plain `KEY=value`, since Docker keeps quotes and ` #` comments as part of the value. Keep the file out of git and back it up, because without its `APP_KEY` nothing encrypted can be read again.

Build the image, then run it with that file and a volume for the database at `/data`:

```sh
docker build -t my-app .
docker run -d -p 80:80 --env-file .env -v my-app-data:/data --name my-app my-app
docker exec my-app php bin/console migrations:run
```

The container runs as a user without root, and its health check calls `/ping`, so keep that route. Run one container per volume, since two can't share a SQLite file safely. Behind a host's proxy, such as Fly or Render, add `'trusted_proxies' => ['*']` to `config.php`. To serve HTTPS yourself, set `SERVER_NAME` to your domain.
