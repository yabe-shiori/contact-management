@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}" />
@endsection

@section('content')
    <h1>管理システム</h1>
    <form method="post" action="{{ route('admin.search') }}" class="search-form">
        @csrf
        <div class="form__group">
            <label for="name">お名前</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="form__group">
            <label for="gender">性別</label>
            <label for="gender">性別</label>
            <input type="radio" name="gender" value="0" {{ old('gender', '0') === '0' ? 'checked' : '' }}>全て
            <input type="radio" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : '' }}>男性
            <input type="radio" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }}>女性
        </div>

        <div class="form__group-date">
            <label for="created_at">登録日</label>
            <input type="text" name="created_at" value="{{ old('created_at') }}">
        </div>

        <div class="form__group">
            <label for="email">メールアドレス</label>
            <input type="text" name="email" value="{{ old('email') }}">
        </div>
        <button type="submit" class="search-button">検索</button>
        <a href="{{ route('admin.reset') }}">リセット</a>
    </form>
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
@if ($searching ?? false)
    @if ($contacts->count() > 0)
        <table>
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
                        <td>{{ $contact->opinion }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.destroy', ['id' => $contact->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">削除</button>
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
    <!-- 以下、元の一覧データセクション -->
    @if ($contacts->count() > 0)
        <table>
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
                        <td>{{ $contact->opinion }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.destroy', ['id' => $contact->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">削除</button>
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
