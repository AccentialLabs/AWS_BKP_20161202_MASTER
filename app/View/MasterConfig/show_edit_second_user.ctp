<div class="form-group marginTop10">
    <input type="hidden" class="form-control" id="secundary_user_id" value="<?php echo $user['secondary_masterusers']['id'];?>" >
    <label for="inputEmail3" class="col-sm-2 control-label">Nome *</label>
    <div class="col-sm-6">
        <input name="data[secundary_user][name]" type="text" class="form-control" id="secundary_user_name" placeholder="Nome" value="<?php echo $user['secondary_masterusers']['name'];?>" >
    </div>
</div>
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">E-mail *</label>
    <div class="col-sm-6">
        <input name="data[secundary_user][email]" type="email" class="form-control"  id="secundary_user_email" placeholder="E-mail" value="<?php echo $user['secondary_masterusers']['email'];?>">
    </div>
</div>
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Cargo *</label>
    <div class="col-sm-3">
        <select  class="form-control" name="data[secundary_user][type]" id="secundary_user_type" >
            <option value="<?php echo $user['secondary_masterusers_types']['id'];?>"><?php echo $user['secondary_masterusers_types']['name'];?></option>
                                <?php
                                if (is_array($secondsMasterUsersTypes)) {
                                    foreach ($secondsMasterUsersTypes as $user) {
                                        echo '<option value="' . $user['secondary_masterusers_types']['id'] . '">' . $user['secondary_masterusers_types']['name'] . '</option>';
                                    }
                                }
                                ?>
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button id="userModalButomEdit" type="button" class="btn btn-success" onclick="saveEditSecondary()">Salvar</button>
    </div>
</div>