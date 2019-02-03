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
   */
  require_once('_base.php');
  
  //=== PROCESS ALL CHANGES ===
  $ayBoxes = array();
  $rs = $db->query("SELECT id,name,imapok,admin,procmailok,domadmin FROM mailbox ORDER BY admin DESC, imapok DESC, id");
  while($ayResult = $rs->fetch_array()) {
    $id = $ayResult['id'];

    if(isset($_REQUEST["new_$id"]) && trim($_REQUEST["new_$id"])!='') {
      //--- Domain already exists? ---
      $rc = $db->query(sprintf(
        "SELECT DISTINCT domain FROM address WHERE domain='%s'",
        $db->real_escape_string(trim($_REQUEST["new_$id"]))
      ));
      if($rc->num_rows==0) {
        //--- Create new domain ---
        $db->query(sprintf(
          "INSERT INTO address SET domain='%s', mailboxid='%s'",
          $db->real_escape_string(trim($_REQUEST["new_$id"])),
          $db->real_escape_string($id)
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
    
    $rc = $db->query(sprintf(
      "SELECT DISTINCT domain FROM address WHERE mailboxid='%s' ORDER BY domain",
      $db->real_escape_string($id)
    ));

    $ayResult['ayDomains'] = array();
    while($ayResult2 = $rc->fetch_array()) {
      $ayResult['ayDomains'][] = $ayResult2['domain'];
    }

    $ayBoxes[] = $ayResult;
  }
  
  //=== COLLECT ALL TEMPLATE DATA ===
  $rs = $db->query("SELECT DISTINCT domain FROM address WHERE mailboxid IS NULL ORDER BY domain");
  $ayNUDomains = array();
  while($ayResult = $rs->fetch_array()) {
    $ayNUDomains[] = $ayResult['domain'];
  }
  
  //=== PROCESS TEMPLATE ===
  $smarty->assign( 'title'      , tr('toc_title') );
  $smarty->assign( 'ayBoxes'    , $ayBoxes        );
  $smarty->assign( 'ayNUDomains', $ayNUDomains    );
  
  $smarty->display('toc.tpl');
?>
