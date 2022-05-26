<?php

namespace App\twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class UtilExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('getExcerpt', [$this, 'getExcerpt']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('array_check_list', [$this, 'arrayCheckList']),
        ];
    }

    public function getExcerpt(string $text, int $maxLen = 50, string $ellipsis = '...'): string
    {
        $text = ucwords($text);

        if (strlen($text) <= $maxLen) {
            return $text;
        }

        return substr($text, 0, $maxLen - 3).$ellipsis;
    }

    /**
     * Determines if an array is list.
     *
     * An array is "list" if it have sequential numerical keys beginning with zero.
     */
    public function arrayCheckList(array $array): bool
    {
        return array_keys($array) === range(0, count($array) - 1);
    }
}
