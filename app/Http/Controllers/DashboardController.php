<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $tasksCount = $user->tasks()->count();
        $completedCount = $user->tasks()->where('status', 'completed')->count();
        $pendingCount = $user->tasks()->where('status', 'pending')->count();

        return view('dashboard', compact('tasksCount', 'completedCount', 'pendingCount'));
    }
}
