<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;

class CompaniesController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(25);
        return view('moderator.companies.index')->with('companies',$companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('moderator.companies.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:companies',
            'image' => 'mimes:jpeg,jpg,bmp,png',
            'categories' => 'required|array', 
            'categories.*' => 'integer',   
        ]);

        if($request->hasFile('image')){
            //get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
          //File name to Store 
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload Image
          $path = $request->file('image')->storeAs('public/company',$fileNameToStore);
            }    else {
              $fileNameToStore = 'noimage.jpg';
            }

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->activity_description = $request->activity_description;
        $company->website = $request->website;
        $company->image = $fileNameToStore;
        $company->save();
        $company->categories()->sync($request->input('categories', []));
        return redirect()->route('moderator.companies.index')->with('success', 'Η εταιρεία αποθηκεύτηκε');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all()->pluck('name', 'id');
        $company = Company::find($id);
        return view('moderator.companies.edit', compact('categories', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:companies,email,'.$company->id,
            'image' => 'mimes:jpeg,jpg,bmp,png',
            'categories' => 'required|array', 
            'categories.*' => 'integer', 
        ]);

        $image = $request->file('image');
        if($request->hasFile('image')){
            //get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
          //File name to Store 
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload Image
          $path = $request->file('image')->storeAs('public/company',$fileNameToStore);
        }   

        $company->name = $request->name;
        $company->email = $request->email;
        $company->activity_description = $request->activity_description;
        $company->website = $request->website;
        if($request->hasFile('image')){
            if ($company->image != 'noimage.jpg') {
            Storage::delete('public/company/' . $company->image);
            }
             $company->image = $fileNameToStore;
        }
        $company->save();
        $company->categories()->sync($request->input('categories', []));
        return redirect()->route('moderator.companies.index')->with('success', 'Η εταιρεία ενημερώθηκε');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('moderator.companies.index')->with('success', 'Η εταιρεία διαφράφηκε');
    }
}
