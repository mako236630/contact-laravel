@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <h2>login</h2>
    </div>
    <div class="login-form__inner">
        @if ($errors->has('email') && old('email') && !str_contains($message = $errors->first('email'), '形式'))
        <p class="error-message" style="text-align: center; margin-bottom: 15px;">
            {{ $message }}
        </p>
        @endif

        <form class="form" action="/login" method="post" novalidate>
            @csrf

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">メールアドレス</span>
                </div>
                <div class="form__input-text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                </div>
                @error('email')
                @if(!old('email') || str_contains($message, '形式'))
                <p class="error-message">{{ $message }}</p>
                @enderror
                @endif
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">パスワード</span>
                </div>
                <div class="form__input-text">
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="例: coachtechi1106">
                </div>
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror

                @if($errors->has('email') && old('email'))
                @endif
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection