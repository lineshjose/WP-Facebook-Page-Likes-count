<?php
/*
	Name: Facebook Page Like Count as Text for WordPress sites/blogs
	Version : 1.0
	Author: Linesh Jose
	Url: https://linesh.com
	Donate:  http://bit.ly/donate-linesh
	github: https://github.com/lineshjose
	Copyright: Copyright (c) 2013 LineshJose.com
	
	Note: This script is free; you can redistribute it and/or modify  it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.This script is distributed in the hope  that it will be useful,    but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the  GNU General Public License for more details.

-----------------------------------------------------------

	This function to get Facebook Fans count as text
	@param $value : your Facebook page ID
*/

function lj_fb_count($fb_ID='')
{
    $fb_count='';
    if($fb_ID && get_site_transient('lj_fb_count')===false) 
    {
        $url='http://api.facebook.com/method/fql.query?format=json&query=SELECT+fan_count+FROM+page+WHERE+page_id+IN%28'.$fb_ID.'%29';
        $fb_count = json_decode(wp_remote_fopen($url),false); 
        $fb_count=$fb_count[0]->fan_count; 
		//Caching count for Ten hours----------------------------
        set_site_transient('lj_fb_count',$fb_count, 60 * 60* 10 ); 
    }else{
        $fb_count=get_site_transient('lj_fb_count');
    }
    echo $fb_count;
}


/* 
  Usage------------------------------->
*/
lj_fb_count('114877608587606');
?>
