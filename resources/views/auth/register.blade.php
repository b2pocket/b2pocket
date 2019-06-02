@extends('layouts.app')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #7386D5;">{{ __('Register') }}
                     <a style="float: right;" href="{{ url ('/home') }}" >
                        <i class="fas fa-home"></i>
                        Pocetna
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Rola') }}</label>

                            <div class="col-md-6">
                                
                                    <select name="role" class="form-control" id="odabranaRola" onchange="definisanjeObjekta()">
                                        <option value="admin">admin</option>
                                        <option value="cmat">cmat</option>
                                        <option value="cmatMPO">MATEA_ADMIN</option>
                                        <option value="cmatRADNJA">MATEA OBJEKAT</option>
                                       
                                    </select> 
                         
                            </div>
                            </div>   
                            <div class="form-group row" id="sifraRadnje">
                                <label for="orgjed" class="col-md-4 col-form-label text-md-right">{{ __('Sifra radnje') }}</label>

                                <div class="col-md-6">
                                            <input id="orgjed" type="text" class="form-control{{ $errors->has('orgjed') ? ' is-invalid' : '' }}" name="orgjed" value="{{ old('orgjed') }}" >

                                            @if ($errors->has('orgjed'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('orgjed') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                            </div>
                         

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      document.getElementById('sifraRadnje').style.display = 'none';
    function definisanjeObjekta() {
            if(document.getElementById('odabranaRola').value == 'cmatRADNJA' )
            {
                document.getElementById('sifraRadnje').style.display = '';

            }
            else 
            {
                 document.getElementById('sifraRadnje').style.display = 'none';
            }
      
    }
</script>
@endsection
