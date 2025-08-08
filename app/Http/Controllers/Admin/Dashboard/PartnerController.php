<?php
namespace App\Http\Controllers\Admin\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerBalance;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::with('balance')->get();
        return view('admin.pages.dashboard.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.pages.dashboard.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'investment' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);

        $partner = Partner::create($data);
        $partner->balance()->create(['total_balance' => 0]);
return redirect()->route('admin.dashboard.partners.index')->with('success', 'Partner added!');

    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.pages.dashboard.partners.update', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'investment' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);

        Partner::findOrFail($id)->update($data);
       return redirect()->route('admin.dashboard.partners.index')->with('success', 'Partner updated!');

    }

    public function destroy($id)
    {
        Partner::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Partner deleted!');
    }
}
