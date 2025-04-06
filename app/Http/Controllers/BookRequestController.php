<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRequest;
use App\Models\Book;

class BookRequestController extends Controller
{
    public function create()
    {
        return view('book_requests.create');
    }

    // Xử lý lưu đề xuất
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'category' => 'required',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'quantity' => 'required|integer|min:1',
    ]);

    BookRequest::create([
        'title' => $request->title,
        'author' => $request->author,
        'category' => $request->category,
        'quantity' => $request->quantity,
        'user_id' => auth()->id(), 
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', '📩 Gửi đề xuất thành công!');
}


    // Quản lý xem danh sách đề xuất
    public function index()
    {
        $requests = BookRequest::where('status', 'pending')->get();
        return view('book_requests.index', compact('requests'));
    }

    public function approve($id)
{
    $bookRequest = BookRequest::findOrFail($id);

    // Thêm sách vào bảng books
    Book::create([
        'title' => $bookRequest->title,
        'author' => $bookRequest->author,
        'category' => $bookRequest->category,
        'quantity' => $bookRequest->quantity,
    ]);

    // Xóa đề xuất sau khi duyệt
    $bookRequest->delete();

    return redirect()->back()->with('success', 'Đã duyệt đề xuất và thêm sách vào thư viện.');
}
}