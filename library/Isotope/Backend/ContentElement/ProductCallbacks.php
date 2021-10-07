<?php

/**
 * Copyright (C) 2017 Rhyme Digital, LLC.
 * 
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Isotope\Backend\ContentElement;


class ProductCallbacks extends \Backend
{
	
	/**
	 * Run
	 */
	public function run()
	{
		$arrOptions = array();
		
		$objProducts = \Database::getInstance()->prepare("SELECT * FROM tl_iso_product WHERE pid=0")->execute();
		if ($objProducts->numRows)
		{
			while ($objProducts->next())
			{
				$arrOptions[$objProducts->id] = $objProducts->name . ' (ID ' . $objProducts->id . ')';
			}
		}
		
		return $arrOptions;
	}
}