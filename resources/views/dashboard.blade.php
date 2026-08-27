<x-layouts::app :title="__('Dashboard')">

    <x-mary-card title="Dashboard">

        {{-- Image Backdrop --}}
        <div class="h-screen rounded-2xl bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('images/autumn.png') }}');">

            {{-- Main Grid --}}
            <div class="grid h-full grid-cols-5 grid-rows-5 gap-4 p-4">

                {{-- Left Column - Current Weather / Change Location --}}
                <div class="flex items-start justify-start col-start-1 row-start-1 row-span-2 mt-10 m-10 ml-16">

                    <div class="flex flex-col items-start text-white">

                        <img class="w-32 h-32"
                            src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png"
                            alt="Weather Icon">

                        <p class="text-6xl font-bold mt-2 mb-3 capitalize">
                            {{ $location['name'] }}
                        </p>

                        <p class="text-6xl font-bold mt-2">
                            {{ round($weather['main']['temp']) }}°C
                        </p>

                        <div class="flex items-center gap-1 mt-4">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21s6-5.686 6-11a6 6 0 1 0-12 0c0 5.314 6 11 6 11Z" />
                                <circle cx="12" cy="10" r="2.25" />
                            </svg>


                            <span class="text-4xl font-semibold">
                                Change Location
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Right Column - Feels Like --}}
                <div class="flex items-center justify-start col-start-5 row-start-1 text-white translate-y-12">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9a3 3 0 0 0-3 3v4.5a4.5 4.5 0 1 0 6 0V12a3 3 0 0 0-3-3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12V3" />
                    </svg>

                    <div class="flex flex-col">

                        <p class="text-4xl font-semibold">
                            Feels Like
                        </p>

                        <p class="text-6xl font-bold mt-2">
                            {{ round($weather['main']['feels_like']) }}°C
                        </p>

                    </div>

                </div>


                {{-- Right Column - Humidity --}}
                <div class="flex items-center justify-start col-start-5 row-start-2 text-white translate-y-9">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3.75s-6 6.25-6 10.5a6 6 0 0 0 12 0c0-4.25-6-10.5-6-10.5Z" />
                    </svg>

                    <div class="flex flex-col">

                        <p class="text-4xl font-semibold">
                            Sunrise
                        </p>

                        <p class="text-6xl font-bold mt-2">
                            {{ date('H:i', $weather['sys']['sunrise']) }}
                        </p>

                    </div>

                </div>


                {{-- Right Column - Clouds --}}
                <div class="flex items-center justify-start col-start-5 row-start-3 text-white translate-y-4">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 19.5H6.75a4.5 4.5 0 0 1-.72-8.94A6 6 0 0 1 17.5 9a5.25 5.25 0 0 1-.25 10.5Z" />
                    </svg>

                    <div class="flex flex-col">

                        <p class="text-4xl font-semibold">
                            Sunset
                        </p>

                        <p class="text-6xl font-bold mt-2">
                            {{ date('H:i', $weather['sys']['sunset']) }}
                        </p>

                    </div>

                </div>


                {{-- Bottom Cards - Time / Degrees / Feels Like --}}
                <div class="col-span-5 row-start-5 self-end grid w-full grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 p-4">

                    @foreach ($forecasts as $forecast)
                        <div class="cube-box">

                            {{-- Normal face --}}
                            <div class="cube-face front">

                                <p class="absolute top-4 left-4 text-xl font-semibold">
                                    {{ strtolower(date('ga', strtotime($forecast['dt_txt']))) }}
                                </p>

                                <div class="flex h-full flex-col items-center justify-center">
                                    <p class="text-5xl font-bold">
                                        {{ round($forecast['main']['temp']) }}°C
                                    </p>
                                </div>

                            </div>


                            {{-- Face revealed on hover --}}
                            <div class="cube-face top">

                                <div class="flex h-full flex-col items-center justify-center">

                                    <p class="text-lg font-semibold">
                                        Feels like
                                    </p>

                                    <p class="text-5xl font-bold">
                                        {{ round($forecast['main']['feels_like']) }}°C
                                    </p>

                                </div>

                            </div>

                        </div>
                    @endforeach



                </div>
                {{-- End Main Grid --}}

            </div>
            {{-- End Image Backdrop --}}

    </x-mary-card>

</x-layouts::app>
