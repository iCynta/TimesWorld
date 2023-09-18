<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Colors;
use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $message;


    public function index()
    {
        $products = Products::withTrashed()->get();
        return view('products/index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Colors::all();
        $sizes  = Sizes::all();
        return view('products/create')
                ->with('colors',$colors)
                ->with('sizes',$sizes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product['title']       = $request->title;
        $product['description'] = $request->description;
        $product['color_id']    = (int)$request->color_id;
        $product['size_id']     = (int)$request->size_id;
        $product['image']       =  $request->image;
        dd($request->image);
        $validator = Validator::make(
            $product, 
            [
                'title'         => 'required',
                'description'   => 'required',
                'color_id'      => 'required',
                'size_id'       => 'required',
            ], 
            [
                'title.required'        => "Title is required.",
                'description.required'  => "Description is required.",
                'color_id.required'     => "Please select a color.",
                'size_id.equired'       => "Please select a size."
            ]);
        
        if($validator->fails()){
            return view('create-product')->withErrors($validator);
        } else {
            $image_name = $this->upload_product_image($request->image);
            $product['image']     = $image_name;
            $product_id = Products::create($product)->id;
            $this->message = "SUCCESS : Product created Successfully";
            
            return redirect()->route('product', ['id' => $product_id])->with('success',$this->message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $product = Products::where('id',$request->id)->first();
        if($product) {
            return view('products/view')->with('product',$product);
        }
        else {
            $this->message = "ERROR : Product not found.";
            return redirect()->route('products')->with('warning',$this->message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $colors = Colors::all();
        $sizes  = Sizes::all();
        $product = Products::where('id',$request->id)->first();
        return view('products/edit')
                ->with('product',$product)
                ->with('colors',$colors)
                ->with('sizes',$sizes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       $validator = Validator::make(
            array(
                'title'         => $request->title,
                'description'   => $request->description,
                'color_id'         => $request->color_id,
                'size_id'          => $request->size_id,
            ),
            array(
                'title'         => 'required',
                'description'   => 'required',
                'color_id'      => 'required',
                'size_id'       => 'required',

            )
        );
        
        if($validator->fails()){
            $this->message = ("VALIDATION ERROR : Please fill all the required fields" );
            redirect()->route('edit-product',$request->id)->with('error',$this->message);
        } else {
            $data['title'] = $request->title;
            $data['color_id'] = $request->color_id;
            $data['size_id'] = $request->size_id;
            $data['description'] = $request->description;
            Products::where('id',$request->id)->update($data);
            $this->message = ("SUCCESS : Successfully updated the Product details" );
            return redirect()->route('products')->with('success',$this->message);
        }
    }
    
    public function disable($id){
        $products = Products::where('id',$id)->delete();
        $this->message = "SUCCESS: Successfully deleted the product";
        return redirect()->route('products')->with('success',$this->message);
     
    }
    
    public function enable($id){
        Products::where('id',$id)->restore();
        $this->message = "SUCCESS: Successfully enabled Product";
        return redirect()->route('products')->with('success',$this->message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $products = Products::where($id,'id');
        $products->forceDelete();
        $this->message = "SUCCESS: Successfully thrashed the Product";
        return redirect()->route('products')->with('success',$this->message);
    }
    
    public function upload_product_image($image){
        $imageName = time().'.'.$image->extension();  
        $image->move(public_path('images/products'), $imageName);
        return $imageName;
    }
   
    /**
     * Upload image to the public/images/products folder.
    */
    public function store_image(Request $request): JsonResponse
    {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {

              $data['success'] = 0;
              $data['error'] = $validator->errors()->first('file');// Error response

         } else {
             
         }
          
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/products'), $imageName);
        
        if($request->hasFile($imageName)){ 
            return response()->json([
                'product_image_name' => $imageName,
            ]);
        } else {
            return response()->json([
                'product_image_name' => FALSE,
            ]);
        }

    }
}
