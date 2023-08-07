@extends('Templates.Navbar')

@section('content')
    <div class="mt-8">
        <div class="mb-3 flex justify-between">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Mata Kuliah</h3>
        </div>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-lg">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">NMK</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-left">Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-center">
                    @if (count($matkuls) > 0)
                        @foreach ($matkuls as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">1</td>
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900 text-left">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $item->name }}</div>
                                    </div>
                                </th>
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
