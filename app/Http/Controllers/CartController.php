<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Страница корзины
     */
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('project')->get();
        
        // Считаем общую сумму (убираем все нецифровые символы из цены)
        $total = $cartItems->sum(function ($item) {
            $price = preg_replace('/[^0-9]/', '', $item->project->price);
            return (float) $price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }
    
    /**
     * Добавить проект в корзину
     */
    public function add(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        
        $cartItem = Auth::user()->cartItems()->where('project_id', $projectId)->first();
        
        if ($cartItem) {
            $cartItem->increment('quantity');
            $message = 'Количество проекта "' . $project->title . '" увеличено';
        } else {
            Auth::user()->cartItems()->create([
                'project_id' => $projectId,
                'quantity' => 1
            ]);
            $message = 'Проект "' . $project->title . '" добавлен в корзину!';
        }
        
        return redirect()->back()->with('success', $message);
    }
    
    /**
     * Удалить проект из корзины
     */
    public function remove($id)
    {
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $projectTitle = $cartItem->project->title;
        $cartItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Проект "' . $projectTitle . '" удален из корзины');
    }
    
    /**
     * Обновить количество проекта в корзине
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
        
        return redirect()->route('cart.index')->with('success', 'Количество обновлено');
    }
    

    public function checkout(Request $request)
    {
        $cartItems = Auth::user()->cartItems()->with('project')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        
        $total = $cartItems->sum(function ($item) {
            $price = preg_replace('/[^0-9]/', '', $item->project->price);
            return (float) $price * $item->quantity;
        });
        
        // Сохраняем заказ
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'items' => $cartItems->map(function ($item) {
                return [
                    'id' => $item->project->id,
                    'title' => $item->project->title,
                    'price' => $item->project->price,
                    'quantity' => $item->quantity,
                    'author' => $item->project->author,
                ];
            })->toArray(),
            'status' => 'new',
        ]);
        
        Auth::user()->cartItems()->delete();
        
        return redirect()->route('profile.orders')->with('success', 'Заказ #' . $order->id . ' успешно оформлен!');
    }
}