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
                    <a href="/admin/post/<?= $post->id ?>/edit" class="btn btn-primary">Editer</a>
                </td>
            </tr>
       <?php endforeach; ?>
    </tbody>
</table>


