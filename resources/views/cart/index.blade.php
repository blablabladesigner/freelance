@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Моя корзина</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    @if($cartItems->isEmpty())
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-gray-600 mb-4">Корзина пуста</p>
            <a href="{{ route('works') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition inline-flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Перейти к проектам</span>
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Проект</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Цена</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Количество</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Сумма</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="{{ $item->project->image }}" alt="{{ $item->project->title }}" class="w-12 h-12 object-cover rounded mr-3">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->project->title }}</p>
                                    <p class="text-sm text-gray-500">Автор: {{ $item->project->author }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $item->project->price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border border-gray-300 rounded-lg px-2 py-1 text-center focus:outline-none focus:border-indigo-500">
                                <button type="submit" class="text-indigo-600 hover:text-indigo-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-indigo-600">
                            {{ number_format((float) preg_replace('/[^0-9]/', '', $item->project->price) * $item->quantity, 0, ',', ' ') }} ₽
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Удалить этот проект из корзины?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="bg-gray-50 px-6 py-4 border-t">
                <div class="flex justify-between items-center">
                    <div class="text-lg font-semibold text-gray-800">
                        Итого:
                    </div>
                    <div class="text-2xl font-bold text-indigo-600">
                        {{ number_format($total, 0, ',', ' ') }} ₽
                    </div>
                </div>
                
                <div class="mt-4 text-right">
                    <button id="checkoutBtn" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow-md inline-flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Оформить заказ</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="text-center mb-4">
                <svg class="mx-auto h-12 w-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mt-2">Подтверждение заказа</h3>
                <p class="text-gray-500 mt-1">
                    Вы уверены, что хотите оформить заказ на сумму <span id="modalTotal" class="font-bold text-indigo-600"></span>?
                </p>
            </div>
            <div class="flex space-x-3">
                <button id="cancelBtn" class="flex-1 bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Отмена
                </button>
                <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Подтвердить
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Получаем общую сумму
    const totalElement = document.querySelector('.text-2xl.font-bold.text-indigo-600');
    const total = totalElement ? totalElement.innerText : '0 ₽';
    document.getElementById('modalTotal').innerText = total;
    
    // Модальное окно
    const modal = document.getElementById('confirmModal');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    
    checkoutBtn.onclick = function(e) {
        e.preventDefault();
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };
    
    cancelBtn.onclick = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };
    
    // Закрыть при клике вне окна
    modal.onclick = function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };
</script>
@endsection