<div>
    <div class="md:flex">
        <div class="mb-4 bg-white p-4 rounded-xl shadow-xl w-full mr-4">
            <h1 class="text-xl font-bold mb-4">
                Recommendation Posts
            </h1>
            <div id="recommendation" class="">
                {{-- @for ($i = 0; $i < 3; $i++)
                    <a href="/{{ $i }}">
                        <x-card />
                    </a>
                @endfor --}}
            </div>
        </div>
        <div class="flex-shrink-0 px-8 py-4 mb-4 bg-white rounded-xl shadow-xl">
            <h1 class="text-xl font-bold mb-4">
                Donate Box
            </h1>

            <div class="w-44 h-44 bg-[#F2F6F9BF] rounded-xl flex items-center justify-center p-4 mb-4 bg-[#D87FF6]">
                <img src="/images/qr.png" alt="undraw-Donation-re-1w8y" border="0">
            </div>

            {{-- <h1 class="text-xl font-bold mb-4">
                Donate Link
            </h1> --}}

            {{-- <ul class="">
                <li class="mb-2">
                    <a href="https://saweria.co/">
                        www.saweria.com/{{ config('app.name', 'Laravel') }}
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://trakteer.id/">
                        www.trakteer.id/{{ config('app.name', 'Laravel') }}
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://www.paypal.com/">
                        www.paypal.com/{{ config('app.name', 'Laravel') }}
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>

    <script>
        const recommendation = document.getElementById('recommendation');

        fetch('/api/recommendation')
            .then(response => response.json())
            .then(data => {
                data.forEach(element => {
                    recommendation.innerHTML += `
                        <a href="/${element.post_name}">
                            <x-card
                                title="${element.post_title}"
                                date="${element.post_date_gmt}"
                                thumbnail="${element.thumbnail}"
                            />
                        </a>
                    `;
                });
            });
    </script>
</div>
