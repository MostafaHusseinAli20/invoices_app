<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:المنتجات'] , ['only' => ['index']]);
        $this->middleware(['permission:اضافة منتج'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:تعديل منتج'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:حذف منتج'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = Section::all();
        $product = Product::with('section')->get();
        // $products = ;
        return view('products.products', compact('section','product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaidator = $request->validate([
            'product_name' => 'required',
            'section_id' => 'required',
        ],
        [
            'product_name.required' => 'يرجي أدخال اسم المنتج',
            'product_name.unique' => 'هذا المنتج مسجل بالفعل',
            'section_id.required' => 'يرجي أدخال قسم المنتج'
        ]);
        Product::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'section_id' => $request->section_id,
        ]);
        session()->flash('Add' , 'تم اضافة المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $id = Section::where('section_name', $request->section_name)->first()->id;

       $Products = Product::findOrFail($request->pro_id);

       $this->validate($request, [
        'product_name' => 'required',
    ],[
        'product_name.required' => 'يرجي أدخال اسم المنتج',
        'product_name.unique' => 'هذا الأسم مسجل بالفعل',
    ]);

       $Products->update([
       'product_name' => $request->product_name,
       'product_description' => $request->product_description,
       'section_id' => $id,
       ]);

       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $products = Product::findOrFail($request->pro_id);
        $products->delete();
        session()->flash('Delete' , 'تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
