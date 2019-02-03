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
   */

  require_once('/etc/emtea/config.php');
  require_once('inc/language.php');

  define('CR',"\n");

  //=== LOGIN QUERY ===
  if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Emtea"');
    header('HTTP/1.0 401 Unauthorized');
    print(tr('auth_error_login'));
    exit();
  }

  //=== CONNECT TO DATABASE ===
  $db = mysqli_connect($CONFIG['dbHost'],$CONFIG['dbUser'],$CONFIG['dbPasswd'],$CONFIG['dbName']);
  if (!$db) {
    echo("Failed to connect to database: " . $db->connect_error);
    exit();
  }

  //=== LOGIN CHECK ===
  $rc = $db->query(sprintf(
    "SELECT id, domadmin FROM mailbox WHERE id='%s' AND password=ENCRYPT('%s',password) AND (admin=1 OR domadmin=1)",
    $db->real_escape_string($_SERVER['PHP_AUTH_USER']),
    $db->real_escape_string($_SERVER['PHP_AUTH_PW'])
  ));

  if($rc->num_rows != 1) {
    header('WWW-Authenticate: Basic realm="Emtea"');
    header('HTTP/1.0 401 Unauthorized');
    print(tr('auth_error_unknown'));
    exit();
  }

  $data = $rc->fetch_array();
  $domadmin = $data['domadmin']==1;

  function isDomAdmin() {
    global $domadmin;
    return $domadmin;
  }

  function getUser() {
    return $_SERVER['PHP_AUTH_USER'];
  }

  //=== INITIALIZE SMARTY ===
  require_once('Smarty/Smarty.class.php');
  $smarty = new Smarty();
  $smarty->assign( 'tr', $lang );
  $smarty->assign( 'domadmin', $domadmin );
  $smarty->assign( 'user', $_SERVER['PHP_AUTH_USER'] );

  //=== HEADER ===
  header("Content-Type: text/html;charset=utf-8");
?>
