@extends('layouts.app')

@section('title', 'Все работы')

@section('content')
<div class="container mx-auto px-6 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Наши работы</h1>

        <p class="text-xl text-gray-600">Все проекты, выполненные нашими фрилансерами</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($projects as $project)
        <a href="{{ route('project.show', $project->id) }}" class="block">
            <div class="project-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition duration-300">
                <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($project->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-semibold">{{ $project->price }}</span>
                        <span class="text-sm text-gray-500"><i class="far fa-user mr-1"></i> {{ $project->author }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection