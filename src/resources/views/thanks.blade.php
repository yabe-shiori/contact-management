@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('content')
<div class="container">
        <div class="thanks-content">
            <p>ご意見いただきありがとうございました。</p>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">トップページへ</button>
        </div>
    </div>

@endsection
