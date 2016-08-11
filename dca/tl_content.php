<?php

/**
 * Copyright (C) 2016 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @author		Cassondra Hayden <cassie@rhyme.digital>
 * @author		Melissa Frechette <melissa@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['iso_product'] = str_replace(',module', ',iso_product,iso_gallery,iso_readerTpl,iso_moduleTpl', $GLOBALS['TL_DCA']['tl_content']['palettes']['module']);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['iso_product'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_product'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'select',
	'foreignKey'        	  => \Isotope\Model\Product::getTable().'.name',
    'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
	'sql'                     => "int(10) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iso_gallery'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_content']['iso_gallery'],
    'exclude'                   => true,
    'inputType'                 => 'select',
    'foreignKey'                => \Isotope\Model\Gallery::getTable().'.name',
    'eval'                      => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                       => "int(10) unsigned NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iso_readerTpl'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_readerTpl'],
	'exclude'                 => true,
	'filter'                  => true,
	'default'                 => 'iso_reader_default',
	'inputType'               => 'select',
    'options_callback'        => function(\DataContainer $dc) {
        return \Isotope\Backend::getTemplates('iso_reader_');
    },
    'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''",
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