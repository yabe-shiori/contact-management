@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('script')
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postcodeInput = document.getElementById('postcode');

            if (postcodeInput) {
                postcodeInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[０-９]/g, function(s) {
                        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
                    });
                });
            }
        });
    </script>
@endsection

@section('content')
    <div class="contact">
        <h1 class="contact-ttl">お問い合わせ</h1>
        <form class="form h-adr" action="{{ route('contact.confirm') }}" method="post">
            @csrf
            <table class="contact-table">
                <input type="hidden" class="p-country-name" value="Japan">
                <tr>
                    <th class="contact-item">
                        <label>お名前<span class="required">※</span></label>
                    </th>
                    <td class="contact-body">

                        <input type="text" name="name" class="form-text name"
                            value="{{ old('name', session('contactData.name')) }}" />
                        {{-- <input type="text" name="first_name" class="form-text name"
                            value="{{ old('first_name') }}" placeholder="名" /> --}}
                        <div class="description">例）山田 太郎</div>
                        <div class="error-message">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <th class="contact-item">
                    <label>性別<span class="required">※</span></label>
                </th>
                <td class="contact-body">
                    <input type="radio" name="gender" value="1" checked>
                    <label>男性</label>
                    <input type="radio" name="gender" value="2">
                    <label>女性</label>
                    <span class="error-message"></span>
                </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label>メールアドレス<span class="required">※</span></label>
                    </th>
                    <td class="contact-body">
                        <input type="email" name="email" class="form-text"
                            value="{{ old('email', session('contactData.email')) }}" />
                        <div class="description">例）test@example.com</div>
                        <div class="error-message">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label>郵便番号<span class="required">※</span></label>
                    </th>
                    <td class="contact-body">
                        <input type="text" id="postcode" name="postcode" class="form-text p-postal-code" size="8"
                            maxlength="8" value="{{ old('postcode', session('contactData.postcode')) }}" />
                        <div class="description">例）123-4567</div>
                        <div class="error-message">
                            @error('postcode')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label>住所<span class="required">※</span></label>
                    </th>
                    <td class="contact-body">
                        <input type="text" name="address"
                            class="form-text p-region p-locality p-street-address p-extended-address"
                            value="{{ old('address', session('contactData.address')) }}" />
                        <div class="description">例） 東京都渋谷区千駄ヶ谷1-2-3</div>
                        <div class="error-message">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label for="building_name">建物名</label>
                    </th>
                    <td class="contact-body">
                        <input type="text" name="building_name" class="form-text"
                            value="{{ old('building_name', session('contactData.building_name')) }}" />
                        <div class="description">例）千駄ケ谷マンション101</div>
                        <div class="error-message">
                            @error('building_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label>ご意見<span class="required">※</span></label>
                    </th>
                    <td class="contact-body">
                        <textarea name="opinion" class="form-textarea">{{ old('opinion', session('contactData.opinion')) }}</textarea>
                        <div class="error-message">
                            @error('opinion')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
            </table>
            <button class="form__button-submit"type="submit">確認</button>
        </form>
    </div>
@endsection
