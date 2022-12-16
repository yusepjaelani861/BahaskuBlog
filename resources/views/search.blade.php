<x-guest-layout>
    <div class="w-full p-4">
        <h1 class="text-xl font-bold mb-4">
            Search {{ $title }}
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
            {{ $posts->links() }}
        </div>
    </div>
</x-guest-layout>