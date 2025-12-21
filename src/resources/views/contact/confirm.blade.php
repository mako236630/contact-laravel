@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__container">
    <h2 class="confirm__title">Confirm</h2>

    <form action="{{ route('contact.store') }}" method="post">
        @csrf
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                    {{ $data['first_name'] }} {{ $data['last_name'] }}
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    {{ $data['gender'] == '1' ? '男性' : ($data['gender'] == '2' ? '女性' : 'その他') }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">{{ $data['email'] }}

                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">{{ $data['tel1'] . $data['tel2'] . $data['tel3'] }}

                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">{{ $data['address'] }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">{{ $data['building'] }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">{{ $data['category_content'] }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの内容</th>
                <td class="confirm-table__text">{{ $data['detail'] }}
                </td>
            </tr>

            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
            <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
            <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
            <input type="hidden" name="address" value="{{ $data['address'] }}">
            <input type="hidden" name="building" value="{{ $data['building'] }}">
            <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">

        </table>

        <div class="confirm-form__button">
            <button class="btn-submit" type="submit">送信</button>
            <button class="btn-back" type="submit" name="back" value="back">修正</button>
        </div>
    </form>
</div>
@endsection