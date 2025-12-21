@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact__container">
    <div class="contact__heading">
        <h2 class="contact__title">Contact</h2>
    </div>

    <form action="{{ route('contact.confirm') }}" method="post" novalidate>
        @csrf

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">お名前 <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <div class="input-flex">
                    <input type="text" name="first_name" placeholder="例: 山田" value="{{ old('first_name') }}">
                    <input type="text" name="last_name" placeholder="例: 太郎" value="{{ old('last_name') }}">
                </div>
                @error('first_name') <div class="error">{{ $message }}</div> @enderror
                @error('last_name') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">性別 <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <div class="input-flex radio-group">
                    <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                </div>
                @error('gender') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">メールアドレス <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">電話番号 <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <div class="input-flex tel-group">
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"> <span>-</span>
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"> <span>-</span>
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                </div>
                @error('tel')
                <p class="error-message" style="color: red;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">住所 <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                @error('address') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">建物名</label>
            </div>
            <div class="form-group__input">
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                @error('building') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">お問い合わせの種類 <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <select name="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label class="form-label">お問い合わせ内容 <span class="required">※</span></label>
            </div>
            <div class="form-group__input">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                @error('detail') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form__button">
            <button type="submit" class="btn-confirm">確認画面</button>
        </div>
    </form>
</div>
@endsection