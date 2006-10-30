<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * Base include file. This file is included first, in every Emtea
   * web page. It checks for proper authorisation, and will abort
   * PHP execution if the user is not authorized.
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
   * $Id: _base.php,v 1.3 2004/03/09 23:15:04 shred Exp $
   */

  require_once('_config.php');
  require_once('_language.php');

  define('CR',"\n");

  //=== LOGIN QUERY ===
  if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Emtea"');
    header('HTTP/1.0 401 Unauthorized');
    print(tr('auth_error_login'));
    exit();
  }

  //=== CONNECT TO DATABASE ===
  mysql_connect($CONFIG['dbHost'],$CONFIG['dbUser'],$CONFIG['dbPasswd']);
  mysql_select_db($CONFIG['dbName']);

  //=== LOGIN CHECK ===
  $rc = mysql_query(sprintf(
    "SELECT id FROM mailbox WHERE id='%s' AND password=ENCRYPT('%s',password) AND admin=1",
    addslashes($_SERVER['PHP_AUTH_USER']),
    addslashes($_SERVER['PHP_AUTH_PW'])
  ));
  if(mysql_num_rows($rc)!=1) {
    header('WWW-Authenticate: Basic realm="Emtea"');
    header('HTTP/1.0 401 Unauthorized');
    print(tr('auth_error_unknown'));
    exit();
  }
  
  //=== INITIALIZE SMARTY ===
  require_once('Smarty.class.php');
  $smarty = new Smarty();
  $smarty->assign( 'tr', $lang );

  //=== HEADER ===
  header("Content-Type: text/html;charset=iso-8859-1");
  ob_start('ob_gzhandler');
?>
