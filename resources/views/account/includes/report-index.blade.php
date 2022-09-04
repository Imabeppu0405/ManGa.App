<div class="flex flex-wrap justify-center">
    @if (isset($reports))
        @foreach ($reports as $report)
            <div class="m-2 p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                <div class="flex justify-between items-start">
                    <a href="#">
                        <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-700">{{ $report->title }}</h5>
                    </a>
                    <button
                        x-on:click="
                        open = true; 
                        data={  id: '{{$report->id}}', 
                                game_id: '{{ $report->game_id }}', 
                                status_id: '{{$report->status_id}}', 
                                start_at: '{{$report->start_at}}', 
                                end_at: '{{$report->end_at}}', 
                                memo: '{{$report->memo}}'}" 
                        class="fa-solid fa-pen-to-square text-xl text-emerald-500 hover:text-emerald-300 "
                        type="button" 
                        data-modal-toggle="editModal"
                    ></button>
                </div>
                <div class="flex justify-center">
                    <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-rose-100 bg-rose-500 rounded">{{ config("const.hardware_list.{$report->hardware_type}") }}</span>
                    <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-500 rounded">{{ config("const.category_list.{$report->category_id}") }}</span>
                    @if(empty($is_favorite))
                        <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-indigo-500 rounded">
                            @if(isset($is_stack))
                                プレイ開始：{{ $report->start_at }}
                            @elseif(isset($is_clear))
                                クリア日：{{ $report->start_at }}
                            @endif
                        </span>
                    @endif
                </div>
                <hr>
                <div>
                    <p class="mb-3 font-normal text-center text-gray-700 dark:text-gray-400">
                        @if(isset($report->memo))
                            {{ $report->memo }}
                        @else
                            -
                        @endif
                    </p>
                </div>
                {{-- <div class="m-3 flex justify-center">
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
                </div> --}}
            </div>
        @endforeach
    @else
        <div class="p-6 bg-white border-b border-gray-200">
            登録されている記録はありません
        </div>
    @endif
</div>