<?php

namespace App\Http\Controllers;

use App\Models\AgriTip;
use App\TipCategory;
use Illuminate\Http\Request;

class AgriTipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AgriTip::latest();
        
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
        
        $tips = $query->paginate(10);
        $categories = TipCategory::options();
        
        return view('agri-tips.index', compact('tips', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TipCategory::options();
        return view('agri-tips.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'in:crop_cultivation,pest_management,soil_care,irrigation,fertilizer,harvesting,livestock,weather'],
        ], [
            'title.required' => 'শিরোনাম অবশ্যই প্রয়োজন।',
            'title.string' => 'শিরোনাম অবশ্যই একটি বৈধ টেক্সট হতে হবে।',
            'title.max' => 'শিরোনাম সর্বোচ্চ ২৫৫ অক্ষরের হতে পারে।',
            'description.required' => 'বিবরণ অবশ্যই প্রয়োজন।',
            'description.string' => 'বিবরণ অবশ্যই একটি বৈধ টেক্সট হতে হবে।',
            'category.required' => 'বিভাগ নির্বাচন অবশ্যই প্রয়োজন।',
            'category.in' => 'নির্বাচিত বিভাগটি বৈধ নয়।',
        ]);

        AgriTip::create($data);

        return redirect()->route('agri-tips.index')
            ->with('success', 'কৃষি টিপ সফলভাবে তৈরি হয়েছে!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AgriTip $agriTip)
    {
        return view('agri-tips.show', compact('agriTip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgriTip $agriTip)
    {
        $categories = TipCategory::options();
        return view('agri-tips.edit', compact('agriTip', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AgriTip $agriTip)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'in:crop_cultivation,pest_management,soil_care,irrigation,fertilizer,harvesting,livestock,weather'],
        ], [
            'title.required' => 'শিরোনাম অবশ্যই প্রয়োজন।',
            'title.string' => 'শিরোনাম অবশ্যই একটি বৈধ টেক্সট হতে হবে।',
            'title.max' => 'শিরোনাম সর্বোচ্চ ২৫৫ অক্ষরের হতে পারে।',
            'description.required' => 'বিবরণ অবশ্যই প্রয়োজন।',
            'description.string' => 'বিবরণ অবশ্যই একটি বৈধ টেক্সট হতে হবে।',
            'category.required' => 'বিভাগ নির্বাচন অবশ্যই প্রয়োজন।',
            'category.in' => 'নির্বাচিত বিভাগটি বৈধ নয়।',
        ]);

        $agriTip->update($data);

        return redirect()->route('agri-tips.show', $agriTip)
            ->with('success', 'কৃষি টিপ সফলভাবে আপডেট হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgriTip $agriTip)
    {
        $agriTip->delete();

        return redirect()->route('agri-tips.index')
            ->with('success', 'কৃষি টিপ সফলভাবে মুছে ফেলা হয়েছে!');
    }
}