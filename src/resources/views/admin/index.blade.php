@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}" />
@endsection

@section('content')
    <div class="inner__Wrap">
        <h1>管理システム</h1>
        <form method="post" action="{{ route('admin.search') }}" class="search__form">
            @csrf
            <div class="form__group">
                <label for="name" class="form__group-name">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}">
                <label for="gender" class="form__group-gender">性別</label>
                <input type="radio" name="gender" value="0" {{ old('gender', '0') === '0' ? 'checked' : '' }}>
                <label for="gender">全て</label>
                <input type="radio" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : '' }}>
                <label for="gender">男性</label>
                <input type="radio" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }}>
                <label for="gender">女性</label>
            </div>
            <div class="form__group">
                <label for="created_at" class="form__group-date">登録日</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}">
                <span class="form__group__date-between">~</span>
                <input type="date" name="end_date" value="{{ old('end_date') }}">
            </div>
            <div class="form__group">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" value="{{ old('email') }}">
            </div>
            <div class="search__button-center">
                <button type="submit" class="search__button">検索</button>
            </div>
            <div class="reset__button-center">
                <a class="reset__button" href="{{ route('admin.reset') }}">リセット</a>
            </div>
        </form>
        <div class="pagination">
            {{ $contacts->links('pagination::default') }}
        </div>
        @if ($searching ?? false)
            @if ($contacts->count() > 0)
                <table class="contacts__data">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>お名前</th>
                            <th>性別</th>
                            <th>メールアドレス</th>
                            <th>ご意見</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : '不明') }}</td>
                                <td>{{ $contact->email }}</td>
                                <td class="opinion" data-full-text="{{ $contact->opinion }}">
                                    {{ $contact->opinion }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.destroy', ['id' => $contact->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete__button">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>該当するデータが見つかりません。</p>
            @endif
        @else
            @if ($contacts->count() > 0)
                <table class="contacts__data">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>お名前</th>
                            <th>性別</th>
                            <th>メールアドレス</th>
                            <th>ご意見</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : '不明') }}</td>
                                <td>{{ $contact->email }}</td>
                                <td class="opinion" data-full-text="{{ $contact->opinion }}">
                                    {{ $contact->opinion }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.destroy', ['id' => $contact->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete__button">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>データがありません。</p>
            @endif
        @endif
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const opinionCells = document.querySelectorAll(".opinion");

            opinionCells.forEach((cell) => {
                let fullText = cell.getAttribute("data-full-text");
                let truncatedText = fullText.slice(0, 25);

                if (fullText.length > 25) {
                    truncatedText += "...";
                }

                cell.textContent = truncatedText;

                cell.addEventListener("mouseover", function() {
                    cell.textContent = fullText;
                    cell.style.whiteSpace = "normal";
                    cell.style.overflow = "visible";
                });

                cell.addEventListener("mouseout", function() {
                    cell.textContent = truncatedText;
                    cell.style.whiteSpace = "nowrap";
                    cell.style.overflow = "hidden";
                });
            });
        });
    </script>
@endsection
