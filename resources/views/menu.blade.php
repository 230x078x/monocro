@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                

            <div class=" p-0">
                <div class="card h-100">
                    <div class="card-header"><a href="/home">{{$day['day']}}</a> <br>メニュー</div>
                    <div class="card-body py-2 px-4">
                        <a class='d-block' href='/create'>伝票</a>
                        <a class='d-block' href='/prof'>売上</a>
                    </div>
                </div>
            </div>
 
            
        </div>
    </div>
</div>
@endsection
