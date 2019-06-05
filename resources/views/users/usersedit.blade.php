<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1 class="text-center display-4">Editar usuario</h1>
    <div class="shadow-lg p-5 rounded-lg mx-5">
    <form method="POST" action="{{ url( 'usuario/'.$user->userid ) }}">
        {{ method_field('PUT')}}
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="professionid">Profesión:</label>
            <select class="form-control" id="professionid" name="professionid">
            @foreach($professions as $profession)

                <option value="{{$profession->professionid}}" 
                @if($user->professionid == $profession->professionid)
                    selected
                @endif
                >{{$profession->name}}</option>

            @endforeach
            </select>
            @if($errors->has('professionid'))
                <p>{{ $errors->first('professionid')}}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
            @if($errors->has('name'))
                <p>{{ $errors->first('name')}}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" >
            @if($errors->has('email'))
                <p>{{ $errors->first('email')}}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password">
            @if($errors->has('password'))
                <p>{{ $errors->first('password')}}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar usuario</button>
    </form>
    </div>
</div>
</body>
</html>