<h2>Criação de uma nova tarefa</h2>

<form action="<?php echo site_url('Clientrest/validate_new_task'); ?>"
      class="form-horizontal" method="post" accept-charset="utf-8">

    <div class="row">
        <div class="col-lg-12">
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="inputName" class="col-lg-3 control-label">Nome</label>
                <div class="col-lg-9">
                    <input type="text" name="inputName" value="" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group row">
                <label for="inputData" class="col-lg-3 control-label">Data</label>
                <div class="col-lg-9">
                    <input type="text" name="inputData" value="" class="form-control">
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="form-group row">
                <label for="inputUser" class="col-lg-3 control-label">Utilizador</label>
                <div class="col-lg-9">
                    <input type="text" name="inputUser" value="" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group row">
                <label for="inputComments" class="col-lg-3 control-label">Descrição</label>
                <div class="col-lg-9">
                    <textarea name="inputComments" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">
                <br>
                <button type="submit" class="btn btn-primary">Criar Tarefa</button>
            </p>
        </div>
    </div>
    
</form>
