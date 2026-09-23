<x-layout>
    <!-- Error Message -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded-md mb-6">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <h2 class="text-center mb-4 text-[28px] underline">RIC PAL Center</h2>
        {{-- Youtube Video --}}
        <iframe class="w-1/2 m-auto aspect-video"  src="https://www.youtube.com/embed/rbr0DHSeyNw?si=6iKLSEYSv8j6Qv-z" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <div class=" w-4/5 m-auto p-2 mb-4 text-[12px] mt-5">
            <div id="accordion-collapse-timetable" data-accordion="collapse" class="w-4/5 flex m-auto flex-row gap-1">
                {{-- First Item --}}
                <div class="w-full">
                    <h2 id="accordion-collapse-heading-1">
                        <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                                data-accordion-target="#accordion-collapse-body-1"
                                aria-expanded="false"
                                aria-controls="accordion-collapse-body-1">
                            <span>Monday</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>

                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1 ">
                        <div class="p-5 border border-b-0 border-gray-200">
                            <p class="mb-2 text-gray-500">
                                <p>09:00 - 11:00 (5 Mentors)</p>
          <p>11:00 - 12:00 (20 Mentors)</p>
          <p>12:00 - 13:00 (20 Mentors)</p>
          <p>13:00 - 14:00 (20 Mentors)</p>
          <p>14:00 - 15:00 (20 Mentors)</p>
          <p>15:00 - 16:00 (20 Mentors)</p>
          <p>16:00 - 17:00 (20 Mentors)</p>
          <p>17:00 - 18:00 (-)</p>
          <p>18:00 - 19:00 (-)</p>
          <p>19:00 - 20:00 (-)</p>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Second Item --}}
                <div class="w-full">
                    <h2 id="accordion-collapse-heading-2">
                        <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                                data-accordion-target="#accordion-collapse-body-2"
                                aria-expanded="false"
                                aria-controls="accordion-collapse-body-2">
                            <span>Tuesday</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                        <div class="p-5 border border-b-0 border-gray-200">
                            <p class="mb-2 text-gray-500">
                                <p>09:00 - 11:00 (5 Mentors)</p>
          <p>11:00 - 12:00 (20 Mentors)</p>
          <p>12:00 - 13:00 (20 Mentors)</p>
          <p>13:00 - 14:00 (20 Mentors)</p>
          <p>14:00 - 15:00 (20 Mentors)</p>
          <p>15:00 - 16:00 (20 Mentors)</p>
          <p>16:00 - 17:00 (20 Mentors)</p>
          <p>17:00 - 18:00 (-)</p>
          <p>18:00 - 19:00 (-)</p>
          <p>19:00 - 20:00 (-)</p>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Third Item --}}
                <div class="w-full">
                    <h2 id="accordion-collapse-heading-3">
                        <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                                data-accordion-target="#accordion-collapse-body-3"
                                aria-expanded="false"
                                aria-controls="accordion-collapse-body-3">
                            <span>Wednesday</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
                        <div class="p-5 border border-b-0 border-gray-200">
                            <p class="mb-2 text-gray-500">
                                <p>09:00 - 11:00 (5 Mentors)</p>
          <p>11:00 - 12:00 (20 Mentors)</p>
          <p>12:00 - 13:00 (20 Mentors)</p>
          <p>13:00 - 14:00 (20 Mentors)</p>
          <p>14:00 - 15:00 (20 Mentors)</p>
          <p>15:00 - 16:00 (20 Mentors)</p>
          <p>16:00 - 17:00 (20 Mentors)</p>
          <p>17:00 - 18:00 (-)</p>
          <p>18:00 - 19:00 (-)</p>
          <p>19:00 - 20:00 (-)</p>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Fourth Item --}}
                <div class="w-full">
                    <h2 id="accordion-collapse-heading-4">
                        <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                                data-accordion-target="#accordion-collapse-body-4"
                                aria-expanded="false"
                                aria-controls="accordion-collapse-body-4">
                            <span>Thursday</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-4" class="hidden" aria-labelledby="accordion-collapse-heading-4">
                        <div class="p-5 border border-b-0 border-gray-200">
                            <p class="mb-2 text-gray-500">
                                <p>09:00 - 11:00 (5 Mentors)</p>
          <p>11:00 - 12:00 (20 Mentors)</p>
          <p>12:00 - 13:00 (20 Mentors)</p>
          <p>13:00 - 14:00 (20 Mentors)</p>
          <p>14:00 - 15:00 (20 Mentors)</p>
          <p>15:00 - 16:00 (20 Mentors)</p>
          <p>16:00 - 17:00 (20 Mentors)</p>
          <p>17:00 - 18:00 (-)</p>
          <p>18:00 - 19:00 (-)</p>
          <p>19:00 - 20:00 (-)</p>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Fifth Item --}}
                <div class="w-full">
                    <h2 id="accordion-collapse-heading-5">
                        <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                                data-accordion-target="#accordion-collapse-body-5"
                                aria-expanded="false"
                                aria-controls="accordion-collapse-body-5">
                            <span>Friday</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-5" class="hidden" aria-labelledby="accordion-collapse-heading-5">
                        <div class="p-5 border border-b-0 border-gray-200">
                            <p class="mb-2 text-gray-500">
                                <p>09:00 - 11:00 (5 Mentors)</p>
          <p>11:00 - 12:00 (20 Mentors)</p>
          <p>12:00 - 13:00 (20 Mentors)</p>
          <p>13:00 - 14:00 (20 Mentors)</p>
          <p>14:00 - 15:00 (20 Mentors)</p>
          <p>15:00 - 16:00 (20 Mentors)</p>
          <p>16:00 - 17:00 (20 Mentors)</p>
          <p>17:00 - 18:00 (-)</p>
          <p>18:00 - 19:00 (-)</p>
          <p>19:00 - 20:00 (-)</p>
                            </p>
                        </div>
                    </div>
                </div>


            </div>


          </div>
        {{-- Accordion----------- --}}
        <div id="accordion-collapse" data-accordion="collapse" class="w-4/5 mx-auto mb-6">
            {{-- Sixth Item --}}
            <h2 id="accordion-collapse-heading-6">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                        data-accordion-target="#accordion-collapse-body-6"
                        aria-expanded="false"
                        aria-controls="accordion-collapse-body-6">
                    <span>What is the RSU PAL Centre?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-6" class="hidden" aria-labelledby="accordion-collapse-heading-6">
                <div class="p-5 border border-b-0 border-gray-200">
                    <p class="mb-2 text-gray-500">Established in 2018 (as the RIC Language Center) by Dr. Edward Devere Bacon of Rangsit University International College, it was originally set up as a peer-assisted learning (PAL) center for the faculty to aid international students with their English communication skills. Fast forward to 6 years later, it is now Rangsit University’s official PAL centre, where thousands of students come each week to develop their English skills. This is now a collaborative academic program between RELI and RIC, with Dr. Edward Devere Bacon (RIC) acting as Director, and Aj. Gary Ambito Torremucha (RELI) acting as Deputy Director.</p>
                </div>
            </div>

            {{-- Seventh Item --}}
            <h2 id="accordion-collapse-heading-7">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                        data-accordion-target="#accordion-collapse-body-7"
                        aria-expanded="false"
                        aria-controls="accordion-collapse-body-7">
                    <span>How often do RIC students attend the RSU PAL Centre?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-7" class="hidden" aria-labelledby="accordion-collapse-heading-7">
                <div class="p-5 border border-b-0 border-gray-200 text-gray-500">
                    <p class="mb-2 ">In order to align with Rangsit University’s motto of “Creating a giving and sharing society,” RIC students who are enrolled in the following courses are expected to volunteer at the RSU PAL Centre for one hour each week for this 10-week program (from Week 4 to Week 13):</p>
                    <ol class="italic"><li>ENL/ILE 125: English for Global Exploration</li><li>ENL/ILE 126: English in TED</li>
                    <li>ENL/ILE 127: English at Work</li>
                    </ol>
                    <p >There are plans to expand this academic program to other courses next academic year (and every year thereafter) – with the eventual goal by the academic year of 2570 to have a minimum of 20,000 RSU/RIC students each year to attend this PAL centre.</p>
                </div>
            </div>

            {{-- Eighth Item --}}
            <h2 id="accordion-collapse-heading-8">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                        data-accordion-target="#accordion-collapse-body-8"
                        aria-expanded="false"
                        aria-controls="accordion-collapse-body-8">
                    <span>How do RSU students select their mentors?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-8" class="hidden" aria-labelledby="accordion-collapse-heading-8">
                <div class="p-5 border border-t-0 border-gray-200">
                    <p class="mb-2 text-gray-500">At the beginning of each academic term, groups of Thai students are randomly paired up with mentors in the International College. However, if students wish to have a specific mentor that is possible as well. If you wish to do this, please let a member of the student management team know and they can set this up for you.
                        Additionally, by the Summer Term, we are hoping to have mentor profiles (with images) on the website, that way students can more easily select their mentors. Please stay tuned!
                        </p>
                </div>
            </div>
            {{-- Ninth Item --}}
            <h2 id="accordion-collapse-heading-9">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                        data-accordion-target="#accordion-collapse-body-9"
                        aria-expanded="false"
                        aria-controls="accordion-collapse-body-9">
                    <span>Who should I contact for additional information about the RSU PAL Centre?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-9" class="hidden" aria-labelledby="accordion-collapse-heading-9">
                <div class="p-5 border border-b-0 border-gray-200 ">
                    <p class="mb-2 text-gray-500">
                        If you would like more information about the RSU PAL Centre, please contact Poe Theingi Khaing (Helen).</p>
                        <img src="/images/helen_line_qr.jpg" alt="Helen Line ID" class="size-[100px]"/>
                        <a href="https://line.me/ti/p/i4bxITrUFu" class="underline text-blue-500">helen05_ptk</a>
                </div>
            </div>
            {{-- Tenth Item --}}
            <h2 id="accordion-collapse-heading-10">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                        data-accordion-target="#accordion-collapse-body-10"
                        aria-expanded="false"
                        aria-controls="accordion-collapse-body-10">
                    <span>Where is the RSU PAL Centre located?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-10" class="hidden" aria-labelledby="accordion-collapse-heading-10">
                <div class="p-5 border border-b-0 border-gray-200 text-gray-500">
                    <p class="mb-2 "><span class="font-bold">The RSU PAL Centre is located in Building 7 (Library Building), in room 101. The mailing address is the following: 52/347 Phahonyothin Rd, Tambon Lak Hok, Amphoe Mueang Pathum Thani, Chang Wat Pathum Thani 12000</p>
                </div>
            </div>
            <h2 id="accordion-collapse-heading-11">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100"
                        data-accordion-target="#accordion-collapse-body-11"
                        aria-expanded="false"
                        aria-controls="accordion-collapse-body-11">
                    <span>Has there been any academic research published regarding the RSU PAL Centre?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-11" class="hidden" aria-labelledby="accordion-collapse-heading-11">
                <div class="p-5 border border-b-0 border-gray-200 text-gray-500">
                    <p class="mb-2 text-gray-500">Yes, as of now we have four papers published in academic journals. The following two papers are published in Thailand’s TCI-indexed journals:</p>
                    <ol class="italic">
                        <li>1.	Bacon, E.D. (2020). Development of English Grammar and Writing Skills Based on Participation in a Peer-assisted Learning Center. Human, Behavior and Society, 21(2), 81-89.</li>
                        <li>2.	Bacon, E.D., Boundy, T. (2020). Utilizing Peer Feedback by Synthesizing a Peer-Assisted Learning Center with an English Course to Develop English Grammar and Academic Writing Skills. Rangsit Journal of Educational Studies, 7(1), 34-45. DOI: 10.14456/rjes.2020.11</li>
                    </ol>
                    <br/>
                    <p>The following two papers are published in international Scopus-indexed journals:</p>
                    <br/>
                    <ol class="italic">
                        <li>1.	Bacon, E.D., Satienchayakorn, N. & Prakaiborisuth, P. (2021). Integrating Seamless Learning within a Peer-Assisted Learning Center to Develop Student English Academic Writing Skills. rEFLections, 28(2), 147-167.</li>
                        <li>2.	Bacon, E.D., and Maneerutt, G. (2024). Enhancing EFL Academic Writing through AI and Peer-assisted Learning. Journal of Institutional Research South East Asia, 22(3), 282-314.</li>
                    </ol><br/>
                    <p>There are ambitious plans to have additional academic papers published in other international Scopus-index journals by the end of 2025!</p>
                </div>
            </div>

        </div>
    </div>
</x-layout>
