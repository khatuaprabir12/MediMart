<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
   public function index()
   {
    // return view('dashboard.index');
     // Fetch total counts from the database
     $totalProducts = DB::table('products')->count();
     $totalUsers = DB::table('users')->count();
     $totalOrders = DB::table('orders')->count();
    //  $totalRevenue = DB::table('orders')->sum('total_price');

     // Pass the data to the view
     return view('dashboard.index', [
         'totalProducts' => $totalProducts,
         'totalUsers' => $totalUsers,
         'totalOrders' => $totalOrders,
        //  'totalRevenue' => $totalRevenue,
     ]);
   }

   //view product
   public function products()
   {
    
    $products=DB::table('products')->join('catagories','products.catagory_id','catagories.id')->select('catagories.*','products.*','catagories.id as catagory_id')
    ->get();
    
    
    return view ('dashboard.product',compact('products'));
   }


// add product
   public function add_product(Request $req)
   {
    


        $name=$req->input('title');
        $price=$req->input('price');
        $quantity=$req->input('quantity');
        $category=$req->input('category');
        if($req->file('image'))
        $file=$req->file('image');
        $fileName=time()."_".$file->getClientOriginalName();
        $uploadLocation="./product_image";
        $file->move($uploadLocation,$fileName);
        $add_data=[
            'name'=>$name,
            'price'=>$price,
            'image'=>$uploadLocation."/".$fileName,
            'catagory_id'=>$category,
            'quantity'=>$quantity,
            
            
            'created_at' => now()
        ];
        DB::table('products')->insert($add_data);
        // dd($add_data);
        // return view('dashboard.product');
        return redirect()->back()->with('success', 'Product added successfully!');
   }

   public function edit_product(Request $req, $id)
   {
       // Validate the input
    //    $req->validate([
    //        'title' => 'required|string|max:255',
    //        'price' => 'required|numeric',
    //        'quantity' => 'required|integer',
    //        'category' => 'required|string',
    //        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //    ]);
   
       // Prepare the update data
       $update_data = [
           'name' => $req->input('title'),
           'price' => $req->input('price'),
           'quantity' => $req->input('quantity'),
           'catagory_id' => $req->input('category'),
           'updated_at' => now(),
       ];
   
       // Handle image upload if a new image is provided
       if ($req->hasFile('image')) {
           $file = $req->file('image');
           $fileName = time() . "_" . $file->getClientOriginalName();
           $uploadLocation = './product_image';
           $file->move($uploadLocation, $fileName);
   
           $update_data['image'] = $uploadLocation . '/' . $fileName;
       }
   
       // Update the product in the database
       $affected = DB::table('products')
           ->where('id', $id)
           ->update($update_data);
   
       if ($affected) {
           return redirect()->back()->with('message', 'Product updated successfully!');
       } else {
           return redirect()->back()->with('message', 'Failed to update product!');
       }
   }


   //delete

//    public function delete_product(Request $req, $del_id)
//    {
//     $deleteid=$del_id;
//     DB::table('products')->where('id',$deleteid)
//                              ->delete();


//    }



public function delete_product(Request $req, $id)
{
    // Check if the product exists
    $product = DB::table('products')->where('id', $id)->first();

    if (!$product) {
        return redirect()->back()->with('message', 'Product not found!');
    }

    // Delete the product
    $deleted = DB::table('products')->where('id', $id)->delete();

    if ($deleted) {
        return redirect()->back()->with('message', 'Product deleted successfully!');
    } else {
        return redirect()->back()->with('message', 'Failed to delete product!');
    }
}



//user view

public function customer_view()
{
    // Fetch all users (customers) from the database
    $totalUsers = DB::table('users')->get(); // Fetch all users

    // Return the admin dashboard view with the total users
    return view('dashboard.customer_view', compact('totalUsers'));
}
public function blockCustomer($id)
{
    DB::table('users')->where('id', $id)->update(['status' => 'block']);
    return redirect()->back()->with('message', 'Customer blocked successfully.');
}

public function unblockCustomer($id)
{
    DB::table('users')->where('id', $id)->update(['status' => 'unblock']);
    return redirect()->back()->with('message', 'Customer unblocked successfully.');
}

public function deleteCustomer($id)
{
    DB::table('users')->where('id', $id)->delete();
    return redirect()->back()->with('message', 'Customer deleted successfully.');
}


//order view

// public function orderDetails($orderId)
// {
//     // Fetch the order details
//     $order = DB::table('orders')
//                 ->where('id', $orderId)
//                 ->first();

//     // Fetch the items for this order, along with product details
//     $orderItems = DB::table('order_items')
//                     ->join('products', 'order_items.product_id', '=', 'products.id')
//                     ->where('order_items.order_id', $orderId)
//                     ->select('order_items.*', 'products.name as product_name', 'products.price as product_price')
//                     ->get();

//     // Pass the correct variable names to the view
//     return view('dashboard.vieworder', compact('order', 'orderItems'));
// }

// Display all orders
public function  showOrders()
{
   
        // Fetch orders with their related order items
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('dashboard.orderlist', compact('orders'));
    }

    public function viewOrderDetails($id)
    {
        // Fetch specific order details
        $order = DB::table('orders')
            ->where('id', $id)
            ->first();

        $orderItems = DB::table('order_items')
            ->where('order_id', $id)
            ->get();

        return view('dashboard.vieworder', compact('order', 'orderItems'));
    }

   
   
//admin profile view
public function admin_profile()
{
    $id=session()->get('session_id');
    $admin = DB::table('admin')->find($id);
     
   return view('dashboard.adminprofile', compact('admin'));
   
}

//admin profile update
public function updateProfile(Request $request)
{
    $id = session()->get('session_id');
    $admin = DB::table('admin')->where('id', $id)->first();

    // Validate inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        // 'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update profile data
    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
        'updated_at' => now(),
    ];

    // Check if an image file is uploaded
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = time() . "_" . $file->getClientOriginalName();
        $uploadLocation = public_path('users_img'); // Ensure it's publicly accessible
        $file->move($uploadLocation, $fileName);

        $updateData['profile_image'] = 'users_img/' . $fileName;
    }

    // Update admin data
    DB::table('admin')->where('id', $id)->update($updateData);

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


}
