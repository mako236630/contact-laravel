@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<style>
    .header {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__background">Thank you</div>

    <div class="thanks__content">
        <p class="thanks__text">お問い合わせありがとうございました</p>
        <div class="thanks__button">
            <a href="/" class="thanks__btn">HOME</a>
        </div>
    </div>
</div>
@endsection