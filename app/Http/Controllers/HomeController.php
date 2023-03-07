<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function redirect(){
        $usertype=Auth::user()->usertype;
        if (isset($usertype) && $usertype == '1') {
            return view('admin.home');
        }
        else {
            return to_route('root');
        }
    }
    public function index(){
        $products=Product::paginate(10);
        return view('home.userpage',compact('products'));
    }
    public function product_details($id){
        dd($id);
    }
}
