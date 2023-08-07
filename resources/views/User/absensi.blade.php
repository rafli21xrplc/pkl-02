@extends('Templates.Navbar')

@section('content')
    <div class="mt-8">
        <div class="mb-3 flex justify-between">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Absensi</h3>
        </div>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-lg">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-left">name</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Kelas</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tanggal</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Surat</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-center">
                    <form action="{{ route('postAbsen') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2">-</td>
                            <th class="px-3 py-2 text-center">
                                <div class="sm:col-span-3">
                                    <div class="mt-2">
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                            placeholder="Eko Kurniawan Khanedi" required=""
                                            value="{{ auth()->user()->name }}" readonly hidden>
                                        @error('mahasiswa_id')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </th>
                            <td class="px-3 py-2 text-center">
                                <div class="sm:col-span-3">
                                    <div class="mt-2">
                                        <select required id="country" name="jadwal_id" autocomplete="country-name"
                                            class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            @foreach ($jadwals as $item)
                                                <option value="{{ $item->id }}">{{ $item->dosen[0]->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('jadwal_id')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 flex justify-center items-center">
                                <div class="mt-6 flex gap-2 justify-center">
                                    <div class="flex items-center gap-x-1">
                                        <input required id="hadir" name="status" type="radio" value="Hadir"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="hadir"
                                            class="block text-sm font-medium leading-6 text-gray-900">Hadir</label>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <input required id="izin" name="status" type="radio" value="Alpha"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="izin"
                                            class="block text-sm font-medium leading-6 text-gray-900">Alpha</label>
                                    </div>
                                    <div class="flex items-center gap-x-1">
                                        <input required id="sakit" name="status" type="radio" value="Izin"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="sakit"
                                            class="block text-sm font-medium leading-6 text-gray-900">Sakit</label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </td>
                            <td class="px-3 py-2 text-center"> <input required type="date" name="date" id="tanggal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    required="">
                                @error('date')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </td>
                            <td class="px-3 py-2 text-center">
                                <div class="sm:col-span-2 flex justify-center">
                                    <input
                                        class="block w-2/3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none "
                                        aria-describedby="file_input_help" id="file_input" type="file" name="image">
                                    @error('image')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="flex justify-center gap-4 ">
                                    <button type="submit">
                                        <i class="fa-solid fa-floppy-disk text-[30px]"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </form>

                    @foreach ($absens as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">1</td>
                            {{-- <td class="px-6 py-4 w-2/6 font-normal text-gray-900 text-left">
                                <div class="flex justify-center items-center gap-3">
                                    <span class="relative h-10 w-10">
                                        <img class="h-full w-full rounded-full object-cover object-center" width="10"
                                            height="10" src="{{ asset('storage/' . $item->mahasiswa[0]->image) }}"
                                            alt="" />
                                    </span>
                                    <span class="text-sm">
                                        <span class="font-medium text-gray-700">{{ $item->mahasiswa[0]->name }}</span>
                                        <span class="text-gray-400">{{ $item->mahasiswa[0]->email }}</span>
                                    </span>
                                </div>
                            </td> --}}
                            <td class="px-6 py-4 text-center"> {{ $item->name }}
                            <td class="px-6 py-4 text-center"> {{ $item->jadwal[0]->dosen[0]->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full text-black px-2 py-1 text-xs font-semibold {{ $item->status == 'Hadir' ? 'bg-green-600' : '' }} {{ $item->status == 'alpha' ? 'bg-red-600' : '' }} {{ $item->status == 'izin' ? 'bg-yellow-600' : '' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center"> {{ $item->date }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="" srcset="">
                            </td>
                        @else
                            <span>None</span>
                    @endif
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-4">
                            <a x-data="{ tooltip: 'Delete' }" href="#" onclick="showConfirmation('{{ $item->code }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </a>
                        </div>
                    </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
