@extends('Templates.Navbar')

@section('content')
    <section class="bg-white m-5 sm:p-5 shadow-md sm:rounded-lg overflow-hidden">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Dosen Baru</h2>
            <form action="{{ route('newDosen') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Eko Kurniawan Khanedi" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" placeholder="root@root.com">
                    </div>
                    <div class="w-full">
                        <label for="tlp" class="block mb-2 text-sm font-medium text-gray-900 ">Telefon</label>
                        <input type="number" name="tlp" id="tlp"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" placeholder="085*****">
                    </div>
                    <div>
                        <label for="mengajar" class="block mb-2 text-sm font-medium text-gray-900 ">Bidang Mengajar</label>
                        <select id="mengajar" name="mengajar"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            @foreach ($matkuls as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 rounded-lg bg-cyan-500 shadow-cyan-500/50 text-white hover hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 shadow-md">
                    Tambah Dosen
                </button>
            </form>
        </div>
    </section>
@endsection
