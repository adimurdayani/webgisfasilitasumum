<div class="col-lg-4">
    <div class="card-box ribbon-box">
        <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-menu mr-1"></i>
            {{ __('List Menu Settings') }}
        </div>

        <div class="ribbon-content">
            <div class="list-group">
                <a href="{{ route('app.settings.index') }}" class="list-group-item list-group-item-action">
                    {{ __('General') }}
                </a>
                <a href="{{ route('app.settings.company-setting') }}" class="list-group-item list-group-item-action">{{
                    __('Company') }}</a>
                <a href="{{ route('app.mails.index') }}" class="list-group-item list-group-item-action">{{ __('Mail')
                    }}</a>
                <a href="{{ route('app.settings.recaptcha-setting') }}"
                    class="list-group-item list-group-item-action">{{ __('reCaptcha') }}</a>
                <a href="{{ route('app.settings.social-setting') }}" class="list-group-item list-group-item-action">{{
                    __('Social') }}</a>
                <a href="{{ route('app.settings.social-login-setting') }}"
                    class="list-group-item list-group-item-action">{{ __('Social Login') }}</a>
                <a href="{{ route('app.languages.index') }}" class="list-group-item list-group-item-action">{{
                    __('Language Setting') }}</a>
            </div>
        </div>
    </div>
</div>