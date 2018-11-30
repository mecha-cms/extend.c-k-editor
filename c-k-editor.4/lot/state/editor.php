<?php

return [
    'customConfig' => false,
    'stylesSet' => false,
    'filebrowserWindowWidth' => 600,
    'filebrowserWindowHeight' => 300,
    'toolbarGroups' => [
        [
            'name' => 'styles',
            'groups' => ['styles']
        ], [
            'name' => 'basicstyles',
            'groups' => ['basicstyles']
        ], [
            'name' => 'paragraph',
            'groups' => ['list', 'blocks', 'horizontalrule']
        ], [
            'name' => 'links',
            'groups' => ['links']
        ], [
            'name' => 'insert',
            'groups' => ['insert']
        ], [
            'name' => 'clipboard',
            'groups' => ['undo']
        ], [
            'name' => 'data',
            'groups' => ['mode']
        ]
	  ],
	  'removeButtons' => 'Outdent,Indent,Anchor,Strike,Underline,Paste,Copy,Cut',
    'format_tags' => 'p;h3;h4;h5;h6;pre',
    'image2_alignClasses' => ['align-left', 'align-center', 'align-right'],
    'image2_captionedClass' => 'image',
    'linkShowAdvancedTab' => false,
    'removeDialogFields' => 'table:info:txtBorder;table:info:cmbAlign;table:info:txtCellSpace;table:info:txtCellPad',
    'disallowedContent' => 'article aside base body footer head header hgroup html iframe link main nav noscript script style title',
    'extraPlugins' => 'confighelper,placeholder,sourcedialog'
];