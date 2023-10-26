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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementsByName('name')[0];
            const emailInput = document.getElementsByName('email')[0];
            const postcodeInput = document.getElementById('postcode');
            const addressInput = document.getElementsByName('address')[0];
            const opinionInput = document.getElementsByName('opinion')[0];

            function validateName() {
                const nameError = document.getElementById('name-error');
                const nameValue = nameInput.value;
                if (nameValue.trim() === '' || nameValue.length > 255) {
                    nameError.textContent = 'お名前は必須です(255文字以内)';
                } else {
                    nameError.textContent = '';
                }
            }

            function validateEmail() {
                const emailError = document.getElementById('email-error');
                const emailValue = emailInput.value;
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (emailValue.trim() === '' || emailValue.length > 255 || !emailRegex.test(emailValue)) {
                    emailError.textContent = '有効なメールアドレスを入力してください（255文字以内）';
                } else {
                    emailError.textContent = '';
                }
            }

            function validatePostcode() {
                const postcodeError = document.getElementById('postcode-error');
                const postcodeValue = postcodeInput.value;
                const postcodeRegex = /^\d{3}-\d{4}$/;
                if (postcodeValue.trim() === '' || !postcodeRegex.test(postcodeValue)) {
                    postcodeError.textContent = '郵便番号を7桁でハイフン付きで入力してください（例：123-4567）';
                } else {
                    postcodeError.textContent = '';
                }
            }

            function validateAddress() {
                const addressError = document.getElementById('address-error');
                const addressValue = addressInput.value;
                if (addressValue.trim() === '' || addressValue.length > 255) {
                    addressError.textContent = '住所は必須です(255文字以内)';
                } else {
                    addressError.textContent = '';
                }
            }

            function validateOpinion() {
                const opinionError = document.getElementById('opinion-error');
                const opinionValue = opinionInput.value;
                if (opinionValue.trim() === '' || opinionValue.length > 120) {
                    opinionError.textContent = 'ご意見は必須です(120文字以内)';
                } else {
                    opinionError.textContent = '';
                }
            }

            nameInput.addEventListener('input', validateName);
            emailInput.addEventListener('input', validateEmail);
            postcodeInput.addEventListener('input', validatePostcode);
            addressInput.addEventListener('input', validateAddress);
            opinionInput.addEventListener('input', validateOpinion);
        });
    </script>
@endsection

@section('content')
    <div class="contact">
        <h1 class="contact__ttl">お問い合わせ</h1>
        <form class="form h-adr" action="{{ route('contact.confirm') }}" method="post">
            @csrf
            <table class="contact__table">
                <input type="hidden" class="p-country-name" value="Japan">
                <tr>
                    <th class="contact__table-item">
                        <label>お名前<span class="contact__table__item-required">※</span></label>
                    </th>
                    <td class="contact__table-body">

                        <input type="text" name="name" class="form__text name"
                            value="{{ old('name', session('contactData.name')) }}" />
                        {{-- <input type="text" name="first_name" class="form-text name"
                            value="{{ old('first_name') }}" placeholder="名" /> --}}
                        <div class="description">例）山田 太郎</div>
                        <div class="error-message" id="name-error">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <th class="contact__table-item">
                    <label>性別<span class="contact__table__item-required">※</span></label>
                </th>
                <td class="contact__table-body">
                    <input type="radio" name="gender" value="1" checked>
                    <label>男性</label>
                    <input type="radio" name="gender" value="2">
                    <label>女性</label>
                    <span class="error-message"></span>
                </td>
                </tr>
                <tr>
                    <th class="contact__table-item">
                        <label>メールアドレス<span class="contact__table__item-required">※</span></label>
                    </th>
                    <td class="contact__table-body">
                        <input type="email" name="email" class="form__text"
                            value="{{ old('email', session('contactData.email')) }}" />
                        <div class="description">例）test@example.com</div>
                        <div class="error-message" id="email-error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact__table-item">
                        <label>郵便番号<span class="contact__table__item-required">※</span></label>
                    </th>
                    <td class="contact__table-body">
                        <input type="text" id="postcode" name="postcode" class="form__text p-postal-code" size="8"
                            maxlength="8" value="{{ old('postcode', session('contactData.postcode')) }}" />
                        <div class="description">例）123-4567</div>
                        <div class="error-message" id="postcode-error">
                            @error('postcode')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact__table-item">
                        <label>住所<span class="contact__table__item-required">※</span></label>
                    </th>
                    <td class="contact__table-body">
                        <input type="text" name="address"
                            class="form__text p-region p-locality p-street-address p-extended-address"
                            value="{{ old('address', session('contactData.address')) }}" />
                        <div class="description">例） 東京都渋谷区千駄ヶ谷1-2-3</div>
                        <div class="error-message" id="address-error">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact__table-item">
                        <label for="building_name">建物名</label>
                    </th>
                    <td class="contact__table-body">
                        <input type="text" name="building_name" class="form__text"
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
                    <th class="contact__table-item">
                        <label>ご意見<span class="contact__table__item-required">※</span></label>
                    </th>
                    <td class="contact__table-body">
                        <textarea name="opinion" class="form__textarea">{{ old('opinion', session('contactData.opinion')) }}</textarea>
                        <div class="error-message" id="opinion-error">
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
