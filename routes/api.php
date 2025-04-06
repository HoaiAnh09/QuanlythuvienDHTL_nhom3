<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::get('/user/{id}', function ($id) {
    dd(123);
    if (!is_numeric($id)) {
        return response()->json(['success' => false, 'message' => 'ID không hợp lệ'], 400);
    }

    $user = User::select('id', 'name')->where('id', $id)->where('role', 'reader')->first();

    if ($user) {
        return response()->json(['success' => true, 'user' => $user]);
    }

    return response()->json(['success' => false, 'message' => 'Không tìm thấy độc giả'], 404);
});
