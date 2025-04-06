@extends('layouts.app')

@section('content')
<div class="container">
    <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('book_requests.create') }}'">📥 Gửi Đề Xuất</button>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Tên sách</th>
                <th>Tác giả</th>
                <th>Thể loại</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->title }}</td>
                <td>{{ $request->author }}</td>
                <td>{{ $request->category }}</td>
                <td>{{ $request->quantity }}</td>
                <td>
                    <form action="{{ route('book_requests.approve', $request->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">✅ Duyệt</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
