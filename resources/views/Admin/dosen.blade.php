@extends('Templates.Navbar')

@section('content')
    <div class="mt-8">
        <div class="mb-3 flex justify-between">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Dosen</h3>
            <button
                class="bg-cyan-500 shadow-cyan-500/50 text-white py-1 px-2 rounded-lg hover hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 shadow-md"><a
                    href="/admin/form_dosen">Tambah Data</a></button>
        </div>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-lg">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">NID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-left">Nama</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Bidang Mengajar</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Phone</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-center">
                    @if (count($dosens) > 0)
                        @foreach ($dosens as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">11222</td>
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900 text-left">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $item->name }}</div>
                                        <div class="text-gray-400">{{ $item->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center">{{ $item->bidang_mengajar }}</td>
                                <td class="px-6 py-4">
                                    <span>{{ $item->phone }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-4 ">
                                        <a x-data="{ tooltip: 'Edite' }" href="/admin/form_editDosen/{{ $item->code }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                        <a x-data="{ tooltip: 'Delete' }" href="/admin/deleteDosen/{{ $item->code }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </a>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                        @if (session('error'))
                                            <script>
                                                swal("Warning", "{{ session('error') }}", "warning");
                                            </script>
                                        @endif
                                    </div>
                                </td>
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
    @include('sweetalert::alert')

@endsection
