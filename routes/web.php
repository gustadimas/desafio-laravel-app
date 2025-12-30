<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
      return redirect()->route('tarefas.index');
  });

Route::resource('tarefas', TaskController::class)->except(['show']);