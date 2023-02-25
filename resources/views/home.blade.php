@extends('layout.app') 

@section('content') 
<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de Pedidos</span>
                <span class="info-box-number">
                  300
                  <small>Pedidos</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pagamentos pedentes</span>
                <span class="info-box-number">100</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pedidos Pagos</span>
                  <span class="info-box-number">200</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Alunos Cadastrados</span>
                  <span class="info-box-number">300
                    <small>Alunos já Cadastrados</small>
                  </span>
                  
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Ultimos Pedidos</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Data Pedido</th>
                  <th>Aluno - R.A.</th>
                  <th>Valor Pedido</th>
                  <th>Unidade</th>                    
                  <th>Ações</th> 
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>
                      1231
                  </td>
                  <td>25/05/1585</td>
                  <td>
                    Alnuo Zé Silva -
                    <small class="text-success mr-3">
                      1234565
                    </small>
                  </td>
                  <td>
                    R$ 255,33
                  </td>
                  <td>
                    Unidade Positivo Junior
                  </td>
                  <td>
                    <a href="#" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    1231
                </td>
                <td>25/05/1585</td>
                <td>
                  Alnuo Zé Silva -
                  <small class="text-success mr-3">
                    1234565
                  </small>
                </td>
                <td>
                  R$ 255,33
                </td>
                <td>
                  Unidade Positivo Junior
                </td>
                <td>
                  <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                  </a>
                </td>
                <tr>
                  <td>
                    1231
                  </td>
                  <td>25/05/1585</td>
                  <td>
                    Alnuo Zé Silva -
                    <small class="text-success mr-3">
                      1234565
                    </small>
                  </td>
                  <td>
                  R$ 255,33
                  </td>
                  <td>
                  Unidade Positivo Junior
                  </td>
                  <td>
                    <a href="#" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
        </div>
@endsection    