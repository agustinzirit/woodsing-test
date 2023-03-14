@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verficacion de 2FA') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('two-factor') }}">
                        @csrf
                        @if (session('correo'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('correo') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="float-center">
                                <div class="title m-b-md">
                                    {!! $qr !!}
                                </div>
                            </div>
                            <input type="hidden" name="datos" value="{{$datos}}">
                        </div>
                        <div class="clearfix"></div>
                        <div class="row mb-3 pt-5">
                            <label for="codigo" class="col-md-4 col-form-label text-md-end">{{ __('Escanee e Ingrese el código') }}</label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>

                                @error('codigo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirmar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection