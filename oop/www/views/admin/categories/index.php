<h1>Administrer les categories</h1>

<p>
    <a href="/admin/category/create" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
       <tr>
           <td>ID</td>
           <td>Titre</td>
           <td>Actions</td>
       </tr>
    </thead>
    <tbody>
       <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category->id ?></td>
                <td><?= $category->title ?></td>
                <td>
                    <a href="/admin/category/<?= $category->id ?>/edit" class="btn btn-primary">Editer</a>

                    <form action="/admin/category/delete/<?= $category->id ?>" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $category->id ?>">
                        <button type="submit" class="btn btn-danger" href="/admin/category/delete/<?= $category->id ?>">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
       <?php endforeach; ?>
    </tbody>
</table>


