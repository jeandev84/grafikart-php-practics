<h1>Administrer les articles</h1>

<p>
    <a href="/admin/post/create" class="btn btn-success">Ajouter</a>
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
       <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= $post->id ?></td>
                <td><?= $post->title ?></td>
                <td>
                    <a href="<?= $router->generate('admin.post.edit', ['id' => $post->id]) ?>" class="btn btn-primary">Editer</a>

                    <form action="<?= $router->generate('admin.post.delete', ['id' => $post->id]) ?>" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $post->id ?>">
                        <button type="submit" class="btn btn-danger" href="<?= $router->generate('admin.post.delete', ['id' => $post->id]) ?>">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
       <?php endforeach; ?>
    </tbody>
</table>


