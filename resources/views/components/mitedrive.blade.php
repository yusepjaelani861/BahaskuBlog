@props(['title', 'size', 'created_at', 'short_url'])
<?php
    function convertSize($size)
    {
        $unit = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    function convertFormatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d F Y');
    }
?>
<div class="w-full container mx-auto mb-4">
    <div class="bg-white rounded-xl shadow-sm p-4 mb-4 py-8">
        <h1 class="text-2xl font-bold text-center mb-2 break-words">
            {{ $title }}
        </h1>

        <div class="w-full flex justify-center items-center text-blue-600 mb-4">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="ml-2">
                This file is considered safe
            </p>
        </div>

        <div class="flex md:flex-row flex-col justify-center items-center mb-4">
            <p class="text-md font-semibold text-gray-600">
                Size : {{ convertSize($size) }}
            </p>
            <p class="text-md font-semibold text-gray-600 md:ml-4">
                Uploaded at : {{ convertFormatDate($created_at) }}
            </p>
        </div>

        <div class="flex justify-center">
            <button id="download-btn" class="bg-blue-200 text-blue-600 font-medium rounded-xl py-2 px-4">
                Please wait ...
            </button>
        </div>

    </div>
    <div id="advertiser" class="w-full h-[280px] bg-gray-200 rounded-xl mb-4">
        {{-- Ads --}}
    </div>

    <script>
        const downloadBtn = document.getElementById('download-btn');

        var i = 10;
        var interval = setInterval(() => {
            downloadBtn.innerHTML = `Download in ${i} seconds`;
            i--;
            if (i == 0) {
                clearInterval(interval);
                downloadBtn.innerHTML = `Click here to continue`;
                downloadBtn.classList.remove('bg-blue-200');
                downloadBtn.classList.remove('hover:bg-blue-400');
                downloadBtn.classList.remove('text-blue-600');
                downloadBtn.classList.add('bg-blue-600');
                downloadBtn.classList.add('hover:bg-blue-800');
                downloadBtn.classList.add('text-white');
                downloadBtn.classList.add('cursor-pointer');
                downloadBtn.addEventListener('click', () => {
                    downloadBtn.innerHTML = `<div class="flex items-center"><p class="mr-2">Processing</p><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>`
                    setTimeout(() => {
                        $.ajax({
                            url: '/checking',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                short_url: '{{ $short_url}}',
                            },
                            success: function(data) {
                                console.log(data)
                                if (data.success == true) {
                                    downloadBtn.innerHTML = `Success`;
                                    window.location.href = data.data.otw
                                }
                            }
                        })
                    }, 500);
                });
            }
        }, 1000);

    </script>

    <style>
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 30px;
            height: 30px;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 22px;
            height: 22px;
            margin: 4px;
            border: 4px solid #fff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #fff transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</div>
