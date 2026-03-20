
@extends('layouts.app')

@section('title', 'Главная - Биржа фрилансеров')

@section('content')

<section class="bg-gradient-to-br from-indigo-50 to-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
            Биржа фрилансеров на <span class="text-indigo-600">Laravel</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
            Современная PHP-платформа для заказчиков и исполнителей.
        </p>
       <div class="flex justify-center space-x-4">
    <a href="#works" class="bg-white text-indigo-600 border border-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">Примеры работ</a>
</div>
    </div>
</section>


<section id="about" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">О нас</h2>

        </div>
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Team" class="rounded-2xl shadow-xl w-full">
            </div>
            <div class="md:w-1/2 space-y-6">
                <h3 class="text-2xl font-semibold text-gray-800">Платформа для профессионалов на Laravel</h3>
                <p class="text-gray-600 leading-relaxed">
                    Мы объединяем заказчиков и лучших PHP-разработчиков, дизайнеров, копирайтеров.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    <i class="fas fa-check-circle text-indigo-500 mr-2"></i>
                    Более 5000 завершенных проектов
                </p>
                <p class="text-gray-600 leading-relaxed">
                    <i class="fas fa-check-circle text-indigo-500 mr-2"></i>
                    Прозрачная система рейтингов
                </p>
                <p class="text-gray-600 leading-relaxed">
                    <i class="fas fa-check-circle text-indigo-500 mr-2"></i>
                    Безопасная сделка 24/7
                </p>
            </div>
        </div>
    </div>
</section>


<section id="works" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Наши проекты</h2>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">Работы, выполненные фрилансерами через нашу биржу</p>
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
</section>
@endsection