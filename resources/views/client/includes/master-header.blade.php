<header class="app-bar toolbar">
    <div class="toolbar__content d-flex justify-content-between align-items-center">
		<div class="toolbar__content-left d-flex align-items-center">
			<a href="{{ route('client.home.index') }}" class="d-block">
                <div class="company-logo">
                    <div class="company-logo__image" style="background-image: url('{{ get_storage_image_url(optional(ListHelper::siteManagement('logoImage'))->path) }}')"></div>
                </div>
            </a>
			<div class="app-bar-text">
				{{ ListHelper::siteManagement('greeting') }}<span class="username">{{ \StudentFacades::visitor() }}</span>
			</div>
		</div>
		<div class="toolbar__content-right d-flex align-items-center">
			@if(\StudentFacades::isLogin())
            <button type="button" class="btn btn-light">
				<span>Thông báo</span>
				<span class="badge badge-light">0</span>
			</button>
			<div class="app-bar-account">
                <button id="profileDropdown" type="button" class="toolbar-profile__u-dropdown btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ \StudentFacades::avatar() }}" alt="user avatar" class="toolbar-profile__u-avt">
                </button>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="toolbar-profile__u-basicInfo d-flex justify-content-between align-items-center">
                        <div class="sheet d-flex justify-content-between align-items-center">
                            <img src="{{ \StudentFacades::avatar() }}" alt="user avatar" class="u-avt__sector">
                            <div class="u-content__sector">
                                <h3 class="username">{{ \StudentFacades::visitor() }}</h3>
                                <span class="joined">{{ \StudentFacades::joined() }}</span>
                            </div>
                        </div>
                        <div class="u-email__verify-stt"></div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('client.user.profile.detail', ['user' => \StudentFacades::studentKey()]) }}">Tài khoản</a>
                    <a class="dropdown-item" href="{{ route('client.auth.submit.logout') }}">Đăng xuất</a>
                </div>
			</div>
            @endif
		</div>
    </div>
</header>
