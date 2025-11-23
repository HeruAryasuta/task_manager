@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <!-- Header - Mobile Optimized -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">My Tasks</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your tasks efficiently</p>
        </div>
        <a href="{{ route('tasks.create') }}"
            class="inline-flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white px-4 sm:px-6 py-3 rounded-md font-medium shadow-sm transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Task
        </a>
    </div>

    @if($tasks->isEmpty())
        <div class="bg-white rounded-lg shadow p-8 sm:p-12 text-center">
            <svg class="w-16 h-16 sm:w-20 sm:h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <p class="text-gray-500 text-base sm:text-lg mb-4">No tasks yet. Create your first task!</p>
            <a href="{{ route('tasks.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium">
                Get Started
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @foreach($tasks as $task)
                    <li class="p-4 sm:p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <!-- Task Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 break-words">{{ $task->title }}</h3>
                                @if($task->description)
                                    <p class="text-sm sm:text-base text-gray-600 mt-1 break-words">{{ $task->description }}</p>
                                @endif
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs sm:text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($task->status == 'completed') bg-green-100 text-green-800
                                        @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                    @if($task->due_date)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Due: {{ $task->due_date->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Actions - Mobile Optimized -->
                            <div class="flex gap-2 lg:ml-4">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="flex-1 lg:flex-none inline-flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>
                                <button onclick="deleteTask({{ $task->id }})"
                                    class="flex-1 lg:flex-none inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Delete</span>
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- Delete Modal - Mobile Optimized -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 p-4">
    <div class="relative top-20 mx-auto max-w-md border shadow-lg rounded-lg bg-white">
        <div class="p-5">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl font-medium text-gray-900 text-center mb-2">Delete Task</h3>
            <p class="text-sm text-gray-500 text-center mb-6">Are you sure you want to delete this task? This action cannot be undone.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <button onclick="closeModal()" 
                        class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-medium transition-colors">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 font-medium transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteTask(taskId) {
        document.getElementById('deleteForm').action = `/tasks/${taskId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection