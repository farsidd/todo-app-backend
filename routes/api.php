<?php

use App\Models\TodoNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/get/note/all', function () {
    return TodoNote::all();
});
Route::post('/note/add', function (Request $request) {
    $addNewTodoNote = new TodoNote();
    $addNewTodoNote->note_text = $request->note_text;
    if($addNewTodoNote->save())
    {
        return response()->json(['message' => 'success'],201);
    } else {
        return response()->json(['message' => 'something went wrong'],500);
    }
});
Route::post('/note/update', function (Request $request) {
    $updateTodoNote = TodoNote::find($request->id);
    $updateTodoNote->note_text = $request->note_text;
    if($updateTodoNote->save())
    {
        return response()->json(['message' => 'success'],202);
    } else {
        return response()->json(['message' => 'something went wrong'],500);
    }
});
Route::post('/note/mark', function (Request $request) {
    $updateTodoNote = TodoNote::find($request->id);
    $updateTodoNote->isCompleted = !$updateTodoNote->isCompleted;
    if($updateTodoNote->save())
    {
        return response()->json(['message' => 'success'],202);
    } else {
        return response()->json(['message' => 'something went wrong'],500);
    }
});
Route::post('/note/delete', function (Request $request) {
    $deleteTodoNote = TodoNote::find($request->id);
    if($deleteTodoNote->delete())
    {
        return response()->json(['message' => 'success'],202);
    } else {
        return response()->json(['message' => 'something went wrong'],500);
    }
});
