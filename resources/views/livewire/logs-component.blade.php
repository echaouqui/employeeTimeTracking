<div>
    {{-- @dump($sessions) --}}
    <div class="mt-16 max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg min-h-full">
                <div class="flex flex-col m-5">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Starting at
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Ending at
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sessions
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total Hours
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($sessions as $session)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                                {{ $session->day }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                                {{ $session->start }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                                {{ $session->end }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                                {{ $session->total }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $session->hours }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
