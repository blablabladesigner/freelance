@extends('layouts.app')

@section('title', $project->title . ' - Детали проекта')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Назад
        </a>
    </div>
    

    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl mx-auto">
        <!-- Изображение -->
        <div class="h-96 overflow-hidden">
            <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
        
        <form action="{{ route('cart.add', $project->id) }}" method="POST">
    @csrf

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
                    
<div class="mt-8 text-center">
    <form action="{{ route('cart.add', $project->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow-md inline-flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span>Добавить в корзину</span>
        </button>
    </form>
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