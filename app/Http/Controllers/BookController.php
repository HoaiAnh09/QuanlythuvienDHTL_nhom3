<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('dashboard', compact('books'));
    }
    public function show()
    {
        $books = Book::paginate(10);
        return view('books.index', compact('books'));
    }
    public function create()
    {
        return view('books.create');
    }
    
        public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('books.show')->with('success', 'Cập nhật sách thành công!');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('books.show')->with('success', 'Xóa sách thành công!');
    }
    
}
