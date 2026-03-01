@extends('layouts.app')

@section('title', 'Добавить проект')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Добавить новый проект</h1>
    
    <form action="{{ route('admin.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 max-w-2xl">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Название проекта</label>
            <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Описание</label>
            <textarea name="description" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Цена</label>
            <input type="text" name="price" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Автор</label>
            <input type="text" name="author" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Ссылка на изображение</label>
            <input type="url" name="image" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">Отмена</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                Сохранить проект
            </button>
        </div>
    </form>
</div>
@endsection