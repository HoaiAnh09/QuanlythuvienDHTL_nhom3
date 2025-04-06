@extends('layouts.app')

@section('content')
<h2>Danh Sách Mượn Trả</h2>

<table class="table">
    <thead>
        <tr>
            <th>Mã Độc Giả</th>
            <th>Tên Độc Giả</th>
            <th>Số Sách Đang Mượn</th>
            <th>Số Sách Đã Trả</th>
            <th>Số Sách Trả Muộn</th>
            <th>Số Sách Bị Mất</th>
            <th>Chi Tiết</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($borrowStats as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->borrowed_books }}</td>
            <td>{{ $user->returned_books }}</td>
            <td>{{ $user->late_returns }}</td>
            <td>{{ $user->lost_books }}</td>
            <td>
                <a href="{{ route('borrow_returns.show', $user->id) }}" class="btn btn-info">Xem</a>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
