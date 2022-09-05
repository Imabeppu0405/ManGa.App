<div x-show="deleteOpen" id="deleteModal" tabindex="-1" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-md h-full md:h-auto">
        <div @click.outside="deleteOpen = false" class="relative bg-white rounded-lg shadow">
            <button x-on:click="deleteOpen = false" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">下記の{{ $deleteItem }}を削除してもよいですか？</h3>
                {{ $slot }}
                <form id="createOrUpdateForm" class="space-y-6" action="{{ $action }}" method="POST">
                    @csrf
                    <input hidden name="id" type="number" x-bind:value="deleteData.id">
                    <button data-modal-toggle="deleteModal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        削除する
                    </button>
                    <button x-on:click="deleteOpen = false" data-modal-toggle="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-700 focus:z-10">キャンセル</button>
                </form>
            </div>
        </div>
    </div>
</div>