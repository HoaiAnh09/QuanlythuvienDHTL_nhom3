@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📖 Gửi Đề Xuất Nhập Sách</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('book_requests.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">📚 Tên sách</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">✍️ Tác giả</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Thể loại</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        

        <div class="mb-3">
            <label class="form-label">📦 Số lượng</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">📩 Gửi đề xuất</button>
    </form>
</div>
@endsection
