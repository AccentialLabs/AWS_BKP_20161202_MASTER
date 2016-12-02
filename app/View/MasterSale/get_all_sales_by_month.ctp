
						<?php
						if(!empty($minhasVendas)){
						foreach ($minhasVendas as $venda) { ?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_state_id']) {
		case 1:
			echo "AUTORIZADO";
			break;
		case 2:
			echo "INICIADO";
			break;
		case 3:
			echo "BOLETO IMPRESSO";
			break;
		 case 4:
			echo "CONCLUIDO";
			break;
		 case 5:
			echo "CANCELADO";
			break;
		 case 6:
			echo "EM ANALISE";
			break;
		 case 7:
			echo "ESTORNADO";
			break;
		 case 8:
			echo "EM REVISAO";
			break;
		 case 9:
			echo "REEMBOLSADO";
			break;
		 case 14:
			echo "INICIO DA TRANSACAO";
			break;
	}
								?>

							</td>
						</tr>
						<?php }}?>
						<input type="hidden" id="totalValueMensal" value="<?php echo $valorTotalMensal;?>" />
