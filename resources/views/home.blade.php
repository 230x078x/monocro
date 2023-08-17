@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class=" p-0">
                <div class="card h-100">
                    <div class="card-header">日付を選択してください</div>
                    <div class="card-body py-2 px-4">
                    <form method='post' action="/day">
                        @csrf
                        <input type='hidden' name='user_id' value="{{ $user['id'] }}">
 　                     <input name="date" type="date" />
                            
                        <button type='submit' class="btn btn-primary btn-sm">確定</button>
                    </form>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
