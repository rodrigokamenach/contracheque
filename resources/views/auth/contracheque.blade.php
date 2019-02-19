@extends('auth.base')
@extends('auth.menu')
@section('conteudo')    
    <div class="container-fluid mt-2 ml-1">        
        <div class="card">                       
            <div class="card-body">
                <h4 class="card-title">Consulta Contracheque</h4>
                <h6 class="card-subtitle mb-2 text-muted">Selecione o Mẽs de Competência</h6>
                <form action="{{ route('buscaContracheque') }}" method="POST" class="buscon" autocomplete="off">
                    {!! csrf_field() !!}                    
                    <div class="form-group{{ $errors->has('mes') ? ' has-error' : '' }} row">
                        <label for="mes" class="col-12">Mês</label>
                        <input type="text" name="mes" id="mes" 
                            class="datepicker-here form-control form-control-md rounded-0 col-2 ml-3" 
                            data-language='pt-BR' 
                            data-min-view="months"
                            data-view="months"
                            data-date-format="mm/yyyy"
                            data-position='bottom left'
                        >
                        <input type="hidden" name="cpf" id="cpf" value="{{ intval(Auth::user()->cpf) }}">                        
                        <input type="hidden" name="matricula" id="matricula" value="{{ Auth::user()->matricula }}">
                        @if ($errors->has('mes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mes') }}</strong>
                            </span>
                        @endif 
                        <div class="col-2">
                            <button type="submit" class="btn btn-md btn-success text-white">Buscar</button>
                        </div>                                               
                    </div>
                    <span class="help-block erros"></span>                                        
                </form>
            </div>
        </div>         
        <div class="retorno"></div>           
    </div>
    <script>        
        $(document).ready(function() {
            $('form.buscon').on('submit', function(event) {
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
                            //msg = jQuery.parseJSON(data.retorno);                       
                            $('.retorno').html(data.dados);
                            
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
                return false;
            });
        });
    </script>
@endsection
@extends('auth.rodape')