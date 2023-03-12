<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = \App\Models\Order::orderBy('order_time', 'DESC')->with('menus')->get();
        return new \App\Http\Resources\OrderCollection($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cancel_status' => ['required'],
            'order_status' => ['required'],
            'total_price' => ['required'],
            'order_time' => ['required'],
        ]);

        $order = new Order();
        $order->cancel_status = $request->input('cancel_status');
        $order->order_status = $request->input('order_status');
        $order->total_price = $request->input('total_price');
        $order->order_time = $request->input('order_time');
        $order->table_number =  $request->input('table_number');
        $order->menu_id = 0;
        $order->order_id = 0;
        $order->save();

        $menus = $request->input('menus');
        $this->updateMenu($order, $menus);
        // $menu_array = [];
        // $menu_array = $request->input('menus');
        // return $menu_array[1]['menu_id'];

        return $order;
    }

    private function updateMenu(Order $order, $menus)
    {
        // $menu_array = [];
        // foreach ($menus as $menu)
        // {
        //     array_push($menu_array, $menu['menu_id']);
        // }
        // $order->menus()->sync($menu_array);

        foreach ($menus as $menu)
        {
            $id = $menu['menu_id'];
            $order->menus()->attach($id, ['comment' => $menu['comment'] ,
            'QTY' => $menu['QTY'], 
            'price' => $menu['price'], 
            'status' => $menu['status'],
            'food_status' => $menu['food_status'],
            'order_time' => $menu['order_time'],
            'complete_at' => $menu['complete_at']]);



            // array_push($menu_array, $menu);

            
        }
        

    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        
        $order->order_status = $request->input('order_status');
        $order->save();

        return response()->json(['message' => 'updated order status']);
    }

    public function updateMenuStatus(Request $request, Order $order)
    {
        
        $menu_id = $request->input('menu_id');

        $menu = Menu::findOrFail($request->input('menu_id'));
        $order->menus()->updateExistingPivot($menu->id, ['food_status' => $request->input('food_status')]);
        $order->save();

        return response()->json(['message' => 'updated food status']);
        
        // $order_by_id = Order::where('id' , '=' , $order_id)->with('menus')->get();

        // return $order_by_id;
        // $menu = $order_by_id->menus()->where('id','=',$id);    

        // $order_by_id = \App\Models\Order::with('menus')->whereId($id)->get();

        // return $order_by_id;


        // $orders = Order::with('menus' => function($query) {
        //     $query->where('id', 1);
        // })->get();

        // return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new \App\Http\Resources\Order($order);
        // return new \App\Models\Order($order);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function getOrder()
    {
        // return $table = FoodTable::get();
        $foodTable = \App\Models\FoodTable::where('have_order','>',0)->with('orders')->get();
        // return $foodTable->orders;
        // foreach ($this->$foodTable as $table) {
        //     if ($table->orders) {
        //         $table->order_id = 1;
        //     }
        // }
        // return $foodTable;
        return new \App\Http\Resources\FoodTableCollection($foodTable);

    }

    public function getUnPaidOrder(Request $request)
    {
        $table = $request->input('table_number');
        $order = \App\Models\Order::where('table_number','=',$table)->where('order_status','!=',3)->where('order_status','!=',5)->where('pay_status','=',1)->with('menus')->get();
        // return $foodTable->orders;
        // foreach ($this->$foodTable as $table) {
        //     if ($table->orders) {
        //         $table->order_id = 1;
        //     }
        // }
        // return $foodTable;
        return new \App\Http\Resources\OrderCollection($order);

    }

    public function getUnPaidOrderThatCanCancel(Request $request)
    {
        $table = $request->input('table_number');
        $order = \App\Models\Order::where('table_number','=',$table)->where('order_status','!=',3)->where('order_status','!=',4)->where('order_status','!=',5)->with('menus')->get();

        
        return new \App\Http\Resources\OrderCollection($order);

    }

    public function getWaitForPayOrder(Request $request)
    {
        $table = $request->input('table_number');
        $order = \App\Models\Order::where('table_number','=',$table)->where('order_status','=',3)->where('pay_status','=',1)->with('menus')->get();
        return new \App\Http\Resources\OrderCollection($order);

    }

    public function getOrderByDate(Request $request)
    {
        // $date = $request->input('date');
        $order = \App\Models\Order::where('order_time','like','%2023-04-05%')->with('menus')->get();
        return new \App\Http\Resources\OrderCollection($order);

    }

    public function getOrderBySearch(Request $request)
    {
        $table = $request->input('table_number');
        $order_status = $request->input('order_status');

        if($table === 0)
        {
            $order = \App\Models\Order::where('order_status','=',$order_status)->where('pay_status','=',1)->with('menus')->get();
            return new \App\Http\Resources\OrderCollection($order);
        }
        elseif($order_status === 0)
        {
            $order = \App\Models\Order::where('table_number','=',$table)->where('pay_status','=',1)->with('menus')->get();
            return new \App\Http\Resources\OrderCollection($order);
        }
        else
        {
            $order = \App\Models\Order::where('table_number','=',$table)->where('order_status','=',$order_status)->with('menus')->get();
            return new \App\Http\Resources\OrderCollection($order);
        }


    }
}
