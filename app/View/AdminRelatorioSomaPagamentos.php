<main role="main" class="container" >
<body>

<?php 
    $relatorio = new Relatorio();
    
    if(isset($_POST['periodo'])){
      if($_POST['periodo'] == "Dia"){
        $dadosplano = $relatorio->somaPagamentosDia();
      }
      else if($_POST['periodo'] == "Ano"){
        $dadosplano = $relatorio->somaPagamentosAno();
      }
      else if($_POST['periodo'] == "Mes"){
        $dadosplano = $relatorio->somaPagamentosMes();
      }
    }
    else{
      $dadosplano = $relatorio->somaPagamentosDia();
    }
?>

<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <br><br>
    <h1 class="display-5 fw-normal">Relatório</h1>
    <p class="fs-4 text-muted">Valores totais dos pagamentos recebidos por período e por forma de pagamento</p>
</div>

<form action="http://localhost/guararapesnatacao/admin/somapagamentos" class="w-100 me-3" method="post">
    <div class="row">		
      <div class="col-md-2 mb-3">
        <select class="custom-select d-block w-100" id="periodo" name="periodo" required>
          <option value='Dia'>Dia</option>
          <option value='Mes'>Mês</option>
          <option value='Ano'>Ano</option>
        </select>
      </div>
      <div class="col-md-1 order-md-1">
          <button class="btn btn-primary btn btn-block" type="submit">Filtrar</button>
      </div>
    </div>
  </form>  
     <table class="table table-bordered border-primary table-sm">
        <tr >	
          <th scope="col">Data de pagamento</th>
          <th scope="col">Forma de pagamento</th>
          <th scope="col">Valor total</th>		  
        </tr>	
      <?php 
      foreach ($dadosplano as $dado){ ?>
        <tr>
          <td ><?php echo $dado["data_pagamento"];?></td>  
          <td ><?php echo $dado["forma_pagamento"];?></td>
          <td ><?php echo 'R$'.number_format((float)$dado["valor_total"], 2, ',', '');?></td>
        </tr>
      <?php } ?>
    </table>
        

</body>
</main>
  <script src="http://localhost/guararapesnatacao/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="http://localhost/guararapesnatacao/js/jquery-slim.min.js"><\/script>')</script>
    <script src="http://localhost/guararapesnatacao/js/popper.min.js"></script>
    <script src="http://localhost/guararapesnatacao/js/bootstrap.min.js"></script>
    <script src="http://localhost/guararapesnatacao/js/holder.min.js"></script>
    <script>