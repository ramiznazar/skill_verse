<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Expense::query()->orderBy('date', 'desc');

        // 🔎 Search filter
        $search = trim((string) $request->get('search'));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('ref_type', 'like', "%{$search}%");
            });
        }

        if ($request->filled('month')) {
            $query->whereMonth('date', '=', Carbon::parse($request->month)->month)
                ->whereYear('date', '=', Carbon::parse($request->month)->year);
        }
        if ($request->filled('type') && in_array($request->type, ['essential', 'non-essential'])) {
            $query->where('type', $request->type);
        }
        if ($request->filled('ref_type')) {
            $query->where('ref_type', $request->ref_type);
        }

        // ✅ Paginate and get filtered expenses
        $expenses = $query->paginate(15)->withQueryString();

        // 💰 Summary totals
        $totalExpense = $query->sum('amount');
        $essentialTotal = (clone $query)->where('type', 'essential')->sum('amount');
        $nonEssentialTotal = (clone $query)->where('type', 'non-essential')->sum('amount');

        // 📦 Categories list (for filter dropdown)
        $categories = Expense::select('ref_type')
            ->distinct()
            ->pluck('ref_type')
            ->filter()
            ->values();

        return view('admin.pages.dashboard.expense.index', compact(
            'expenses',
            'totalExpense',
            'essentialTotal',
            'nonEssentialTotal',
            'categories'
        ));
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
            'title' => 'required|string|max:255',
            'ref_type' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'purpose' => 'nullable|string',
            'type' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $expense = Expense::create($data);

        // 🔔 Create Notification
        $notification = Notification::create([
            'title' => 'New Expense',
            'message' => 'Expense of ₨' . number_format($expense->amount) . ' added (' . $expense->title . ')',
            'icon' => 'fa fa-credit-card',
            'type' => 'expense',
            'status' => 1, // active
        ]);

        // Attach to target roles (no Spatie; using users.role column)
        $targetRoles = ['admin', 'administrator', 'partner'];
        $userIds = \App\Models\User::whereIn('role', $targetRoles)->pluck('id');

        if ($userIds->isNotEmpty()) {
            $now = now();
            $attach = [];
            foreach ($userIds as $uid) {
                $attach[$uid] = ['is_read' => false, 'created_at' => $now, 'updated_at' => $now];
            }
            $notification->users()->syncWithoutDetaching($attach);
        }

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
            'title' => 'required|string|max:255',
            'ref_type' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'purpose' => 'nullable|string',
            'type' => 'required|string',
            'date' => 'nullable|date',
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
