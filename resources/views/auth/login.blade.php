<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thư viện Đại học Thủy Lợi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="flex bg-white shadow-lg rounded-lg overflow-hidden w-3/4 max-w-4xl">
        
        <!-- Phần hình ảnh bên trái -->
        <div class="w-1/2 bg-blue-800 flex flex-col items-center justify-center p-8 text-white">
            <img src="{{ asset('images/android-chrome-512x512.png') }}" alt="Logo Đại học Thủy Lợi" class="mb-4 w-20 h-20">
            <h2 class="text-2xl font-bold">Đại học Thủy Lợi</h2>
            <p class="text-center mt-2">Hệ thống thư viện dành cho sinh viên và giảng viên.</p>
        </div>
        
        <!-- Form đăng nhập bên phải -->
        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center text-gray-700">Đăng nhập</h2>
            
            <!-- Form đăng nhập -->
            <form action="{{ route('login') }}" method="POST" class="mt-6">
                @csrf
                
                <label class="block text-gray-700">Tài khoản</label>
                <input type="text" name="email" placeholder="Nhập tài khoản" 
                       class="w-full px-4 py-2 mt-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                
                <label class="block mt-4 text-gray-700">Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu" 
                       class="w-full px-4 py-2 mt-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                
                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Quên mật khẩu?</a>
                </div>
                
                <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Đăng nhập
                </button>
            </form>
            
            <!-- Nút đăng ký -->
            <a href="{{ route('register') }}" 
               class="w-full block text-center px-4 py-2 mt-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white">
                Đăng ký
            </a>
        </div>
    </div>
</body>
</html>
