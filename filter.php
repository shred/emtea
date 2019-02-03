<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * Edit a filter set.
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
    
  if(!isset($_REQUEST['id'])) die(tr('filter_noid'));
  $id = trim($_REQUEST['id']);
  
  if(isDomAdmin() && $id!==getUser()) die("Forbidden");
  
  $errorMsg = '';
  
  //=== PROCESS ALL CHANGES ===
  if(isset($_REQUEST['event'])) {
    if(trim($_REQUEST['new_folder'])!='') {
      $folder    = trim($_REQUEST['new_folder']);
      $sender    = trim($_REQUEST['new_from']);
      $subject   = trim($_REQUEST['new_subject']);
      $recipient = trim($_REQUEST['new_to']);
      if($sender=='' && $subject=='' && $recipient=='') {
        $errorMsg = tr('filter_emptyrule');
      }else {
        mysql_query(sprintf(
          "INSERT INTO filter SET mailboxid='%s', sender=%s, subject=%s, recipient=%s, folder='%s'",
          addslashes($id),
          ($sender!=''    ? "'".addslashes($sender)."'"    : "NULL" ),
          ($subject!=''   ? "'".addslashes($subject)."'"   : "NULL" ),
          ($recipient!='' ? "'".addslashes($recipient)."'" : "NULL" ),
          addslashes($folder)
        ));
      }
    }

    foreach($_REQUEST as $key=>$val) {
      $val = trim($val);

      if(preg_match('/^r_(\d+)_id$/', $key, $ayMatch)) {
        $eid = $ayMatch[1];
        $folder    = trim($_REQUEST['r_'.$eid.'_folder']);
        $sender    = trim($_REQUEST['r_'.$eid.'_from']);
        $subject   = trim($_REQUEST['r_'.$eid.'_subject']);
        $recipient = trim($_REQUEST['r_'.$eid.'_to']);
        if($folder=='') {
          $errorMsg = tr('filter_nofolder');
        }elseif($sender=='' && $subject=='' && $recipient=='') {
          $errorMsg = tr('filter_emptyrule');
        }else {
          mysql_query(sprintf(
            "UPDATE filter SET sender=%s, subject=%s, recipient=%s, folder='%s' WHERE id=%s",
            ($sender!=''    ? "'".addslashes($sender)."'"    : "NULL" ),
            ($subject!=''   ? "'".addslashes($subject)."'"   : "NULL" ),
            ($recipient!='' ? "'".addslashes($recipient)."'" : "NULL" ),
            addslashes($folder),
            addslashes($eid)
          ));
        }
      }

      //--- Delete entry ---
      if(preg_match('/^del_(\d+)$/', $key, $ayMatch)) {
        mysql_query(sprintf(
          "DELETE FROM filter WHERE id='%s'",
          addslashes($ayMatch[1])
        ));
      }
    }
  }

  //=== COLLECT ALL TEMPLATE DATA ===
  $rs = mysql_query(sprintf(
    "SELECT id, sender, subject, recipient, folder FROM filter WHERE mailboxid='%s'",
    addslashes($id)
  ));
  $ayData = array();
  while($ayResult = mysql_fetch_array($rs)) {
    $ayData[] = $ayResult;
  }

  //=== PROCESS TEMPLATE ===
  $smarty->assign( 'id'         , $id );
  $smarty->assign( 'errorMsg'   , $errorMsg );
  $smarty->assign( 'title'      , tr('filter_title') );
  $smarty->assign( 'ayData'     , $ayData );
  
  $smarty->display('filter.tpl');
?>
