<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

	function mopics_file_exists($file_base, $file_types = DYNAMIC_MOPICS_THUMB_IMAGE_TYPES) {
		$file_types = str_replace(' ', '', $file_types);
		$file_types = preg_split('/[,]/', $file_types);
		
		foreach ($file_types as $file_type) {
			if (file_exists($file_base . '.' . $file_type)) {
				return $file_type;
			}
		}
		
		return false;
	}

	function mopics_match_pattern($pattern) {
		if (preg_match('/{.*}/U', $pattern, $matches)) {
			return $matches[0];
		}

		return false;
	}

	function mopics_getmethod($pattern) {
		return str_replace(array('{', '}'), '', mopics_match_pattern($pattern));
	}
	
	function mopics_get_imagebase($image, $pre_append = '') {
		return $pre_append . substr($image, 0, strrpos($image, '.') );
	}
?>