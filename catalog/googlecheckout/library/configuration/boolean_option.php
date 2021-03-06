<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  Copyright (C) 2009 Google Inc.

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require_once(DIR_FS_CATALOG . '/googlecheckout/library/configuration/google_configuration.php');

/**
 * Google Checkout v1.5.0
 * 
 * Class for an on/off option.
 * 
 * @author Ed Davisson (ed.davisson@gmail.com)
 */
class GoogleBooleanOption /* implements GoogleOptionInterface */ {
  
  var $type = "boolean";
  
  var $title;
  var $description;  
  var $database_key;
  
  var $google_configuration;
  
  function GoogleBooleanOption($title, $description, $database_key, $default) {
    $this->title = $title;
    $this->description = $description;
    $this->database_key = $database_key;
    
    $this->google_configuration = new GoogleConfiguration();
    $this->google_configuration->setDefault($this->database_key, $default);
  }

  function getOptionType() {
    return $this->type;
  }
  
  function getKey() {
  	return $this->database_key;
  }
  
  function getTitle() {
    return $this->title;
  }
  
  function getDescription() {
    return $this->description;
  }  
  
  function getValue() {
    return $this->google_configuration->getValue($this->database_key);
  }

  function setValue($value) {
    if ($value) {
      $value = "True";
    } else {
      $value = "False";
    }
    $this->google_configuration->setValue($this->database_key, $value);
  }

  function getHtml() {
    $html = '<input type="checkbox" name="' . $this->database_key . '"';
    if ($this->getBooleanValue()) {
      $html .= 'checked="true"';
    }
    $html .= '/>';
    return $html;
  }
  
  /**
   * Get the value stored in the database as a PHP boolean.
   */
  function getBooleanValue() {
  	return ($this->getValue() == "True");
  }

}

?>
