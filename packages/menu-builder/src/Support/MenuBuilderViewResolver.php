<?php

namespace LaravelMcpDemo\MenuBuilder\Support;

use Closure;
use Illuminate\Support\Facades\View;

class MenuBuilderViewResolver
{
    public function canRender(string $view): bool
    {
        $view = trim($view);

        return $view !== '' && View::exists($view);
    }

    public function defaultView(): string
    {
        return 'pages.dynamic';
    }

    public function validationRule(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail): void {
            if (! is_string($value) || ! $this->canRender($value)) {
                $fail('Die Blade View muss existieren.');
            }
        };
    }
}
