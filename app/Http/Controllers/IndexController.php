<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Orders;
use App\Models\ourbrand;
use App\Models\product;
use App\Models\review;
use App\Models\User;
use App\Repository\MoneyCoursRepository;
use App\Repository\NoticesRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function adminindex()
    {
        $user = User::count();
        $zakazlar = Orders::count();
        $ugradylmadyk = Orders::whereStatus(false)->count();
        return view('Admin.index', compact('user', 'zakazlar', 'ugradylmadyk'));
    }

    public function orders_false()
    {
        $order = Orders::with('User', 'product')->whereStatus(0)->get();
        $order = $this->GenerateData($order);
        return view('Admin.order_false', compact('order'));
    }

    public function orders_true()
    {
        $order = Orders::with('User', 'product')->whereStatus(1)->get();
        $order = $this->GenerateData($order);
        return view('Admin.order_true', compact('order'));
    }

    private function GenerateData($query)
    {
        return $query->map(function ($query) {
            $array = [];
            $ff = [];
            foreach (json_decode($query->product_id) as $key => $value) {
                $array[] = product::find($key);
                $ff[] = $value;
            }
            return [
                'status' => $query->status,
                'product_id' => $query->id,
                'user_name' => $query->user->name,
                'user_phone' => $query->user->phone_number,
                'products' => $array,
                'quantity' => $ff
            ];
        });
    }

    public function index(
        MoneyCoursRepository $money_cours,
        NoticesRepository $notices
    ) {
        $category = category::get();
        $product = product::orderBy('category_id', 'DESC')->get();
        return view('User.index', [
            'money_cours' => $money_cours->get(),
            'notices' => $notices->get()
        ], compact('category', 'product'));
    }

    public function cart()
    {
        $category = category::get();

        return view('User.cart', compact('category'));
    }

    public function checkout()
    {
        $category = category::get();
        return view('User.checkout', compact('category'));
    }

    public function store()
    {
        $category = category::get();
        $ourbrand = ourbrand::get();
        $product = product::with('category')->get();
        return view('User.store', compact('category', 'ourbrand', 'product'));
    }

    public function product($id)
    {
        $cart = session()->get('cart');


        if (empty($cart[$id])) {
            $cart = 1;
        } else {
            $cart = $cart[$id]['quantity'];
        }


        $product = product::find($id);
        $products = product::get();
        $category = category::get();
        $rating = review::where('product_id', $id)->pluck('rating');
        $count = $rating->countBy();
        $all = 0;
        foreach ($count as $item) {
            $all = $all + $item;
        }
        $review = review::paginate(3);

        return view('User.product', compact('product', 'products', 'count', 'all', 'review', 'category', 'cart'));
    }

    public function review(Request $request, $id)
    {
        $data = $request->all();
        $data['product_id'] = $id;
        review::create($data);
        $rating = review::where('product_id', $id)->pluck('rating')->avg();
        $data = product::where('id', $id)->first();
        $data->rating = $rating;
        $data->save();
        return $this->product($id);
    }

    public function login(Request $request)
    {
        dd($request);
        return view('login');
    }
    public function register()
    {
        return view('register');
    }

    public function search(Request $request)
    {
        $text = $request->input('text');

        $search = product::whereHas('ourbrand', function ($query) use ($text) {
            $query->where('name', 'Like', "%$text%");
        })->orWhere('name', 'Like', "%$text%")->with('category')->get();
        return response()->json($search, 200);
    }

    public function category_checkbox()
    {
        $id = request('id');
        $cart1 = [];
        if ($id == null) {
            $cart = product::with('category')->get();
            array_push($cart1, $cart);
        } else {
            foreach ($id as $key => $value) {

                $cart = product::where('category_id', $value)->with('category')->get();
                array_push($cart1, $cart);
            }
        }
        return response()->json($cart1, 200);
    }

    public function price(Request $request)
    {
        $minVal = (int)$request->minVal;
        $maxVal = (int)$request->maxVal;
        $data = product::where('price', '>=', $minVal)->where('price', '<=', $maxVal)->with('category')->get();
        return response()->json($data, 200);
    }
}
