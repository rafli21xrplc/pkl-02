<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="./leaf.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;900&family=Open+Sans:wght@300;400&family=Poppins:wght@100;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body class="font-work">
    <!-- component -->
    <div class="flex flex-wrap bg-gray-100 w-full h-screen">
        <div class="w-3/12 bg-white rounded p-3 shadow-lg">
            <div class="flex items-center space-x-4 p-2 mb-5">
                <img class="h-12 rounded-full"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png"
                    alt="James Bhatta">
                <div>
                    <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">James Bhatta
                    </h4>
                    <span class="text-sm tracking-wide flex items-center space-x-1">
                        <svg class="h-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg><span class="text-gray-600">Verified</span>
                    </span>
                </div>
            </div>
            <ul class="space-y-2 mb-2 text-sm">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Wisata</label>
                <li>
                    <a href="/Dashboard"
                        class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <span>Detail Wisata</span>
                    </a>
                </li>
            </ul>
            <ul class="space-y-2 mb-2 text-sm">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Product</label>
                <li>
                    <a href="/Product"
                        class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <span>Detail Product</span>
                    </a>
                </li>
            </ul>
            <ul class="space-y-2 mb-2 text-sm">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Category</label>
                <li>
                    <a href="/category"
                        class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <span>Add New Category</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-9/12">
            <div class="bg-gray-100">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
