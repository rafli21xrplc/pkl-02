@extends('Templates.Navbar')

@section('content')
    <section class="bg-white m-5 sm:p-5 shadow-md sm:rounded-lg overflow-hidden">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Jadwal Baru</h2>
            <form action="{{ route('updatedJadwal', $jadwals->code) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <div>
                            <label for="mengajar" class="block mb-2 text-sm font-medium text-gray-900 ">Dosen</label>
                            <select id="mengajar" name="dosen_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                @foreach ($dosens as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $data->id === $jadwals->dosen[0]->id ? 'selected' : '' }}>{{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div>
                            <label for="mengajar" class="block mb-2 text-sm font-medium text-gray-900">Mata Kuliah</label>
                            <select name="day_of_week" id="day_of_week"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="Monday" {{ $jadwals->day_of_week === 'Monday' ? 'selected' : '' }}>Monday
                                </option>
                                <option value="Tuesday" {{ $jadwals->day_of_week === 'Tuesday' ? 'selected' : '' }}>
                                    Tuesday</option>
                                <option value="Wednesday" {{ $jadwals->day_of_week === 'Wednesday' ? 'selected' : '' }}>
                                    Wednesday</option>
                                <option value="Thursday" {{ $jadwals->day_of_week === 'Thursday' ? 'selected' : '' }}>
                                    Thursday</option>
                                <option value="Friday" {{ $jadwals->day_of_week === 'Friday' ? 'selected' : '' }}>Friday
                                </option>
                                <option value="Saturday" {{ $jadwals->day_of_week === 'Saturday' ? 'selected' : '' }}>
                                    Saturday</option>
                                <option value="Sunday" {{ $jadwals->day_of_week === 'Sunday' ? 'selected' : '' }}>Sunday
                                </option>
                            </select>
                            @error('mata_kuliah_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="start" class="block mb-2 text-sm font-medium text-gray-900 ">Mulai Kelas</label>
                        <input type="time" name="start_time" id="start"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" value="{{ $jadwals->start_time }}">
                        @error('start_time')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="end" class="block mb-2 text-sm font-medium text-gray-900 ">Akhir Kelas</label>
                        <input type="time" name="end_time" id="end"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="" value="{{ $jadwals->end_time }}">
                        @error('end_time')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 rounded-lg bg-cyan-500 shadow-cyan-500/50 text-white hover hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 shadow-md">
                    Tambah Dosen
                </button>
            </form>
        </div>
    </section>
    @include('sweetalert::alert')

@endsection
