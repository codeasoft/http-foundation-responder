<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $parameters = $ecsConfig->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $parameters->set(Option::SKIP, [
        PhpCsFixer\Fixer\Basic\BracesFixer::class => null,
        PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer::class => null,
        PhpCsFixer\Fixer\ControlStructure\SwitchCaseSemicolonToColonFixer::class => null,
        PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer::class => null,
    ]);

    $ecsConfig->import(SetList::COMMON);
    $ecsConfig->import(SetList::CLEAN_CODE);
    $ecsConfig->import(SetList::PSR_12);
};

