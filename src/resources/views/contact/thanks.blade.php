<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンクスページ</title>
</head>
@extends('layouts.app')

@section('content')
<div class="thanks__container">
    <div class="thanks__background">Thank you</div>

    <div class="thanks__content">
        <p class="thanks__text">お問い合わせありがとうございました</p>
        <a href="/" class="thanks__btn">HOME</a>
    </div>
</div>
@endsection