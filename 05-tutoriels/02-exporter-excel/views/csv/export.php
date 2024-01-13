"ID";"Title";"Duration (in seconds)"
<?php foreach ($videos as $video): ?>
"<?= $video->getId() ?>";"<?= $video->getTitle() ?>";"<?= $video->getDuration() ?>"
<?php endforeach; ?>
