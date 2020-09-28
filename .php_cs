<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath('bootstrap/*')
    ->notPath('storage/*')
    ->notPath('vendor')
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/tests',
        __DIR__ . '/database',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,

        'blank_line_after_opening_tag' => true,

        'trailing_comma_in_multiline_array' => true,

        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'no_unused_imports' => true,

        'unary_operator_spaces' => true,
        'binary_operator_spaces' => [ 'default' => 'align' ],
        'cast_spaces' => true,
        'not_operator_with_successor_space' => true,

        'declare_strict_types' => true,
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
        ],

        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_without_name' => true,

        'class_attributes_separation' => [
            'elements' => ['method', 'property'],
        ],
        'visibility_required' => ['property', 'method'],

        'void_return' => true,
        'protected_to_private' => true,

        'explicit_string_variable' => true,

        'whitespace_after_comma_in_array' => true,

        'single_quote' => true,

        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => true,
        ],
        'single_trait_insert_per_statement' => true,
    ])
    ->setLineEnding("\r\n")
    ->setFinder($finder);
