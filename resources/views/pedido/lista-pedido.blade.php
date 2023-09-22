@extends('layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pedidos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url('pedidos/cadastro') }}"class="btn btn btn-primary">Adicionar Novo Pedido</a>
                            {{-- <a href="{{ url('/pedidos') }}" class="btn btn btn-success float-right">Atualizar dados
                                Pagamentos </a> --}}

                        </div>
                        <!-- /.card-header  usar modelo table que baixa em CSV-->
                        <div class="card-body table-responsive p-2">
                            <table id="tabela_itens_produto" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data Pedido</th>
                                        <th>Aluno - R.A.</th>
                                        <th>Valor Pedido</th>
                                        <th>Status</th>
                                        <th>Unidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dados as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td><?php echo date('d/m/Y', strtotime($p->created_at)); ?></td>
                                            <td>{{ $p->nome_aluno }} - {{ $p->ra_aluno }}</td>
                                            <td>{{ $p->valor }}</td>
                                            <td>
                                                <span class="badge badge-{{$p->classeStatus()}}">{{$p->nomeStatus()}}</span>
                                            </td>
                                            <td> {{ $p->unidade->nome_fantasia ?? '' }} </td>
                                            <td>
                                                @if ($p->podeEditar())
                                                    <a class="btn btn-primary btn-sm p-1" href="{{ url('pedidos/cadastro', [$p->id]) }}">
                                                        <i class="fas fa-edit"> </i> Ver | Editar
                                                    </a>
                                                @endif

                                                <a href="{{ url('pedidos/detalhes-pedido-print', [$p->id]) }}" rel="noopener" target="_blank" class="btn btn-default btn-sm p-1">
                                                    <i class="fas fa-print"></i> Imprimir
                                                </a>

                                                <form class="alterar-status-pedido p-1" action="{{url('pedidos/alterarStatus',[$p->id])}}" method="post">
                                                    @csrf
                                                    @if ($p->podeMudarStatus())
                                                        <input type="hidden" name="novo_status" value="{{$p->novoStatus()}}">
                                                        <input type="button" value="Mudar para {{$p->novoNomeStatus()}}" class="btn btn-sm btn-{{$p->novaClasseStatus()}}" onclick="confirmarAlteracao(this);">
                                                    @endif
                                                </form>

                                                <form class="excluir-pedido p-1" action="{{url('pedidos/excluir',[$p->id])}}" method="post">
                                                    @csrf
                                                    @if($p->podeExcluir())
                                                        <input type="button" value="Excluir" class="btn btn-danger btn-sm" onclick="confirmarExclusao(this);">
                                                    @endif
                                                </form>

                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Não foram encontrados Produtos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

    <script>
        function confirmarExclusao(button) {
            if (confirm('Tem certeza de que deseja excluir?')) {
                $(button).closest('form.excluir-pedido').submit();
            }
        }

        function confirmarAlteracao(button) {
            if (confirm('Tem certeza de que deseja alterar o Status do Pedido?')) {
                $(button).closest('form.alterar-status-pedido').submit();
            }
        }

        $(function() {
            var table = new DataTable('#tabela_itens_produto', {
                "order": [0, 'desc'],
                language: {
                    url: "{{ asset('plugins/datatables/datatable-pt-BR.json') }}"
                },
            });
        });

        function verificarPagamento($id) {

            url_atualiza = "{{ url('pedidos/pagseguro/consulta/') }}" + '/' + $id;

            $.ajax({
                url: url_atualiza,
                method: "GET",
                data: {
                    id: $id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        swal(data.msg, {
                            icon: "success",
                            
                        }).then((ok) => {
                            location.reload();
                        });
                    } else {
                        swal(data.msg, {
                            icon: "error",
                        })
                    }
                },
                complete: function() {
                    swal.close();
                },
                beforeSend: function() {
                    swal('Processando...', {
                        icon: "info",
                        buttons: false
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr.responseText);
                    swal("Falha ao consultar o Status no PagSeguro, Tente novamente", {
                        icon: "error",
                    });
                }

            });
        }
    </script>
@endsection
