@extends('Templates.Navbar')

@section('content')
    <section class="bg-white m-5 sm:p-5 shadow-md sm:rounded-lg overflow-hidden">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Mahasiswa Baru</h2>
            <form action="{{ route('updatedMahasiswa', $mahasiswas->code) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <script>
                    @if ($errors->any())
                        let errorMessage = "{!! implode('<br>', $errors->all()) !!}";
                        alert(errorMessage);
                    @endif
                </script>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="npm" class="block mb-2 text-sm font-medium text-gray-900 ">NPM</label>
                        <input type="text" name="npm" id="npm"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="0029192" required="" value="{{ $mahasiswas->npm }}">
                        @error('npm')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Mochamad Surya Rafliansyah" required="" value="{{ $mahasiswas->name }}">
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Lahir</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" value="{{ $mahasiswas->birth_date }}">
                        @error('birth_date')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 ">Semester</label>
                        <input type="number" name="semester" id="semester"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" placeholder="2" value="{{ $mahasiswas->semester }}">
                        @error('semester')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload
                            file image</label>
                        <div class="w-full px-3 mb-5">
                            <div class="flex gap-10">
                                <div class="flex justify-center">
                                    <span class="font-medium text-center w-32 h-32"><img
                                            src="{{ asset('storage/' . $mahasiswas->image) }}" alt="Image"></span>
                                </div>
                            </div>
                        </div>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none "
                            aria-describedby="file_input_help" id="file_input" type="file" name="image"
                            value="{{ $mahasiswas->image }}">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                            (MAX. 800x400px).</p>
                        @error('image')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" placeholder="root@root.com" value="{{ $mahasiswas->email }}">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="tlp" class="block mb-2 text-sm font-medium text-gray-900 ">Telefon</label>
                        <input type="text" name="tlp" id="tlp"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" placeholder="085*****" value="{{ $mahasiswas->phone }}">
                        @error('phone')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 rounded-lg bg-cyan-500 shadow-cyan-500/50 text-white hover hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 shadow-md">
                    Tambah Mahasiswa
                </button>
            </form>
        </div>
    </section>
@endsection
