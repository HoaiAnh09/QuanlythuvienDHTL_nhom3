<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trang Chủ') }}
        </h2>
    </x-slot> --}}

    @section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <!-- Hình ảnh thư viện -->
        <div class="mb-6">
            <img src="{{ asset('images/library.jpg') }}" alt="Thư viện" class="w-full h-64 object-cover rounded-lg shadow-lg">
        </div>

    </div>
    <footer class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-2">📍 Thông Tin Thư Viện</h3>
            <p><strong>🏛 Địa chỉ:</strong> 175 Tây Sơn, Đống Đa, Hà Nội</p>
            <p><strong>⏰ Giờ mở cửa:</strong> 8:00 - 17:00 (Thứ 2 - Thứ 7)</p>
            <p><strong>📞 Liên hệ:</strong> 024-38522201</p>
        </footer>
    @endsection
</x-app-layout>
