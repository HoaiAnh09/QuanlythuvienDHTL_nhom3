@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">

    @if (session('success'))
        <div class="alert alert-success p-3 mb-3 bg-green-200 text-green-800">
            {{ session('success') }}
        </div>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <table class="min-w-full bg-white border border-gray-300 shadow-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Tên</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Chức vụ</th>
                <th class="py-2 px-4 border">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staffs as $staff)
                <tr class="text-center">
                    <td class="py-2 px-4 border">{{ $staff->id }}</td>
                    <td class="py-2 px-4 border">{{ $staff->name }}</td>
                    <td class="py-2 px-4 border">{{ $staff->email }}</td>
                    <td class="py-2 px-4 border">{{ $staff->role }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('staff.edit', $staff->id) }}" 
                           class="inline-block px-3 py-1 text-white bg-yellow-400 rounded hover:bg-yellow-500">
                            Sửa
                        </a>
                        <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">Xóa</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
