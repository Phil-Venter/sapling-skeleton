<?php /** @var string $appName */ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($appName) ?> :: Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.lime.min.css">
    <link rel="stylesheet" href="/app.css">
</head>
<body>
    <header>
        <nav>
            <ul><li><strong><?= e($appName) ?></strong></li></ul>
            <ul>
                <li><a target="_blank" href="https://github.com/Phil-Venter/sapling-core/blob/main/README.md#guides">Docs</a></li>
                <li><a target="_blank" href="https://github.com/Phil-Venter/sapling-core">GitHub</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="text-center">
            <hgroup>
                <h1><?= e($appName) ?> :: Welcome</h1>
                <p>Your Sapling app is running.</p>
            </hgroup>
            <p>
                <a target="_blank" href="https://github.com/Phil-Venter/sapling-core/blob/main/README.md#guides" role="button">Read the docs</a>
                <a href="/ping" role="button">Try /ping</a>
            </p>
        </section>

        <section>
            <h2>Next steps</h2>

            <article>
                <header><strong>Add a page</strong></header>
                <p>A page is one class in <code>app/</code>, with its route on the class. Save this as <code>app/Hello.php</code> and open <a href="/hello">/hello</a>:</p>
                <pre><code>&lt;?php

namespace App;

use Sapling\Attributes\Route;
use Sapling\Http\Response;

#[Route('GET', '/hello')]
final class Hello
{
    public function __invoke(): Response
    {
        return Response::text('Hello');
    }
}</code></pre>
                <footer><a href="https://github.com/Phil-Venter/sapling-core/blob/main/docs/routing.md">Routing</a></footer>
            </article>

            <article>
                <header><strong>Change this page</strong></header>
                <p>Templates are plain PHP in <code>views/</code>. This page is <code>welcome.tmpl.php</code>. Print values with <code>e()</code>:</p>
                <pre><code>&lt;h1&gt;&lt;?= e($title) ?&gt;&lt;/h1&gt;</code></pre>
                <footer><a href="https://github.com/Phil-Venter/sapling-core/blob/main/docs/templates.md">Templates</a></footer>
            </article>

            <article>
                <header><strong>Run a command</strong></header>
                <p><code>php bin/console</code> lists every command, such as <code>routes:list</code> and <code>migrations:run</code>.</p>
                <footer><a href="https://github.com/Phil-Venter/sapling-core/blob/main/docs/commands.md">Commands</a></footer>
            </article>
        </section>
    </main>
    <footer class="text-center">
        <p><small>This page is <code>views/welcome.tmpl.php</code>, rendered by <code>app/WelcomeAction.php</code>.</small></p>
        <p><small>This demo is styled with <a target="_blank" href="https://picocss.com/docs/classless">Pico CSS, classless</a>.</small></p>
    </footer>
</body>
</html>
