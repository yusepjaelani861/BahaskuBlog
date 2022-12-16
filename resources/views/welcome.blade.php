<x-guest-layout>
    {{-- <div class="p-4">
        <div id="advertiser" class="w-full h-[90px] bg-gray-200 rounded-xl">
        </div>
    </div> --}}

    <div class="w-full p-4">
        <h1 class="text-xl font-bold mb-4">
            Artikel Terbaru
        </h1>

        <div class="w-full">
            @foreach($posts as $key => $value)
            @if($key % 3 == 0)
            <div id="advertiser" class="w-full h-[100px] bg-gray-200 rounded-xl mt-4 mb-4">
                {{-- Ads --}}
            </div>
            @endif
            <a href="/{{ $value->post_name }}">
                <x-card
                    title="{{ $value->post_title }}"
                    date="{{ $value->post_date_gmt }}"
                    thumbnail="{{ $value->thumbnail }}"
                />
            </a>
            @endforeach
        </div>

        <div class="w-full flex justify-center mt-4">
            @if ($posts->onFirstPage())
            {{-- <a href="#" class="bg-gray-200 rounded-xl px-4 py-2 mr-2">Previous</a> --}}
            @else
            <a href="{{ $posts->previousPageUrl() }}" class="bg-gray-200 rounded-xl px-4 py-2 mr-2">« Previous</a>
            @endif

            @if ($posts->hasMorePages())
            <a href="{{ $posts->nextPageUrl() }}" class="bg-gray-200 rounded-xl px-4 py-2 ml-2">Next »</a>
            @else
            {{-- <a href="#" class="bg-gray-200 rounded-xl px-4 py-2 ml-2">Next</a> --}}
            @endif
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>
</x-guest-layout>
