@props(['title'])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="robots" content="noindex, nofollow, noarchive" />
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <title>{{ $title }} | GLCC PAL Center</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-white text-gray-800">
        <div class="flex min-h-screen flex-col">
            <header class="border-b border-purple-100 bg-white px-4 py-4 shadow-sm sm:px-8">
                <a href="{{ route('guest') }}" class="inline-flex items-center gap-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#b085c2]" aria-label="GLCC PAL Center home">
                    <img src="{{ asset('images/rsuGlobal.png') }}" alt="RSU Logo" class="h-12 w-12" />
                    <span class="text-xl font-bold tracking-wider text-[#7D3C98]">
                        GLCC
                        <span class="block text-xs font-normal tracking-normal text-gray-600">PAL Center</span>
                    </span>
                </a>
            </header>

            <main class="flex flex-1 items-center justify-center px-4 py-12 sm:py-16">
                <div class="w-full max-w-md rounded-xl border border-[#7D3C98] bg-white p-6 shadow-md md:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
