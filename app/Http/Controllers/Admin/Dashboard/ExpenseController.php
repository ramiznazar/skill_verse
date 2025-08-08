<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('admin.pages.dashboard.expense.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.dashboard.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $data = $request->validate([
            'title'   => 'nullable|string|max:255',
            'amount'  => 'nullable|numeric|min:0',
            'purpose' => 'nullable|string',
            'date'    => 'nullable|date',
        ]);

        Expense::create($data);

        return redirect()->route('expense.index')->with('store', 'Expense added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('admin.pages.dashboard.expense.update', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title'   => 'nullable|string|max:255',
            'amount'  => 'nullable|numeric|min:0',
            'purpose' => 'nullable|string',
            'date'    => 'nullable|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($data);

        return redirect()->route('expense.index')->with('update', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expense.index')->with('delete', 'Expense deleted successfully.');
    }
}
