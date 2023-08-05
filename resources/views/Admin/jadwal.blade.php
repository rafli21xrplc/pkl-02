@extends('Templates.Navbar')

@section('content')
    <div class="mt-8">
        <div class="mb-3 flex justify-between">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Jadwal</h3>
            <button type="button"
                class="bg-cyan-500 shadow-cyan-500/50 text-white py-1 px-2 rounded-lg hover hover:bg-gradient-to-br focus:ring-4 focus:outline-none shadow-md focus:ring-cyan-300"><a
                    href="/admin/form_Jadwal">Tambah Data</a></button>
        </div>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-lg">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Dosen</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Mata Kuliah</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Hari</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Mulai Kelas</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Akhir Kelas</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-center">
                    @if (count($jadwal) > 0)
                        @foreach ($jadwal as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center">{{ $item->id }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->dosen[0]->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->matkul[0]->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->day_of_week }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->start_time }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->end_time }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-4 ">
                                        <a x-data="{ tooltip: 'Edite' }" href="/admin/form_EditJadwal/{{ $item->code }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                        <a x-data="{ tooltip: 'Delete' }" href="/admin/deleteJadwal/{{ $item->code }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection