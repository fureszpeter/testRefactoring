<?php

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::NONE_LEVEL)
    ->fixers([
        // PSR2
        'psr0',
        'encoding',
        'short_tag',
        'braces',
        'elseif',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'indentation',
        'line_after_namespace',
        'linefeed',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiple_use',
        'parenthesis',
        'php_closing_tag',
        'trailing_spaces',
        'visibility',

        // Additions
        'concat_with_spaces',
        'duplicate_semicolon',
        'extra_empty_lines',
        'include',
        'join_function',
        'list_commas',
        'multiline_array_trailing_comma',
        'multiline_spaces_before_semicolon',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_blank_lines_before_namespace',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'ordered_use',
        'phpdoc_indent',
        'phpdoc_order',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'short_array_syntax',
        'single_array_no_trailing_comma',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'strict',
        'unalign_double_arrow',
        'unalign_equals',
        'unused_use',
        'whitespacy_lines',
    ]);