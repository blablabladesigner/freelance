<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Главная страница админки — список проектов
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.index', ['projects' => $projects]);
    }
    
    /**
     * Форма создания нового проекта
     */
    public function create()
    {
        return view('admin.create');
    }
    
    /**
     * Сохранить новый проект
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'image' => 'required|url|max:500',
        ]);
        
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->price = $request->price;
        $project->author = $request->author;
        $project->image = $request->image;
        $project->save();
        
        return redirect()->route('admin.index')->with('success', 'Проект "' . $project->title . '" успешно добавлен!');
    }
    
    /**
     * Форма редактирования проекта
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.edit', ['project' => $project]);
    }
    
    /**
     * Обновить проект
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'image' => 'required|url|max:500',
        ]);
        
        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->price = $request->price;
        $project->author = $request->author;
        $project->image = $request->image;
        $project->save();
        
        return redirect()->route('admin.index')->with('success', 'Проект "' . $project->title . '" обновлён!');
    }
    
    /**
     * Удалить проект
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $title = $project->title;
        $project->delete();
        
        return redirect()->route('admin.index')->with('success', 'Проект "' . $title . '" удалён!');
    }
    
    /**
     * Список всех заказов
     */
    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', ['orders' => $orders]);
    }
    
    /**
     * Обновить статус заказа
     */
    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,processing,completed,cancelled'
        ]);
        
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);
        
        $statusNames = [
            'new' => 'Новый',
            'processing' => 'В обработке',
            'completed' => 'Выполнен',
            'cancelled' => 'Отменён'
        ];
        
        return redirect()->route('admin.orders')->with('success', 
            'Заказ #' . $order->id . ' изменён на статус "' . $statusNames[$request->status] . '"');
    }
    
    /**
     * Удалить заказ
     */
    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $orderNumber = $order->id;
        $order->delete();
        
        return redirect()->route('admin.orders')->with('success', 'Заказ #' . $orderNumber . ' удалён');
    }
}