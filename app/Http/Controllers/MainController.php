<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
header('Cache-Control: no-cache, no-store');

class MainController extends Controller
{
    public function index()
    {
        // return view('home');
        $categories = DB::table('catagories')->get();
        $products = DB::table('products')->get();
    
        foreach ($categories as $category) {
            $category->products = DB::table('products')->where('catagory_id', $category->id)->get();
        }
    
        return view('home', compact('categories', 'products'));
    }
    public function register():View
    {
        return view('register');  //blade.php
    }
    public function data_submit(Request $req)
    {
        // dd($req->all());
        $req->validate(
            ['name' => 'required|regex:/^[A-Za-z ]{3,40}$/',
            'email' => 'required|regex:/^[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,3}$/|unique:users,email,',
            'phone' => 'required|regex:/^[789]\d{9}$/|unique:users,phone,',
            'password' => 'required|min:4,10',
            'conf_password'=> 'required|min:4,10',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

        ],
        [
            'name.required'=> 'Required minimum 3 characters',
            'email.unique' => 'The email address is already registered.',
            'email.required' => 'Email is required.',
            'email.regex' => 'Invalid email format.',
            'phone.unique' => 'The phone number is already registered.',
            'phone.regex' => 'Enter Valided Phone Number',
            'password.required'=> 'Required minimum 4 Numbers',
            'image.required'=> 'Image Required ',
        ]);
            

            $name=$req->input('name');
            $email=$req->input('email');
            $phone=$req->input('phone');
            $password=$req->input('password');
            $conf_password=$req->input('conf_password');
            if($req->file('image'))
            $file=$req->file('image');
            $fileName=time()."_".$file->getClientOriginalName();
            $uploadLocation="./users_img";
            $file->move($uploadLocation,$fileName);
            $data=[
                'name'=>$name,
                'email'=>$email,
                'phone'=>$phone,
                'password'=>$password,
                'profile_image'=>$uploadLocation."/".$fileName,
                'type' => 'client',
                'created_at' => now()
               

            ];

            if($password==$conf_password){
                 DB::table('users')->insert($data);
                // dd($data);
                return redirect('login');
            }

    }


    //login

    public function login():View
    {
        return  view('login'); // blade.php
    }

    // public function data_login(Request $req)
    // {
    //     $req->validate(
    //         [
    //             'username' => [
    //                 'required',
    //                 'regex:/^(\d{10}|[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,})$/'
    //             ],
    //             'password' => 'required|min:4|max:10',
    //         ],
    //         [
    //             'username.required' => 'Username is required.',
    //             'username.regex' => 'Enter a valid email or phone number.',
    //             'password.required' => 'Password is required.',
    //             'password.min' => 'Password must be at least 4 characters.',
    //             'password.max' => 'Password must not exceed 10 characters.',
    //         ]
    //     );


    //     $userId=$req->input('username');
    //     $password=$req->input('password');
    //     $loginData= DB::table('users')->where('email',$userId)
    //                                   ->orWhere('phone',$userId)
    //                                     ->get()
    //                                     ->first();
    //     //dd($loginData);
    //     if(!empty($loginData))
    //     {
    //         $dbPassword=$loginData->password;
    //         if($dbPassword==$password)
    //         {
    //             $uid=$loginData->id;
    //             $req->session()->put('session_id',$uid);
    //             return redirect ('home')->with('message','Login successfull');
               
    //         }else{
    //             return redirect('login')->with('message','Password does not matched');
    //         }
    //     }
    //     else{
    //         return redirect('login')->with('message','User not found');
    //     }
    // }




    public function data_login(Request $req)
    {
        $req->validate(
            [
                'username' => [
                    'required',
                    'regex:/^(\d{10}|[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,})$/'
                ],
                'password' => 'required|min:4|max:10',
            ],
            [
                'username.required' => 'Username is required.',
                'username.regex' => 'Enter a valid email or phone number.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 4 characters.',
                'password.max' => 'Password must not exceed 10 characters.',
            ]
        );
    
        $userId = $req->input('username');
        $password = $req->input('password');
        
        // Check for user login first
        $userData = DB::table('users')->where('email', $userId)
                                      ->orWhere('phone', $userId)
                                      ->first();
    
        if ($userData) {
            // If the user exists, check password
            if ($userData->password == $password) {
                if ($userData->status == 'block') {
                    return redirect('login')->with('message', 'Your account is blocked.');
                }
                $req->session()->put('session_id', $userData->id);
                return redirect('home')->with('message', 'Login successful');
            } else {
                return redirect('login')->with('message', 'Password does not match');
            }
        }
    
        // Check for admin login if no user is found
        $adminData = DB::table('admin')->where('email', $userId)->first();
    
        if ($adminData) {
            // If the admin exists, check password
            if ($adminData->password == $password) {
                $req->session()->put('session_id', $adminData->id);
                return redirect('admin')->with('message', 'Admin login successful');
            } else {
                return redirect('login')->with('message', 'Password does not match');
            }
        }
    
        // If no user or admin is found
        return redirect('login')->with('message', 'User or Admin not found');
    }
    




//     public function data_login(Request $req)
// {
//     $req->validate(
//         [
//             'email' => 'required|regex:/^[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,3}$/',
//             'password' => 'required|min:4,10',
//         ],
//         [
//             'email.required' => 'Email is required.',
//             'email.regex' => 'Invalid email format.',
//             'password.required' => 'Password is required.',
//             'password.min' => 'Password must be at least 4 characters.',
//         ]
//     );

//     $email = $req->input('email');
//     $password = $req->input('password');

//     // Check if the email or phone number already exists
//     $existingUser = DB::table('users')->where('email', $email)->first();

//     if (!$existingUser) {
//         return redirect('login')->with('message', 'User not found.');
//     }

//     if (!empty($existingUser)) {
//         if ($existingUser->password === $password) {
//             // Login success, store session
//             $req->session()->put('session_id', $existingUser->id);
//             return redirect('home')->with('message', 'Login successful');
//         } else {
//             return redirect('login')->with('message', 'Password does not match.');
//         }
//     }

//     return redirect('login')->with('message', 'User not found.');
// }


    //log out

    public function logout(Request $request)
{
    $request->session()->forget('session_id');
    $request->session()->flush();
    return redirect('/home')->with('message', 'Logged out successfully');
}



//srore
// public function store()
// {
//     $products=DB::table('products')->get();
//     // return redirect('store')->with(['storeInfo'=>$products]);
 
//    return view('store', compact('products'));
// }


// Display Products with Categories
public function store(Request $request)
{
    // Fetch categories
     // Fetch categories with product counts
     $catagories = DB::table('catagories')
     ->leftJoin('products', 'catagories.id', '=', 'products.catagory_id')
     ->select('catagories.*', DB::raw('COUNT(products.id) as product_count'))
     ->groupBy('catagories.id', 'catagories.catagory_name')
     ->get();

    // Fetch products with default sorting (by name or created_at, depending on your preference)
    $sort = $request->input('sort', 'default'); // Default sorting

    // Fetch products
    $query = DB::table('products')
        ->join('catagories', 'products.catagory_id', '=', 'catagories.id')
        ->select('products.*', 'catagories.catagory_name');

         // Apply sorting
    if ($sort === 'name') {
        $query->orderBy('products.name', 'asc');
    } elseif ($sort === 'price') {
        $query->orderBy('products.price', 'asc');
    } elseif ($sort === 'latest') {
        $query->orderBy('products.created_at', 'desc');
    }
    $products = $query->get();
    return view('store', compact('catagories', 'products','sort'));
}

// Filter Products by Category
public function filterByCategory($categoryId)
{
    // Fetch catagories
     // Fetch categories with product counts
    $catagories = DB::table('catagories')
        ->leftJoin('products', 'catagories.id', '=', 'products.catagory_id')
        ->select('catagories.*', DB::raw('COUNT(products.id) as product_count'))
        ->groupBy('catagories.id', 'catagories.catagory_name')
        ->get();

    // Fetch products by category
    $products = DB::table('products')
        ->join('catagories', 'products.catagory_id', '=', 'catagories.id')
        ->where('catagories.id', $categoryId)
        ->select('products.*', 'catagories.catagory_name')
        ->get();

 // Set the default sort value
    $sort = 'default';

    return view('store', compact('catagories', 'products','sort'));
}






// add to cart

// public function addToCart($product_id)
// {
//     {
//         // Fetch product by ID
//         $product = DB::table('products')->find($product_id);

//         if (!$product) {
//             return redirect()->back()->with('error', 'Product not found.');
//         }

//         // Retrieve existing cart from session or initialize an empty cart
//         $cart = session()->get('cart', []);

//         // Check if the product already exists in the cart
//         if (isset($cart[$product_id])) {
//             $cart[$product_id]['quantity']++;
//         } else {
//             // Add product to cart
//             $cart[$product_id] = [
//                 'id' => $product->id,
//                 'name' => $product->name,
//                 'price' => $product->price,
//                 'quantity' => 1,
//             ];
//         }

//         // Save cart back to session
//         session()->put('cart', $cart);

//         return redirect()->back()->with('success', 'Product added to cart!');
//     }
// }

// public function viewCart()
// {
//     $cart = session()->get('cart', []);
//     return view('cart', compact('cart'));
// }

// // cart remove
// public function removeFromCart($productId)
// {
//     $cart = session()->get('cart', []);

//     if (isset($cart[$productId])) {
//         unset($cart[$productId]);
//         session()->put('cart', $cart);
//     }

//     return redirect()->route('view.cart')->with('success', 'Product removed from cart.');
// }

// add to cart

// public function addToCart($product_id)
// {
//      // Check if the user is logged in
//      $user_id = session()->get('session_id'); // Or session()->get('user_id');
//      if (!$user_id) {
//          return redirect()->route('login')->with('message', 'Please log in to add items to your cart.');
//      }
 

//     // Fetch product by ID
//     $product = DB::table('products')->find($product_id);

//     if (!$product) {
//         return redirect()->back()->with('message', 'Product not found.');
//     }

//     // Retrieve the user's cart (assuming user_id is available in the session)
//     $user_id = session()->get('session_id'); // Or session()->get('user_id');
//     $cart = DB::table('carts')->where('user_id', $user_id)->first();

//     // If the cart doesn't exist, create it
//     if (!$cart) {
//         $cart_id = DB::table('carts')->insertGetId([
//             'user_id' => $user_id,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     } else {
//         $cart_id = $cart->id;
//     }

//     // Check if the product already exists in the cart
//     $cartItem = DB::table('cart_items')->where('cart_id', $cart_id)->where('product_id', $product_id)->first();

//     if ($cartItem) {
//         // Update quantity if product already exists in the cart
//         DB::table('cart_items')
//             ->where('cart_id', $cart_id)
//             ->where('product_id', $product_id)
//             ->update([
//                 'quantity' => $cartItem->quantity + 1,
//                 'price' => $product->price * ($cartItem->quantity + 1),
//                 'updated_at' => now(),
//             ]);
//     } else {
//         // Add new product to the cart
//         DB::table('cart_items')->insert([
//             'user_id' => $user_id,
//             'cart_id' => $cart_id,
//             'product_id' => $product_id,
//             'product_name' => $product->name,
//             'product_price' => $product->price,
//             'quantity' => 1,
//             'price' => $product->price, // or 'price' could be calculated (product->price * quantity)
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
    
//     return redirect()->back()->with('message', 'Product added to cart!');
// }


public function addToCart($product_id)
{
    $user_id = session()->get('session_id'); // Or session()->get('user_id');
    if (!$user_id) {
        return redirect()->route('login')->with('message', 'Please log in to add items to your cart.');
    }

    $product = DB::table('products')->find($product_id);
    if (!$product) {
        return redirect()->back()->with('message', 'Product not found.');
    }

    // Check stock availability
    if ($product->quantity <= 0) {
        return redirect()->back()->with('message', 'Product is out of stock.');
    }

    $cart = DB::table('carts')->where('user_id', $user_id)->first();

    if (!$cart) {
        $cart_id = DB::table('carts')->insertGetId([
            'user_id' => $user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } else {
        $cart_id = $cart->id;
    }

    $cartItem = DB::table('cart_items')->where('cart_id', $cart_id)->where('product_id', $product_id)->first();

    if ($cartItem) {
        $newQuantity = $cartItem->quantity + 1;

        if ($newQuantity > $product->quantity) {
            return redirect()->back()->with('message', 'Requested quantity exceeds available stock.');
        }

        DB::table('cart_items')
            ->where('cart_id', $cart_id)
            ->where('product_id', $product_id)
            ->update([
                'quantity' => $newQuantity,
                'price' => $product->price * $newQuantity,
                'updated_at' => now(),
            ]);
    } else {
        DB::table('cart_items')->insert([
            'user_id' => $user_id,
            'cart_id' => $cart_id,
            'product_id' => $product_id,
            'product_name' => $product->name,
            'product_price' => $product->price,
            'quantity' => 1,
            'price' => $product->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->back()->with('message', 'Product added to cart!');
}



public function viewCart()
{
    // Retrieve user's cart
    $user_id = session()->get('session_id'); // Or session()->get('user_id')or  auth()->id();
    $cart = DB::table('carts')->where('user_id', $user_id)->first();

    if ($cart) {
        $cartItems = DB::table('cart_items')
            ->where('cart_id', $cart->id)
            ->get();
    } else {
        $cartItems = [];
    }

    return view('cart', compact('cartItems'));
}



public function removeFromCart($productId)
{
    $user_id = session()->get('session_id'); // Or session()->get('user_id');
    $cart = DB::table('carts')->where('user_id', $user_id)->first();

    if ($cart) {
        DB::table('cart_items')->where('cart_id', $cart->id)->where('product_id', $productId)->delete();
    }

    return redirect()->route('view.cart')->with('message', 'Product removed from cart.');
}


//checkout


// public function processCheckout(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'address' => 'required|string',
//         'payment_method' => 'required|string',
//     ]);

//     $user_id = session()->get('session_id'); // Replace with session ID if using guest users.
//     $cart = DB::table('carts')->where('user_id', $user_id)->first();

//     if (!$cart) {
//         return redirect()->back()->with('message', 'Cart is empty.');
//     }

//     $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();

//     $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->quantity);
//     $tax = $subtotal * 0.10;
//     $total = $subtotal + $tax;

//     // Save the order
//     $order_id = DB::table('orders')->insertGetId([
//         'user_id' => $user_id,
//         'name' => $request->name,
//         'address' => $request->address,
//         'payment_method' => $request->payment_method,
//         'subtotal' => $subtotal,
//         'tax' => $tax,
//         'total' => $total,
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//          // Add items to the order_items table
//          foreach ($cartItems as $item) {
//             DB::table('order_items')->insert([
//                 'order_id' => $order_id,
//                 'product_id' => $item->product_id,
//                 'product_name' => $item->product_name,
//                 'product_price' => $item->product_price,
//                 'quantity' => $item->quantity,
//                 'total_price' => $item->product_price * $item->quantity,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }

//     // Clear the cart
//     DB::table('cart_items')->where('cart_id', $cart->id)->delete();
//     DB::table('carts')->where('id', $cart->id)->delete();

//     return redirect()->route('store')->with('message', 'Order placed successfully! Your Order ID is ' . $order_id);
// }


public function processCheckout(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    $user_id = session()->get('session_id'); // Replace with session ID if using guest users.
    $cart = DB::table('carts')->where('user_id', $user_id)->first();

    if (!$cart) {
        return redirect()->back()->with('message', 'Cart is empty.');
    }

    $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();

    // Validate stock availability and update stock
    foreach ($cartItems as $item) {
        $product = DB::table('products')->find($item->product_id);

        if ($product->quantity < $item->quantity) {
            return redirect()->back()->with('message', 'Stock insufficient for ' . $item->product_name);
        }

        DB::table('products')
            ->where('id', $item->product_id)
            ->decrement('quantity', $item->quantity);
    }

    $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->quantity);
    $tax = $subtotal * 0.10;
    $total = $subtotal + $tax;

    // Save the order
    $order_id = DB::table('orders')->insertGetId([
        'user_id' => $user_id,
        'name' => $request->name,
        'address' => $request->address,
        'payment_method' => $request->payment_method,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'total' => $total,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Add items to the order_items table
    foreach ($cartItems as $item) {
        DB::table('order_items')->insert([
            'order_id' => $order_id,
            'product_id' => $item->product_id,
            'product_name' => $item->product_name,
            'product_price' => $item->product_price,
            'quantity' => $item->quantity,
            'total_price' => $item->product_price * $item->quantity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Clear the cart
    DB::table('cart_items')->where('cart_id', $cart->id)->delete();
    DB::table('carts')->where('id', $cart->id)->delete();

    return redirect()->route('store')->with('message', 'Order placed successfully! Your Order ID is ' . $order_id);
}



public function updateQuantity(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    $user_id = session()->get('session_id');
    $product = DB::table('products')->find($request->product_id);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    if ($request->quantity > $product->quantity) {
        return response()->json(['success' => false, 'message' => 'Requested quantity exceeds available stock.']);
    }

    $cart = DB::table('carts')->where('user_id', $user_id)->first();

    if (!$cart) {
        return response()->json(['success' => false, 'message' => 'Cart not found.']);
    }

    $updated = DB::table('cart_items')
        ->where('cart_id', $cart->id)
        ->where('product_id', $request->product_id)
        ->update([
            'quantity' => $request->quantity,
            'price' => $product->price * $request->quantity,
            'updated_at' => now(),
        ]);

    return $updated
        ? response()->json(['success' => true, 'message' => 'Quantity updated successfully.'])
        : response()->json(['success' => false, 'message' => 'Error updating quantity.']);
}




// profile

public function profile_display()
{
    $id=session()->get('session_id');
    $users = DB::table('users')->find($id); 
   return view('profile', compact('users'));
   // $pro_data=DB::table('users')->find($id);
    //return redirect('profile')->with("userData",$pro_data);
    // return redirect()->route('view_profile', ['users' => $pro_data]);
}

public function data_update(Request $req)
{
    $req->validate([
        'name' => 'required|regex:/^[A-Za-z ]{3,40}$/',
        'email' => 'required|regex:/^[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,3}$/',
        'phone' => 'required|regex:/^[789]\d{9}$/',
    ]);

    $uid = $req->input('uid');
    $name = $req->input('name');
    $email = $req->input('email');
    $phone = $req->input('phone');

    $update_data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'updated_at' => now(),
    ];

    // Check if an image file is uploaded
    if ($req->hasFile('image')) {
        $file = $req->file('image');
        $fileName = time() . "_" . $file->getClientOriginalName();
        $uploadLocation = "./users_img";
        $file->move($uploadLocation, $fileName);

        $update_data['profile_image'] = $uploadLocation . "/" . $fileName;
    }

    DB::table('users')->where('id', $uid)->update($update_data);

    return redirect()->back();
}

 //change password

 public function changepass_submit(Request $req)
 {
     $oldp=$req->input('current_password');
     $newp=$req->input('new_password');
     $confp=$req->input('new_password_confirmation');
     $id=session()->get('session_id');
     $changeData= DB::table('users')->where('id',$id)
                                           ->get()
                                           ->first();
     $dbpass=$changeData->password;
     if($dbpass==$oldp){
         if($oldp!=$newp){
             if($newp==$confp){
                 DB::table('users')->where('id',$id)
                                          ->update(['password'=>$confp]);
                return redirect()->back();
             }
             else{
                 return redirect()->back()->with('message','New and Confirm Password not Matched');
             }
         }
         else{
             return redirect()->back()->with('message','Old and New password same');
         }
     }
     else{
         return redirect()->back()->with('message','Password not match');
     }

 }


 //search result

//  public function search(Request $request)
//  {
//      $query = $request->validate(['query' => 'required|string|max:255'])['query'];
 
//      // Fetch products from the database
//      $products = DB::table('products')
//          ->select('id', 'name', 'price', 'image')
//          ->where('name', 'LIKE', "%{$query}%")
//          ->limit(10) // Add a limit for better performance
//          ->get();
 
//      // Return products as JSON response
//      return response()->json($products);
//  }

public function search(Request $request)
{
    $query = $request->validate(['query' => 'required|string|max:255'])['query'];

    // Fetch products matching the query
    $products = DB::table('products')
        ->where('name', 'LIKE', "%{$query}%")
        ->get();

    // Return a view with the search results
    return view('search', compact('products', 'query'));
}

 


 



 
    
}
