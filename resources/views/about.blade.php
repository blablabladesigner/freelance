@extends('layouts.app')

@section('title', 'О нас')

@section('content')
<!-- Заголовок страницы -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">О нас</h1>
        <div class="bg-indigo-600 mx-auto rounded-full"></div>
    </div>
</section>

<!-- Рассказ о нас -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-12 max-w-5xl mx-auto">
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Наша команда" 
                     class="rounded-2xl shadow-xl w-full">
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Кто мы?</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-4">
                    Мы — платформа для фрилансеров, созданная на Laravel. Помогаем заказчикам находить исполнителей, а специалистам — интересные проекты.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    За 5 лет работы мы помогли реализовать более 5000 проектов.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Карусель -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Наши работы</h2>
            <p class="text-gray-600">Примеры проектов наших фрилансеров</p>
        </div>
        
        <div class="relative max-w-4xl mx-auto" x-data="{ currentSlide: 0, slides: [
            {
                image: 'https://img.freepik.com/premium-photo/person-front-computer-working-html_1112329-171146.jpg?semt=ais_hybrid',
                title: 'Интернет-магазин на Laravel'
            },
            {
                image: 'https://img.freepik.com/premium-photo/young-man-programming-welllit-workspace-with-multiple-monitors-green-plants-around-him-day_93675-258789.jpg?semt=ais_hybrid&w=740',
                title: 'REST API для приложения'
            },
            {
                image: 'https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                title: 'CRM для логистики'
            }
        ] }">
            <div class="overflow-hidden rounded-2xl shadow-lg">
                <div class="flex transition-transform duration-500 ease-in-out" 
                     :style="{ transform: 'translateX(-' + (currentSlide * 100) + '%)' }">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div class="w-full flex-shrink-0 relative">
                            <img :src="slide.image" :alt="slide.title" class="w-full h-80 object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white p-4">
                                <h3 class="text-xl font-semibold" x-text="slide.title"></h3>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            <button @click="currentSlide = (currentSlide - 1 + slides.length) % slides.length" 
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-2 rounded-full shadow-md transition">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <button @click="currentSlide = (currentSlide + 1) % slides.length" 
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-2 rounded-full shadow-md transition">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div class="flex justify-center space-x-2 mt-4">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index" 
                            class="w-2 h-2 rounded-full transition"
                            :class="currentSlide === index ? 'bg-indigo-600 w-4' : 'bg-gray-300 hover:bg-indigo-400'">
                    </button>
                </template>
            </div>
        </div>
    </div>
</section>

@endsection