@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Hlavní panel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                            <div class="card text-center col">
                                <div class="card-body">
                                    <h5 class="card-title">Vaše vstupenky</h5>
                                    <p class="card-text">Zobrazte si všechny vámi zakoupené vstupenky.</p>
                                    <a href="/home/tickets" class="btn btn-primary">Přejít</a>
                                </div>
                            </div>
                        @if( Auth::user()->hasAnyRole(['administrator','manager']))
                            <div class="card text-center col">
                                <div class="card-body">
                                    <h5 class="card-title">Správa akcí</h5>
                                    <p class="card-text">Vytvářejte nové akce a upravujte již vytvořené.</p>
                                    <a href="/home/events" class="btn btn-primary">Přejít</a>
                                </div>
                            </div>
                        @endif
                        @if( Auth::user()->hasAnyRole(['administrator','manager']))
                            <div class="card text-center col">
                                <div class="card-body">
                                    <h5 class="card-title">Správa míst</h5>
                                    <p class="card-text">Vytvářejte nové místa a upravujte již vytvořené.</p>
                                    <a href="/home/venues" class="btn btn-primary">Přejít</a>
                                </div>
                            </div>
                        @endif
                        @if( Auth::user()->hasAnyRole(['administrator']))
                        <div class="card text-center col">
                            <div class="card-body">
                                <h5 class="card-title">Správa uživatelů</h5>
                                <p class="card-text">Změna uživatelských rolí.</p>
                                <a href="/home/users" class="btn btn-primary">Přejít</a>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
