

<option selected disabled>Выбрать номера акта</option>
<option
        value="<?= $act['id']?>"


        id="<?= $act['id_contract']?>"
    <?php if($act['id'] == $this->model->id_contract) echo ' selected'?>
><?= $act['number']?>

</option>

