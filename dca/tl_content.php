<?php

/**
 * Copyright (C) 2021 Rhyme Digital, LLC.
 *
 * @link		https://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

\Contao\Controller::loadDataContainer('tl_module');
\Contao\Controller::loadLanguageFile('tl_module');

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['iso_product'] = str_replace(
    ['{title_legend},name,headline,type', '{config_legend},', ',customTpl'],
    ['{type_legend},type,headline', '{config_legend},iso_product,', ',iso_moduleTpl'],
    $GLOBALS['TL_DCA']['tl_module']['palettes']['iso_productreader']
);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_product'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_product'],
    'exclude'                 => true,
    'filter'                  => true,
    'inputType'               => 'select',
    'options_callback'     	  => array('Isotope\Backend\ContentElement\ProductCallbacks', 'run'),
    'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "int(10) NOT NULL default '0'"
);


$GLOBALS['TL_DCA']['tl_content']['fields']['iso_moduleTpl'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_moduleTpl'],
    'exclude'                 => true,
    'filter'                  => true,
    'default'                 => 'mod_iso_productreader',
    'inputType'               => 'select',
    'options_callback'        => function(\DataContainer $dc) {
        return \Isotope\Backend::getTemplates('mod_iso_');
    },
    'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iso_readerTpl']         = $GLOBALS['TL_DCA']['tl_module']['fields']['iso_reader_layout'];
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_gallery']           = $GLOBALS['TL_DCA']['tl_module']['fields']['iso_gallery'];
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_use_quantity']      = $GLOBALS['TL_DCA']['tl_module']['fields']['iso_use_quantity'];
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_buttons']           = $GLOBALS['TL_DCA']['tl_module']['fields']['iso_buttons'];
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_addProductJumpTo']  = $GLOBALS['TL_DCA']['tl_module']['fields']['iso_addProductJumpTo'];
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_wishlistJumpTo']    = $GLOBALS['TL_DCA']['tl_module']['fields']['iso_wishlistJumpTo'];