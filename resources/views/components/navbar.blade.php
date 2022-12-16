<div class="text-slate-900">
    <div class="fixed w-full z-20">
        <div id="navbar-mobile" class="w-full flex items-center p-4 border-b shadow-sm bg-white md:hidden">
            <div class="container mx-auto flex justify-between">
                <a href="/">
                    <h1 class="text-3xl font-bold">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                </a>
            </div>

            <div class="flex items-center">
                <button onclick="openSidebar()" class="md:hidden block" id="menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="md:block hidden w-full p-3" style="background: rgba(255, 255, 255, 0.53);">
        <div class="container mx-auto">
            <div class="flex justify-between">
                <div class="flex">
                    <a href="/" class="mr-8">
                        <h1 class="text-3xl font-bold">
                            {{ config('app.name', 'Laravel') }}
                        </h1>
                    </a>

                    <div class="flex items-center">
                        <a href="/category/news" class="mr-4">
                            <p class="text-lg font-semibold hover:text-blue-500">News</p>
                        </a>
                    </div>
                </div>

                <form action="/search" id="search" class="flex items-center justify-center">
                    <label for="search" class="mr-2 relative">
                        <input type="text" id="search" name="title"
                            class="w-full border border-gray-300 rounded-full py-2 px-4 focus:outline-none mr-2 bg-[#ECECEC]"
                            placeholder="Search" />
                        <div class="absolute top-2 right-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21 21l-6.35-6.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z">
                                </path>
                            </svg>
                        </div>

                    </label>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="sidebar-mobile"
    class="h-screen fixed bg-white z-10 top-[68px] overflow-y-auto transition-all duration-500 ease-in-out hidden md:hidden">
    <ul class="flex flex-col w-full">
        <li class="flex flex-col w-full">
            <a href="/category/news" class="flex flex-row items-center w-full p-4 border-b hover:bg-[#F2F6F9CC]">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#ECECEC]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>

                </div>
                <div class="flex flex-col ml-4">
                    <p class="text-lg font-semibold">
                        News
                    </p>
                    <p class="text-sm text-gray-400">
                        Latest news
                    </p>
                </div>
            </a>
        </li>
    </ul>
</div>

<script>
    const sidebar_mobile = document.getElementById('sidebar-mobile');
    const navbar_mobile = document.getElementById('navbar-mobile');

    function openSidebar() {
        if (sidebar_mobile.classList.contains('hidden')) {
            sidebar_mobile.classList.remove('hidden');
            // animation transition
            sidebar_mobile.classList.add('w-0');
            setTimeout(() => {
                sidebar_mobile.classList.remove('w-0');
                sidebar_mobile.classList.add('w-full');
                sidebar_mobile.classList.add('block');
            }, 100);
        } else {
            sidebar_mobile.classList.remove('block');
            sidebar_mobile.classList.remove('w-full');
            sidebar_mobile.classList.add('w-0');
            setTimeout(() => {
                sidebar_mobile.classList.remove('w-0');
                sidebar_mobile.classList.add('hidden');
            }, 500);
        }
    }
</script>
