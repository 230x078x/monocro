 
@extends('layouts.app')

@section('content')

<a class="navbar-brand" href="{{ url('/') }}">{{$day['day']}}</a>
<div class="row">  

<div class="col-md-2">
            <div class="card h-100">
            <div class="card-header d-flex">ゲスト一覧 <a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a></div>
                <div class="card-body">
                @foreach($guests as $guest)
                    @if($guest['date_id']==$day['day'])
                    <a href="/edit/{{$guest['id']}}"class='d-block'>{{$guest['name']}}</a>
                    @endif
                @endforeach
                </div>
            </div>    
</div> 

<div class="col-md-10">
    
    <form method='POST' action="/store">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
    <div class="row">  
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">顧客情報</div>
            <div class="card-body">     
            
                <div class ='form-group'>
                    <label for ='name'>名前</label>
                    <input name='name' type="text" class ='form-control' id ='name' placeholder='名前を入力'>
                </div>

                <div class="form-group">
                <label for ='job'>職業</label>
                <select name="job" class="form-select">
                <option value="" selected >選択してください</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job->id }}">{{ $job->str }}</otion>
                    @endforeach
                </select>
                </div>

                

               
                <div class="form-group">
                    <label for ='content'>備考</label>
                     <textarea name='content' class="form-control"rows="10"></textarea>
                </div>  
            </div>
            </div>  
        </div>         
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">オーダー </div>
                <div class="card-body">  
                @foreach($menus as $menu)
                <div class ='form-group'>
                    <label for ='name'>{{$menu['name']}} : {{$menu['price']}}円</label>
                    <input type="number" id="number-of-unit" name="{{$menu['name']}}" value="0" min="0" max="10" class="form-control input-number border-dark">
                </div>
                @endforeach   
                </div>
            </div>
        </div>
        <button type='submit' class="btn btn-primary btn-lg">保存</button>
    </div>
             
    </form>
</div>
</div>



@endsection