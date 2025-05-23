<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thông tin hồ sơ') }}
        </h2>
        
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-slot>
</x-app-layout>
{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa Hồ sơ</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">Tên:</label>
        <input type="text" name="name" value="{{ auth()->user()->name }}" required>

        <button type="submit">Cập nhật</button>
        
    </form>
</div>
@endsection --}}
