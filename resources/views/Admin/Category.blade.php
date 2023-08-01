@extends('Admin.TemplateSidebar')

@section('content')
    <section class="bg-white dark:bg-gray-900 m-5 sm:p-5 shadow-md sm:rounded-lg overflow-hidden">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">New Category
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Lorem ipsum dolor sit
                amet consectetur adipisicing elit. Libero reiciendis fuga nesciunt harum quae omnis error unde illo, odit
                aut.</p>
            <form action="/category" method="POST" class="space-y-8 flex gap-5 flex-col">
                @csrf
                <div>
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category</label>
                    <input type="text" id="category" name="category"
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="mount, waterfall, mosque, etc" required>
                </div>
                <button type="submit"
                    class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
            </form>
        </div>
    </section>
@endsection
