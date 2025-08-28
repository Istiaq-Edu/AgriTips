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
        try {
            $query = AgriTip::latest();
            $categories = TipCategory::options();
            $selectedCategory = $request->get('category');
            
            // Validate category and apply filter if provided and valid
            if ($request->filled('category') && array_key_exists($selectedCategory, $categories)) {
                $query->byCategory($request->category);
            } else {
                // If invalid category provided, reset to null
                $selectedCategory = null;
            }
            
            $tips = $query->paginate(10);
            
            return view('agri-tips.index', compact('tips', 'categories', 'selectedCategory'));
        } catch (\Exception $e) {
            return view('agri-tips.index', [
                'tips' => collect(),
                'categories' => TipCategory::options(),
                'selectedCategory' => null
            ])->with('error', 'কৃষি টিপ লোড করতে সমস্যা হয়েছে।');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = TipCategory::options();
            return view('agri-tips.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('agri-tips.index')
                ->with('error', 'নতুন কৃষি টিপ তৈরির পেজ লোড করতে সমস্যা হয়েছে।');
        }
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

        try {
            AgriTip::create($data);
            return redirect()->route('agri-tips.index')
                ->with('success', 'কৃষি টিপ সফলভাবে তৈরি হয়েছে!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'কৃষি টিপ তৈরি করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AgriTip $agriTip)
    {
        try {
            return view('agri-tips.show', compact('agriTip'));
        } catch (\Exception $e) {
            return redirect()->route('agri-tips.index')
                ->with('error', 'অনুরোধকৃত কৃষি টিপটি খুঁজে পাওয়া যায়নি।');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgriTip $agriTip)
    {
        try {
            $categories = TipCategory::options();
            return view('agri-tips.edit', compact('agriTip', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('agri-tips.show', $agriTip)
                ->with('error', 'কৃষি টিপ সম্পাদনার পেজ লোড করতে সমস্যা হয়েছে।');
        }
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

        try {
            $agriTip->update($data);
            return redirect()->route('agri-tips.show', $agriTip)
                ->with('success', 'কৃষি টিপ সফলভাবে আপডেট হয়েছে!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'কৃষি টিপ আপডেট করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgriTip $agriTip)
    {
        try {
            // Check if the tip still exists (in case of concurrent deletion)
            if (!$agriTip->exists) {
                return redirect()->route('agri-tips.index')
                    ->with('error', 'এই কৃষি টিপটি আগেই মুছে ফেলা হয়েছে।');
            }
            
            // Store tip title for success message
            $tipTitle = $agriTip->title;
            
            // Delete the tip
            $agriTip->delete();
            
            return redirect()->route('agri-tips.index')
                ->with('success', "কৃষি টিপ \"{$tipTitle}\" সফলভাবে মুছে ফেলা হয়েছে!");
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Failed to delete AgriTip: ' . $e->getMessage(), [
                'tip_id' => $agriTip->id,
                'tip_title' => $agriTip->title ?? 'Unknown'
            ]);
            
            return redirect()->back()
                ->with('error', 'কৃষি টিপ মুছে ফেলতে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }
}