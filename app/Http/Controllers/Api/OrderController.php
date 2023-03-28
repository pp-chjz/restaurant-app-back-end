<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Carbon\Carbon;


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

    public function getOrderWaitForCheckBill()
    {
        $tables = array();
        $orders_return = array(
        );
        $orders = \App\Models\Order::where('order_status', '=' , 'wait_for_check_bill')->with('menus')->get();
        
        // array_push($orders_return, array());
        // array_push($orders_return, array(4,5,6));
        // array_push($orders_return, array(4,5,6));
        foreach ($orders as $order) {
            array_push($tables, $order->table_number);
        }

        $tables = array_unique($tables);
        foreach ($tables as $table) {
            // echo "tables = ";
            // echo $table;
            // echo "       ";

            array_push($orders_return, array($table));

        }
        // array_push($orders_return[0], "yes");



        // foreach ($orders_return as $order) {

        //     foreach ($orders as $order) {
        //         if($order->table_number)
        //         {

        //         }
        //     }

        // }
        $count = 0;
        foreach ($orders_return as $order) {
            // echo "--";

            foreach ($order as $o) {
                // echo $o;
                foreach ($orders as $order_obj) {
                    if($o === $order_obj->table_number)
                    {
                        // echo "if";
                        array_push($orders_return[$count], $order_obj);
                    }
                }
        
            }
            $count += 1;
        }
        $count = 0;
        
        // foreach ($orders_return as $order) {
        //     $order = array_shift($orders_return[$count]);  
        //     $count += 1;


        // }

        // foreach ($orders_return as $order) {
        //     echo "[";

        //     foreach ($order as $o) {
        //         echo $o;
        //         echo ",";


        //         // foreach ($orders as $order_obj) {
        //         //     if($o === $order_obj->table_number)
        //         //     {
        //         //         array_push($order, "have");
        //         //     }
        //         // }
        
        //     }
        //     echo "]-----------";

        // }
        return $orders_return;
    }

    public function getCountCatagories(Request $request)
    {
        $date = $request->input('date');
        $searchType = $request->input('searchType');

        if($searchType === 'day')
        {
            $order = \App\Models\Order::where('created_at','like',$date)->with('menus')->get();
            return $this->getAllCatagory($order);
            // return new \App\Http\Resources\OrderCollection($order);
        }
        elseif($searchType === 'week')
        {
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            Carbon::setWeekEndsAt(Carbon::SATURDAY);
            $order = \App\Models\Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            return $this->getAllCatagory($order);
            // return new \App\Http\Resources\OrderCollection($order);
            
        }
        elseif($searchType === 'month')
        {
            $order = \App\Models\Order::where('created_at','like',$date)->with('menus')->get();
            return $this->getAllCatagory($order);
            // return new \App\Http\Resources\OrderCollection($order);

        }
        elseif($searchType === 'year')
        {
            $order = \App\Models\Order::where('created_at','like',$date)->with('menus')->get();
            return $this->getAllCatagory($order);
            // return new \App\Http\Resources\OrderCollection($order);
            
        }
    }

    public function getAllCatagory($orders)
    {
        $pivots_return = array();
        foreach ($orders as $order) {
            foreach ($order->menus as $menu) {
                array_push($pivots_return,$menu->pivot);
            }
        }

        // foreach ($pivots_return as $return) {
        //     echo $return;
        //     echo "\r\n";
        //     echo "\r\n";

        // }

        return $pivots_return;

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
            'catagories_dashboard' => $menu['catagories'],
            'name_ENG_dashboard' => $menu['name_ENG'],
            'name_TH_dashboard' => $menu['name_TH'],

            'complete_at' => $menu['complete_at']]);



            // array_push($menu_array, $menu);

            
        }
        

    }

    public function updateOrderStatusPay(Request $request)
    {

        $orders = $request->input('orders');
        
        foreach ($orders as $order_id)
        {
            $order = \App\Models\Order::where('id','=',$order_id)->get();
            echo $order;
            $order->order_status = '5';
            echo $order;

            // $order->pay_status = 'paid';
            // $order->save();

            
        }

        return response()->json(['message' => 'updated order status']);
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

    public function getTotalOrderByDate(Request $request)
    {
        $date = $request->input('date');
        $searchType = $request->input('searchType');

        if($searchType === 'day')
        {
            $order = \App\Models\Order::where('created_at','like',$date)->with('menus')->get();
            return new \App\Http\Resources\OrderCollection($order);
        }
        elseif($searchType === 'week')
        {
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            Carbon::setWeekEndsAt(Carbon::SATURDAY);
            $order = \App\Models\Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            return new \App\Http\Resources\OrderCollection($order);
            
        }
        elseif($searchType === 'month')
        {
            $order = \App\Models\Order::where('created_at','like',$date)->with('menus')->get();
            return new \App\Http\Resources\OrderCollection($order);

        }
        elseif($searchType === 'year')
        {
            $order = \App\Models\Order::where('created_at','like',$date)->with('menus')->get();
            return new \App\Http\Resources\OrderCollection($order);
            
        }
        

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
