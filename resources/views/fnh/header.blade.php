<header>  
    <div class="header-image d-flex align-items-center">
        @if(Gate::check('isUser') || Gate::check('isAdmin') || Gate::check('isModer'))
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 col-10 offset-xl-8 offset-lg-8 offset-md-7 offset-sm-3 offset-1">
                <div class="row">
                    <a href="/profile" class="col-xl-5 col-sm-9 col-9 header-profile btn btn-dark">
                        Личный кабинет
                    </a>
                    <a href="/logout" class="col-xl-2 col-sm-3 col-3 header-profile-logout btn btn-dark">
                        <i class="fas fa-arrow-circle-right" style="font-size: 20px;"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-10 col-12 offset-xl-9 offset-lg-8 offset-md-7 offset-sm-1">
                <div class="row">
                    <a href="/register" class="col header-profile btn btn-dark">
                        Регистрация
                    </a>
                    <a href="/login" class="col header-profile-logout btn btn-dark">
                        Авторизация
                    </a>
                </div>
            </div>
        @endif
    </div>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/" style="padding: 0;margin: 0;">
                <i class="fas fa-book-open" style="font-size: 26px;"> LibraryManga</i>
            </a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/">Главная</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/news">Новости</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/catalog">Каталог манги</a>
                    </li>
                    @if(Gate::check('isAdmin') || Gate::check('isModer'))
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="/adminPanel">Панель администратора</a>
                        </li>
                    @endif
                    <li class="nav-item" role="presentation">
                        <div class="nav-link search-item">@livewire('counter')</div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>