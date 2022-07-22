<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-xl font-bold">Leads table</h2>
                    <a href="{{ route('leads.create') }}" class="bg-gradient-cyan ml-auto bg-success block p-2 rounded-xl text-white">+ Add New Lead</a>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Manager</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Lead Value</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Assigned Lead Manager</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Expected Closed Date</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Created At</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads as $lead)
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <p class="mb-0 leading-tight text-slate-400">{{ $lead->id }}</p>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="#" class="mb-0 leading-tight text-slate-400">{{ $lead->user->name }}</a>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $lead->lead_value }}</p>
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="#" class="mb-0 leading-tight text-slate-400">{{ $lead->user->name }}</a>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 leading-tight text-slate-400">{{ date('d/m/Y', strtotime($lead->expected_closed_date)); }}</p>
                                        </td>

                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 leading-tight text-slate-400">{{ date('d/m/Y', strtotime($lead->created_at)); }}</p>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="{{ route('leads.edit', ['id' => $lead->id]) }}"
                                                class="font-semibold leading-tight text-slate-400"> Edit
                                            </a>
                                            <a href="{{ route('leads.delete', ['id' => $lead->id]) }}"
                                                class="pl-4 font-semibold leading-tight text-slate-400"> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="align-middle p-4">
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
