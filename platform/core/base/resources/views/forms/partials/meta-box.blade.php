<?php
use Illuminate\Support\Arr;

$attributes = Arr::get($metaBox, 'attributes', []);
$title = Arr::get($metaBox, 'title');
$subtitle = Arr::get($metaBox, 'subtitle');
$headerActions = Arr::get($metaBox, 'header_actions');
$hasTable = Arr::get($metaBox, 'has_table', false);
$content = Arr::get($metaBox, 'content');
$footer = Arr::get($metaBox, 'footer');
?>

@if (Arr::get($metaBox, 'before_wrapper'))
    {!! Arr::get($metaBox, 'before_wrapper') !!}
@endif

@if (Arr::get($metaBox, 'wrap', true))
    <div class="card mb-3" <?php foreach ($attributes as $key => $value) {
        echo $key . '="' . e($value) . '" ';
    } ?>>
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom">
            <?php if ($subtitle && $title): ?>
            <div>
                <h5 class="card-title mb-0"><?= e($title) ?></h5>
                <small class="card-subtitle text-muted"><?= e($subtitle) ?></small>
            </div>
            <?php else: ?>
            <h5 class="card-title mb-0"><?= e($title) ?></h5>
            <?php endif; ?>

            <?php if ($headerActions): ?>
            <div class="card-actions">
                <?= $headerActions ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!$hasTable): ?>
        <div class="card-body">
            <?= $content ?>
        </div>
        <?php else: ?>
        <?= $content ?>
        <?php endif; ?>

        <?php if ($footer): ?>
        <div class="card-footer">
            <?= $footer ?>
        </div>
        <?php endif; ?>
    </div>
@else
    {!! Arr::get($metaBox, 'content') !!}
@endif

@if (Arr::get($metaBox, 'after_wrapper'))
    {!! Arr::get($metaBox, 'after_wrapper') !!}
@endif
