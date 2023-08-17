@extends('layouts.app')

@section('content')
<a class="navbar-brand" href="{{ url('/') }}">{{$day['day']}}</a>
<div class="row">
<div class="col-md-2">
              <div class="card h-100">
                <div class="card-header d-flex">ゲスト一覧 <a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a></div>
                <div class="card-body">
                @foreach($guests as $gues)
                    @if($gues['date_id']==$day['day'])    
                        <a href="/edit/{{$gues['id']}}"class='d-block'>{{$gues['name']}}</a>
                    @endif
                @endforeach
                
            <form method="POST" action="/delete/{{$guest['id']}}" id='delete-form'>
                    @csrf
                    
                    <button>削除<i id="delete-button" class="fas fa-trash"></i></button></td>
                    
                </form>
                </div>
              </div>    
</div>
<div class="col-md-10">
    <form method='POST' action="{{ route('update', ['id'=>$guest['id'] ]) }}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
            <table> 
                <td>顧客情報編集</td>
                <td>
            </table>    
            </div>
            <div class="card-body">
                <div class ='form-group'>
                    <label for ='name'>名前</label>
                    
                    <input name='name' type="text" class ='form-control' id ='name' value="{{$guest['name']}}">
                </div>

                <div class="form-group">
                <label for ='job'>職業</label>

                 <select name="job" class="form-select">
                    @foreach ($jobs as $job)
                        <?php
                            if($job->id==$guest['job']):
                        ?>
                        <option value="{{ $job->id }}" selected>{{ $job->str }}</otion>
                        <?php else:?>
                         <option value="{{ $job->id }}">{{ $job->str }}</otion>
                         <?php endif;?>
                    @endforeach
                 </select>
                </div>

              
               
                <div class="form-group">
                    <label for ='content'>備考</label>
                     <textarea name='content' class="form-control"rows="10">{{$guest['content']}}</textarea>
                </div>
            </div>               
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card h-100">
                <div class="card-header">オーダー </div>
                <div class="card-body">
                @foreach($menus as $menu)
                <div class ='form-group'>
                    <label for ='name'>{{$menu['name']}} : {{$menu['price']}}円</label>
                    <?php $itemName=$menu['name']?>
                    <input type="number" id="number-of-unit" name="{{$menu['name']}}" value="{{$order[$itemName]}}" min="0" max="10" class="form-control input-number border-dark">
                </div>
                @endforeach
                <p>小計</p>
                <u  class="text-center fs-2">{{$sum}}円</u>
                </div>
            </div> 
        </div>
        <button type='submit' class="btn btn-primary btn-lg">更新</button>
        </form>
    </div>
    
             
</div>
@endsection