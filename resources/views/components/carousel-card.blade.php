@props(['title', 'thumbnail', 
'created_at' => now(), 
'slug'])
<div>
    <div class="flex cursor-pointer hover:text-blue-500 text-slate-900">
        <div class="w-52 flex-shrink-0 p-4 rounded-xl h-full">
            <img src="{{ config('app.wordpress') }}/wp-content/uploads/{{ $thumbnail }}" alt="avatar" class="rounded-xl object-cover w-full">
        </div>
        <div class="py-4">
            <h1 class="text-xl font-bold break-all pr-4 line-clamp">
                {{ $title }}
            </h1>
            <div class="flex mt-4">
                <div class="rounded-full flex-shrink-0 w-9 h-9 bg-[#9CACC5]">
                    <img src="https://ui-avatars.com/api/?name=YUSEP&background=0D8ABC&color=fff&size=128" class="rounded-full" />
                </div>
                <div class="ml-2">
                    <h1 class="text-sm font-medium text-slate-700 line-clamp-1">
                        Yusep Jaelani
                    </h1>
                    <p class="text-xs text-slate-700 line-clamp-1">
                        {{ $created_at }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>