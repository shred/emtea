<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * Logout page
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
   */
  
  require_once('_config.php');
  require_once('_language.php');

  define('CR',"\n");

  header('WWW-Authenticate: Basic realm="Emtea"');
  header('HTTP/1.0 401 Unauthorized');
  
  //=== INITIALIZE SMARTY ===
  require_once('Smarty.class.php');
  $smarty = new Smarty();
  $smarty->assign( 'tr', $lang );

  //=== HEADER ===
  header("Content-Type: text/html;charset=utf-8");
  ob_start('ob_gzhandler');
  
  $smarty->display('logout.tpl');
  exit();
?>

