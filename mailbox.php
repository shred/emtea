<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * Edit a mailbox with usernames, passwords and permissions.
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

  if(isDomAdmin()) die("Forbidden!");
  
  unset($id);
  $ayData = array('name'=>'', 'uid'=>'', 'gid'=>'', 'home'=>'', 'maildir'=>'', 'spamdir'=>'', 'virusdir'=>'', 'imapok'=>0, 'admin'=>0, 'procmailok'=>0, 'amavisok'=>0, 'domadmin'=>0);
  $changed = false;
  $deleted = false;
  $errorMsg = '';
  
  //=== PROCESS ALL CHANGES ===
  if(isset($_REQUEST['del1']) || isset($_REQUEST['del2'])) {
    if(isset($_REQUEST['del1']) && isset($_REQUEST['del2']) && $_REQUEST['del1'] && $_REQUEST['del2']) {
      mysql_query(sprintf("UPDATE address SET mailboxid=NULL WHERE mailboxid='%s'", addslashes(trim($_REQUEST['id'])) ));
      mysql_query(sprintf("DELETE FROM mailbox WHERE id='%s'", addslashes(trim($_REQUEST['id'])) ));
      $changed = true;
      $deleted = true;
    }else {
      $errorMsg = tr('mb_pleaseack');
    }
  }elseif(isset($_REQUEST['name'])) {
    $rc = mysql_query(sprintf(
      "SELECT id FROM mailbox WHERE id='%s'",
      addslashes(trim($_REQUEST['id']))
    ));
    if(mysql_num_rows($rc)==0) {
      //--- New Entry ---
      mysql_query(sprintf(
        "INSERT INTO mailbox SET id='%s', name='%s', uid='%s', gid='%s', home='%s', maildir='%s', spamdir=%s, virusdir=%s, imapok='%s', admin='%s', procmailok='%s', amavisok='%s', domadmin='%s'",
        addslashes(trim($_REQUEST['id'])),
        addslashes(trim($_REQUEST['name'])),
        addslashes(intval($_REQUEST['uid'])),
        addslashes(intval($_REQUEST['gid'])),
        addslashes(trim($_REQUEST['home'])),
        addslashes(trim($_REQUEST['maildir'])),
        (trim($_REQUEST['spamdir'])!='' ? "'".addslashes(trim($_REQUEST['spamdir']))."'" : 'NULL'),
        (trim($_REQUEST['virusdir'])!='' ? "'".addslashes(trim($_REQUEST['virusdir']))."'" : 'NULL'),
        addslashes(intval($_REQUEST['imapok'])),
        addslashes(intval($_REQUEST['admin'])),
        addslashes(intval($_REQUEST['procmailok'])),
        addslashes(intval($_REQUEST['amavisok'])),
        addslashes(intval($_REQUEST['domadmin']))
      ));
    }else {
      //--- Existing Entry ---
      mysql_query(sprintf(
        "UPDATE mailbox SET name='%s', uid='%s', gid='%s', home='%s', maildir='%s', spamdir=%s, virusdir=%s, imapok='%s', admin='%s', procmailok='%s', amavisok='%s', domadmin='%s' WHERE id='%s'",
        addslashes(trim($_REQUEST['name'])),
        addslashes(intval($_REQUEST['uid'])),
        addslashes(intval($_REQUEST['gid'])),
        addslashes(trim($_REQUEST['home'])),
        addslashes(trim($_REQUEST['maildir'])),
        (trim($_REQUEST['spamdir'])!='' ? "'".addslashes(trim($_REQUEST['spamdir']))."'" : 'NULL'),
        (trim($_REQUEST['virusdir'])!='' ? "'".addslashes(trim($_REQUEST['virusdir']))."'" : 'NULL'),
        addslashes(intval($_REQUEST['imapok'])),
        addslashes(intval($_REQUEST['admin'])),
        addslashes(intval($_REQUEST['procmailok'])),
        addslashes(intval($_REQUEST['amavisok'])),
        addslashes(intval($_REQUEST['domadmin'])),
        addslashes(trim($_REQUEST['id']))
      ));
    }
    if(trim($_REQUEST['pwd1'])!='' || trim($_REQUEST['pwd2'])!='') {
      if(trim($_REQUEST['pwd1'])==trim($_REQUEST['pwd2'])) {
        mysql_query(sprintf(
          "UPDATE mailbox SET password=ENCRYPT('%s') WHERE id='%s'",
          addslashes(trim($_REQUEST['pwd1'])),
          addslashes($_REQUEST['id'])
        ));
      }else {
        $errorMsg = tr('mb_pwdmismatch');
      }
    }
    
    $changed = true;
  }
  
  //=== COLLECT ALL TEMPLATE DATA ===
  if(!$deleted && isset($_REQUEST['id'])) {
    $id = trim($_REQUEST['id']);
    $rs = mysql_query(sprintf(
      "SELECT name, uid, gid, home, maildir, spamdir, virusdir, imapok, admin, procmailok, amavisok, domadmin FROM mailbox WHERE id='%s'",
      addslashes($id)
    ));
    $ayData = mysql_fetch_array($rs);
  }
  
  if($changed) {
    $smarty->assign('js', 'top.toc.location.href="toc.php";');
  }

  //=== PROCESS TEMPLATE ===
  if(isset($id)) {
    $smarty->assign( 'id'         , $id );
  }
  $smarty->assign( 'errorMsg'   , $errorMsg );
  $smarty->assign( 'title'      , tr('mb_title') );
  $smarty->assign( 'data'       , $ayData );
  
  $smarty->display('mailbox.tpl');
?>
