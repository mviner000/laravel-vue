<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
         @livewireStyles()
    </head>
    <body>

        <header>
            <nav class="p-3 border d-flex gap-3">
                <a wire:navigate href="{{ route('home') }}" class="nav-link" {{ Route::is('home') ? 'text-primary' : ''}}>Home</a>
                <a wire:navigate href="{{ url('/product') }}" class="nav-link" {{ Route::is('product') ? 'text-danger' : ''}}>Product</a>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        @yield('script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @livewireScripts()
    </body>
</html>
