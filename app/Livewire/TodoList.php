<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{
    public $alertVisible = false;
    public $alertMessage = '';
    public $todos;
    public $task;
    public $confirmDeleteVisible = false;
    public $taskToDeleteId;
    public $showAll = false;
    public $showAllToggleButton = "Show All";

    public function confirmDelete($taskId)
    {
        $this->taskToDeleteId = $taskId;
        $this->confirmDeleteVisible = true;
    }

    public function closeConfirmDialog()
    {
        $this->confirmDeleteVisible = false;
        $this->taskToDeleteId = null;
    }
    public function mount()
    {
        $this->fetchTodos();
    }
    public function showAllToggle(){
        if($this->showAll){
            $this->showAll = false;
            $this->showAllToggleButton = "Show All";
        }
        else{
            $this->showAll = true;
            $this->showAllToggleButton = "Show Only Pending";
        }
        $this->fetchTodos();
    }
    public function fetchTodos()
    {
        if ($this->showAll) {
            $this->todos = Todo::orderBy('created_at', 'desc')->get();
        }
        else{
            $this->todos = Todo::where('status', 0)->orderBy('created_at', 'desc')->get();
        }
        info($this->todos);
    }

    public function addTodo()
    {
        if (Todo::where('task', $this->task)->exists()) {
            $this->alertMessage = "Task: `{$this->task}` already exists in your Todo.";
            $this->task = '';
            $this->alertVisible = true;
            $this->fetchTodos();
            return;
        }
        if ($this->task != '') {
            $todo = new Todo();
            $todo->task = $this->task;
            $todo->save();
            $this->task = '';
            $this->fetchTodos();
        }
    }
    public function closeAlert()
    {
        $this->alertVisible = false;
        $this->task = ''; 
    }
    public function updateStatus($id)
    {
        $todo = Todo::find($id);
        $todo->status = !$todo->status;
        $todo->save();
        $this->fetchTodos();
    }

    public function deleteTodo($id)
    {info("To Delete");
        info($id);
        $todo = Todo::find($id);
        $this->confirmDeleteVisible = false;
        $todo->delete();
        $this->fetchTodos();}

    public function render()
    {
        return view('livewire.todo-list');
    }



    // public $alertVisible = false;
    // public $alertMessage = '';
    // public $todos = [];
    // public $task;
    // public $confirmDeleteVisible = false;
    // public $taskToDeleteId;
    // public $showAll = false;
    // public $showAllToggleButton = "Show All";

    // public function mount()
    // {
    //     $this->fetchTodos();
    // }

    // public function fetchTodos()
    // {
    //     // Initialize with some default tasks if needed
    //     $this->todos = [
    //         ['id' => 1, 'task' => 'Sample Task 1', 'status' => 0],
    //         ['id' => 2, 'task' => 'Sample Task 2', 'status' => 1]
    //     ];

    //     if (!$this->showAll) {
    //         $this->todos = array_filter($this->todos, function ($todo) {
    //             return $todo['status'] === 0;
    //         });
    //     }

    //     $this->todos = array_reverse($this->todos); // Reverse to show latest first
    // }

    // public function addTodo()
    // {
    //     if (empty($this->task)) {
    //         return;
    //     }

    //     foreach ($this->todos as $todo) {
    //         if ($todo['task'] === $this->task) {
    //             $this->alertMessage = "Task: `{$this->task}` already exists in your Todo.";
    //             $this->alertVisible = true;
    //             $this->task = '';
    //             return;
    //         }
    //     }

    //     $newId = count($this->todos) + 1; // Simple ID generation
    //     $this->todos[] = [
    //         'id' => $newId,
    //         'task' => $this->task,
    //         'status' => 0
    //     ];

    //     $this->task = '';
    //     $this->fetchTodos();
    // }

    // public function closeAlert()
    // {
    //     $this->alertVisible = false;
    //     $this->task = '';
    // }

    // public function updateStatus($id)
    // {
    //     foreach ($this->todos as &$todo) {
    //         if ($todo['id'] == $id) {
    //             $todo['status'] = !$todo['status'];
    //             break;
    //         }
    //     }

    //     $this->fetchTodos();
    // }

    // public function confirmDelete($taskId)
    // {
    //     $this->taskToDeleteId = $taskId;
    //     $this->confirmDeleteVisible = true;
    // }

    // public function closeConfirmDialog()
    // {
    //     $this->confirmDeleteVisible = false;
    //     $this->taskToDeleteId = null;
    // }

    // public function deleteTodo()
    // {
    //     $this->todos = array_filter($this->todos, function ($todo) {
    //         return $todo['id'] != $this->taskToDeleteId;
    //     });

    //     $this->confirmDeleteVisible = false;
    //     $this->fetchTodos();
    // }

    // public function showAllToggle()
    // {
    //     $this->showAll = !$this->showAll;
    //     $this->showAllToggleButton = $this->showAll ? "Show Only Pending" : "Show All";
    //     $this->fetchTodos();
    // }

    // public function render()
    // {
    //     return view('livewire.todo-list');
    // }


}
