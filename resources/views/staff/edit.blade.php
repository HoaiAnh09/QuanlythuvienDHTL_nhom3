@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">✏️ Chỉnh sửa nhân viên</h2>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <form action="{{ route('staff.update', $staff->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block text-gray-700">Tên</label>
            <input type="text" name="name" value="{{ $staff->name }}" class="w-full px-4 py-2 border rounded-md">
        </div>

        <div class="mb-3">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $staff->email }}" class="w-full px-4 py-2 border rounded-md">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Lưu thay đổi</button>
    </form>
</div>
@endsection
