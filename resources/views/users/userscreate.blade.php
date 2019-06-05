<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creando</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1 class="text-center display-4">Crear Usuario</h1>
    <div class="shadow-lg p-5 rounded-lg mx-5">
    <form method="POST" action="{{ route('usuarios.crear')}}">
        {!! csrf_field() !!}
        <div class="form-group">
        <div class="form-group">
            <label for="professionid">Profesión:</label>
            <select class="form-control" id="professionid" name="professionid">
            @foreach($professions as $profession)
                <option value="{{$profession->professionid}}">{{$profession->name}}</option>
            @endforeach
            </select>
            @if($errors->has('professionid'))
                <div class="alert alert-danger">{{ $errors->first('professionid')}}</div>
            @endif
        </div>

        <!-- <input type="number" class="form-control" name="professionid" id="professionid" value="{{ old('professionid') }}"> -->

        </div>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            @if($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
            @if($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('email')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password">
            @if($errors->has('password'))
                <div class="alert alert-danger">{{ $errors->first('password')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Crear usuario</button>
    </form>
    </div>
</div>
    <!-- @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
</body>
</html>