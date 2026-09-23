@props (['title', 'wide' => false])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow, noarchive" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <title>{{ $title }} | GLCC PAL Center</title>
    @vite ('resources/css/app.css')
</head>
<body class="bg-white text-gray-800">
    <div class="flex min-h-screen flex-col">
        <header
            class="flex flex-wrap items-center justify-between gap-4 border-b border-purple-100 bg-white px-4 py-4 shadow-sm sm:px-8"
        >
            <a
                href="{{ route('guest') }}"
                class="inline-flex items-center gap-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#b085c2]"
                aria-label="GLCC PAL Center home"
            >
                <img
                    src="{{ asset('images/rsuGlobal.png') }}"
                    alt="RSU Logo"
                    class="h-12 w-12"
                />
                <span class="text-xl font-bold tracking-wider text-[#7D3C98]">
                    GLCC
                    <span
                        class="block text-xs font-normal tracking-normal text-gray-600"
                        >PAL Center</span
                    >
                </span>
            </a>
            @auth ('teacher')
                <nav
                    aria-label="Teacher navigation"
                    class="flex flex-wrap items-center gap-4 text-sm font-semibold text-[#7D3C98]"
                >
                    <a
                        href="{{ route('teacher.dashboard') }}"
                        class="hover:underline"
                        >Account</a
                    >
                    <a
                        href="{{ route('teacher.syllabus.edit') }}"
                        class="hover:underline"
                        >Course syllabus</a
                    >
                    <form method="POST" action="{{ route('teacher.logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="rounded-md border border-purple-200 px-3 py-2 hover:bg-purple-50"
                        >
                            Log out
                        </button>
                    </form>
                </nav>
            @endauth
        </header>

        <main
            @class (['flex flex-1 justify-center px-4 py-10 sm:px-6', 'items-center' => ! $wide, 'bg-slate-50' => $wide])
        >
            <div
                @class (['w-full', 'max-w-6xl' => $wide, 'max-w-md rounded-xl border border-[#7D3C98] bg-white p-6 shadow-md md:p-8' => ! $wide])
            >
                {{ $slot }}
            </div>
        </main>
    </div>
    @stack ('scripts')
</body>
</html>
