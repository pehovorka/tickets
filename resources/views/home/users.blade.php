@extends('layouts.app')


@section('content')
    <h1>Správa uživatelů</h1>
    @if(count($users)>0)
    {{ Form::open(['action' => 'HomeController@storeUserRoles', 'method' => 'POST']) }}
    <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Jméno</th>
                <th scope="col">Příjmení</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row" class="align-middle">{{$user->id}}</a></th>
                <td class="align-middle">{{$user->first_name}}</td>
                <td class="align-middle">{{$user->last_name}}</td>
                <td class="align-middle">{{$user->email}}</td>
                <td>
                    @if (auth()->user() == $user)
                        <div class="rolesCheckboxes">
                            @foreach ($roles as $role)
                            <div class="form-check form-check-inline">
                                {!! Form::radio('user['.$user->id.'][role]', $role->id, ($user->user_role_id == $role->id), ['class' => 'form-check-input', 'id' => 'user'.$user->id.'role'.$role->id, 'disabled']) !!}
                                {!! Form::label('user'.$user->id.'role'.$role->id, $role->name, ['class' => 'form-check-label']) !!}
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="rolesCheckboxes">
                                @foreach ($roles as $role)
                                <div class="form-check form-check-inline">
                                    {!! Form::radio('user['.$user->id.'][role]', $role->id, ($user->user_role_id == $role->id), ['class' => 'form-check-input', 'id' => 'user'.$user->id.'role'.$role->id]) !!}
                                    {!! Form::label('user'.$user->id.'role'.$role->id, $role->name, ['class' => 'form-check-label']) !!}
                                </div>
                                @endforeach
                            </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else 
        <p>Žádní uživatelé.</p>
    @endif
    <a href="/home" role="button" class="btn btn-secondary">Zpět na hlavní panel</a>
    {{Form::submit('Uložit změny', ['class'=>'btn btn-primary', 'id' => 'updateUsers'])}}
    {{ Form::close() }}
@endsection
