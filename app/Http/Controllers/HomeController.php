<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;
class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if (isset($usertype) && $usertype == '1') {
            return view('admin.home');
        } else {
            return to_route('root');
        }
    }
    public function index()
    {
        $products = Product::paginate(10);
        return view('home.userpage', compact('products'));
    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if (isset($product->discount_price) && $product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();
            return view('home.show_cart', compact('cart'));
        }
        else{
            return redirect('login');
        }
    }
    public function remove_cart($id){
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order(){
        $user=Auth::user();
        $userId=$user->id;
        $data=Cart::where('user_id',$userId)->get();
        foreach ($data as $cartData) {
            $order=new Order();
            $order->name=$cartData->name;
            $order->email=$cartData->email;
            $order->phone=$cartData->phone;
            $order->address=$cartData->address;
            $order->user_id=$cartData->user_id;
            $order->product_title=$cartData->product_title;
            $order->price=$cartData->price;
            $order->quantity=$cartData->quantity;
            $order->image=$cartData->image;
            $order->product_id=$cartData->product_id;
            $order->payment_status="cash on delivery";
            $order->delivery_status="processing";
            $order->save();
            $cartId=$cartData->id;
            $cart=Cart::find($cartId);
            $cart->delete();
        }
        return redirect()->back()->with('message','We have recieved your order. We will connect with you soon.');
    }
    public function stripe($totalPrice){
        return view('home.stripe',compact('totalPrice'));
    }
    //stripe payment function
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment" 
        ]);
        Session::flash('success', 'Payment successful!');
        return back();
    }
}
