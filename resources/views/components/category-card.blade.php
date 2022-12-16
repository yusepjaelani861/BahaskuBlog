@props([
    'name'
])
<div>
    <div class="flex flex-col justify-center mr-4 hover:text-blue-500 cursor-pointer">
        <div class="rounded-full flex-shrink-0 w-16 h-16 border-4 border-white shadow-xl bg-[#9CACC5]">
            <img src="https://ui-avatars.com/api/?name={{ $name }}&background=0D8ABC&color=fff&size=128" alt="avatar" class="rounded-full w-full h-full">
        </div>
        <p class="text-center text-sm font-bold mt-1">{{ $name }}</p>
    </div>
</div>
