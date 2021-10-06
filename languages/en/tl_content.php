<?php

/**
 * Copyright (C) 2021 Rhyme Digital, LLC.
 *
 * @link		https://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

\Contao\Controller::loadLanguageFile('tl_module');

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['iso_product']		= array('Product', 'Please select the product to display.');
$GLOBALS['TL_LANG']['tl_content']['iso_gallery']		= array('Gallery template', 'Please select the gallery template.');
$GLOBALS['TL_LANG']['tl_content']['iso_readerTpl']		= array('Product reader template', 'Please select the product reader template to display.');
$GLOBALS['TL_LANG']['tl_content']['iso_moduleTpl']		= array('Product reader module template', 'Please select the product reader module template to display.');

/**
 * Legend
 */
$GLOBALS['TL_LANG']['tl_content']['redirect_legend']    = $GLOBALS['TL_LANG']['tl_content']['redirect_legend'] ?: $GLOBALS['TL_LANG']['tl_module']['redirect_legend'];
