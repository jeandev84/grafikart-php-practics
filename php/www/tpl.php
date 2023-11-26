<table class="table table-striped">
    <thead>
    <tr>
        <th><?= \App\Helper\TableHelper::sort('id', 'ID', $queryParams) ?></th>
        <th><?= \App\Helper\TableHelper::sort('name', 'Name', $queryParams) ?></th>
        <th><?= \App\Helper\TableHelper::sort('price', 'Price', $queryParams) ?></th>
        <th><?= \App\Helper\TableHelper::sort('city', 'City', $queryParams) ?></th>
        <th><?= \App\Helper\TableHelper::sort('address', 'Address', $queryParams) ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td>#<?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= \App\Helper\NumberHelper::price($product['price']) ?></td>
            <td><?= $product['city'] ?></td>
            <td><?= $product['address'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<!--/ end table section -->

<!-- Pagination section -->
<?php if ($totalOfPages > 1 && $page > 1): ?>
    <a href="?<?= \App\Helper\URLHelper::withParam($queryParams, 'page', $page - 1) ?>" class="btn btn-primary">Previous page</a>
<?php endif; ?>

<?php if ($totalOfPages > 1 && $page < $totalOfPages): ?>
    <a href="?<?= \App\Helper\URLHelper::withParam($queryParams, 'page', $page + 1) ?>" class="btn btn-primary">Next page</a>
<?php endif; ?>
<!--/ Pagination section -->