<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe\PaymentIntent;
use Stripe\Service\PaymentIntentService;
use Stripe\Stripe;
class HomeController extends Controller
{
    const BASE_URL = 'https://api.stripe.com';
    const SECRET_KEY = 'sk_test_51Mjis7SCshgbkMI6R6KdqU7ASCNCm8XEMZypsnRgERFfLbii0k2s55fLb3IiguhgI2KGNUvPeCScSzR7VQe1EVpd00okLpdUpc';

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if (isset($usertype) && $usertype == '1') {
            $totalProducts=Product::all()->count();
            $totalOrders=Order::all()->count();
            $totalCustomers=User::all()->count();
            $orders=Order::all();
            $totalRevenue=0;
            foreach ($orders as $order) {
               $totalRevenue=$totalRevenue+$order->price;
            }
            $totalDelivered=Order::where('delivery_status','delivered')->get()->count();
            $totalProcessing=Order::where('delivery_status','processing')->get()->count();
            return view('admin.home',compact('totalProducts','totalCustomers','totalOrders','totalRevenue','totalDelivered','totalProcessing'));
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
        } else {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', $userId)->get();
        foreach ($data as $cartData) {
            $order = new Order();
            $order->name = $cartData->name;
            $order->email = $cartData->email;
            $order->phone = $cartData->phone;
            $order->address = $cartData->address;
            $order->user_id = $cartData->user_id;
            $order->product_title = $cartData->product_title;
            $order->price = $cartData->price;
            $order->quantity = $cartData->quantity;
            $order->image = $cartData->image;
            $order->product_id = $cartData->product_id;
            $order->payment_status = "cash on delivery";
            $order->delivery_status = "processing";
            $order->save();
            $cartId = $cartData->id;
            $cart = Cart::find($cartId);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have recieved your order. We will connect with you soon.');
    }
    public function stripe($totalPrice)
    {
        return view('home.stripe', compact('totalPrice'));
    }
    //stripe payment function
    public function submit(Request $request)
    {
        // $input = $request->validate([
        //     'card_no' => 'required',
        //     'exp_month' => 'required',
        //     'exp_year' => 'required',
        //     'cvc' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'country' => 'required',
        //     'line1' => 'required',
        //     'postal_code' => 'required',
        //     'email' => 'required',
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'phone' => 'required',
        //     'amount' => 'required',
        //     'currency' => 'required',
        // ]);
        $request['transaction_id'] = \Str::random(18); // random string for transaction id
        // save to database
        // it is recomended to save before sending data to stripe server
        // so we can verify after return from 3ds page
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', $userId)->get();
        foreach ($data as $cartData) {
            $order = new Order();
            $order->name = $cartData->name;
            $order->email = $cartData->email;
            $order->phone = $cartData->phone;
            $order->address = $cartData->address;
            $order->user_id = $cartData->user_id;
            $order->product_title = $cartData->product_title;
            $order->price = $cartData->price;
            $order->quantity = $cartData->quantity;
            $order->image = $cartData->image;
            $order->product_id = $cartData->product_id;
            $order->payment_status = "paid ";
            $order->delivery_status = "processing";
            $order->save();
            $cartId = $cartData->id;
            $cart = Cart::find($cartId);
            $cart->delete();
        }
        // \DB::table('transactions')
        //     ->insert($input);
        // create payment method request
        // see documentation below for options
        // https://stripe.com/docs/api/payment_methods/create
        $payment_url = self::BASE_URL.'/v1/payment_methods';
        $payment_data = [
            'type' => 'card',
            'card[number]' => $request['card_no'],
            'card[exp_month]' => $request['exp_month'],
            'card[exp_year]' => $request['exp_year'],
            'card[cvc]' => $request['cvc'],
            'billing_details[address][city]' => $request['city'],
            'billing_details[address][state]' => $request['state'],
            'billing_details[address][country]' => $request['country'],
            'billing_details[address][line1]' => $request['line1'],
            'billing_details[address][postal_code]' => $request['postal_code'],
            'billing_details[email]' => $request['email'],
            'billing_details[name]' => $request['first_name'].' '.$request['last_name'],
            'billing_details[phone]' => $request['phone'],
        ];
        $payment_payload = http_build_query($payment_data);
        $payment_headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.self::SECRET_KEY
        ];
        // sending curl request
        // see last function for code
        $payment_body = $this->curlPost($payment_url, $payment_payload, $payment_headers);
        $payment_response = json_decode($payment_body, true);
        // create payment intent request if payment method response contains id
        // see below documentation for options
        // https://stripe.com/docs/api/payment_intents/create
        if (isset($payment_response['id']) && $payment_response['id'] != null) {
            $request_url = self::BASE_URL.'/v1/payment_intents';
            $request_data = [
                'amount' => $request['amount'] * 100, // multiply amount with 100
                'currency' => $request['currency'],
                'payment_method_types[]' => 'card',
                'payment_method' => $payment_response['id'],
                'confirm' => 'true',
                'capture_method' => 'automatic',
                'return_url' => route('stripeResponse', $request['transaction_id']),
                'payment_method_options[card][request_three_d_secure]' => 'automatic',
            ];
            $request_payload = http_build_query($request_data);
            $request_headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.self::SECRET_KEY
            ];
            // another curl request
            $response_body = $this->curlPost($request_url, $request_payload, $request_headers);
            $response_data = json_decode($response_body, true);
            // transaction required 3d secure redirect
            if (isset($response_data['next_action']['redirect_to_url']['url']) && $response_data['next_action']['redirect_to_url']['url'] != null) {
                return redirect()->away($response_data['next_action']['redirect_to_url']['url']);
            // transaction success without 3d secure redirect
            } elseif (isset($response_data['status']) && $response_data['status'] == 'succeeded') {
                return redirect()->route('stripeResponse', $request['transaction_id'])->with('success', 'Payment success.');
            // transaction declined because of error
            } elseif (isset($response_data['error']['message']) && $response_data['error']['message'] != null) {
                return redirect()->route('stripeResponse', $request['transaction_id'])->with('error', $response_data['error']['message']);
            } else {
                return redirect()->route('stripeResponse', $request['transaction_id'])->with('error', 'Something went wrong, please try again.');
            }
        // error in creating payment method
        } elseif (isset($payment_response['error']['message']) && $payment_response['error']['message'] != null) {
            return redirect()->route('stripeResponse', $request['transaction_id'])->with('error', $payment_response['error']['message']);
        }
    }
    private function curlPost($url, $data, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);
        return $response;
    }
    public function response(Request $request, $transaction_id)
    {
        $request_data = $request->all();
        // if only stripe response contains payment_intent
        if (isset($request_data['payment_intent']) && $request_data['payment_intent'] != null) {
            // here we will check status of the transaction with payment_intents from stripe server
            $get_url = self::BASE_URL.'/v1/payment_intents/'.$request_data['payment_intent'];
            $get_headers = [
                'Authorization: Bearer '.self::SECRET_KEY
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $get_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $get_headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $get_response = curl_exec($ch);
            curl_close ($ch);
            $get_data = json_decode($get_response, 1);
            // get record of transaction from database
            // so we can verify with response and update the transaction status
            // $input = \DB::table('transactions')
            //     ->where('transaction_id', $transaction_id)
            //     ->first();
            // here you can check amount, currency etc with $get_data
            // which you can check with your database record
            // for example amount value check
            if ($request['amount'] * 100 == $get_data['amount']) {
                // nothing to do
            } else {
                // something wrong has done with amount
            }
            // succeeded means transaction success
            if (isset($get_data['status']) && $get_data['status'] == 'succeeded') {
                return redirect()->back()->with('success', 'Payment success.');
                // update here transaction for record something like this
                // $input = \DB::table('transactions')
                //     ->where('transaction_id', $transaction_id)
                //     ->update(['status' => 'success']);
            } elseif (isset($get_data['error']['message']) && $get_data['error']['message'] != null) {
                return redirect()->back()->with('error', $get_data['error']['message']);
            } else {
                return redirect()->back()->with('error', 'Payment request failed.');
            }
        } else {
            return redirect()->back()->with('error', 'Payment request failed.');
        }
    }
    public function show_order(){
        if (Auth::id()) {
            $userId=Auth::user()->id;
            $orders=Order::where('user_id',$userId)->get();
            return view('home.order',compact('orders'));
        }
        else{
            return redirect('login');
        }
    }
    public function cancel_order($id){
        $order=Order::find($id) ;
        $order->delivery_status='Cancelled';
        $order->save();
        return redirect()->back();
    }
}
