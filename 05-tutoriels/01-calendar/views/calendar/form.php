<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Titre</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $param->escape('name') ?>">
            <?php if($validator->hasError('name')):?>
                <p class="form-text text-muted">
                    <?= $validator->getError('name') ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" value="<?= $param->escape('date') ?>">
            <?php if($validator->hasError('date')):?>
                <p class="form-text text-muted">
                    <?= $validator->getError('date') ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="start">Demarrage</label>
            <input type="time" class="form-control" name="start" id="start" placeholder="HH::MM" value="<?= $param->escape('start') ?>">
            <?php if($validator->hasError('start')):?>
                <p class="form-text text-muted">
                    <?= $validator->getError('start') ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="end">Fin</label>
            <input type="time" class="form-control" name="end" id="end" placeholder="HH::MM" value="<?= $param->escape('end') ?>">
            <?php if($validator->hasError('end')):?>
                <p class="form-text text-muted">
                    <?= $validator->getError('end') ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control"><?= $param->escape('description') ?></textarea>
</div>