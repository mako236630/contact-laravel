@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-nav')
<form action="/logout" method="post" class="logout-form">
    @csrf
    <button class="logout-btn" type="submit">logout</button>
</form>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    <div class="admin__inner">
        <form class="search-form" action="/admin/search" method="get">
            @csrf
            <div class="search-form__group">
                <input type="text" name="keyword" class="search-form__item-input" placeholder="名前やメールアドレスを入力してください">

                <select name="gender" class="search-form__item-select">
                    <option value="">性別</option>
                    <option value="">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>

                <select name="category_id" class="search-form__item-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->content }}</option>
                    @endforeach
                </select>

                <input type="date" name="date" class="search-form__item-date">

                <button class="search-form__button-submit" type="submit">検索</button>
                <a href="/admin" class="search-form__button-reset" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">リセット</a>
            </div>
        </form>

        <div class="admin-table__header-row">
            <button class="export-btn" type="button" onclick="location.href='/admin/export?' + new URLSearchParams(new FormData(document.querySelector('.search-form'))).toString()">エクスポート</button>
            <div class="pagination-wrapper">
                {{ $contacts->links() }}
            </div>
        </div>

        <div class="admin-table">
            <table class="admin-table__inner">
                <tr class="admin-table__row">
                    <th class="admin-table__header">お名前</th>
                    <th class="admin-table__header">性別</th>
                    <th class="admin-table__header">メールアドレス</th>
                    <th class="admin-table__header">お問い合わせの種類</th>
                    <th class="admin-table__header"></th>
                </tr>
                @foreach ($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__item">
                        {{ $contact->last_name }} {{ $contact->first_name }}
                    </td>

                    <td class="admin-table__item">
                        @if($contact->gender == 1) 男性
                        @elseif(@$contact->gender == 2)女性
                        @else その他 @endif
                    </td>

                    <td class="admin-table__item">{{ $contact->email }}
                    </td>

                    <td class="admin-table__item">{{ $contact->category->content }}
                    </td>

                    <td class="admin-table__item">
                        <button class="admin-table__detail-btn"
                            onclick="openModal(this)"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-gender="{{ $contact->gender == 1 ? '男性' : '女性' }}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{ $contact->tel }}"
                            data-address="{{ $contact->address }}"
                            data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content }}"
                            data-detail="{{ $contact->detail }}">詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div id="detailModal" class="modal">
    <div class="modal__content">
        <div class="modal__header">
            <button class="modal__close" onclick="closeModal()">×</button>
        </div>
        <table class="modal-table">
            <tr>
                <th>お名前</th>
                <td id="modal-name"></td>
            </tr>
            <tr>
                <th>性別</th>
                <td id="modal-gender"></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td id="modal-email"></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td id="modal-tel"></td>
            </tr>
            <tr>
                <th>住所</th>
                <td id="modal-address"></td>
            </tr>
            <tr>
                <th>建物名</th>
                <td id="modal-building"></td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td id="modal-category"></td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td id="modal-detail"></td>
            </tr>
        </table>
        <div class="modal__footer">
            <form id="delete-form" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal__delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    function openModal(button) {

        document.getElementById('modal-name').innerText = button.getAttribute('data-name');
        document.getElementById('modal-gender').innerText = button.getAttribute('data-gender');
        document.getElementById('modal-email').innerText = button.getAttribute('data-email');
        document.getElementById('modal-tel').innerText = button.getAttribute('data-tel');
        document.getElementById('modal-address').innerText = button.getAttribute('data-address');
        document.getElementById('modal-building').innerText = button.getAttribute('data-building');
        document.getElementById('modal-category').innerText = button.getAttribute('data-category');
        document.getElementById('modal-detail').innerText = button.getAttribute('data-detail');

        const contactId = button.getAttribute('data-id');
        document.getElementById('delete-form').action = '/admin/delete/' + contactId;

        document.getElementById('detailModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }
</script>