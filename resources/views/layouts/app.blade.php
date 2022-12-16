<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umenie mesta Bratislavy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
        {{-- prettier-ignore-start --}}
        <script type=“text/javascript”>
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src=“https://www.clarity.ms/tag/”+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, “clarity”, “script”, “enuuzaniox”);
        </script>

        {{-- GA4 --}}
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-0SY85J90C4"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-0SY85J90C4');
        </script>

        {{-- UA --}}
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-250179477-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-250179477-1');
        </script>
        {{-- prettier-ignore-end --}}
    @endproduction
</head>

<body class="antialiased text-neutral-800 bg-neutral-100">
    <div class="p-4 md:px-14 md:pt-10 max-w-screen-3xl mx-auto">
        <div class="flex pb-3 flex-col md:flex-row md:items-center">
            <h1 class="text-[1.75rem] md:text-5xl text-center">
                <a href="/">
                    <span class="font-medium">Umenie</span>
                    mesta
                    <span class="font-medium">Bratislavy</span>
                </a>
            </h1>
            <nav class="flex-grow">
                <ul
                    class="text-lg flex flex-wrap justify-around md:justify-end mt-4 font-medium uppercase whitespace-nowrap md:gap-x-6">
                    <li>
                        <a href="{{ route('about') }}" @class(['text-red-500' => request()->routeIs('about')])>O projekte</a>
                    </li>
                    <li>
                        <a href="{{ route('artworks.index') }}" @class(['text-red-500' => request()->routeIs('artworks.index')])>Mapa a katalóg diel</a>
                    </li>
                </ul>
            </nav>
        </div>
        <hr class="h-0.5 md:h-[0.15rem] -mx-0.5 md:-mx-2 bg-neutral-800">
    </div>

    <div id="app">
        @yield('content')
    </div>

    <footer class="bg-neutral-700 text-white text-sm">
        <div class="max-w-screen-3xl mx-auto py-14 px-6 md:px-14 md:flex">
            <div class="shrink md:pr-9">
                <a href="https://gmb.sk/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 532.125 178.656" fill="currentColor"
                        class="h-12">
                        <path
                            d="M145.587 401.643c-29.507 0-53.375 23.875-53.375 53.344v72.031c0 29.442 23.868 53.282 53.375 53.282h72.75c29.426 0 53.281-23.84 53.281-53.282 0-29.506-23.855-53.468-53.281-53.468h-83.344v34.812h83.344c10.256 0 18.531 8.321 18.531 18.656a18.47 18.47 0 0 1-18.53 18.532h-72.75c-10.294 0-18.688-8.224-18.688-18.532v-72.03c0-10.336 8.394-18.657 18.687-18.657H261.4c10.277 0 18.718 8.32 18.718 18.656V580.3h34.625V454.987c0-10.335 8.357-18.656 18.657-18.656 10.256 0 18.562 8.32 18.562 18.656V580.3h34.813V454.987c0-10.335 8.294-18.656 18.593-18.656 10.316 0 18.657 8.32 18.657 18.656v72.031c0 29.442 23.85 53.282 53.343 53.282h93.563c29.526 0 53.406-23.84 53.406-53.282 0-13.96-5.344-26.559-14.031-36.062 8.687-9.51 14.031-22.037 14.031-35.969 0-29.47-23.88-53.344-53.406-53.344H466.806v34.688H570.93c10.299 0 18.656 8.32 18.656 18.656 0 10.292-8.357 18.563-18.656 18.563H466.806v34.812H570.93c10.299 0 18.656 8.321 18.656 18.656 0 10.308-8.357 18.532-18.656 18.532h-93.563c-10.32 0-18.593-8.224-18.593-18.532v-72.03c0-29.47-23.98-53.345-53.407-53.345a53.192 53.192 0 0 0-35.968 13.97 53.32 53.32 0 0 0-36-13.97c-13.858 0-26.487 5.32-35.97 13.97-9.511-8.65-22.135-13.97-36.03-13.97z"
                            style="fill-rule:nonzero;stroke:none" transform="translate(-92.212 -401.643)" />
                    </svg>
                </a>
            </div>

            <div class="grow my-10 md:my-0">
                <div class="max-w-5xl">
                    Galéria mesta Bratislavy v spolupráci s ďalšími partnermi, odbornými inštitúciami a expertmi mapuje
                    existujúce diela, ako aj fragmenty a diela presunuté, odstránené alebo zničené. Cieľom je
                    prezentovať a popularizovať pestrú škálu umenia vo verejnom priestore od 2. polovice 20. storočia až
                    po súčasnosť a priniesť čo najviac informácií o význame, okolnostiach vzniku a príbehoch diel, o ich
                    autoroch, použitých materiáloch a výtvarných technikách.
                </div>
                <div>
                    <h3 class="text-xl mt-10 md:mt-14 font-medium">Partneri projektu</h3>
                    <div class="flex mt-4 gap-10 items-center">
                        <a href="https://bratislava.sk/" target="_blank">
                            <svg viewBox="0 0 93 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-auto">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M33.8184 21.3187H37.4117V17.7761H33.8184V21.3187ZM41.0066 21.3187H44.6015V17.7761H41.0066V21.3187ZM48.1314 21.3187H51.7248V17.7761H48.1314V21.3187ZM55.4472 21.3187H59.0406V17.7761H55.4472V21.3187ZM59.0413 14.2334V0H55.4465V3.63697H51.789V0H48.1948V3.63697H37.4125V0H33.8184V14.2334H37.4117V7.18039H48.1956V14.2334H51.789V7.18039H55.4465V14.2334H59.0413ZM41.0066 14.2334H44.6007V10.6597H41.0066V14.2334Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 39.8312V30.031H4.57373C6.42533 30.031 7.80667 30.8308 7.80667 32.516C7.80667 33.7519 7.16539 34.4406 6.05531 34.8051V34.8331C7.37988 35.1005 8.06318 35.8017 8.06318 36.9956C8.06318 39.3399 5.9698 39.8312 4.18896 39.8312H0.0014734L0.000736699 39.8319L0 39.8312ZM2.65063 35.6757V37.9773H3.43417C4.40272 37.9773 5.41403 37.8374 5.41403 36.8416C5.41403 35.7737 4.37471 35.6757 3.46218 35.6757H2.65063ZM2.65063 31.8841V33.9058H3.39068C4.26046 33.9058 5.15825 33.6952 5.15825 32.8673C5.15825 31.9688 4.30321 31.8841 3.41869 31.8841H2.65063ZM10.0725 39.8312V30.031H14.8018C16.5671 30.031 18.006 30.8176 18.006 32.502C18.006 33.8079 17.3794 34.6784 16.0976 34.9731V35.0025C16.9527 35.2257 17.0094 35.9703 17.5077 37.1635L18.477 39.8312H15.7128L15.1438 38.0628C14.6013 36.3776 14.2593 35.9563 13.2767 35.9563H12.7209V39.8312H10.0725V39.8319V39.8312ZM12.7209 31.8841V34.1025H13.419C14.274 34.1025 15.3568 34.0752 15.3568 32.9653C15.3568 32.052 14.4303 31.8841 13.4182 31.8841H12.7209ZM19.4028 39.8312L23.1768 30.0302H26.4252L30.2566 39.8304H27.3502L26.6095 37.7387H22.8782L22.0947 39.8304H19.402L19.4028 39.8312ZM25.9844 35.8856L24.8013 32.0527H24.7719L23.4915 35.8856H25.9844ZM32.6095 39.8312V31.9688H30.1593V30.0317H37.7088V31.9702H35.2594V39.8319H32.6095V39.8312ZM39.5176 39.8312H42.1675V30.031H39.5176V39.8312ZM44.5174 39.5786C45.4019 39.8599 46.5547 39.9998 47.4813 39.9998C49.6889 39.9998 51.8545 39.3112 51.8545 36.7709C51.8545 33.2319 47.1533 34.2999 47.1533 32.7127C47.1533 31.8568 48.2648 31.8001 48.9341 31.8001C49.6889 31.8001 50.4584 31.94 51.1432 32.2494L51.3142 30.2276C50.6435 30.0022 49.7029 29.8623 48.7484 29.8623C46.7545 29.8623 44.4186 30.509 44.4186 32.8673C44.4186 36.4343 49.1191 35.2824 49.1191 37.1075C49.1191 37.8941 48.3216 38.0628 47.4813 38.0628C46.3837 38.0628 45.4292 37.7822 44.7452 37.4161L44.5174 39.5786ZM53.9914 39.8312H60.7425V37.8941H56.6405V30.031H53.9914V39.8304V39.8312ZM61.6691 39.8312L65.4438 30.031H68.6922L72.5237 39.8312H69.6165L68.8765 37.7395H65.1452L64.3617 39.8312H61.6691ZM68.2499 35.8856L67.0684 32.0527H67.0389L65.757 35.8856H68.2499ZM75.6622 39.8312L72.3291 30.031H75.1492L77.3576 37.7262H77.3856L79.608 30.031H82.3286L78.9394 39.8312H75.6622ZM82.005 39.8312L85.7812 30.0302H89.0274L92.8596 39.8304H89.9525L89.2139 37.7387H85.4805L84.6977 39.8304H82.005V39.8312ZM88.5866 35.8856L87.4036 32.0527H87.3741L86.093 35.8856H88.5866Z" />
                            </svg>
                        </a>
                        <a href="https://www.fpu.sk" target="_blank">
                            <svg viewBox="0 0 108 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-auto">
                                <path
                                    d="M31.31 27.4551L30.8005 16.742V2.82899C30.8005 0.927536 29.8278 0.0927536 27.8362 0.0927536C24.8255 0.0927536 21.8148 1.02029 18.8967 2.22609V3.15362H23.3896V24.9971C21.6758 25.7391 20.1936 26.342 18.4335 26.342C14.0333 26.342 12.0879 24.1623 12.0879 18.5971V2.68986C12.0879 0.788406 11.1616 0 9.26253 0C6.29816 0 3.19484 0.973913 0.230469 2.22609V3.15362H4.72334V20.6841C4.72334 28.058 7.87298 31.0725 13.4312 31.0725C17.0903 31.0725 20.5179 29.3565 23.4359 26.7131V27.0841C23.6675 29.8203 25.196 30.8406 28.5772 30.8406C30.8005 30.8406 33.8112 29.542 35.6639 27.9652L35.525 27.4551H31.31ZM72.487 22.6319C71.0974 22.6319 70.1247 23.8841 70.1247 25.2754C70.1247 26.7594 70.8195 27.5942 72.348 27.5942C73.2281 27.5942 73.9228 27.2696 74.2934 26.8058L74.2471 26.7131C73.7376 26.8986 73.2744 26.9449 72.9501 26.9449C72.0238 26.9449 71.3753 26.3884 71.2827 25.0435V24.9971H74.525V24.7652C74.4787 23.5594 73.8765 22.6319 72.487 22.6319ZM71.2364 24.6725C71.2827 23.3739 71.7459 22.9102 72.4406 22.9102C73.1354 22.9102 73.4133 23.5594 73.4133 24.6725H71.2364ZM68.6889 26.8522L68.6425 25.1362V24.3015C68.6425 23.0957 68.133 22.6319 67.253 22.6319C66.6045 22.6319 65.9561 23.0029 65.4929 23.4667C65.2613 22.8638 64.8445 22.6319 64.196 22.6319C63.5939 22.6319 63.038 22.9565 62.5749 23.3739V23.0493C62.5749 22.7246 62.4359 22.6319 62.1117 22.6319C61.6485 22.6319 61.139 22.771 60.6758 23.0029V23.142H61.3706V25.1362L61.3243 26.8522C61.3243 27.0841 61.2316 27.2232 60.9537 27.316L60.6758 27.3623C60.6758 27.4087 60.6758 27.4551 60.6758 27.5015H63.177C63.177 27.4551 63.2233 27.4087 63.2233 27.3623L62.8528 27.2696C62.6212 27.2232 62.5285 27.0841 62.5285 26.8522L62.4822 25.1362V23.6058C62.7601 23.4667 63.038 23.4203 63.3159 23.4203C64.0107 23.4203 64.335 23.7449 64.335 24.5797V25.1362L64.2886 26.8522C64.2886 27.0841 64.196 27.2232 63.9181 27.316L63.7791 27.3623C63.7791 27.4087 63.7791 27.4551 63.7791 27.5015H66.2803C66.2803 27.4551 66.3266 27.4087 66.3266 27.3623L65.9561 27.2696C65.7245 27.2232 65.6319 27.0841 65.6319 26.8522L65.5855 25.1362V24.3015C65.5855 24.0696 65.5392 23.8377 65.4929 23.6522C65.8171 23.5131 66.095 23.4203 66.4193 23.4203C67.114 23.4203 67.4383 23.7449 67.4383 24.5797V25.1362L67.392 26.8522C67.392 27.0841 67.2993 27.2232 67.0214 27.316L66.7435 27.3623C66.7435 27.4087 66.7435 27.4551 66.7435 27.5015H69.2447C69.2447 27.4551 69.291 27.4087 69.291 27.3623L68.9205 27.2696C68.7815 27.1768 68.6889 27.0841 68.6889 26.8522ZM59.3789 26.9913L59.2863 25.2754V23.0493C59.2863 22.7246 59.1473 22.6319 58.8231 22.6319C58.3599 22.6319 57.8504 22.771 57.3872 22.9565V23.0957H58.082V26.5739C57.8041 26.7131 57.5725 26.8058 57.2946 26.8058C56.5998 26.8058 56.2756 26.4348 56.2756 25.5536V23.0029C56.2756 22.6783 56.1366 22.5855 55.8124 22.5855C55.3492 22.5855 54.8397 22.7246 54.3765 22.9565V23.0957H55.0713V25.8783C55.0713 27.0377 55.5808 27.5478 56.4608 27.5478C57.063 27.5478 57.5725 27.2696 58.0357 26.8522V26.8986C58.082 27.316 58.3136 27.5015 58.8694 27.5015C59.2399 27.5015 59.7031 27.2696 59.981 27.0377V26.9449H59.3789V26.9913ZM88.8373 26.9913L88.7447 25.1826V23.9768C88.7447 22.8638 87.9573 22.5855 87.2162 22.5855C86.4288 22.5855 85.595 23.0493 85.2245 23.3739L85.3171 23.4667C85.6414 23.2812 86.1045 23.1884 86.5214 23.1884C87.0772 23.1884 87.5867 23.4203 87.5867 24.1159V25.0435L86.7993 25.1362C85.8729 25.229 84.9003 25.5536 84.9003 26.5739C84.9003 27.1304 85.3171 27.5942 86.0582 27.5942C86.7067 27.5942 87.1699 27.2232 87.5867 26.7594V26.8986C87.5867 27.4087 87.8646 27.5942 88.4204 27.5942C88.7447 27.5942 89.2542 27.4087 89.5321 27.1304V27.0377H88.8373V26.9913ZM87.5867 26.5739C87.2625 26.7594 86.9846 26.8522 86.7067 26.8522C86.2898 26.8522 86.0119 26.6203 86.0119 26.1102C86.0119 25.6928 86.2898 25.4609 86.8456 25.3217C87.0772 25.2754 87.3551 25.229 87.5404 25.1826V26.5739H87.5867ZM83.6034 21.1015C83.6034 20.9623 83.0475 20.4522 82.9086 20.4522C82.7696 20.4522 82.2601 20.9623 82.2601 21.1015C82.2601 21.2406 82.7696 21.7507 82.9086 21.7507C83.0475 21.7507 83.6034 21.1942 83.6034 21.1015ZM83.557 26.8522L83.5107 25.1362V23.0957C83.5107 22.771 83.3718 22.6783 83.0475 22.6783C82.5844 22.6783 82.0749 22.8174 81.6117 23.0493V23.1884H82.3064V25.1826L82.2601 26.8986C82.2601 27.1304 82.1675 27.2696 81.8896 27.3623L81.6117 27.4087C81.6117 27.4551 81.6117 27.5015 81.6117 27.5478H84.1128C84.1128 27.5015 84.1592 27.4551 84.1592 27.4087L83.7886 27.316C83.6497 27.1768 83.557 27.0841 83.557 26.8522ZM80.3148 26.8522L80.2684 25.1362V24.3015C80.2684 23.0957 79.7126 22.6319 78.8326 22.6319C78.1841 22.6319 77.582 22.9565 77.1188 23.4203V23.0957C77.1188 22.771 76.9798 22.6783 76.6556 22.6783C76.1924 22.6783 75.6829 22.8174 75.2197 23.0493V23.1884H75.9145V25.1826L75.8682 26.8986C75.8682 27.1304 75.7756 27.2696 75.4977 27.3623L75.2197 27.4087C75.2197 27.4551 75.2197 27.5015 75.2197 27.5478H77.7209C77.7209 27.5015 77.7673 27.4551 77.7673 27.4087L77.3967 27.316C77.1651 27.2696 77.0725 27.1304 77.0725 26.8986L77.0262 25.1826V23.6986C77.3504 23.5594 77.6746 23.4667 77.9525 23.4667C78.6473 23.4667 79.0178 23.7913 79.0178 24.6261V25.1826L78.9715 26.8986C78.9715 27.1304 78.8789 27.2696 78.601 27.3623L78.3231 27.4087C78.3231 27.4551 78.3231 27.5015 78.3231 27.5478H80.8243C80.8243 27.5015 80.8706 27.4551 80.8706 27.4087L80.5 27.316C80.4074 27.1768 80.3148 27.0841 80.3148 26.8522ZM99.4905 13.2174V12.7072C99.4905 12.3826 99.3516 12.2899 99.0273 12.2899C98.5642 12.2899 98.0546 12.429 97.5915 12.6609V12.8H98.2862V14.7942L98.2399 16.5101C98.2399 16.742 98.1473 16.8812 97.8694 16.9739L97.5915 17.0203C97.5915 17.0667 97.5915 17.113 97.5915 17.1594H100.093C100.093 17.113 100.139 17.0667 100.139 17.0203L99.7684 16.9275C99.5368 16.8812 99.4442 16.742 99.4442 16.5101L99.3979 14.7942V13.4029C99.6295 13.2638 99.9537 13.1246 100.324 13.1246C100.602 13.1246 100.88 13.171 101.158 13.3101L101.436 12.3826C101.251 12.3362 101.112 12.2899 100.88 12.2899C100.324 12.2899 99.7684 12.7536 99.4905 13.2174ZM61.3706 13.2174C61.6948 13.0319 62.158 12.9391 62.5749 12.9391C63.1307 12.9391 63.6402 13.171 63.6402 13.8667V14.7478L62.8528 14.8406C61.9264 14.9333 60.9537 15.258 60.9537 16.2783C60.9537 16.8348 61.3706 17.2986 62.1117 17.2986C62.7601 17.2986 63.2233 16.9275 63.6402 16.4638V16.6029C63.6402 17.113 63.9181 17.2986 64.4739 17.2986C64.7981 17.2986 65.3076 17.113 65.5855 16.8348V16.742H64.8908L64.7981 14.9797V13.7739C64.7981 12.6609 64.0107 12.3826 63.2696 12.3826C62.4822 12.3826 61.6485 12.8464 61.278 13.171L61.3706 13.2174ZM63.6402 16.2319C63.3159 16.4174 63.038 16.5101 62.7601 16.5101C62.3433 16.5101 62.0654 16.2783 62.0654 15.7681C62.0654 15.3507 62.3433 15.1188 62.8991 14.9797C63.1307 14.9333 63.4086 14.887 63.5939 14.8406V16.2319H63.6402ZM107.689 16.6957H107.04L106.948 14.9797V12.7536C106.948 12.429 106.809 12.3362 106.485 12.3362C106.021 12.3362 105.512 12.4754 105.049 12.6609V12.8H105.743V16.2783C105.466 16.4174 105.234 16.5101 104.956 16.5101C104.261 16.5101 103.937 16.1391 103.937 15.258V12.7072C103.937 12.3826 103.798 12.2899 103.474 12.2899C103.011 12.2899 102.501 12.429 102.038 12.6609V12.8H102.733V15.5826C102.733 16.742 103.242 17.2522 104.122 17.2522C104.724 17.2522 105.234 16.9739 105.697 16.5565V16.6029C105.743 17.0203 105.975 17.2058 106.531 17.2058C106.901 17.2058 107.365 16.9739 107.643 16.742L107.689 16.6957ZM94.4881 12.2899C93.1449 12.2899 92.0796 13.5884 92.0796 14.8406C92.0796 16.4638 92.867 17.2058 94.3955 17.2058C95.7851 17.2058 96.8041 15.8609 96.8041 14.6551C96.8041 13.0783 95.9703 12.2899 94.4881 12.2899ZM94.4881 16.9739C93.5618 16.9739 93.3302 16 93.3302 14.7015C93.3302 13.4493 93.5618 12.5681 94.3955 12.5681C95.3682 12.5681 95.5535 13.8203 95.5535 14.8406C95.5071 16.1391 95.2756 16.9739 94.4881 16.9739ZM68.5036 12.8H69.1984V14.7015L69.1057 18.4116C69.1057 18.6435 69.0131 18.7826 68.7352 18.8754L68.4573 18.9217C68.4573 18.9681 68.4573 19.0145 68.4573 19.0609H71.0048C71.0048 19.0145 71.0511 18.9681 71.0511 18.9217L70.6805 18.829C70.449 18.7826 70.3563 18.6435 70.3563 18.4116V17.1594C70.5416 17.2058 70.7269 17.2058 71.0048 17.2058C72.3943 17.2058 73.5523 16.371 73.5523 14.6087C73.5523 13.0319 72.9038 12.2899 71.6996 12.2899C71.1437 12.2899 70.6805 12.5681 70.3563 12.8928V12.7072C70.3563 12.3826 70.2174 12.2899 69.8931 12.2899C69.43 12.2899 68.9205 12.429 68.4573 12.6609V12.8H68.5036ZM70.4026 13.1246C70.5879 13.0319 70.9121 12.9391 71.1901 12.9391C71.9775 12.9391 72.348 13.3565 72.348 14.7942C72.348 16.0928 71.9775 16.9275 71.0974 16.9275C70.7732 16.9275 70.5879 16.8812 70.4026 16.7884V14.5623V13.1246ZM59.6568 16.5101L59.6105 14.7942V13.9594C59.6105 12.7536 59.0547 12.2899 58.1746 12.2899C57.5262 12.2899 56.924 12.6145 56.4608 13.0783V12.7536C56.4608 12.429 56.3219 12.3362 55.9977 12.3362C55.5345 12.3362 55.025 12.4754 54.5618 12.7072V12.8464H55.2566V14.8406L55.2103 16.5565C55.2103 16.7884 55.1176 16.9275 54.8397 17.0203L54.5618 17.0667C54.5618 17.113 54.5618 17.1594 54.5618 17.2058H57.063C57.063 17.1594 57.1093 17.113 57.1093 17.0667L56.7388 16.9739C56.5072 16.9275 56.4145 16.7884 56.4145 16.5565L56.3682 14.8406V13.3565C56.6924 13.2174 57.0167 13.1246 57.2946 13.1246C57.9893 13.1246 58.3599 13.4493 58.3599 14.2841V14.8406L58.3136 16.5565C58.3136 16.7884 58.2209 16.9275 57.943 17.0203L57.6651 17.0667C57.6651 17.113 57.6651 17.1594 57.6651 17.2058H60.1663C60.1663 17.1594 60.2126 17.113 60.2126 17.0667L59.8421 16.9739C59.7031 16.8812 59.6568 16.742 59.6568 16.5101ZM85.4098 16.6957H84.7613L84.6687 14.8406V10.8986C84.6687 10.5739 84.5297 10.4812 84.2055 10.4812C83.7423 10.4812 83.2328 10.6203 82.7696 10.8522V10.9913H83.4644V12.3826C83.2791 12.3362 83.0475 12.3362 82.7233 12.3362C81.3801 12.3362 80.2684 13.3565 80.2684 14.9333C80.2684 16.8812 81.2411 17.2058 82.1675 17.2058C82.677 17.2058 83.1402 16.9739 83.4644 16.6493C83.5107 17.0203 83.7423 17.2058 84.2981 17.2058C84.6687 17.2058 85.1319 16.9739 85.4098 16.742V16.6957ZM83.4644 16.4638C83.2328 16.5565 83.0012 16.6029 82.7233 16.6029C82.0285 16.6029 81.4727 16.0464 81.4727 14.6087C81.4727 13.2638 81.8896 12.5681 82.7696 12.5681C83.0475 12.5681 83.2791 12.6145 83.4644 12.7072V16.4638ZM79.2958 14.7015C79.2958 13.0783 78.462 12.2899 76.9798 12.2899C75.6366 12.2899 74.5713 13.5884 74.5713 14.8406C74.5713 16.4638 75.3587 17.2058 76.8872 17.2058C78.3231 17.2522 79.2958 15.9073 79.2958 14.7015ZM75.8682 14.7015C75.8682 13.4493 76.0998 12.5681 76.9335 12.5681C77.9062 12.5681 78.0915 13.8203 78.0915 14.8406C78.0915 16.1391 77.8136 16.9739 77.0262 16.9739C76.0998 16.9739 75.8682 16 75.8682 14.7015ZM89.2079 12.2899C88.652 12.2899 88.1889 12.5681 87.8646 12.8928V12.7072C87.8646 12.3826 87.7257 12.2899 87.4015 12.2899C86.9383 12.2899 86.4288 12.429 85.9656 12.6609V12.8H86.6604V14.7015L86.5677 18.4116C86.5677 18.6435 86.4751 18.7826 86.1972 18.8754L85.9193 18.9217C85.9193 18.9681 85.9193 19.0145 85.9193 19.0609H88.4668C88.4668 19.0145 88.5131 18.9681 88.5131 18.9217L88.1425 18.829C87.9109 18.7826 87.8183 18.6435 87.8183 18.4116V17.1594C88.0036 17.2058 88.1889 17.2058 88.4668 17.2058C89.8563 17.2058 91.0143 16.371 91.0143 14.6087C91.1069 13.0319 90.4585 12.2899 89.2079 12.2899ZM88.6057 16.9275C88.2815 16.9275 88.0962 16.8812 87.9109 16.7884V14.5623V13.1246C88.0962 13.0319 88.4205 12.9391 88.6984 12.9391C89.4858 12.9391 89.8563 13.3565 89.8563 14.7942C89.8563 16.0464 89.4395 16.9275 88.6057 16.9275ZM72.3017 6.95652C72.8112 6.95652 73.2744 6.72464 73.5986 6.4C73.6449 6.77102 73.8765 6.95652 74.4323 6.95652C74.8029 6.95652 75.2661 6.72464 75.544 6.49276V6.4H74.8955L74.8029 4.54493V0.602899C74.8029 0.278261 74.6639 0.185507 74.3397 0.185507C73.8765 0.185507 73.367 0.324638 72.9038 0.556522V0.695652H73.5986V2.08696C73.4133 2.04058 73.1817 2.04058 72.8575 2.04058C71.5143 2.04058 70.4026 3.06087 70.4026 4.63768C70.449 6.58551 71.4216 6.95652 72.3017 6.95652ZM72.9038 2.31884C73.1817 2.31884 73.4133 2.36522 73.5986 2.45797V6.21449C73.367 6.30725 73.1354 6.35362 72.8575 6.35362C72.1627 6.35362 71.6069 5.7971 71.6069 4.35942C71.6069 3.01449 72.0238 2.31884 72.9038 2.31884ZM63.0844 4.45218C63.0844 2.82899 62.2506 2.04058 60.7684 2.04058C59.4252 2.04058 58.3599 3.33913 58.3599 4.59131C58.3599 6.21449 59.1473 6.95652 60.6758 6.95652C62.1117 7.0029 63.0844 5.65797 63.0844 4.45218ZM60.7684 6.72464C59.8421 6.72464 59.6105 5.75073 59.6105 4.45218C59.6105 3.2 59.8421 2.31884 60.6758 2.31884C61.6485 2.31884 61.8338 3.57102 61.8338 4.59131C61.8338 5.88986 61.5559 6.72464 60.7684 6.72464ZM64.6129 4.49855L64.5665 6.21449C64.5665 6.44638 64.4739 6.58551 64.196 6.67826L63.9181 6.72464C63.9181 6.77102 63.9181 6.81739 63.9181 6.86377H66.4193C66.4193 6.81739 66.4656 6.77102 66.4656 6.72464L66.095 6.63189C65.8635 6.58551 65.7708 6.44638 65.7708 6.21449L65.7245 4.49855V3.01449C66.0487 2.87536 66.373 2.78261 66.6509 2.78261C67.3456 2.78261 67.7162 3.10725 67.7162 3.94203V4.49855L67.6699 6.21449C67.6699 6.44638 67.5772 6.58551 67.2993 6.67826L67.0214 6.72464C67.0214 6.77102 67.0214 6.81739 67.0214 6.86377H69.5226C69.5226 6.81739 69.5689 6.77102 69.5689 6.72464L69.1984 6.63189C68.9668 6.58551 68.8741 6.44638 68.8741 6.21449L68.8278 4.49855V3.66377C68.8278 2.45797 68.272 1.9942 67.392 1.9942C66.7435 1.9942 66.1414 2.31884 65.6782 2.78261V2.45797C65.6782 2.13333 65.5392 2.04058 65.215 2.04058C64.7518 2.04058 64.2423 2.17971 63.7791 2.41159V2.55073H64.4739V4.49855H64.6129ZM55.3029 4.49855L55.2566 6.21449C55.2566 6.44638 55.1639 6.58551 54.886 6.67826L54.6081 6.72464C54.6081 6.77102 54.6081 6.81739 54.6081 6.86377H57.1093C57.1093 6.81739 57.1556 6.77102 57.1556 6.72464L56.7851 6.63189C56.5535 6.58551 56.4608 6.44638 56.4608 6.21449L56.4145 4.49855V2.78261H57.4335V2.41159H56.4145V1.85507C56.4145 1.11304 56.5072 0.417391 57.2483 0.417391C57.6188 0.417391 57.8967 0.927536 58.2209 1.3913C58.4988 1.29855 58.7304 1.11304 58.7304 0.834783C58.7304 0.417391 58.082 0.185507 57.2483 0.185507C56.3219 0.185507 55.2566 0.973913 55.2566 1.94783V2.45797L54.5618 2.55073V2.78261H55.2566V4.49855H55.3029ZM42.519 23.6986C41.5927 23.6986 38.5357 26.6667 38.5357 27.687C38.5357 28.6609 41.5927 31.7681 42.519 31.7681C43.4454 31.7681 46.5487 28.6145 46.5487 27.687C46.5951 26.7131 43.4454 23.6986 42.519 23.6986Z" />
                            </svg>
                        </a>
                        <a href="http://muop.bratislava.sk/" target="_blank">
                            <img src="{{ asset('muop_logo.png') }}" class="invert h-12 w-auto" />
                        </a>
                    </div>
                    <div class="md:flex gap-x-16">
                        <div>
                            <h3 class="text-xl mt-10 md:mt-14 font-medium">Zapojte sa</h3>
                            <ul class="flex flex-col gap-y-4 mt-4">
                                <li><x-link-underline
                                        href="mailto:umeniemesta@gmb.sk">umeniemesta@gmb.sk</x-link-underline></li>

                                {{-- TODO --}}
                                {{-- <li>
                                    <x-link-underline href="@TODO">Nahlásiť dielo</x-link-underline>
                                </li> --}}
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl mt-10 md:mt-14 font-medium">Sociálne siete</h3>
                            <ul class="flex flex-col gap-y-4 mt-4">
                                <li><x-link-underline href="https://www.instagram.com/galeria_mesta_bratislavy/"
                                        target="_blank">Instagram</x-link-underline></li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl mt-10 md:mt-14 font-medium">Dokumenty</h3>
                            <ul class="flex flex-col gap-y-4 mt-4">
                                <li><x-link-underline href="https://gmb.sk/detail/ochrana-osobnych-udajov"
                                        target="_blank">Ochrana osobných údajov</x-link-underline></li>
                                <li><x-link-underline href="https://gmb.sk/detail/vyhlasenie-o-pristupnosti"
                                        target="_blank">Vyhlásenie o prístupnosti</x-link-underline></li>
                                <li><x-link-underline href="https://gmb.sk/detail/autorske-prava"
                                        target="_blank">Autorské práva</x-link-underline></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shrink self-end md:pl-9 whitespace-nowrap">
                Copyright © {{ now()->format('Y') }} <x-link-underline href="https://gmb.sk/" target="_blank">Galéria
                    mesta
                    Bratislavy</x-link-underline>
            </div>
        </div>
    </footer>
</body>

</html>

