@extends('layouts.app')

@section('title', 'Chỉnh sửa sách')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold mb-4">✏️ Chỉnh Sửa Sách</h3>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tiêu đề</label>
            <input type="text" name="title" value="{{ $book->title }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tác giả</label>
            <input type="text" name="author" value="{{ $book->author }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Thể loại</label>
            <input type="text" name="category" value="{{ $book->category }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Số lượng</label>
            <input type="number" name="quantity" value="{{ $book->quantity }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
        <a href="{{ route('books.show') }}" class="ml-4 text-gray-600"> Quay lại</a>
    </form>
</div>

@endsection
