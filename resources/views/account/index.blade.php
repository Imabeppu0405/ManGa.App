<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>
    <div x-data="{ open : false, data : {}, activeTab: 0 }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                {{-- デフォルトアカウント画像 --}}
                <div class="bg-gray-200 rounded-full w-28 h-28 mx-auto">
                    <svg version="1.1" y="-250" x="-250" viewBox="-250 -250 500 500" height="112px" width="112px" style="overflow:visible">
                        <g transform="rotate(0,0,0)" stroke-linejoin="round" fill="#fff"><path stroke-linecap="butt" stroke-linejoin="round" stroke-width="0" stroke-opacity="0" stroke="rgb(0,0,0)" fill="rgb(103,119,136)" d="m70.386659-69.482701a70.386664 70.288536 0 0 1-70.38666 70.28853a70.386664 70.288536 0 0 1-70.386675-70.288531a70.386664 70.288536 0 0 1 70.386675-70.288545a70.386664 70.288536 0 0 1 70.386659 70.288545z" />
                            <path stroke-linecap="butt" stroke-linejoin="round" stroke-width="0" stroke-opacity="0" stroke="rgb(0,0,0)" fill="rgb(103,119,136)" d="m55.57617 13.92945a100.394434 100.256988 0 0 1-55.576171 16.845705a100.394434 100.256988 0 0 1-55.59375-16.84278c-36.63765 7.141304-64.122075 39.1401-64.122075 77.78028v48.058589h239.43165v-48.05859c0-38.646315-27.493275-70.648666-64.139656-77.783205z" />
                        </g>
                    </svg>
                </div>
                <div class="p-2">
                    <div class="text-indigo-500 md:text-lg font-bold text-center">{{ Auth::user()->name }}</div>
                    <div class="text-gray-400 md:text-lg font-bold text-center">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div>
                <div>
                    <ul class="flex justify-center items-center my-4">
                        @foreach(config("const.status_list") as $key => $status_list_item)
                            <li class="cursor-pointer py-2 px-8 text-gray-500 border-b-8"
                                :class="activeTab == {{ $key }} ? 'text-indigo-500 border-indigo-500' : ''" x-on:click="activeTab = {{ $key }}"
                                >{{ $status_list_item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div x-show="activeTab===0">
                    <div class="flex flex-wrap justify-center">
                        @if (isset($reports))
                            @foreach ($reports as $report)
                                <div class="m-2 p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                                    <div class="flex justify-start">
                                        <a href="#">
                                            <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-700">{{ $report->title }}</h5>
                                        </a>
                                        <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-700 rounded">{{ config("const.hardware_list.{$report->hardware_type}") }}</span>
                                        <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-700 rounded">{{ config("const.category_list.{$report->category_id}") }}</span>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="flex justify-center mb-3">
                                            <span>{{ $report->start_at }}</span>
                                            ~
                                            <span>{{ $report->end_at }}</span>
                                        </div>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            @if(isset($report->memo))
                                                {{ $report->memo }}
                                            @else
                                                メモ未登録
                                            @endif
                                        </p>
                                    </div>
                                    <div class="m-3 flex justify-center">
                                        <button 
                                            x-on:click="
                                                open = true; 
                                                data={  id: '{{$report->id}}', 
                                                        game_id: '{{ $report->game_id }}', 
                                                        status_id: '{{$report->status_id}}', 
                                                        start_at: '{{$report->start_at}}', 
                                                        end_at: '{{$report->end_at}}', 
                                                        memo: '{{$report->memo}}'}" 
                                            class="px-2 py-1 text-green-500 border border-green-500 font-semibold rounded hover:bg-green-500 hover:text-white"
                                            type="button" 
                                            data-modal-toggle="editModal"
                                        >
                                            変更する
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-6 bg-white border-b border-gray-200">
                                登録されている記録はありません
                            </div>
                        @endif
                    </div>  
                </div>
                <div x-show="activeTab===1">

                </div>
                <div x-show="activeTab===2">

                </div>
            </div>
            <div x-show="open" id="registerModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-lg h-auto w-auto">
                    <!-- Modal content -->
                    <div @click.outside="open = false" class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-4 rounded-t border-b">
                            <h3 class="text-xl font-semibold text-gray-700">
                                登録
                            </h3>
                            <button @click="open = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <form id="editForm" class="space-y-6" action="report/save" method="POST">
                                @csrf
                                <div>
                                    <label for="status_id" class="block mb-2 text-sm font-medium text-gray-700">ステータス</label>
                                    <select id="status_id" name="status_id" class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option hidden>選択してください</option>
                                        @foreach(config("const.status_list") as $key => $status_list_item)
                                            <option value="{{ $key }}" x-bind:selected="data.status_id == {{ $key }}">{{ $status_list_item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="start_at" class="block mb-2 text-sm font-medium text-gray-700">プレイ期間</label>
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <input id="start_at" name="start_at" x-bind:value='data.start_at' type="date" class="border border-gray-300 text-gray-700 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="開始日">
                                        </div>
                                        <span class="mx-4 text-gray-500">to</span>
                                        <div class="relative">
                                            <input id="end_at" name="end_at" x-bind:value='data.end_at' type="date" class="border border-gray-300 text-gray-700 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="完了日">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="memo" class="block mb-2 text-sm font-medium text-gray-700">メモ</label>
                                    <textarea id="memo" x-bind:value='data.memo' name="memo" rows="4" class="block p-2.5 w-full text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="メモを入力"></textarea>
                                </div>
                                <input hidden name="report_id" type="number" x-bind:value="data.id" >
                                <input hidden name="game_id" type="number" x-bind:value="data.game_id" >
                                <input hidden name="user_id" type="number" value="{{ $user_id }}" >
                                <button id="editBtn" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">登録</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>