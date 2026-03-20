<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
<a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 hover:text-indigo-800 transition">
    <i class="fas fa-laravel text-indigo-500 mr-1"></i> Lara<span class="text-gray-800">Freelance</span>
</a>    
        
        <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
            <a href="{{ route('about') }}" class="hover:text-indigo-600 transition">О нас</a>
            <a href="{{ route('works') }}" class="hover:text-indigo-600 transition">Работы</a>
            
            @auth
                <a href="{{ route('cart.index') }}" class="hover:text-indigo-600 transition">Корзина</a>
                <a href="{{ route('profile.orders') }}" class="hover:text-indigo-600 transition">Мои заказы</a>
                
                @if(auth()->user()->is_admin)
                    <a href="/admin" class="text-indigo-600 font-bold hover:text-indigo-800 transition">Админка</a>
                    <a href="{{ route('admin.orders') }}" class="hover:text-indigo-600 transition">Заказы</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 transition">
                        Выйти ({{ auth()->user()->name }})
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Вход</a>
                <a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>