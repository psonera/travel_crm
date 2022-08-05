<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Mail</h2>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-10 overflow-x-auto">
                        <a href="{{ route('mails.compose') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-large rounded-full text-md px-5 py-6 text-center mr-2 mb-10 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Compose</a>
                        <a href="{{ route('mails.inbox') }}"   class="text-white bg-pink-600 hover:bg-pink-900 focus:outline-none focus:ring-4 focus:ring-pink-300 font-large rounded-full text-md px-5 py-6 mr-2 mb-10 dark:bg-pink-800 dark:hover:bg-pink-700 dark:focus:ring-pink-700 dark:border-pink-900">Inbox</a>                       
                        <a href="{{ route('mails.sent') }}"    class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-large rounded-full text-md px-5 py-6 text-center mr-2 mb-10 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Sent</a>
                        <a href="{{ route('mails.draft') }}"   class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-large rounded-full text-md px-5 py-6 text-center mb-10 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Draft</a>                       
                        <a href="{{ route('mails.trash') }}"   class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-large rounded-full text-md px-5 py-6 text-center mr-2 mb-10 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Trash</a>
                        <a href="{{ route('mails.outbox') }}"  class="text-white bg-orange-500 hover:bg-orange-500 focus:outline-none focus:ring-4 focus:ring-orange-300 font-large rounded-full text-md px-5 py-6 text-center mr-2 mb-10 dark:hover:bg-orange-700 dark:focus:ring-orange-900">Outbox</a>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

                       