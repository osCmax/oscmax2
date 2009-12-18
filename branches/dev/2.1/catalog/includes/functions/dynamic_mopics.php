<?php
/*
$Id: dynamic_mopics.php 3 2006-05-27 04:59:07Z user $

  Dynamic MoPics version 3.000, built for osCommerce MS2

  Copyright 2006 osCMax2004-2005 Josh Dechant

  Released under the GNU General Public License
*/

	function mopics_file_exists($file_base, $file_types = DYNAMIC_MOPICS_THUMB_IMAGE_TYPES) {
		$file_types = str_replace(' ', '', $file_types);
		$file_types = explode('[,]', $file_types);
		
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
		return $pre_append . substr($image, ((DYNAMIC_MOPICS_MAINTHUMB_IN_THUMBS_DIR == 'true') ? strlen(DYNAMIC_MOPICS_THUMBS_DIR) : 0), ((DYNAMIC_MOPICS_MAINTHUMB_IN_THUMBS_DIR == 'true') ? (strrpos($image, '.') - strlen(DYNAMIC_MOPICS_THUMBS_DIR)) : strrpos($image, '.')) );
	}
?>