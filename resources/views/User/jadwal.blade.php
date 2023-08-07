@extends('Templates.Navbar')

@section('content')
    <div class="mt-8">
        <div class="mb-3 flex justify-between">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Jadwal</h3>
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
                            </tr>
                        @endforeach
                    @else
                        <tr class="hover:bg-gray-50">
                            <td class="text-center w-full py-4" colspan="5">
                                <span class="not-found-text">Not Found</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
