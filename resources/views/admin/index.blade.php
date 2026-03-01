@extends('layouts.app')

@section('title', 'Управление проектами')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Управление проектами</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('admin.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg mb-6 inline-block hover:bg-indigo-700">
        + Добавить новый проект
    </a>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Автор</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Цена</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
@foreach($projects as $project)
<tr>
    <td class="px-6 py-4">{{ $project->id }}</td>
    <td class="px-6 py-4">{{ $project->title }}</td>
    <td class="px-6 py-4">{{ $project->author }}</td>
    <td class="px-6 py-4">{{ $project->price }}</td>
    <td class="px-6 py-4">
        <a href="{{ route('admin.edit', $project->id) }}">Редактировать</a>
        <form action="{{ route('admin.destroy', $project->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </td>
</tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection