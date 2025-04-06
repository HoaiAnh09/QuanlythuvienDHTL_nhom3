<x-app-layout>
    
    @section('content')
    <div class="p-4 bg-white">
        @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <form action="/check-user" method="GET" class="">
        @csrf
        @if(session('error'))
        @endif
        <div class="form-group mb-2">
          <label class="mb-2 fw-bold" for="user_id">📌 Nhập mã độc giả</label>
          <input type="text" class="form-control rounded" name="user_id" id="user_id" placeholder="Nhập mã độc giả">
        </div>
        <button type="submit" class="btn btn-primary">Kiểm tra</button>
      </form>
    </div>
    @endsection
</x-app-layout>
