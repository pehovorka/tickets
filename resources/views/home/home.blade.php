@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="card">
                    <div class="card-header">Hlavní panel</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-ticket-alt fa-5x"></i>
                                        <h5 class="card-title mt-3">Vaše vstupenky</h5>
                                        <p class="card-text">Zobrazte si všechny vámi zakoupené vstupenky.</p>
                                        <a href="/home/tickets" class="btn btn-primary">Přejít</a>
                                    </div>
                                </div>
                            </div>
                            @if( Auth::user()->hasAnyRole(['administrator','manager']))
                            <div class="col-lg-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                            <i class="fas fa-calendar-alt fa-5x"></i>
                                        <h5 class="card-title mt-3">Správa akcí</h5>
                                        <p class="card-text">Vytvářejte nové akce a upravujte již vytvořené.</p>
                                        <a href="/home/events" class="btn btn-primary">Přejít</a>
                                    </div>
                                </div>
                            </div>
                            @endif @if( Auth::user()->hasAnyRole(['administrator','manager']))
                            <div class="col-lg-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-map-marked-alt fa-5x"></i>
                                        <h5 class="card-title mt-3">Správa míst</h5>
                                        <p class="card-text">Vytvářejte nové místa a upravujte již vytvořené.</p>
                                        <a href="/home/venues" class="btn btn-primary">Přejít</a>
                                    </div>
                                </div>
                            </div>
                            @endif @if( Auth::user()->hasAnyRole(['administrator']))
                            <div class="col-lg-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-users fa-5x"></i>
                                        <h5 class="card-title mt-3">Správa uživatelů</h5>
                                        <p class="card-text">Změna uživatelských rolí.</p>
                                        <a href="/home/users" class="btn btn-primary">Přejít</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection