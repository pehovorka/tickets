<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">{{config('app.name', 'KupVstup')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Domů</a>
        <a class="nav-item nav-link {{ Request::is('events*') ? 'active' : '' }}" href="/events">Akce</a>
        <a class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">O nás</a>
        </div>
    </div>
</nav>