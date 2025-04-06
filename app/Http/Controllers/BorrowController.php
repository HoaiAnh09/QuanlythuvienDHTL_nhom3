<?php

namespace App\Http\Controllers;

use App\Models\BorrowReturn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function showBorrowForm()
    {
        return view('borrow'); 
    }
    public function borrowBook(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);
        $borrow = new BorrowReturn();
        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->status = 'borrowed';
        $borrow->borrow_date = Carbon::now();
        $borrow->return_date = Carbon::now()->addDays(30);
        $borrow->save();
        return redirect()->back()->with('success', 'Mượn sách thành công');
    }
}
