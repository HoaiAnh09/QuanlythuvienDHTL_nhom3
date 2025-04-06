@extends('layouts.app')

@section('content')
<h2>Mượn Sách Mới</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('borrow_returns.borrow') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="user_id" class="form-label">Người Mượn</label>
        <select class="form-control" name="user_id" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="book_id" class="form-label">Chọn Sách</label>
        <select class="form-control" name="book_id" required>
            @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="borrow_date" class="form-label">Ngày Mượn</label>
        <input type="date" class="form-control" name="borrow_date" required>
    </div>

    <button type="submit" class="btn btn-primary">Xác nhận mượn</button>
</form>
@endsection
