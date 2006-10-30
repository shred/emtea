<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * List all mailboxes and set edit links.
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
   * $Id: toc.php,v 1.8 2004/03/09 23:15:04 shred Exp $
   */
  require_once('_base.php');
  
  //=== PROCESS ALL CHANGES ===
  $ayBoxes = array();
  $rs = mysql_query("SELECT id,name,imapok,admin,procmailok FROM mailbox ORDER BY admin DESC, imapok DESC, id");
  while($ayResult = mysql_fetch_array($rs)) {
    $id = $ayResult['id'];

    if(isset($_REQUEST["new_$id"]) && trim($_REQUEST["new_$id"])!='') {
      //--- Domain already exists? ---
      $rc = mysql_query(sprintf(
        "SELECT DISTINCT domain FROM address WHERE domain='%s'",
        addslashes(trim($_REQUEST["new_$id"]))
      ));
      if(mysql_num_rows($rc)==0) {
        //--- Create new domain ---
        mysql_query(sprintf(
          "INSERT INTO address SET domain='%s', mailboxid='%s'",
          addslashes(trim($_REQUEST["new_$id"])),
          addslashes($id)
        ));
        $smarty->assign(
          'js',
          sprintf(
            'top.index.location.href="domain.php?domain=%s"',
            htmlspecialchars( trim( $_REQUEST["new_$id"] ) )
          )
        );
      }
    }
    
    $rc = mysql_query(sprintf(
      "SELECT DISTINCT domain FROM address WHERE mailboxid='%s' ORDER BY domain",
      addslashes($id)
    ));

    $ayResult['ayDomains'] = array();
    while($ayResult2 = mysql_fetch_array($rc)) {
      $ayResult['ayDomains'][] = $ayResult2['domain'];
    }

    $ayBoxes[] = $ayResult;
  }
  
  //=== COLLECT ALL TEMPLATE DATA ===
  $rs = mysql_query("SELECT DISTINCT domain FROM address WHERE mailboxid IS NULL ORDER BY domain");
  $ayNUDomains = array();
  while($ayResult = mysql_fetch_array($rs)) {
    $ayNUDomains[] = $ayResult['domain'];
  }
  
  //=== PROCESS TEMPLATE ===
  $smarty->assign( 'title'      , tr('toc_title') );
  $smarty->assign( 'ayBoxes'    , $ayBoxes        );
  $smarty->assign( 'ayNUDomains', $ayNUDomains    );
  
  $smarty->display('toc.tpl');
?>
