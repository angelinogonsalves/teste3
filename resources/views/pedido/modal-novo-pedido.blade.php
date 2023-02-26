<div class="modal fade modalPedido" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Procedimentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="procedure_table">
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Procedimento</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($procedures)
                                @foreach ($procedures as $procedure)
                                    <tr class="cursorPointer" procedure_id="{{ $procedure->id }}" category_id="{{ $procedure['procedureCategory']->id }}">
                                        <td class="category"> {{ $procedure['procedureCategory']->nome_categoria }} </td>
                                        <td class="procedureName"> {{ $procedure->nome_procedimento }} </td>
                                        <td class="suggestedValue"> {{ ManualHelper::mysqlCurrencyToBr($procedure->valor_sugerido) }} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnSaveProcedures">Salvar</button>
                <button type="button" class="btn btn-outline-secondary" id="fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function savePedido() {
        $("#btnSavePedido").on('click', function() {
            listSelectedProcedures(myProcedures,'.modalPedido');

            // Zera para não duplicar caso abra o modal novamente e selecione outros procedimentos
            myPedidos = [];
        });
    }

    
    
    $(document).ready(function() {
        saveProcedures();
        selecionarProcedimentos();
        fecharModal();
        addDataTable('#procedure_table', 0, 'asc', true, true);
    });
</script>