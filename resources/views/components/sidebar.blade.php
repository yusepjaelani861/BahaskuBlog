<div>
    <div class="mb-8 rounded-xl bg-[#F2F6F9CC] shadow-xl p-4">
            <form action="/search" class="flex items-center justify-between">
            <input type="text" name="title" class="w-full border border-gray-300 rounded-md py-2 px-4 focus:outline-none mr-2"
                placeholder="Search" />
            <button type="submit" class="bg-blue-500 rounded-md py-2 px-4 flex-shrink-0">
                Search
            </button>
            </form>
    </div>
    <div class="rounded-xl bg-[#F2F6F9CC] text-slate-900 shadow-xl p-4">
        <h1 class="text-xl font-bold mb-4 border-b-black border-b-2 pb-2">
            Popular Posts
        </h1>
        <div class="mb-8">
            <div class="w-full" id="popular-post">
            </div>
        </div>
    </div>

    <script>
        const popular = document.getElementById('popular-post');
        const popularPost = popular.innerHTML;

        fetch('/api/recommendation')
            .then(response => response.json())
            .then(data => {
                data.forEach(element => {
                    popular.innerHTML += `
                        <a href="/${element.post_name}">
                            <p class="mb-2">
                                ${element.post_title}
                            </p>
                        </a>
                    `;
                });
            })
            .catch(error => {
                popular.innerHTML = popularPost;
            });
    </script>
</div>
