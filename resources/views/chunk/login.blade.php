<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="large-4 medium-6 small-12 cell callout form-section">
            <div class="grid-x grid-padding-x">
                <div class="large-12 medium-12 small-12 text-center header">
                    <h1> Войти в Личный кабинет пользователя </h1>
                </div>
                <div class="large-12 columns cell">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="grid-x grid-padding-x">
                            
                            <div class="large-12 medium-12 cell">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="text" name="email" value="{{ old('email') }}" placeholder="Ваш логин">
                            </div>
                            <div class="large-12 medium-12 cell">
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="password" class="@error('password') is-invalid @enderror" placeholder="Пароль" name="password" placeholder="Ваш пароль">
                            </div>
                            
                            <div class="large-12 medium-12 cell">
                                <button class="button primary login-btn">Войти</button>
                            </div>
                            <div class="grid-x grid-padding-x cell columns forget-section">
                                <div class="large-6 medium-6 small-12 cell text-center">
                                    <input id="remember-me" type="checkbox" name="remember"><label for="remember-me">Запомнить меня</label>
                                </div>
                                <div class="large-6 medium-6 text-center small-12 text-right">
                                    <a href="#">Забыли пароль?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="grid-x grid-padding-x sign-section">
                <div class="large-12 small-12 text-center last-text">
                    <span>Еще нет аккаунта? <a href="#" class="large-12">Создать</a></span>
                </div>
            </div>
        </div>
    </div>
</div>