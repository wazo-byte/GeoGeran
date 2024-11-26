<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Data GeoGeran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full w-full divide-y divide-gray-200">
                        <thead>
                            <tr style="border-bottom:1px solid black !important;">
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">#</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Pengguna</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Lot</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Tempat</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Bandar/Pekan/Mukim</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Daerah</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Negeri</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(!empty($lists) && count($lists) > 0)
                                @foreach($lists as $location)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->lot }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->area }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->city->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->district->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->state->name }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tiada data direkodkan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    @if(!empty($lists) && count($lists) > 0)
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $lists->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
