<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム確認ページ</title>
</head>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h2 class="content-title">Confirm</h2>
        <form action="{{ url('/thanks') }}" method="post">
            @csrf
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>{{ $data['gender'] == '1' ? '男性' : ($data['gender'] == '2' ? '女性' : 'その他') }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $data['tel1'] . $data['tel2'] . $data['tel3'] }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $data['address'] }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $data['building'] }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $data['category_content'] }}</td>
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

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn">送信</button>
                <button type="submit" name="back" value="true" class="btn-secondary">修正</button>
            </div>
        </form>
    </div>
    @endsection