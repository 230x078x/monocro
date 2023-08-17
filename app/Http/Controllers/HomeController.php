<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Guest;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Day;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function menu()
    {
        return view('menu');
    }
    
    public function create()
    {
        $user = auth()->user();
        $guests=Guest::where('status',1)->where('user_id',$user['id'])->get();
        return view('create',compact('guests'));
    }
    
    public function store(Request $request)
    {
        $data =$request->all();
        $date=Day::first();
        
        $user = auth()->user();
        $menus=Menu::get();
        $order_id=Order::insertGetId([
           
            'beer'=>$data['beer'],
            'wine'=>$data['wine'],
            'sour'=>$data['sour'],
            'whisky'=>$data['whisky']
        ]);

        $sum=0;

        foreach($menus as $menu){
            $sum+=$menu['price']*$data[$menu['name']];
        }

        $guest_id =Guest::insertGetId([
            'name'=>$data['name'],
            'kakaku'=>$sum,
            'content'=>$data['content'],
            'user_id'=>$user['id'],
            'status'=>1,
            'order_id'=>$order_id,
            'job'=>$data['job'],
            'date_id'=>$date['day'],
        ]);

        
       
        return redirect()->route('create');
    }
    
    public function edit($id)
    {
        $user = auth()->user();
       
        $guest=Guest::where('status',1)->where('id',$id)->where('user_id',$user['id'])->first();
        $guests=Guest::where('status',1)->where('user_id',$user['id'])->get();
        $menus=Menu::get();
       
        $order=Order::where('id',$guest['order_id'])->first();

        $sum=0;
        foreach($menus as $menu){
            $sum+=$menu['price']*$order[$menu['name']];
        }
       
        return view('edit',compact('guest','guests','order','sum'));
    }

    public function update(Request $request,$id)
    {
        $inputs=$request->all();
        $date=Day::first();
      
        $menus=Menu::get();
        $user = auth()->user();
        
       
        $order_guest=Guest::where('status',1)->where('id',$id)->where('user_id',$user['id'])->first();
        
        
        $order=Order::where('id',$order_guest['order_id'])->update([
            'beer'=>$inputs['beer'],
            'wine'=>$inputs['wine'],
            'sour'=>$inputs['sour'],
            'whisky'=>$inputs['whisky']
        ]);
        
        $sum=0;

        foreach($menus as $menu){
            $sum+=$menu['price']*$inputs[$menu['name']];
        }

        $guest=Guest::where('id',$id)->update([
            'content'=>$inputs['content'],
            'name'=>$inputs['name'],
            'kakaku'=>$sum,
            'job'=>$inputs['job'],
            'date_id'=>$date['day'],
        ]);

        return redirect()->route('create');
    }

    public function delete(Request $request,$id)
    {
        $inputs =$request->all();
     
        Guest::where('id',$id)->update(['status'=>2]);
        return redirect()->route('create')->with('success','削除しました');

    }
    
    public function prof()
    {
        
        $user = auth()->user();
        $date=Day::first();
       
        $correctDate=new Carbon($date['day']);
        $m=$correctDate->month;
       
        $dayGuests=Guest::where('status',1)->where('date_id',$date['day'])->where('user_id',$user['id'])->get();
        $monthGuests=Guest::where('status',1)->whereMonth('date_id','=',"$m")->where('user_id',$user['id'])->get();
      

        $daySum=0;
        $monthSum=0;

        foreach($dayGuests as $guest){
            $daySum+=$guest['kakaku'];
        }

        foreach($monthGuests as $guest){
            $monthSum+=$guest['kakaku'];
        }
        
        return view('prof',compact('daySum','monthSum'));
    }

    public function day(Request $request)
    {
        $data =$request->all();

        $exist_day=Day::first();

        if(empty($exist_day['id']))
        {
            $day_id =Day::insertGetId([
            'day'=>$data['date'],
        ]);}

        else{
            $day_id =Day::where('id',$exist_day['id'])->update([
                'day'=>$data['date'],    
            ]);
        }
        $day=Day::get();
        return view('menu',compact('day'));
}
}