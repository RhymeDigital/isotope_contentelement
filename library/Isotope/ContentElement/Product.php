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

namespace Isotope\ContentElement;

use Isotope\ContentElement\ContentElement as IsoContentElement;
use Isotope\Model\Product as ProductModel;
use Isotope\Module\ProductReader as ProductReaderModule;

/**
 * Class Product
 * Product content element
 */
class Product extends IsoContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_iso_product';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		if (!$this->iso_product) {
			return;
		}
		
		$objProduct = ProductModel::findByPk($this->iso_product);
		if ($objProduct === null) {
			return;
		}
		
		$objModel = $this->objModel->cloneOriginal();
		$objModel->type = 'iso_productreader';
		
		// Store the previous GET value
		$strKey = 'product';
        if ($GLOBALS['TL_CONFIG']['useAutoItem'] && in_array($strKey, $GLOBALS['TL_AUTO_ITEM'])) {
            $strKey = 'auto_item';
        }
        $varTempProduct = \Input::get($strKey);
        $varTempProduct = \Input::setGet($strKey, $objProduct->alias);
		
		// Generate the module
		$objModule 						= new ProductReaderModule($objModel);
		$objModule->iso_reader_layout 	= $this->iso_readerTpl;
		$objModule->customTpl 			= $this->iso_moduleTpl;
		
		$this->Template->content 		= $objModule->generate();
		$this->Template->content 		= static::replaceSectionsOfString($this->Template->content, '<p class="back"', '</p>'); // Remove the back button
        $this->Template->referer        = '';
        $this->Template->back           = '';
		
		// Put the GET value back
        $varTempProduct = \Input::setGet($strKey, $varTempProduct);
	}

	
	/**
	 * Remove sections of a string using a start and end (use "[caption" and "]" to remove any caption blocks)
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return string
	 */
	public static function replaceSectionsOfString($strSubject, $strStart, $strEnd, $strReplace='', $blnCaseSensitive=true, $blnRecursive=true)
	{
		// First index of start string
		$varStart = $blnCaseSensitive ? strpos($strSubject, $strStart) : stripos($strSubject, $strStart);
		
		if ($varStart === false)
			return $strSubject;
		
		// First index of end string
		$varEnd = $blnCaseSensitive ? strpos($strSubject, $strEnd, $varStart+1) : stripos($strSubject, $strEnd, $varStart+1);
		
		// The string including the start string, end string, and everything in between
		$strFound = $varEnd === false ? substr($strSubject, $varStart) : substr($strSubject, $varStart, ($varEnd + strlen($strEnd) - $varStart));
		
		// The string after the replacement has been made
		$strResult = $blnCaseSensitive ? str_replace($strFound, $strReplace, $strSubject) : str_ireplace($strFound, $strReplace, $strSubject);
		
		// Check for another occurence of the start string
		$varStart = $blnCaseSensitive ? strpos($strSubject, $strStart) : stripos($strSubject, $strStart);
		
		// If this is recursive and there's another occurence of the start string, keep going
		if ($blnRecursive && $varStart !== false)
		{
			$strResult = static::replaceSectionsofString($strResult, $strStart, $strEnd, $strReplace, $blnCaseSensitive, $blnRecursive);
		}
		
		return $strResult;
	}
}