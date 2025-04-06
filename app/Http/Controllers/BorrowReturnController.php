<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowReturn;
use App\Models\Book;
use App\Models\User;

class BorrowReturnController extends Controller {
    public function showBorrowForm()
    {
        $users = User::all();
        return view('borrow', compact('users'));
    }
    
    public function index() {
        $borrowStats = User::where('role', 'reader')
            ->withCount([
                'borrowReturns as borrowed_books' => function ($query) {
                    $query->where('status', 'borrowed');
                },
                'borrowReturns as returned_books' => function ($query) {
                    $query->where('status', 'returned');
                },
                'borrowReturns as late_returns' => function ($query) {
                    $query->where('late_returns', true); // Kiểm tra cột boolean
                },
                'borrowReturns as lost_books' => function ($query) {
                    $query->where('lost_books', '>', 0); // Kiểm tra số sách bị mất
                }
            ])->get();
    
        return view('borrow_returns.index', compact('borrowStats'));
    }
    
    
    public function show($id) {
        $borrowReturn = BorrowReturn::with('book')->where('user_id', $id)->get();
        $user = User::findOrFail($id);
    
        if (!$borrowReturn) {
            return BorrowReturnController::index();
        }
    
        if (!$user) {
            return BorrowReturnController::index();
        }
        return view('borrow_returns.show', compact('borrowReturn', 'user'));
    }
    
    

    public function create() {
        $users = User::all();
        $books = Book::all();
        return view('borrow_returns.create', compact('users', 'books'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
        ]);

        BorrowReturn::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'borrowed'
        ]);

        return redirect()->route('borrow_returns.index')->with('success', 'Mượn sách thành công!');
    }

    public function edit($id) {
        $borrowReturn = BorrowReturn::findOrFail($id);
        return view('borrow_returns.edit', compact('borrowReturn'));
    }

    public function update(Request $request, $id) {
        $borrowReturn = BorrowReturn::findOrFail($id);
        $borrowReturn->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);

        return redirect()->route('borrow_returns.index')->with('success', 'Cập nhật trạng thái trả sách thành công!');
    }

    public function destroy($id) {
        BorrowReturn::findOrFail($id)->delete();
        return redirect()->route('borrow_returns.index')->with('success', 'Xóa lịch sử mượn trả thành công!');
    }
    public function borrow(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
        ]);

        BorrowReturn::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'status' => 'borrowed'
        ]);

        return redirect()->route('borrow_returns.index')->with('success', 'Mượn sách thành công!');
    }
    public function returnForm()
    {
        return view('borrow_returns.return');
    }
    

    public function returnBook(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);
    
        // Tìm bản ghi mượn sách chưa trả
        $borrowReturn = BorrowReturn::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->whereNull('returned_at')
            ->first();
    
        if (!$borrowReturn) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin mượn sách.');
        }
    
        $currentDate = now();
        $borrowReturn->returned_at = $currentDate;
    
        // Kiểm tra nếu sách trả muộn
        if ($currentDate->greaterThan($borrowReturn->return_date)) {
            $borrowReturn->late_returns = true; // Cập nhật cột late_returns
            $daysLate = $currentDate->diffInDays($borrowReturn->return_date);
            $borrowReturn->fine = $daysLate * 5000; // Ví dụ 5.000 VNĐ/ngày
        } else {
            $borrowReturn->late_returns = false;
            $borrowReturn->fine = 0;
        }
    
        $borrowReturn->save(); // Lưu dữ liệu vào database
    
        return redirect()->back()->with('success', 'Trả sách thành công!');
    }
    



}


