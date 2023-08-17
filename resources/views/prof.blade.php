@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class=" p-0">
                <div class="card h-100">
                    <div class="card-header"><a href="/home">{{$day['day']}}</a> <br>売上</div>
                    <div class="card-body py-2 px-4">
                        <div class="raw">
                        <div class="card-body col-md-6">   
                        <p class='d-block' >今日</p>
                        <u  class="text-center fs-2">{{$daySum}}円</u>
                        </div>
                        <div class="card-body col-md-6"> 
                        <p class='d-block'>今月</p>
                        <u  class="text-center fs-2">{{$monthSum}}円</u>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
 
            
        
    </div>
</div>
@endsection