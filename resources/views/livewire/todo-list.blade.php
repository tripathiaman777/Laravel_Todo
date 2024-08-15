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
