@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'files_title' => null,
    'files_created_at' => null,
    'files_short_url' => null,
    'files_size' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    @if ($title)
        <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    @if ($description)
        <meta name="description" content="{{ $description }}">
    @else
    <meta name="description" content="{{ config('app.description', '') }}">
    @endif
    @if ($keywords)
        <meta name="keywords" content="{{ $keywords }}">
    @else
    <meta name="keywords" content="{{ config('app.keywords', '') }}">
    @endif
    <meta name="robots" content="index, follow" />
    <meta name="publisher" content="{{ config('app.name', 'Laravel') }}">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="author" content="{{ config('app.name', 'Laravel') }}">
    <meta name="keywords" content="{{ config('app.keywords', '') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    @if ($title)
        <meta property="og:title" content="{{ $title }} | {{ config('app.name', 'Laravel') }}" />
    @else
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    @endif
    <meta property="og:description" content="{{ config('app.description', '') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:image" content="{{ config('app.logo', '') }}" />
    <meta property="og:image:secure_url" content="{{ config('app.logo', '') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="{{ config('app.description', '') }}" />
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}" />
    


    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(90deg, rgba(225, 234, 255, 0.8) -13.75%, rgba(245, 135, 255, 0.8) 100%);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="min-h-screen">
        <div class="md:flex text-slate-900">
            <div class="w-full">
                <x-navbar />

                <main class="p-4 w-full min-h-screen container mx-auto md:p-8 pt-20 md:pt-0">
                    <div class="flex w-full mb-4 overflow-x-auto" id="category-list">
                    </div>

                    @if ($files_title)
                    <div id="advertiser" class="w-full h-[280px] bg-gray-200 rounded-xl mb-4">
                        {{-- Ads --}}
                    </div>
                    @endif

                    @if (Route::currentRouteName() == 'welcome')
                        <div class="md:flex" id="trending">
                            
                        </div>

                        <script>
                            const trending = document.getElementById('trending');

                            fetch('/api/trending')
                                .then(response => response.json())
                                .then(data => {
                                    trending.innerHTML = `
                                    <div class="w-full mr-4">
                                        <a href="/${data.post_name}">
                                            <x-carousel-post
                                                title="${data.post_title}"
                                                thumbnail="${data.thumbnail}"
                                                created_at="${convertDate(data.created_at)}"
                                                slug="${data.post_name}"
                                            />
                                        </a>
                                    </div>
                                    <div>
                                        <x-ads-local1 />
                                    </div>
                                    `
                                });

                                function convertDate(date) {
                                    const d = new Date(date);
                                    const month = d.toLocaleString('default', { month: 'long' });
                                    const day = d.getDate();
                                    const year = d.getFullYear();
                                    return `${day} ${month} ${year}`;
                                }
                        </script>
                    @endif

                    @if ($files_title)
                        <x-mitedrive title="{{$files_title}}" size="{{$files_size}}" created_at="{{$files_created_at}}" short_url="{{ $files_short_url }}" />
                    @endif

                    <div class="md:flex bg-white rounded-xl shadow-xl p-4 mb-4">
                        <div class="md:w-3/4 text-slate-900">
                            {{ $slot }}
                        </div>
                        <div class="md:w-1/4 px-4">
                            <x-sidebar />
                        </div>
                    </div>

                    @if (Route::currentRouteName() == 'post')
                        <x-recommendation-post />
                    @endif
                </main>
                <footer class="text-center text-md p-4 w-full border-t" style="background: rgba(255, 255, 255, 0.53);">
                    <div class="max-w-7xl mx-auto flex justify-center">
                        <p>&copy;2022 <a href="/"
                                class="text-blue-500 hover:text-blue-700 font-bold">{{ config('app.name') }}</a>. All
                            rights
                            reserved.</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <div class="md:hidden block">
        <x-navigasi-float-mobile />
    </div>

    <script>
        // const categoryList = document.getElementById('category-list');
        // const categoryListHTML = categoryList.innerHTML;

        // fetch('/api/category')
        //     .then(response => response.json())
        //     .then(data => {
        //         data.forEach(category => {
        //             categoryList.innerHTML += `
        //                 <a href="/category/${category.slug}">
        //                     <x-category-card 
        //                         name="${category.name}" 
        //                     />
        //                 </a>
        //             `
        //         });
        //     });
    </script>
</body>

</html>
