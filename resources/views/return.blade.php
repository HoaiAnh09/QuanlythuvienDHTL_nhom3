@extends('layouts.app')

@section('title', 'Trả Sách')

@section('content')
    <h2>Trả sách</h2>

    {{-- Form nhập mã sinh viên --}}
    <form method="GET" action="{{ route('return') }}">
        <label for="user_id">Nhập mã sinh viên:</label>
        <input type="text" id="user_id" name="user_id" value="{{ request('user_id') }}" required>
        <button type="submit">Tìm kiếm</button>
    </form>

    {{-- Hiển thị danh sách sách mượn --}}
    @if(isset($user))
        <h3>Thông tin độc giả</h3>
        <p><strong>Mã sinh viên:</strong> {{ $user->id }}</p>
        <p><strong>Tên:</strong> {{ $user->name }}</p>

        @if($borrowedBooks->isEmpty())
            <p>Không có sách nào đang mượn.</p>
        @else
            <h3>Sách đã mượn</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sách</th>
                        <th>Ngày mượn</th>
                        <th>Hạn trả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowedBooks as $borrow)
                        <tr>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->borrow_date }}</td>
                            <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->addDays(14)->format('Y-m-d') }}</td>
                            <td>
                                <form method="POST" action="{{ route('return.process') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="book_id" value="{{ $borrow->book_id }}">
                                    <button type="submit">Trả sách</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif

    {{-- Hiển thị thông báo --}}
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
@endsection
