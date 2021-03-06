<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tunnel</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <section class="section">
            <div class="container">
                <h1 class="title">Tunnel</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ссылка</th>
                        <th>Описание</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($labels as $label)
                            <tr>
                                <th>{{ $label->id }}</th>
                                <td><a href="http://{{$label->name}}" target="_blank" rel="nofollow noopener">{{ $label->name }}</a></td>
                                <td>{{ $label->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </body>
</html>
