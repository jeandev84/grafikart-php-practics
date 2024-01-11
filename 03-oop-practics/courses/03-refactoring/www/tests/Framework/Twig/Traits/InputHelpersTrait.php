<?php
declare(strict_types=1);

namespace Tests\Framework\Twig\Traits;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @InputHelpersTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Twig\Traits
 */
trait InputHelpersTrait
{

    protected function input(string $key, string $label, ?string $value, array $options = []): string
    {
        $class = !empty($options['class']) ?  ' '. $options['class'] : '';
        return <<<HTML
             <div class="form-group">
                <label for="name">$label</label>
                <input type="text" class="form-control$class" name="$key" id="$key" value="$value">
            </div>
HTML;
    }



    protected function inputError(string $key, string $label, ?string $value): string
    {
        return <<<HTML
             <div class="form-group has-danger">
                <label for="name">$label</label>
                <input type="text" class="form-control is-invalid" name="$key" id="$key" value="$value">
                <small class="form-text text-muted">erreur</small>
            </div>
HTML;
    }



    protected function textarea(string $key, string $label, ?string $value): string
    {
        return <<<HTML
             <div class="form-group">
                <label for="name">$label</label>
                <textarea class="form-control" name="$key" id="$key">{$value}</textarea>
            </div>
HTML;
    }




    protected function textareaError(string $key, string $label, ?string $value): string
    {
        return <<<HTML
             <div class="form-group has-danger">
                <label for="name">$label</label>
                <textarea class="form-control form-control-danger" name="$key" id="$key">{$value}</textarea>
                <small class="form-text text-muted">erreur</small>
            </div>
HTML;
    }



    protected function select(): string
    {
        return <<<HTML
             <div class="form-group">
                <label for="name">Titre</label>
                <select class="form-control" name="name" id="name">
                  <option value="1">Demo</option>
                  <option value="2" selected>Demo2</option>
                </select>
            </div>
HTML;
    }
}