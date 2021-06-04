<?php 
	$a = new Aluno();

	if(isset($_POST['buscar'])){
		$busca = $_POST['buscar'];

		$resultados = $a->consultarAlunoPlanoPorNome($busca);
	}
	else{
		$resultados = $a->consultarAlunoPlanoAll();
	}
?>

<div class="container py-3">
  <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <br><br>
    <h1 class="display-5 fw-normal">Consulta de planos</h1>
    <p class="fs-4 text-muted">Buscar ou alterar planos comprados válidos pelo nome</p>
  </div>
<body>
	<div class="container topo">
		<div class="form-group">
			<div class="input-group">
			<form action="http://localhost/guararapesnatacao/admin/consultaplanocomprado" class="w-100 me-3" method="post">
				<input type="search" name="buscar" id="buscar" placeholder="Digite o nome" class="form-control" />
			</form>
			</div>
		</div>
		<div>
			<div id="resultado">
			<table class="table table-bordered border-primary table-sm">
            <tr >	
				<th scope="col">Nome</th>
				<th scope="col">E-mail</th>
				<th scope="col">Data de compra</th> 
				<th scope="col">Plano atual</th> 
				<th scope="col">Turno</th>
                <th scope="col">Valor</th> 
				<th scope="col">Status</th> 
                <th scope="col"> </th> 
				</tr>	
			<?php 
			foreach ($resultados as $dado){ ?>
				<tr>
				<td ><?php echo $dado["nome_aluno"];?></td>
				<td ><?php echo $dado["email_aluno"];?></td>
				<td ><?php $data = new DateTime($dado["criacao_pc"]); echo $data->format('d/m/Y H:i:s');?></td>
				<td ><?php echo $dado["nome_plano"];?></td>
				<td ><?php echo $dado["turno_pc"];?></td>
                <td ><?php echo 'R$'.number_format((float)$dado["valor_pc"], 2, ',', '');?></td>
				<td ><?php echo $dado["status_pc"];?></td>
                <th scope="col">
					<a href="http://localhost/guararapesnatacao/admin/alterarplanocomprado/<?php echo $dado["id_pc"];?>" data-toggle="modal" data-target="#exampleModal<?php echo $dado["id_pc"];?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
							<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
						</svg>
					</a>

					<div class="modal fade" id="exampleModal<?php echo $dado["id_pc"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $dado["id_pc"];?>" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel<?php echo $dado["id_pc"];?>">Altere o plano:</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="file-loading">
								<form action="http://localhost/guararapesnatacao/admin/alterarplanocomprado/<?php echo $dado["id_pc"];?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
							<div class="row">
								<div class="col-md-4 order-md-1">
								<label for="valortotal">Valor total: </label>
								<input type="number" class="form-control" id="valortotal" value="<?php echo $dado["valor_pc"];?>" name="valortotal" required>
									<div class="invalid-feedback">
										O preenchimento do campo "Valor total" é obrigatório
									</div>
								</div>

								<div class="col-md-4 order-md-1">
								<label for="valormensal">Turno: </label>
								<?php 
									if($dado["turno_pc"] == "Manhã"){
										$html = "<option value='Manhã' selected>Manhã</option>
										<option value='Tarde'>Tarde</option>
										<option value='Noite'>Noite</option>";
									}
									else if($dado["turno_pc"] == "Tarde"){
										$html = "<option value='Manhã'>Manhã</option>
										<option value='Tarde' selected>Tarde</option>
										<option value='Noite'>Noite</option>";
									}
									else if($dado["turno_pc"] == "Noite"){
										$html = "<option value='Manhã'>Manhã</option>
										<option value='Tarde'>Tarde</option>
										<option value='Noite' selected>Noite</option>";
									}
								?>
								<select class="custom-select d-block w-100" id="turno" name="turno" required>
									<?php echo $html;?>
								</select>
								</div>	

								<input type="hidden" name='id_alt' value="<?php echo $dado["id_pc"];?>"> 
								<br>
								</div>
								</div>

								<div class="row">
									<div class="col-md-8 order-md-1">
									<br>
										<input type="checkbox" name="Cancelar" value="Cancelar" onclick="return confirm('Atenção! Caso siga com o cancelamento, o aluno perderá o direito ao uso mesmo possuindo um período pago.')"> Você deseja cancelar o plano?
									</div>
								</div>		

								</div>
										<div class="modal-footer">
									<button class="btn btn-primary" type="submit">Alterar</button>
										</div>
										</div>
									</div>
									</form>
									</div>
									</div>

				</th>
				</tr>
			<?php } ?>
			</table>
			</div>
		</div>
	</div>
</body>

<script src="http://localhost/guararapesnatacao/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="http://localhost/guararapesnatacao/js/bootstrap.min.js"></script>