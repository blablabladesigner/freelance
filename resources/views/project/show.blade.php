@extends('layouts.app')

@section('title', $project->title . ' - Детали проекта')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Кнопка назад -->
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Назад
        </a>
    </div>
    
    <!-- Карточка проекта -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl mx-auto">
        <!-- Изображение -->
        <div class="h-96 overflow-hidden">
            <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
        
        <!-- Контент -->
        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $project->title }}</h1>
            
            <div class="flex items-center text-gray-600 mb-6">
                <i class="fas fa-user mr-2 text-indigo-500"></i>
                <span>Автор: <span class="font-semibold">{{ $project->author }}</span></span>
            </div>
            
            <div class="border-t border-gray-200 pt-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Описание проекта</h2>
                <p class="text-gray-600 leading-relaxed">{{ $project->description }}</p>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-sm text-gray-500">Стоимость проекта</span>
                        <div class="text-2xl font-bold text-indigo-600">{{ $project->price }}</div>
                    </div>
                    
                    <div class="text-sm text-gray-500">
                        <i class="far fa-calendar-alt mr-1"></i>
                        Добавлено: {{ \Carbon\Carbon::parse($project->created_at)->format('d.m.Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection