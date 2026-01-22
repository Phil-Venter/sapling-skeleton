# Sapling Skeleton

A minimal starter app powered by [**Sapling Core**](https://github.com/Phil-Venter/sapling-core)

---

## First steps

Install Composer (used to manage PHP packages): https://getcomposer.org/download/

Create a new project (replace `my-app` with your app name):

```sh
composer create-project sapling/skeleton my-app
````

Enter the project directory:

```sh
cd my-app
```

Start the development server:

```sh
composer sapling:serve
```

Open: http://localhost:8080/ping

## Environment

On install, `.env` is created automatically from `.env.dist` if it doesn't exist.

Alternatively you can manually refresh `.env` using:

```sh
composer sapling:refresh
```
