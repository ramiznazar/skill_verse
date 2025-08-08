<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('admin.pages.dashboard.account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new account.
     */
    public function create()
    {
        return view('admin.pages.dashboard.account.create');
    }

    /**
     * Store a newly created account in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'number' => 'required|string|unique:accounts,number',
        ]);

        Account::create([
            'type'   => $request->type,
            'name'   => $request->name,
            'number' => $request->number,
        ]);

        return redirect()->route('account.index')->with('store', 'Account created successfully.');
    }

    /**
     * Display the specified account.
     */
    public function show(Account $account)
    {
        return view('admin.pages.dashboard.account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified account.
     */
    public function edit(string $id)
    {
        $account = Account::findOrFail($id);
        return view('admin.pages.dashboard.account.update', compact('account'));
    }

    /**
     * Update the specified account in storage.
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'number' => 'required|string|unique:accounts,number,' . $account->id,
        ]);
        
        $account->update([
            'type'   => $request->type,
            'name'   => $request->name,
            'number' => $request->number,
        ]);

        return redirect()->route('account.index')->with('update', 'Account updated successfully.');
    }

    /**
     * Remove the specified account from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('account.index')->with('delete', 'Account deleted successfully.');
    }
}
