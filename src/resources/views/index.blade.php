@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="book__alert">
    @if(session('message'))
    <div class="book__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="book__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="book__title">
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <form class="create-form" action="/books" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="title" value="{{ old('title') }}">
                <select class="create-form__item-select" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <div class="section__title">
        <h2>本検索</h2>
    </div>
    <form class="search-form" action="/books/search" method="get">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
            <select class="search-form__item-select" name="category_id">
                <option value="">カテゴリ</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category['id']  }}">{{ $category['name'] }}</option>
                    @endforeach
            </select>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
    </form>
        <div class="book-table">
            <table class="book-table__inner">
                <tr class="book-table__row">
                    <th class="book-table__header">
                        <span class="book-table__header-span">Book</span>
                        <span class="book-table__header-span">カテゴリ</span>
                    </th>
                </tr>
                @foreach ($books as $book)
                <tr class="book-table__row">
                    <td class="book-table__item">
                        <form class="update-form" action="/books/update" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="update-form__item">
                                <input class="update-form__item-input" type="text" name="title" value="{{ $book['title'] ?? '' }}">
                                <input type="hidden" name="id" value="{{ $book['id'] }}">
                            </div>
                            <div class="update-form__item">
                                <p class="update-form__itme-p">{{ $book['category']['name'] }}</p>
                            </div>
                            <div class="update-form__button">
                                <button class="update-form__button-submit" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="book-table__item">
                        <form class="delete-form" action="/books/delete" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="delete-form__button">
                                <input type="hidden" name="id" value="{{ $book['id'] }}">
                                <button class="delete-form__button-submit" type="submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
</div>
@endsection
