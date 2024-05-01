<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index() {
        $portfolio = Portfolio::orderBy('id')->get();

        return Inertia::render('Portfolio', [
            'portfolio' => $portfolio
        ]);
    }

    public function create() {
        return Inertia::render('Portfolio');
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
    
        // If img field is provided, add validation rule for image
        if ($request->hasFile('img')) {
            $rules['img'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
    
        // Validate the incoming request data
        $request->validate($rules);
    
        // Get the base64 encoded image data if available
        $imgData = $request->input('img');
    
        // Create a new portfolio entry in the database
        Portfolio::create([
            'name' => $request->name,
            'description' => $request->description,
            'img' => $imgData,
        ]);
    
        // Redirect back to the portfolio page after creating the entry
        return redirect('/portfolio');
    }
     
    public function destroy(Portfolio $portfolio) {
        $portfolio->delete();

        return redirect('/portfolio');
    }
}
