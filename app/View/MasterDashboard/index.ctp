<br/>
<div>
    <h1 class="page-header letterSize"><span>Dashboard</span></h1>
</div>

<div class="row">

    <div class="col-md-6 squareBox">
        <div class="col-md-12 squareTitle">
            TOTAL
        </div>
        <div class="col-md-3">
            <div class="row heightSquare rightSquare darkBlue">
                <span class="verticalAlign box-dash"><br/>Salões<br/>Ativos</span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare rightSquare darkBlue delivery">
                <?php echo $qtdSaloes[0][0]['total'];?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row heightSquare rightSquare darkBlue">
                <span class="verticalAlign box-dash" style="vertical-align:middle"><br/>Usuários Ativos</br>no dia</span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare rightSquare darkBlue delivery">
                <?php echo $activeusers[0][0]['count(*)']; ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row heightSquare rightSquare darkBlue">
                <span class="verticalAlign box-dash"><br/>Vendas</br>no dia</span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare rightSquare darkBlue delivery currency">
                R$<?php echo str_replace(".", ",", $vendasDoDia[0][0]['total']); ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row heightSquare rightSquare darkBlue">
                <span class="verticalAlign box-dash"><br/>Indicações</br>de salões</span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare rightSquare darkBlue delivery">
                <?php echo $indicationscount[0][0]['count(*)']; ?>
            </div>
        </div>

    </div>

</div>
