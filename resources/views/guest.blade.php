<x-layout>
    <!-- Main content with video -->
    <div class="mx-auto w-screen">
        <div class="relative flex lg:min-h-[500px] w-full items-center overflow-hidden bg-slate-900">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/banner.webp') }}" alt="Background"
                    class="h-full w-full object-cover opacity-50" />
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 to-transparent"></div>
            </div>

            <div class="container relative z-10 mx-auto px-2 py-12 text-white max-w-7xl">
                <div class="max-w-3xl">

                    <!-- Badge -->
                    <div
                        class="mb-6 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 shadow-lg backdrop-blur-md">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#B98CCB] opacity-75"></span>

                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-[#7D3C98]"></span>
                        </span>

                        <span class="text-xs font-medium uppercase tracking-[0.15em] text-gray-200 lg:text-sm">
                            Peer-Assisted Learning Center
                        </span>
                    </div>

                    <!-- Heading -->
                    <h1
                        class="mb-6 text-4xl font-bold leading-[1.1] tracking-tight text-white sm:text-5xl lg:text-6xl xl:text-7xl">
                        Empowering
                        <span class="text-[#B98CCB]">Global</span>
                        <br />
                        Communication
                    </h1>

                    <!-- Description -->
                    <p class="mb-8 max-w-xl text-sm leading-7 text-gray-300 lg:text-lg">
                        Connect with mentors, improve your English skills, and
                        become part of Rangsit University's vibrant
                        international community.
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-wrap gap-4">

                        <!-- Primary Button -->
                        <a href="{{ route('register.mentor') }}"
                            class="group inline-flex items-center gap-2 rounded-lg bg-[#7D3C98] px-6 py-3 font-semibold text-white shadow-lg shadow-purple-900/30 transition-all duration-300 hover:-translate-y-1 hover:bg-[#6C3483] hover:shadow-xl">
                            Join Mentorship

                            <span class="transition-transform duration-300 group-hover:translate-x-1">
                                →
                            </span>
                        </a>

                        <!-- Secondary Button -->
                        <a href="{{ route('about') }}"
                            class="group inline-flex items-center gap-2 rounded-lg border border-white/30 bg-white/10 px-6 py-3 font-semibold text-white backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:border-white hover:bg-white hover:text-[#7D3C98]">
                            Learn More

                            <span class="transition-transform duration-300 group-hover:translate-x-1">
                                →
                            </span>
                        </a>

                    </div>

                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-4 lg:gap-2 px-2 py-12 lg:px-24 lg:py-24">
            <div
                class="group flex flex-col items-center justify-center rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#7D3C98]/20 hover:shadow-lg">

                <div
                    class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#7D3C98]/10 transition-all duration-300 group-hover:bg-[#7D3C98]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor"
                            class="text-[#7D3C98] transition-colors duration-300 group-hover:text-white"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0a3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>

                <h1 class="text-2xl lg:text-4xl font-bold text-[#7D3C98]">
                    {{ number_format($totalStudents) }}+
                </h1>

                <p class="mt-2 text-sm font-medium text-gray-500">
                    Active Students
                </p>

            </div>
            <div
                class="group flex flex-col items-center justify-center rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#7D3C98]/20 hover:shadow-lg">

                <div
                    class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#7D3C98]/10 transition-all duration-300 group-hover:bg-[#7D3C98]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor"
                            class="text-[#7D3C98] transition-colors duration-300 group-hover:text-white"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372a9.337 9.337 0 0 0 4.121-.952a4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0a3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0a2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>

                <h1 class="text-2xl lg:text-4xl font-bold text-[#7D3C98]">
                    {{ number_format($totalMentors) }}+
                </h1>

                <p class="mt-2 text-sm font-medium text-gray-500">
                    Mentors
                </p>

            </div>
            <div
                class="group flex flex-col items-center justify-center rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#7D3C98]/20 hover:shadow-lg">

                <div
                    class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#7D3C98]/10 transition-all duration-300 group-hover:bg-[#7D3C98]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor"
                            class="text-[#7D3C98] transition-colors duration-300 group-hover:text-white"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5a17.92 17.92 0 0 1-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                </div>

                <h1 class="text-2xl lg:text-4xl font-bold text-[#7D3C98]">
                    {{ number_format($totalTeamLeaders) }}+
                </h1>

                <p class="mt-2 text-sm font-medium text-gray-500">
                    Team Leaders
                </p>

            </div>
            <div
                class="group flex flex-col items-center justify-center rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#7D3C98]/20 hover:shadow-lg">

                <div
                    class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#7D3C98]/10 transition-all duration-300 group-hover:bg-[#7D3C98]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor"
                            class="text-[#7D3C98] transition-colors duration-300 group-hover:text-white"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>

                <h1 class="text-2xl lg:text-4xl font-bold text-[#7D3C98]">
                    50+
                </h1>

                <p class="mt-2 text-sm font-medium text-gray-500">
                    Programs
                </p>

            </div>
        </div>

        <div class="flex flex-col justify-center gap-4 px-2 py-12 lg:px-24 lg:py-24 text-center bg-gray-50 rounded-lg">
            <div>
                <h1 class="mb-4 px-6 text-4xl font-bold tracking-wide text-gray-800">
                    Why join GLCC PAL?
                </h1>
                <p class="break-word mx-auto mb-4 px-4 max-w-xl text-sm leading-relaxed text-gray-400">
                    We believe in the power of peer-to-peer learning to break
                    down language barriers and foster cultural exchange.
                </p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 justify-center px-2 lg:px-24">
                <div
                    class="flex flex-col items-left justify-center text-left gap-2 p-4 bg-white rounded-xl min-w-lg h-full max-h-64 border border-gray-200/20 shadow-md">
                    <svg class="bg-[#7d3c98]/20 rounded-lg p-1" xmlns="http://www.w3.org/2000/svg" width="36"
                        height="36" viewBox="0 0 24 24">
                        <path fill="none" stroke="#7d3c98" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>

                    <h2 class="text-lg font-semibold text-gray-800">
                        GLCC Newsletter
                    </h2>
                    <p class="text-xs text-gray-500 min-h-[60px]">
                        Get matched with experienced mentors who can help you
                        improve your English skills and navigate cultural
                        differences.
                    </p>
                    <a href="{{ route('newsletter') }}"
                        class="inline-flex w-fit items-center gap-2 rounded-lg bg-[#7D3C98]/10 px-4 py-2 text-sm font-medium text-[#7D3C98] transition-all duration-300 hover:bg-[#7D3C98] hover:text-white">
                        Learn More
                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>
                    </a>
                </div>
                <div
                    class="flex flex-col items-left justify-center text-left gap-2 p-4 bg-white rounded-xl min-w-lg h-full max-h-64 border border-gray-200/20 shadow-md">

                    <svg class="bg-[#7d3c98]/20 rounded-lg p-1" xmlns="http://www.w3.org/2000/svg" width="36"
                        height="36" viewBox="0 0 24 24">
                        <path fill="none" stroke="#7D3C98" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372a9.337 9.337 0 0 0 4.121-.952a4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0a3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0a2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>

                    <h2 class="text-lg font-semibold text-gray-800">
                        GLCC Publications
                    </h2>
                    <p class="text-xs text-gray-500 min-h-[60px]">
                        Access publications, research papers, and resources to support your language learning journey
                        and academic success.
                    </p>

                    <a href="{{ route('publications') }}"
                        class="inline-flex w-fit items-center gap-2 rounded-lg bg-[#7D3C98]/10 px-4 py-2 text-sm font-medium text-[#7D3C98] transition-all duration-300 hover:bg-[#7D3C98] hover:text-white">
                        Learn More
                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>
                    </a>
                </div>
                @if ($courseSyllabus)
                <div
                    class="flex flex-col items-left justify-center text-left gap-2 p-4 bg-white rounded-xl min-w-lg h-full max-h-64 border border-gray-200/20 shadow-md">
                    <svg class="bg-[#7d3c98]/20 rounded-lg p-1" xmlns="http://www.w3.org/2000/svg" width="36"
                        height="36" viewBox="0 0 24 24">
                        <path fill="none" stroke="#7d3c98" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41a60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84a51.39 51.39 0 0 0-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>

                    <h2 class="text-lg font-semibold text-gray-800">{{ $courseSyllabus->code }}</h2>
                    <p class="text-xs text-gray-500 min-h-[60px]">
                        {{ $courseSyllabus->title }}
                    </p>
                    <a href="{{ route('course.show') }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex w-fit items-center gap-2 rounded-lg bg-[#7D3C98]/10 px-4 py-2 text-sm font-medium text-[#7D3C98] transition-all duration-300 hover:bg-[#7D3C98] hover:text-white">
                        Learn More
                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>
                    </a>
                </div>
                @endif
                <div
                    class="flex flex-col items-left justify-center text-left gap-2 p-4 bg-white rounded-xl min-w-lg h-full max-h-64 border border-gray-200/20 shadow-md">
                    <svg class="bg-[#7d3c98]/20 rounded-lg p-1"xmlns="http://www.w3.org/2000/svg" width="36"
                        height="36" viewBox="0 0 24 24">
                        <path fill="none" stroke="#7d3c98" stroke-linecap="round" stroke-width="1.5"
                            d="m15.75 10.5l4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">
                        YouTube @RSUGlobal
                    </h2>
                    <p class="text-xs text-gray-500 min-h-[60px]">
                        Access a library of video resources covering language learning, cultural insights, and success
                        stories from our community.
                    </p>

                    <a href="https://www.youtube.com/@RSUGlobal555" target="_blank"
                        class="inline-flex w-fit items-center gap-2 rounded-lg bg-[#7D3C98]/10 px-4 py-2 text-sm font-medium text-[#7D3C98] transition-all duration-300 hover:bg-[#7D3C98] hover:text-white">
                        Learn More
                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>
                    </a>
                </div>
            </div>

        </div>

        {{-- Learn through Youtube --}}
        <section class="bg-gray-50 py-10">
            <div class="mx-auto max-w-7xl px-6 lg:px-24">

                <!-- Section Heading -->
                <div class="mb-12 text-center">
                    <span
                        class="inline-block rounded-full bg-[#7D3C98]/10 px-4 py-1 text-sm font-medium text-[#7D3C98]">
                        Learning Resources
                    </span>

                    <h2 class="mt-4 text-3xl font-bold text-gray-800 lg:text-4xl">
                        Learn Through Videos
                    </h2>

                    <p class="mx-auto mt-3 max-w-2xl text-gray-500">
                        Watch videos to improve your English, discover campus life,
                        and learn from experienced mentors at GLCC PAL.
                    </p>
                </div>

                <!-- Featured Playlists -->
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

                    <!-- Playlist 1 -->
                    <div
                        class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="aspect-video">
                            <iframe class="h-full w-full"
                                src="https://www.youtube.com/embed/videoseries?si=Q5b73A-YgzcNTEIK&amp;list=PLarQ3z7ST7hQ"
                                title="Playlist 1" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                            </iframe>

                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Introduction to GLCC PAL
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                An introduction to the RIC Language Center and the Data-Driven Seamless Learning
                                theoretical framework it utilizes.
                            </p>
                        </div>
                    </div>

                    <!-- Playlist 2 -->
                    <div
                        class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="aspect-video">

                            <iframe class="h-full w-full"
                                src="https://www.youtube.com/embed/videoseries?si=6eP_e4G01FvD8fQH&amp;list=PLDZT8TYo9mV0"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Mentor Experiences and Insights
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                RSU ILC Student x @eainvlog interview
                            </p>
                        </div>
                    </div>

                    <!-- Playlist 3 -->
                    <div
                        class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="aspect-video">

                            <iframe class="h-full w-full"
                                src="https://www.youtube.com/embed/videoseries?si=IQrfdPWyLZe6BGtY&amp;list=PLYf849xZ_Fx5YWS7vFujvhY3h2N6_C7nM"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">
                                GLCC Passport
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                For this event, Thai students have to complete 3 interactive stations, then complete
                                Station #4 - where they register and select their mentoring session for next week @ RSU
                                Global!
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Button -->
                <div class="mt-12 text-center">
                    <a href="{{ route('playlist') }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-lg bg-[#7D3C98] px-8 py-3 font-medium text-white transition-all duration-300 hover:bg-[#6C3483] hover:shadow-lg">

                        View All Playlists

                        <span class="transition-transform duration-300 hover:translate-x-1">
                            →
                        </span>
                    </a>
                </div>

            </div>
        </section>

        <div class="flex flex-col justify-center py-24 gap-2 text-center bg-[#7D3C98]">
            <h1 class="mb-2 text-4xl font-bold tracking-wide text-white text-center">
                Ready to start your journey?
            </h1>
            <p class="break-word mx-auto mb-4 max-w-xl text-sm leading-relaxed text-white text-center">
                Whether you want to improve your English or become a mentor, there's a place for you at GLCC.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register.mentor') }}"
                    class="group inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-[#7D3C98] shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-gray-50 hover:shadow-xl lg:px-8 lg:py-3.5">
                    Join Mentorship
                    <span class="transition-transform duration-300 group-hover:translate-x-1">
                        →
                    </span>
                </a>


                <a href="{{ route('newsletter') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-white/50 bg-white/5 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:text-[#7D3C98] lg:px-8 lg:py-3.5">
                    Newsletter
                </a>
            </div>
        </div>

        <script>
            function toggleAccordion(id) {
                const element = document.getElementById(id);
                if (element.classList.contains('hidden')) {
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }
            }
        </script>

</x-layout>
