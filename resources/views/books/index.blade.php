@extends('layouts.app')

@section('title', 'Danh sách sách')

@section('content')

<!-- Danh sách sách -->
<div class="overflow-x-auto">
    <h3 class="text-lg font-semibold mb-4">📚 Danh Sách Sách</h3>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <form action="{{ route('books.index') }}" method="GET" class="mb-4 flex items-center space-x-4">
        <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="🔍 Tìm sách..." 
            class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Tìm kiếm</button>
    </form>
    
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Tiêu đề</th>
                <th class="border border-gray-300 px-4 py-2">Tác giả</th>
                <th class="border border-gray-300 px-4 py-2">Thể loại</th>
                <th class="border border-gray-300 px-4 py-2">Số lượng</th>
                <th class="border border-gray-300 px-4 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $index => $book)
            <tr class="text-center">
                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->author }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->category }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->quantity }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('books.edit', $book->id) }}" 
                       class="bg-blue-500 text-black font-semibold px-3 py-1 rounded hover:bg-blue-600 transition duration-200"> ✏️
                    </a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white font-semibold px-3 py-1 rounded hover:bg-red-600 transition duration-200"> 🗑️
                        </button>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $books->links() }}
    </div>
    
</div>

@endsection
