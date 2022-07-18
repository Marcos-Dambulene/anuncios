<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');


	class Usuarios extends CI_Controller{

			public function __construct(){

				parent::__construct();

				/*
				 * Definiar se ha sessao valida

				 /*


				 /*
				 * Definiar se e adim.

				 */
			}	


			public function index(){

				$data = array(

					'titulo' => 'Usuarios cadastrados',
					'styles' => array(
						'assets/bundles/datatables/datatables.min.css',
						'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
					),
					
					'scripts' => array(
						'assets/bundles/datatables/datatables.min.js',
						'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
						'assets/bundles/jquery-ui/jquery-ui.min.js',
						'assets/js/page/datatables.js',
						

					),

					'usuarios' => $this->ion_auth->users()->result(),
				);





				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/usuarios/index');
				$this->load->view('restrita/layout/footer');


			}


			public function core($usuario_id=null){
				$usuario_id=(int) $usuario_id;

				if (!$usuario_id) {
					/*
					*  Cadastrar o novo usuario
					*/

					exit('usuario novo');
			}else{


				if (!$usuario= $this->ion_auth->user($usuario_id)->row()) {
					exit('usuario nao encontrado');
				}else{

						$this->form_validation->set_rules('first_name','Nome','trim|required');

						if ($this->form_validation->run()) {
							// sucesso ..... formulario foi validadio


							echo '<pre>';
							print_r($this->input->post());
							exit();

						}else{

							//erro de validacao

						$data= array(
						'titulo' => 'Editar Usuarios',
						'scripts' => array(
						'assets/mask/jquery.mask.min.js',
						'assets/mask/jquery.mask.js',
						'assets/mask/custom.js',
						'assets/js/usuarios.js',
												

					),
						'usuario' => $usuario,
						'perfil' => $this->ion_auth->get_users_groups($usuario->id)->row(),
						'grupos' => $this->ion_auth->groups()->result(),

							
					);

						$this->load->view('restrita/layout/header', $data);
						$this->load->view('restrita/usuarios/core');
						$this->load->view('restrita/layout/footer');

						}

					

				}


			}

	}


			public function preenche_endereco(){

				if(!$this->input->is_ajax_request()){
					exit ('Acao nao permitida');
				}

				$this->form_validation->set_rules('user_cep', 'CEP', 'trim|required|exact_length[9]');


					$retorno = array();


					if($this->form_validation->run()){

						//CEP validado

						$cep = str_replace("-", "", $this->input->post('user_cep'));


						$url = "https://viacep.com.br/ws/";
						$url .=$cep;
						$url .="/json/";


						$cr = curl_init();

						curl_setopt($cr, CURLOPT_URL, $url);


						curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);


						$resultado_requisicao = curl_exec($cr);

						curl_close($cr);

						$resultado_requisicao= json_decode($resultado_requisicao);



								


						if(isset($resultado_requisicao->erro)){

							$retorno['erro'] = 3;
							$retorno['user_cep'] = 'Informa um CEP Valido';
							$retorno['mensagem'] = 'Informa um CEP Valido';


						}else{

							$retorno['erro'] = 0;
							$retorno['user_endereco'] = $resultado_requisicao->logradouro;
							$retorno['user_bairro'] = $resultado_requisicao->bairro;
							$retorno['user_cidade'] = $resultado_requisicao->localidade;
							$retorno['user_provincia'] = $resultado_requisicao->uf;
							$retorno['mensagem'] = 'CEP Valido';
						}


				

					}else{


						
						

						$retorno['erro'] = 3;
						$retorno['user_cep'] = validation_errors();
						$retorno['mensagem'] = validation_errors();

						


					}

					/*
					*Reorno os dados no $retorno
					*/

					echo json_encode($retorno);
					
			}




		public  function upload_file() {

		 		$config['upload_path']= './uploads/usuarios/';
                $config['allowed_types']= '|jpg|png|JPG|PNG|jpeg|JPEG';
	            $config['encrypt_name']= true;
                $config['max_size']= 1048;
                $config['max_width']=500;
                $config['max_height']=500;
                $config['min_width']=350;
                $config['min_height']=340;



                $this->load->library('upload', $config);


               if ($this->upload->do_upload('user_foto_file')){



               		$data = array(
               			'erro'=>0,
               			'foto_enviada'=>$this->upload->data(),
               			'user_foto' =>$this->upload->data('file_name'),
               			'mensagem'=> 'Foto foi enviada com sucesso',

               		);


               		$config['image_library']= 'gd2';
               		$config['source_image']= './uploads/usuarios/' . $this->upload->data('file_name');
               		$config['new_image']= './uploads/usuarios/small/' . $this->upload->data('file_name');
               		$config['height']=300;
                	$config['width']=280;


                	$this ->load->library ( 'image_lib', $config );



                	if (!$this->image_lib->resize()) {

                    	$data['erro'] = 3;
                		$data['mensagem'] = $this->image_lib->display_errors('<span class="text-danger">', '</span>');

                		
                	}


               }else{



       		    	$data= array(
               		'erro'=>3,
               		'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
              	);



               	



               }



               echo json_encode($data);
		}

}