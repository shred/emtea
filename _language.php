<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" K�rber
   *
   * Loads the required language catalog.
   *
   * WARNING: This script is included even if the user has not been
   *   authenticated yet.
   *
   *-----------------------------------------------------------------------
   * This software is free software; you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation; either version 2 of the License, or
   * (at your option) any later version.
   *
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * You should have received a copy of the GNU General Public License
   * along with this program; if not, write to the Free Software
   * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
   *
   * $Id: _language.php,v 1.1 2004/03/09 23:15:04 shred Exp $
   */
   
  $lang = array();

  /*
   * Find out the user's language and include a matching i18n file.
   */
  if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $ay1 = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $catfile = './i18n/catalog.php';
    foreach($ay1 as $llang) {
      preg_match("#^(.*?)([-_].*?)?(\;q\=(.*))?$#i", $llang, $ay2);
      $lcode = strtolower(trim($ay2[1]));
      if(preg_match('#\.|\\|\/#', $lcode))    // THIS is very important to avoid hack attacks
        continue;                             // by giving an exploit path name through the language.
      if(file_exists('./i18n/catalog_'.$lcode.'.php')) {
        $catfile = './i18n/catalog_'.$lcode.'.php';
        break;
      }
    }
    include($catfile);
  }
  
  /**
   * Return the translated key.
   *
   * @param   string    $key      Key to be translated
   * @return  string    Translated key
   */
  function tr( $key )  {
    global $lang;
    if( isset($lang[$key]) )
      return $lang[$key];
    else
      return "[[$key]]";
  }
   
?>