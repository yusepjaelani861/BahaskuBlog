<?php
foreach ($post->categories as $category) {
    $categories[] = $category->name;
}

$categories = implode(', ', $categories);
?>
<x-guest-layout 
    title="{{ $post->post_title }}" 
    description="{{ $post->seo_description }}"
    keywords="{{ $categories }}"
    files_title="{{ $files->title }}"
    files_size="{{ $files->size }}"
    files_created_at="{{ $files->created_at }}"
    files_short_url="{{ $files->short_url }}"
    >
    <div class="w-full mb-4">
        <div class="h-full md:h-[430px] w-full mb-4">
            <img src="{{ config('app.wordpress') }}/wp-content/uploads/{{ $post->thumbnail }}" alt="advertiser" class="rounded-2xl object-contain w-full h-full">
        </div>

        <h1 class="text-2xl font-bold mb-2">
            {{ $post->post_title }}
        </h1>

        <div class="flex mb-4">
            <div class="rounded-full flex-shrink-0 w-8 h-8 bg-[#9CACC5]">
                <img src="https://ui-avatars.com/api/?name=YUSEP&background=0D8ABC&color=fff&size=128"
                    class="rounded-full" />
            </div>
            <div class="ml-2">
                <h1 class="text-xs font-bold line-clamp-1">
                    Yusep Jaelani
                </h1>
                <p class="text-xs text-slate-700 line-clamp-1">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>

        <div id="advertiser" class="w-full h-[100px] bg-gray-200 rounded-xl mb-4">
            {{-- Ads --}}
        </div>

        <div class="text-md text-black mb-4">
             {!! $post->post_content !!}
        </div>

        <p class="text-md font-medium text-slate-700 cursor-pointer mb-8">
            <span class="font-semibold">Tags: </span>
            @foreach($post->categories as $key => $value)
                <a href="/category/{{ $value->slug }}" class="hover:text-blue-500">
                    {{ $value->name }} 
                </a>
            @endforeach
        </p>

        <div class="mb-4">
            <h1 class="text-xl font-bold mb-4">
                Comments
            </h1>

            <div class="w-full flex justify-center p-4 bg-gray-200 rounded-xl">
                <p class="text-md font-semibold">
                    Comment is not available
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>
