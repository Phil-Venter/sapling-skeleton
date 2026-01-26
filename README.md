# Sapling Skeleton

A minimal starter app powered by [**Sapling Core**](https://github.com/Phil-Venter/sapling-core)

---

## Dependencies

This skeleton app assumes **PHP** and **Composer** are installed on your system.

### MacOS

```sh
brew install php composer
```

### Guides
- PHP: `https://www.php.net/manual/en/install.php`
- Composer: `https://getcomposer.org/download/`

## Getting Started

Create a new project (replace `my-app` with your app name):

```sh
composer create-project sapling/skeleton:dev-main my-app
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

## LICENSE

This project is licensed under 0BSD. You can choose a different license if you wish to distribute it.
