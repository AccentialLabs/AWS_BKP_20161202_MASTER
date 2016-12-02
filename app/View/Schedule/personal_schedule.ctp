<table class="table table-bordered tabelSchedule">    
    <thead>        
        <tr>            

            <?php
            if (isset($schedules)) {
                echo '
                    <th class="topBorderSchedule" title="' . $schedules[0]['secondary_users']['name'] . '">
                        ' . split(" ", $schedules[0]['secondary_users']['name'])[0] . ' 
                        <span title="Adicionar Agendamento" name="' . $schedules[0]['secondary_users']['id'] . '" class="glyphicon glyphicon-plus"></span>
                    </th>';
            } else {
                if (isset($userInformation)) {
                    echo '
                    <th class="topBorderSchedule" title="' . $userInformation[0]['secondary_users']['name'] . '">
                        ' . split(" ", $userInformation[0]['secondary_users']['name'])[0] . ' 
                        <span title="Adicionar Agendamento" name="' . $userInformation[0]['secondary_users']['id'] . '" class="glyphicon glyphicon-plus"></span>
                    </th>';
                }
            }
            ?>
            </th>        
        </tr>    
    </thead>    
    <tbody>        
        <?php
        if (isset($schedules)) {
            foreach ($schedules as $schedule) {
                $classGreen = "";
                if ($schedule['schedules']['status'] == 1) {
                    $classGreen = " greenColor ";
                }
                echo '
                    <tr>            
                        <td>' . substr($schedule['schedules']['time_begin'], 0, 5) . ' - ' . substr($schedule['schedules']['time_end'], 0, 5) . '<br>' .$schedule['schedules']['subclasse_name'] . '<br/>' . explode(" ", $schedule['schedules']['client_name'])[0] . ' 
                            <span title="Remover Agendamento" name="removeSchedule" id="' . $schedule['secondary_users']['id'] . '-' . $schedule['schedules']['id'] . '" class="glyphicon glyphicon-minus"></span> | <span title="Agendamento realizado" name="removeSchedule" id="' . $schedule['secondary_users']['id'] . '-' . $schedule['schedules']['id'] . '" class="glyphicon glyphicon-ok ' . $classGreen . '"></span>
                        </td>        
                    </tr> ';
            }
        }
        ?>
    </tbody>
</table>