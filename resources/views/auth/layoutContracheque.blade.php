<div class="card rounded-0 mt-2">  
    <div class="card-body">
        <div class="container-fluid">
            <div class="row border-bottom">
                <div class="col-10">            
                    <h4 class="card-title"><small>Demonstrativo de Pagamento de Salário</small></h4>
                </div>
                <div class="col-2 my-auto pl-2">
                    <h6 align="center"><small><strong>Mês/Ano</strong></small></h6>
                    <h6 align="center"><small>{{ $retorno[0]->mes_ano->format('m/Y') }}</small></h6>
                </div>
            </div>
            <div class="row mt-2 border-bottom">
                <div class="col-8 my-auto pl-2">
                    <h6 align="left"><small><strong>Empresa</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->cod_empresa }} - {{ $retorno[0]->empresa }}</small></h6>
                </div>
                <div class="col-2 my-auto pl-2">
                    <h6 align="left"><small><strong>CNPJ</strong></small></h6>
                    <h6 align="left"><small>99.999.999/9991-99<</small>/h6>
                </div>     
            </div>
            <div class="row mt-2 border-bottom">
                <div class="col-1 my-auto pl-2">
                    <h6 align="left"><small><strong>Cadastro</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->matricula }}</small></h6>    
                </div>
                <div class="col-7 my-auto pl-2">
                    <h6 align="left"><small><strong>Nome</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->nome_funcionario }}</small></h6>    
                </div>
                <div class="col-4 my-auto pl-2">
                    <h6 align="left"><small><strong>Data Admissão</strong></small></h6>
                    <h6 align="left"><small>11/11/1111</small></h6>    
                </div>     
            </div>
            <div class="row mt-2 border-bottom">
                <div class="col-6 my-auto pl-2">
                    <h6 align="left"><small><strong>Cargo</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->codcar }} - {{ $retorno[0]->cargo }}</small></h6>    
                </div>
                <div class="col-6 my-auto pl-2">
                    <h6 align="left"><small><strong>Local</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->local }}</small></h6>    
                </div>            
            </div>
            <div class="row mt-2 border-bottom">
                <div class="col-1 my-auto pl-2">
                    <h6 align="left"><small><strong>N° Banco</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->banco }}</small></h6>    
                </div>
                <div class="col-1 my-auto pl-2">
                    <h6 align="left"><small><strong>Agência</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->agencia }}</small></h6>    
                </div>
                <div class="col-4 my-auto pl-2">
                    <h6 align="left"><small><strong>N° Conta - Dígito</strong></small></h6>
                    <h6 align="left"><small>{{ $retorno[0]->conta }}-{{ $retorno[0]->digito_conta }}</small></h6>    
                </div>
                <div class="col-4 my-auto pl-2">
                    <h6 align="left"><small><strong>Modo de Recebimento</strong></small></h6>
                    <h6 align="left"><small>O - Ordem Pagto</small></h6>    
                </div>     
            </div>
            <div class="row mt-2 border-bottom">
                <table class="table table-hover table-sm table-borderless">
                    <thead class="thead-dark">
                        <tr class="row">
                            <th scope="col" class="col-1 text-center"><small>Cód</small></th>
                            <th scope="col" class="col-8"><small>Descrição</small></th>
                            <th scope="col" class="col-1 text-center"><small>Refêrencia</small></th>
                            <th scope="col" class="col-1 text-right"><small>Vencimentos</small></th>
                            <th scope="col" class="col-1 text-right"><small>Descontos</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($retorno as $item)                                            
                        <tr class="row">
                            <td style="border-right: 1px solid" scope="row" align="center" class="col-1"><small>{{ str_pad($item->codeve,3,0,STR_PAD_LEFT) }}</small></td>
                            <td style="border-right: 1px solid" align="left" class="col-8"><small>{{ $item->deseve }}</small></td>
                            <td style="border-right: 1px solid" align="right" class="col-1"><small>{{ number_format($item->refeve,2,',','.') }}</small></td>
                        @if ($item->tipo == 1)
                            <td style="border-right: 1px solid" align="right" class="col-1"><small>{{ number_format($item->valeve,2,',','.') }}</small></td>
                            <td align="right" class="col-1"></td>
                        @else
                            <td style="border-right: 1px solid" align="right" class="col-1"></td>
                            <td align="right" class="col-1"><small>{{ number_format($item->valeve,2,',','.') }}</small></td>
                        @endif    
                        </tr>                    
                        @endforeach
                    </tbody>
                </table>    
            </div>
            <div class="row mt-2 border-bottom">
                <div class="col-1 my-auto pl-2">
                    <h6 align="center"><small><strong>Salário Base</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->salario_base,2,',','.') }}</small></h6>    
                </div>
                <div class="col-2 my-auto pl-2">
                    <h6 align="center"><small><strong>Salário Contr. INSS</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->base_inss,2,',','.') }}</small></h6>    
                </div>
                <div class="col-1 my-auto pl-2">
                    <h6 align="center"><small><strong>Faixa IRRF</strong></small></h6>
                    <h6 align="right"><small>0,00</small></h6>    
                </div>
                <div class="col-6 my-auto pl-2"></div>
                <div class="col-1 my-auto pl-2">
                    <h6 align="right"><small><strong>Total de Vencimentos</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->proventos,2,',','.') }}</small></h6>    
                </div>
                <div class="col-1 my-auto pl-2">
                    <h6 align="right"><small><strong>Total de Descontos</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->descontos,2,',','.') }}</small></h6>    
                </div>     
            </div>
            <div class="row mt-2 border-bottom">
                <div class="col-2 my-auto pl-2">
                    <h6 align="center"><small><strong>Base Cálc. FGTS</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->base_fgts,2,',','.') }}</small></h6>    
                </div>
                <div class="col-1 my-auto pl-2">
                    <h6 align="center"><small><strong>FGTS do Mês</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->fgts_mes,2,',','.') }}</small></h6>    
                </div>
                <div class="col-2 my-auto pl-2">
                    <h6 align="center"><small><strong>Base Cálculo IRRF</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->base_irrf,2,',','.') }}</small></h6>    
                </div>
                <div class="col-6 my-auto pl-2"></div>
                <div class="col-1 my-auto pl-2">
                    <h6 align="right"><small><strong>Valor Líquido</strong></small></h6>
                    <h6 align="right"><small>{{ number_format($retorno[0]->liquido,2,',','.') }}</small></h6>    
                </div>                        
            </div>
        </div>        
    </div>
</div>
