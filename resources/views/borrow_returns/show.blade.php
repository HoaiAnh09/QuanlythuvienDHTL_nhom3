@extends('layouts.app')

@section('content')
<h2>Chi Tiết Mượn Trả - {{ $user->name }}</h2>

<table class="table">
    <thead>
        <tr>
            <th>Mã Sách</th>
            <th>Tên Sách</th>
            <th>Ngày Mượn</th>
            <th>Ngày Trả Dự Kiến</th>
            <th>Ngày Trả Thực Tế</th>
            <th>Trả Muộn</th>
            <th>Phí Phạt</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($borrowReturn as $borrow)
        <tr>
            <td>{{ $borrow->book->id }}</td>
            <td>{{ $borrow->book->title }}</td>
            <td>{{ date('d/m/Y', strtotime($borrow->borrow_date)) }}</td>
            <td>{{ date('d/m/Y', strtotime($borrow->return_date)) }}</td>
            <td>
                {{ $borrow->returned_at ? date('d/m/Y', strtotime($borrow->returned_at)) : 'Chưa trả' }}
            </td>
            <td>
                @if ($borrow->returned_at && strtotime($borrow->returned_at) > strtotime($borrow->return_date))
                    <span class="text-danger">Trả muộn</span>
                @else
                    <span class="text-success">Đúng hạn</span>
                @endif
            </td>
            <td>{{ $borrow->fine ? number_format($borrow->fine) . ' VNĐ' : 'Không' }}</td>
            <td>
                @if (!$borrow->returned_at) <!-- Nếu sách chưa trả -->
                    <form action="{{ route('return.book') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn trả sách này?');">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $borrow->user_id }}">
                        <input type="hidden" name="book_id" value="{{ $borrow->book->id }}">
                        <button type="submit" class="btn btn-sm btn-success">Trả Sách</button>
                    </form>
                @else
                    <button class="btn btn-sm btn-secondary" disabled>Đã trả</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('borrow_returns.index') }}" class="btn btn-secondary">Quay Lại</a>
@endsection
