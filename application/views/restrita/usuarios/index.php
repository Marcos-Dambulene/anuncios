
    <div class="main-wrapper main-wrapper-1">

        <?php $this->load->view('restrita/layout/navbar') ?>

        <?php $this->load->view('restrita/layout/sidebar') ?>




      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $titulo; ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped data-table">
                        <thead>
                          <tr>
                            <th class="nosort">Imagem</th>
                            <th>Nome Completo</th>
                            <th>Progress</th>
                            <th>Perfil de acesso</th>
                            <th>Ativo</th>
                            <th  class="nosort">Acção</th>
                          </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($usuarios as $usuario): ?>


                          <tr>
                                <td><img alt="image" src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>" width="35"></td>
                            
                                <td><?php echo $usuario->first_name . '' . $usuario->last_name; ?> </td>
                                <td><?php echo $usuario->email ?> </td>

                                <td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Adminsitrador' : 'Anunciante'); ?> </td>

                                <td><?php echo ($usuario->active == 1 ?  '<div class="badge badge-success badge-shadow">Sim</div>' : '<div class="badge badge-success badge-shadow">Não</div>'); ?> ' </td>


                                

                                <td>

                                  <a data-toggle="tooltip" data-placement="top" title="Editar" href="<?php echo base_url('restrita/'. $this->router->fetch_class().'/core/'. $usuario->id); ?>" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                  <a data-toggle="tooltip" data-placement="top" title="Excluir" href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                
                                </td>
                          

                          </tr>
                            <?php endforeach; ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </section>

          <?php $this->load->view('restrita/layout/sidebar_configuracoes') ?>
      
      </div>
