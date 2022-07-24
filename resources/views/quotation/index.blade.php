<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-xl font-bold">Quotation table</h2>
                    <a href="{{ route('quotation.create') }}" class="bg-gradient-cyan ml-auto bg-success block p-2 rounded-xl text-white">+ Add New Quotation</a>
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
                                        subject</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Lead Assigner</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Lead Manager</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Sub Total</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Discount</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Tax
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Adjustment
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Grand Total
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Expired At
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Created Date
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none border-b-solid tracking-none whitespace-nowrap text-slate opacity-70">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quotations as $quotation)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->id }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->subject }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->user->name }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{$quotation->leadManager->name}}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->sub_total }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->discount_amount }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->tax_amount }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->adjustment_amount }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->grand_total }}</p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400"></p>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <p class="mb-0 leading-tight text-slate-400">{{ $quotation->created_at }}</p>
                                        </div>
                                    </td>
                                    <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="{{ route('quotation.edit', ['id' => $quotation->id]) }}"
                                                class="font-semibold leading-tight text-slate-400"> Edit
                                            </a>
                                            <a href="{{ route('quotation.delete', ['id' => $quotation->id]) }}"
                                                class="pl-4 font-semibold leading-tight text-slate-400"> Delete
                                            </a>
                                        </td>
                                </tr>
                                @empty
                                    <p>No users</p>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
