<?php

namespace ArifBudimanAr\ZincUi;

use Illuminate\Support\Arr;
use Stringable;

class ClassBuilder implements Stringable
{
    protected $pending = [];

    public function add($classes)
    {
        $this->pending[] = Arr::toCssClasses($classes);

        return $this;
    }

    public function __toString()
    {
        return (string) collect($this->pending)->join(' ');
    }

    public function classes($styles = null)
    {
        $builder = new ClassBuilder;

        return $styles ? $builder->add($styles) : $builder;
    }

    public function applyInset($inset, $top, $right, $bottom, $left)
    {
        if ($inset === null) {
            return '';
        }

        $insets = $inset === true
            ? collect(['top', 'right', 'bottom', 'left'])
            : str($inset)->explode(' ')->map(fn ($i) => trim($i));

        $insetClasses = [
            'top' => $top,
            'right' => $right,
            'bottom' => $bottom,
            'left' => $left,
        ];

        return $insets->map(fn ($i) => $insetClasses[$i])->join(' ');
    }
}
