@extends('layouts.app')

@section('title', 'Мои заказы')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Мои заказы</h1>
    
    @if($orders->isEmpty())
        <p class="text-gray-600">У вас пока нет заказов.</p>
        <a href="{{ route('works') }}" class="text-indigo-600 hover:underline">Перейти к проектам</a>
    @else
        @foreach($orders as $order)
            <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-bold">Заказ #{{ $order->id }}</span>
                            <span class="text-sm text-gray-500 ml-4">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm 
                            @if($order->status == 'new') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $order->status == 'new' ? 'Новый' : ($order->status == 'completed' ? 'Выполнен' : 'Обрабатывается') }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center py-2 border-b last:border-0">
                            <div>
                                <p class="font-semibold">{{ $item['title'] }}</p>
                                <p class="text-sm text-gray-500">Автор: {{ $item['author'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">{{ $item['price'] }}</p>
                                <p class="text-sm text-gray-500">x{{ $item['quantity'] }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 text-right">
                        <p class="text-xl font-bold text-indigo-600">Итого: {{ $order->total }} ₽</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection