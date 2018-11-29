<div class="uk-margin">
    <label class="uk-form-label" for="select_funcionario">Funcionario *</label>
    <div class="uk-form-controls">
        <select class="uk-select" id="select_funcionario" title="Funcionario" autofocus>
        	<option value="">Seleccione...</option>
        	<?php foreach($this->configuracion_model->obtener("funcionarios") as $funcionario){ ?>
                <option value="<?php echo $funcionario->Pk_Id; ?>"><?php echo $funcionario->Nombre; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javascript:cerrar_interfaz()">Cancelar</button>
<input class="uk-button uk-button-primary" type="button" value="Agregar" onClick="javascript:guardar()"/>
