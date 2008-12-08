<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * Edit password only.
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
   * $Id: mailbox.php,v 1.7 2004/03/09 23:15:04 shred Exp $
   */
  
  require_once('_base.php');

  $errorMsg = '';
  
  //=== PROCESS ALL CHANGES ===
  if(trim($_REQUEST['pwd1'])!='' || trim($_REQUEST['pwd2'])!='') {
    $rc = mysql_query(sprintf(
      "SELECT id FROM mailbox WHERE id='%s' AND password=ENCRYPT('%s',password)",
      addslashes($data['id']),
      addslashes($_REQUEST['pwdold'])
    ));
    if(mysql_num_rows($rc)!=1) {
      $errorMsg = tr('pwd_oldbad');
    } else {
      if(trim($_REQUEST['pwd1'])==trim($_REQUEST['pwd2'])) {
        mysql_query(sprintf(
          "UPDATE mailbox SET password=ENCRYPT('%s') WHERE id='%s'",
          addslashes(trim($_REQUEST['pwd1'])),
          addslashes($data['id'])
        ));

        $smarty->assign( 'title', tr('pwd_title') );
        $smarty->display('passwordchanged.tpl');
        exit();
      }else {
        $errorMsg = tr('mb_pwdmismatch');
      }
    }
  }

  //=== PROCESS TEMPLATE ===
  $smarty->assign( 'errorMsg'   , $errorMsg );
  $smarty->assign( 'title'      , tr('pwd_title') );
  
  $smarty->display('password.tpl');
?>
