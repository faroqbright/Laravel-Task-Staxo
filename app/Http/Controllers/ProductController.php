<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail; // Import Mail facade
use Illuminate\Http\Request;
use App\Mail\ThankYouEmail; // Import your Mailable class here

class ProductController extends Controller
{

  
    public function submitForm(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'link' => 'required|string|max:255',
            'image' => 'required|image', 

        ]);

         // Store image in public/uploads directory
    $imageName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('uploads'), $imageName);

        // $user_id = Auth::id();
        $Product = new Product();
        $Product->name = $validated['name'];
        $Product->link = $validated['link'];
        $Product->price = $validated['price'];
        $Product->image = $imageName; 
   
        $Product->save();

        return redirect()->back()->with('success', 'Product saved successfully!');
    }

//     public function destroy(Product $product)
//     {

        
//         $product->delete();
//   $imagePath = public_path('uploads/' . $product->image);

//   if (file_exists($imagePath)) {
//       unlink($imagePath);
//   }
//         return redirect()->back()->with('success', 'Product deleted successfully');
//     }




    public function destroy($id)
{
    $product = Product::findOrFail($id);
    
    // Delete the product
    $product->delete();
  $imagePath = public_path('uploads/' . $product->image);

  if (file_exists($imagePath)) {
      unlink($imagePath);
  }
   
       // Return JSON response
       return response()->json(['erorr' => 'Product deleted successfully']);
}





    public function edit(Request  $request, $id)
    {


        $products = Product::where('id', $id)->get();
        return view('admin.editproduct', compact('products'));
    }
    public function update(Request $request, Product $product)
    {
        // return $product->image;
        // return $request;
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'link' => 'required|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Check if a new image is being uploaded
        if ($request->hasFile('image')) {
            // Delete previous image if it exists
            if ($product->image) {
                $previousImagePath = public_path('uploads/' . $product->image);
                if (File::exists($previousImagePath)) {
                    File::delete($previousImagePath); // Delete previous image file
                    // return 'asda'.$previousImagePath;
                }
            }
    
            // Store and update with the new image
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $product->image = $imageName;
        }
    
        // Update other product details
        $product->name = $request->name;
        $product->price = $request->price;
        $product->link = $request->link;
    
        // Save the updated product details to the database
        $product->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Product updated successfully');
    }
    
    public function show_single_product(Request $request, $id){


        $product = Product::where('id', $id)->get();
        return view('productshow', compact('product'));
    }
    public function purchase(Request $request){


        $product = Purchase::where('id', $id)->with('product')->get();
        return view('checkout');

    }




public function thanks(Request $request, $id ,$cus_id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);
      // Assuming authenticated user; retrieve user details


    // Assuming authenticated user; retrieve user details
    $user = $request->user();

    // Record the purchase in the database
    $purchase = Purchase::create([
        'user_id' => $user->id,
        'email' => $user->email,
        'product_id' => $product->id,
        'product_image' => $product->image,
        'product_price' => $product->price,
        'customer_id' => $cus_id, // Save the Stripe session ID

    ]);

      
    // Send thank you email
    Mail::to($request->user())->send(new ThankYouEmail($product));

    // Return view or redirect to a thank you page
    return view('thank_u', ['product' => $product]);
}
}

