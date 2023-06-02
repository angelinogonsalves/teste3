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
                                                @if ($p->status == 0)
                                                    <span class="badge badge-white">Cancelado</span>
                                                @elseif ($p->status == 1)
                                                    <span class="badge badge-danger">Aguardando Pagamento</span>
                                                @elseif ($p->status == 2)
                                                    <span class="badge badge-warning">Processando Pagamento</span>
                                                @elseif ($p->status == 3)
                                                    <span class="badge badge-success">Pagamento Aprovado</span>
                                                @elseif ($p->status == 4)
                                                    <span class="badge badge-dark">Em Produção</span>
                                                @elseif ($p->status == 5)
                                                    <span class="badge badge-info">Pedido Finalizado</span>
                                                @elseif ($p->status == 6)
                                                    <span class="badge badge-primary">Pedido Entregue</span>
                                                @endif
                                            </td>
                                            <td> {{ $p->unidade->nome_fantasia }} </td>
                                            <td>
                                                <form action="{{ url('pedidos/mudar-status', [$p->id]) }}" method="post">
                                                    @csrf
                                                    @if ($p->podeEditar())
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ url('pedidos/cadastro', [$p->id]) }}"><i
                                                            class="fas fa-edit"> </i> Ver | Editar</a>
                                                    @endif

                                                    <a href="{{ url('pedidos/detalhes-pedido-print', [$p->id]) }}"
                                                        rel="noopener" target="_blank" class="btn btn-default btn-sm"><i
                                                            class="fas fa-print"></i> Imprimir</a>

                                                    <!-- <button id="btn-pagamento-pagseguro type=" button
                                                        onclick="verificarPagamento('{{ $p->id }}')"
                                                        class="btn btn-success btn-sm"><i
                                                            class="fas fa-sync"> </i> Atualizar
                                                        Status </button> -->

                                                    {{-- <input type="submit" value="Excluir" class="btn btn-danger btn-sm"> --}}
                                                    {{-- <input type="submit" value="Mudar Status" class="btn btn-info btn-sm"> --}}

                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Não foram encontrados Produtos</td>
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
