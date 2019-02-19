@extends('layouts.principal')
@section('login')    
    <div class="container h-100">                
            <div class="row align-self-center h-100">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto my-auto">
                    <div class="card card-block rounded-0 w-100">
                        <div class="card-header bg-dark">                            
                            <div class="mx-auto text-center">
                                <img src="{{ asset('img/logologin.png') }}" class="img-fluid|thumbnail card-img-top" alt="">
                            </div>
                        </div>
                        <div class="card-body">                
                        {{--@if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}                       
                        @if(Session::has('msg'))
                            <div class="alert alert-danger">
                                {{ Session::get('msg')}}                                                 
                                <div class="col-md-3 float-right">
                                        @if(Session::has('cpf'))
                                        <form action="{{ route('ativaLogin') }}" method="POST" class="ajax">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="cpfAtiva" id="cpfAtiva" class="form-control form-control-la rounded-0" value="{{ Session::get('cpf') }}">                                                                                                
                                            <input type="hidden" name="foneAtiva" id="foneAtiva" class="form-control form-control-la rounded-0" value="{{ Session::get('numfon') }}">
                                            <button type="submit" class="btn btn-primary btn-sm">Ativar </button>
                                        </form>                                                                        
                                        @endif
                                    </div>                           
                            </div>                             
                        @endif                                                                                                                                        
                        <form action="{{ route('logar') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" id="cpf" class="form-control form-control-la rounded-0" placeholder="Somente Números">
                                @if ($errors->has('cpf'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control form-control-la rounded-0" placeholder="***">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-success text-white">Logar</button>
                                <a name="" id="" class="btn btn-light btn-sm" href="#" role="button" data-toggle="modal" data-target="#resetModal">Recuperar senha</a>
                                <button type="button" class="btn btn-dark btn-sm btn-info float-right" data-toggle="modal" data-target="#registerModal">Primeiro Acesso</button>                                                            
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
         
        </div>              
    </div>
@endsection

@section('resetar')
    <!-- Modal -->   
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="Relembrar Senha" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Relembrar Senha</h5>
                                <button type="button" class="close float-right btn-sm" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('relembrar') }}" method="POST" class="ajax">
                            {!! csrf_field() !!}
                            <span class="help-block erros"></span>
                            <div class="form-group{{ $errors->has('cpfReset') ? ' has-error' : '' }}">
                                <label for="cpfReset">CPF</label>
                                <input type="text" name="cpfReset" id="cpfReset" class="form-control form-control-la rounded-0" placeholder="Somente Números">                                
                            </div>                                                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="res" class="btn btn-sm btn-success reg">OK</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>                                                    
                </div>
            </form>
            </div>
        </div>    
    </div> 
    
    <!-- Modal -->   
    <div class="modal fade" id="recuperaSenhaModal" tabindex="-1" role="dialog" aria-labelledby="Alterar Senha" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Alterar Senha</h5>
                                    <button type="button" class="close float-right btn-sm" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="{{ route('mudaSenha') }}" method="POST" class="ajax">
                            {!! csrf_field() !!}
                            <span class="help-block erros"></span>
                            <div class="form-group{{ $errors->has('codRecupera') ? ' has-error' : '' }}">
                                <label for="codRecupera">Código de Recuperação</label>
                                <input type="text" name="codRecupera" id="codRecupera" class="form-control form-control-la rounded-0">
                                <input type="hidden" name="cpfRecupera" id="cpfRecupera" class="form-control form-control-la rounded-0" placeholder="Somente Números">                                
                            </div>
                            <div class="form-group{{ $errors->has('senhaRecu') ? ' has-error' : '' }}">
                                <label for="senhaRecu">Nova Senha</label>
                                <input type="password" name="senhaRecu" id="senhaRecu" class="form-control form-control-la rounded-0" placeholder="***">                                
                            </div>
                            <div class="form-group{{ $errors->has('confirmaRecu') ? ' has-error' : '' }}">
                                <label for="confirmaRecu">Confirma Senha</label>
                                <input type="password" name="confirmaRecu" id="confirmaRecu" class="form-control form-control-la rounded-0" placeholder="***">                                
                            </div>                                                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="rec" class="btn btn-sm btn-success reg">Alterar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>                                                    
                    </div>
                </form>
                </div>
            </div>    
        </div> 
@endsection

@section('registro')    
    <!-- Modal -->    
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="Registrar" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Registrar Acesso</h5>
                                <button type="button" class="close float-right btn-sm" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('registrar') }}" method="POST" class="ajax">
                            {!! csrf_field() !!}
                            <span class="help-block erros"></span>
                            <div class="form-group{{ $errors->has('cpf_reg') ? ' has-error' : '' }}">
                                <label for="cpf_reg">CPF</label>
                                <input type="text" name="cpf_reg" id="cpf_reg" class="form-control form-control-la rounded-0" placeholder="Somente Números">                                
                            </div>
                            <div class="form-group{{ $errors->has('senha_reg') ? ' has-error' : '' }}">
                                <label for="senha_reg">Senha</label>
                                <input type="password" name="senha_reg" id="senha_reg" class="form-control form-control-la rounded-0" placeholder="***">                                
                            </div>
                            <div class="form-group{{ $errors->has('confirma') ? ' has-error' : '' }}">
                                <label for="senha">Confirma Senha</label>
                                <input type="password" name="confirma" id="confirma" class="form-control form-control-la rounded-0" placeholder="***">                                
                            </div>                                                     
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="reg" class="btn btn-sm btn-success reg">Registrar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>                                                    
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Modal Ativa -->
    <div class="modal fade" id="ativarModal" tabindex="-1" role="dialog" aria-labelledby="Ativar" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Ativar Usuário</h5>
                                <button type="button" class="close float-right btn-sm" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('ativar') }}" method="POST" class="ajax">
                            {!! csrf_field() !!}
                            <span class="help-block erros"></span>                                                            
                            <input type="hidden" name="cpf_ativa" id="cpf_ativa" class="form-control form-control-la rounded-0">                                                            
                            <div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
                                <label for="codigo">Código</label>
                                <input type="text" name="codigo" id="codigo" class="form-control form-control-la rounded-0">                                
                            </div>                                                                                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="ok" class="btn btn-sm btn-success reg">Ok</button>                    
                </div>
            </form>
            </div>
        </div>
    </div>        
    <script>        
    $(document).ready(function() {
        // Ajax for our form
        $('.modal').on('hidden.bs.modal', function () {            
            $(".erros").html("");
        });

        $('form.ajax').on('submit', function(event) {
            event.preventDefault();
            $('.erros').html(' ');
            var formData = $(this).serialize(); // form data as string
            var formAction = $(this).attr('action'); // form handler url
            var formMethod = $(this).attr('method'); // GET, POST            
            jQuery.ajaxSetup({
                headers: {
                    'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type  : formMethod,
                url   : formAction,
                data  : formData,
                cache : false,

                beforeSend : function() {
                    console.log(formData);
                },

                success : function(data) {
                    if (data.error) {
                        msg = '<div class="alert alert-danger">'+data.error+'</div>';
                        $('.erros').html(msg);
                    } else {
                        if (data.sucesso == 1) {
                            $('#registerModal').modal('hide');
                            $('#cpf_ativa').val(data.cpf_ativa);
                            $('#ativarModal').modal();         
                        }
                        //alert(data.cpf_ativa);
                        if (data.sucesso == 2) {
                            $('#ativarModal').modal('hide');
                        } 
                        
                        if (data.sucesso == 3) {
                            $('#resetModal').modal('hide');
                            $('#cpfRecupera').val(data.cpfReset);
                            $('#recuperaSenhaModal').modal();
                        }

                        if (data.sucesso == 4) {
                            window.location.href = "{{URL::to('/home')}}";
                        }
                        
                    }                
                },

                error : function(xhr, ajaxOptions, thrownError) {                    
                    msg = jQuery.parseJSON(xhr.responseText);
                    //alert(msg.errors.confirma);
                    var erro = '<div class="alert alert-danger">';
                    $.each(msg.errors, function(key, value) {
                        erro += '<li>'+value+'</li>';
                    })
                    erro += '</div>';
                    $('.erros').html(erro);
                }
            });
            // console.log(formData);
            return false; // prevent send form
        });
    });            
    </script>    
@endsection 




    

