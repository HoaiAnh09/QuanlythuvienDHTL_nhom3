@extends('layouts.app')

@section('title', 'Trả Sách')

@section('content')

        <div class="p-4 bg-white">
            <!-- Hiển thị thông báo -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>✅ Thành công!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>❌ Lỗi!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form nhập thông tin trả sách -->
            <form action="{{ route('return.book') }}" method="POST" class="p-3">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label fw-bold">📌 Nhập mã độc giả:</label>
                    <input type="text" name="user_id" id="user_id" class="form-control rounded" placeholder="Nhập mã độc giả..." required>
                </div>

                <div class="mb-3">
                    <label for="book_id" class="form-label fw-bold">📚 Mã sách:</label>
                    <input type="text" name="book_id" id="book_id" class="form-control rounded" placeholder="Nhập mã sách..." required>
                </div>

                <button type="submit" class="btn btn-success">Trả sách</button>
                
            </form>
        </div>
    
@endsection
