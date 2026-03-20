@extends('layouts.app')

@section('title', 'Управление заказами')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Управление заказами</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if($orders->isEmpty())
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-600 mb-4">Заказов пока нет.</p>
            <a href="{{ route('admin.index') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Вернуться в админку
            </a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <div>
                        <span class="font-bold text-lg">Заказ #{{ $order->id }}</span>
                        <span class="text-sm text-gray-500 ml-4">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                        <span class="text-sm text-gray-500 ml-4">Клиент: {{ $order->user->name }} ({{ $order->user->email }})</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <!-- Изменение статуса -->
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border rounded-lg px-3 py-1 text-sm">
                                <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>🟡 Новый</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔵 В обработке</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>🟢 Выполнен</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>🔴 Отменён</option>
                            </select>
                            <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 text-sm">
                                Обновить
                            </button>
                        </form>
                        
                        <!-- Удаление заказа -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Удалить заказ #{{ $order->id }}?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center border-b pb-2 last:border-0">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item['title'] }}</p>
                                <p class="text-sm text-gray-500">Автор: {{ $item['author'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">{{ $item['price'] }}</p>
                                <p class="text-sm text-gray-500">x{{ $item['quantity'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t text-right">
                    <p class="text-xl font-bold text-indigo-600">Итого: {{ number_format($order->total, 0, ',', ' ') }} ₽</p>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection