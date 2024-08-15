<div class="">
    <div class="my-4 px-4 flex justify-center ">
        <div
            class="w-full max-w-2xl rounded-lg p-6 border-2 border-black shadow-[10px_10px_0px_rgba(0,0,0,1)] bg-amber-100">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-blue-700 mb-6 rubik-mono-one-regular">PHP - Simple To-Do List App</h1>
                <div class="flex items-center justify-center mb-6">
                    <input wire:model="task" wire:keydown.enter="addTodo" type="search" id="default-search"
                        class="w-3/5 p-4 text-lg text-gray-900 border border-gray-800 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="Add a To Do here" required />
                    <button wire:click="addTodo"
                        class="relative inline-flex items-center justify-center px-6 py-3 text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 active:bg-blue-800 active:scale-95 active:opacity-90 transition-transform transition-opacity duration-150 ease-in-out">
                        <span class="relative z-10">Add Task</span>
                    </button>


                </div>
            </div>
            <div class="overflow-x-auto rounded-3xl">
                <table class="w-full text-sm text-left text-gray-700 rounded-full">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/8"># </th>
                            <th scope="col" class="px-6 py-3 w-1/2">Task</th>
                            <th scope="col" class="px-6 py-3 w-1/8">Status</th>
                            <th scope="col" class="px-6 py-3 w-1/4 text-center">Action</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @for ($i = 0; $i < count($todos); $i++)
                            <tr class="bg-white border-b hover:bg-gray-50" style="{{ $todos[$i]->status == 1 ? 'background-color:#6eda6e' : '' }}">
                                <td class="px-6 py-4">{{ $i + 1 }}</td>
                                <td class="px-6 py-4 font-sm text-sm text-gray-900">
                                    {{ $todos[$i]->task }}
                                </td>
                                
                                <td>
                                    <div class="flex justify-center cursor-pointer"
                                        wire:click="updateStatus({{ $todos[$i]->id }})">
                                        @if ($todos[$i]->status == 0)
                                            <svg aria-hidden="true"
                                                class="w-4 h-4 me-2  text-gray-200 animate-spin dark:text-gray-600 fill-green-600"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        @else
                                            👍
                                        @endif

                                    </div>
                                </td>

                                <td class="px-6 py-4 flex justify-center items-center space-x-4">
                                    @if ($todos[$i]->status == 0)
                                        <i class="fa fa-check-square text-green-500 text-xl cursor-pointer"
                                            wire:click="updateStatus({{ $todos[$i]->id }})"></i>
                                    @endif

                                    <i class="fa fa-trash text-xl cursor-pointer" style="color: red"
                                        wire:click="confirmDelete({{ $todos[$i]->id }})"></i>
                                </td>
                            </tr>
                        @endfor
                        @if ($alertVisible)
                            <div class="z-10 fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="bg-white p-6 rounded shadow-lg">
                                    <h3 class="text-lg font-semibold">Alert</h3>
                                    <p class="mt-2">{{ $alertMessage }}</p>
                                    <button wire:click="closeAlert"
                                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if ($confirmDeleteVisible)
                            <div class="fixed z-10 inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="bg-white p-6 rounded shadow-lg">
                                    <h3 class="text-lg font-semibold">Confirm Deletion</h3>
                                    <p class="mt-2">Do you really want to delete this task?</p>
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button wire:click="deleteTodo({{ $taskToDeleteId }})"
                                            class="bg-red-500 text-white px-4 py-2 rounded">
                                            Yes, Delete
                                        </button>
                                        <button wire:click="closeConfirmDialog"
                                            class="bg-gray-500 text-white px-4 py-2 rounded">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </tbody> --}}
                    <tbody>
                        @foreach ($todos as $index => $todo)
                            <tr class="bg-white border-b hover:bg-gray-50 transition-opacity duration-300 ease-in-out {{ $todo->isDeleting ? 'opacity-0' : '' }}"
                                style="{{ $todo->status == 1
                                    ? 'background-color: #44b09e;
                                background-image: linear-gradient(315deg, #44b09e 0%, #e0d2c7 74%);'
                                    : '' }}"
                                wire:key="todo-{{ $todo->id }}">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-sm text-sm text-gray-900">{{ $todo->task }}</td>
                                <td>
                                    <div class="flex justify-center cursor-pointer"
                                        wire:click="updateStatus({{ $todo->id }})">
                                        @if ($todo->status == 0)
                                            {{-- <svg aria-hidden="true" class="w-4 h-4 me-2 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span> --}}
                                             <div class="loader"></div>
                                            
                                        @else
                                            👍🏿
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 flex justify-center items-center space-x-4">
                                    @if ($todo->status == 0)
                                        <i class="fa fa-check-square text-green-500 text-xl cursor-pointer"
                                            wire:click="updateStatus({{ $todo->id }})"></i>
                                    @endif

                                    <i class="fa fa-trash text-xl cursor-pointer" style="color: red"
                                        wire:click="confirmDelete({{ $todo->id }})"></i>
                                </td>
                            </tr>
                        @endforeach
                        @if ($alertVisible)
                            <div class="z-10 fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="bg-white p-6 rounded shadow-lg">
                                    <h3 class="text-lg font-semibold">Alert</h3>
                                    <p class="mt-2">{{ $alertMessage }}</p>
                                    <button wire:click="closeAlert"
                                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
                                </div>
                            </div>
                        @endif
                        @if ($confirmDeleteVisible)
                            <div class="fixed z-10 inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="bg-white p-6 rounded shadow-lg">
                                    <h3 class="text-lg font-semibold">Confirm Deletion</h3>
                                    <p class="mt-2">Do you really want to delete this task?</p>
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button wire:click="deleteTodo({{ $taskToDeleteId }})"
                                            class="bg-red-500 text-white px-4 py-2 rounded">Yes, Delete</button>
                                        <button wire:click="closeConfirmDialog"
                                            class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </tbody>

                </table>
                <div class="flex justify-center mt-4">

                    <button wire:click="showAllToggle"
                        class="relative inline-flex items-center justify-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 active:bg-blue-800 active:scale-95 active:opacity-90 transition-transform transition-opacity duration-150 ease-in-out">
                        <span class="relative z-10">{{ $showAllToggleButton }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
