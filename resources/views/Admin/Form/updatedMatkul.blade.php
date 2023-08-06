@extends('Templates.Navbar')

@section('content')
    <section class="bg-white m-5 sm:p-5 shadow-md sm:rounded-lg overflow-hidden">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Mata Kuliah Baru</h2>
            <form action="{{ route('updatedMatkul', $matkuls->code) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                        <input type="text" name="name" id="name" value="{{ $matkuls->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Matematika Linear" required="">
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 rounded-lg bg-cyan-500 shadow-cyan-500/50 text-white hover hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 shadow-md">
                    Tambah Matkul
                </button>
            </form>
        </div>
    </section>
@endsection
