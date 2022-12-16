@props([
    'title',
    'date',
    'thumbnail',
])
<div>
    <div class="flex p-2 bg-white mb-4 cursor-pointer rounded-xl hover:text-blue-500">
        <div class="flex-shrink-0 w-32 h-24">
            <img src="{{ config('app.wordpress') }}/wp-content/uploads/{{ $thumbnail }}" alt="avatar" class="rounded-xl w-full object-contain h-full">
        </div>
        <div class="w-full ml-4">
            <h1 class="text-md font-semibold line-clamp-2">
                {{ $title }}
            </h1>
            <div class="flex mt-2">
                <p class="text-sm font-medium text-slate-700">
                    Yusep Jaelani
                </p>
                <p class="text-sm font-medium text-slate-700 ml-2">
                    {{ $date }}
                </p>
            </div>
        </div>
    </div>
</div>