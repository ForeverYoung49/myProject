<header>
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark" style="padding: 10px 10px; font-size: 20px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="padding: 0;margin: 0;">
                <i class="fas fa-book-open" style="font-size: 30px;"></i>
            </a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="/">Главная</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/news">Новости</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/catalog">Каталог манги</a>
                    </li>
                @if(!Gate::check('isUser') && !Gate::check('isAdmin'))
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/register">Регистрация</a>
                    </li> 
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/login">Авторизация</a>
                    </li>
                @endif
                @if(Gate::check('isUser') || Gate::check('isAdmin'))
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/profile">Личный кабинет</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/logout">Выйти</a>
                    </li>
                @endif
                </ul>
            </div>
        </div>
    </nav>
</header>