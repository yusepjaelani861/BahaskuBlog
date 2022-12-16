@props(['title', 'thumbnail', 'created_at', 'slug'])
<div>
    <div class="w-full flex flex-col items-center justify-center mb-4">
        <div class="rounded-xl border shadow-xl bg-white h-52 w-full relative">
            <x-carousel-card
                title="{{ $title }}"
                thumbnail="{{ $thumbnail }}"
                created_at="{{ $created_at }}"
                slug="{{ $slug }}"
            />
            <div class="absolute top-4 left-4" id="trending-flag">
                <div class="flex items-center justify-center bg-green-600 text-white p-1 px-2 rounded-tl-xl shadow-xl">
                    Trending
                </div>
            </div>
        </div>
    </div>
</div>