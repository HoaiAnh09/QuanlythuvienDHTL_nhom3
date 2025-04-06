<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mượn sách') }}
        </h2>
    </x-slot>
    @section('content')
    <div class="p-4 bg-white">
        @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <div class="p-4 bg-white">
        @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div class="">
        <h2>Thông tin người dùng:</h2>
        <p>ID: {{$user->id}}</p>
        <p>Tên: {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
    </div>
    <form action="/borrow" method="POST" class="">
        @csrf
        <div class="form-group mb-2">
          <label class="mb-2" for="book_id">Chọn sách cần mượn</label>
          <input type="text" class="form-control rounded" name="user_id" id="user_id" value="{{$user->id}}" hidden>
          <select class="form-control rounded" name="book_id" id="book_id">
            @foreach($books as $book)
            <option value="{{$book->id}}">{{$book->title}}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mượn</button>
      </form>
    </div>
    @endsection
</x-app-layout>
