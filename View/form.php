<div class="row">
    <div class="col-sm-7">
        <h2>Форма заказа</h2>
        <form method="post">
            <div class="form-group">
                <label for="firstName">Имя</label>
                <input type="text" id="firstName" name="firstName" value="<?= $order->getFirstName(); ?>"
                       class="form-control" pattern="[a-zA-Z\s]*" required>
            </div>
            <div class="form-group">
                <label for="lastName">Фамилия</label>
                <input type="text" id="lastName" name="lastName" value="<?= $order->getLastName(); ?>"
                       class="form-control" pattern="[a-zA-Z\s]*" required>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lastName">Номер летающей тарелки</label>
                        <input type="text" id="id" name="id" value="<?= $order->getId(); ?>"
                               class="form-control" pattern="[A-Za-z]{1}[0-9]{5}[A-Za-z]{2}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lastName">Телекоммуникационный номер</label>
                        <input type="text" id="number" name="number" value="<?= $order->getNumber(); ?>"
                               class="form-control" pattern="[A-Fa-f0-9]{12}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" name="comment" class="form-control"
                              rows="4"><?= $order->getComment(); ?></textarea>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date">Дата</label>
                        <input type="date" class="form-control" name="date" id="date"
                               value="<?= $order->getDate(); ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-primary pull-right">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-5">
        <br><br><br>
        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $property => $message) {
                    echo $message . '<br>';
                } ?>
            </div>
        <?php } ?>
    </div>
</div>