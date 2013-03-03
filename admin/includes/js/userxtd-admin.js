/*!
 * Windwalker JS
 *
 * Copyright 2013 Asikart.com
 * License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 *
 * Generator: AKHelper
 * Author: Asika
 */


var Userxtd = (function(){
	return {
		
	}
})();

window.addEvent('domready', function(){
	var w 	= $$('#j-main-container')[0].getWidth() ;
	var tr 	= $$('table.adminlist tbody tr')[0] ;
	var d 	= $$('table.adminlist thead th.user-data') ;
	var n 	= tr.getElements('.field-value-wrap').length ;
	
	var data_w = 0 ;
	
	d.each(function(e){
		data_w += e.getWidth();
	}) ;
	
	$$('.field-value-wrap').setStyle('width', (w - data_w - 200) / n ) ;
});

