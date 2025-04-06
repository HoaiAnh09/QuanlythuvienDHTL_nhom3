<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\BorrowReturn;

class ReturnBookController extends Controller
{
    // Hiển thị form nhập mã sinh viên và danh sách sách mượn
    public function showReturnForm(Request $request)
    {
        $user = null;
        $borrowedBooks = [];

        if ($request->has('user_id')) {
            $user = User::where('id', $request->user_id)->where('role', 'reader')->first();
            
            if ($user) {
                $borrowedBooks = BorrowReturn::where('user_id', $user->id)
                    ->whereNull('return_date') // Chỉ lấy sách chưa trả
                    ->with('books') // Load thông tin sách
                    ->get();
            }
        }

        return view('return', compact('user', 'borrowedBooks'));
    }

    // Xử lý trả sách
    public function processReturn(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $borrow = BorrowReturn::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->whereNull('return_date') // Chỉ xử lý sách chưa trả
            ->first();

        if (!$borrow) {
            return redirect()->back()->with('error', 'Sách không hợp lệ hoặc đã được trả!');
        }

        // Xác định số ngày mượn và tính tiền phạt
        $borrowDate = strtoDatime($borrow->borrow_date);
        $returnDate = strtotime(Carbon::now());
        $daysLate = ceil(($returnDate - $borrowDate) / (60 * 60 * 24)) - 14; // Giả sử thời hạn mượn 14 ngày

        $fine = ($daysLate > 0) ? $daysLate * 5000 : 0; // 5.000đ/ngày trễ

        // Cập nhật thông tin trả sách
        $borrow->return_date = Carbon::now();
        $borrow->fine = $fine;
        $borrow->save();

        // Cập nhật số lượng tồn kho sách
        $book = Book::find($request->book_id);
        $book->quantity += 1;
        $book->save();

        return redirect()->route('return')->with('success', "Trả sách thành công! Tiền phạt: " . number_format($fine) . " VNĐ");
    }
}
