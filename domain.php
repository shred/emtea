<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * This page lists and edits all entries which are related to the
   * given domain. This includes mail addresses, forwarders etc.
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
   * $Id: domain.php,v 1.6 2004/03/09 23:15:04 shred Exp $
   */
  
  require_once('_base.php');
  
  if(!isset($_REQUEST['domain'])) die(tr('domain_nodomain'));
  $domain = trim($_REQUEST['domain']);
  
  $errorMsg = '';
  $changed = false;
  
  //=== PROCESS ALL CHANGES ===
  if(isset($_REQUEST['del1']) || isset($_REQUEST['del2'])) {
    if(isset($_REQUEST['del1']) && isset($_REQUEST['del2']) && $_REQUEST['del1'] && $_REQUEST['del2']) {
      //--- Delete forwards to be deleted ---
      $rs = mysql_query(sprintf("SELECT id FROM address WHERE domain='%s'", $domain));
      while($ayResult = mysql_fetch_array($rs)) {
        mysql_query(sprintf("DELETE FROM forward WHERE addressid='%s'", addslashes($ayResult['id'])));
      }
      //--- Delete all domain entries ---
      mysql_query(sprintf("DELETE FROM address WHERE domain='%s'", $domain));
      //--- Refresh ---      
      $smarty->assign('js', 'top.toc.location.href="toc.php";');
      $smarty->display('domaindeleted.tpl');
      exit();
    }else {
      $errorMsg = tr('domain_plsack');
    }
  }elseif(isset($_REQUEST['event'])) {
    if(trim($_REQUEST['newlocal'])!='') {
      $local = trim($_REQUEST['newlocal']);
      if(($pos = strpos($local,'@')) !== false) {
        $local = substr($local,0,$pos);
      }
      mysql_query(sprintf(
        "INSERT INTO address SET local='%s', domain='%s'",
        addslashes($local),
        addslashes($domain)
      ));
    }

    foreach($_REQUEST as $key=>$val) {
      $val = trim($val);

      //--- Update all users ---
      if(preg_match('/^user_(\d+)$/', $key, $ayMatch)) {
        mysql_query(sprintf(
          "UPDATE address SET mailboxid=%s WHERE id='%s'",
          ($val!='' ? "'".addslashes($val)."'" : "NULL"),
          addslashes($ayMatch[1])
        ));
      }
      //--- Delete entry ---
      if(preg_match('/^del_(\d+)$/', $key, $ayMatch)) {
        mysql_query(sprintf(
          "DELETE FROM address WHERE id='%s'",
          addslashes($ayMatch[1])
        ));
      }
      //--- Change existing forwards ---
      if(preg_match('/^fwd_(\d+)_(\d+)$/', $key, $ayMatch)) {
        $oldval = $_REQUEST['fwdid_'.$ayMatch[2]];
        if($val!='' && $val!=$oldval) {
          mysql_query(sprintf(
            "UPDATE forward SET target='%s' WHERE addressid='%s' AND target='%s'",
            addslashes($val),
            addslashes($ayMatch[1]),
            addslashes($oldval)
          ));
        }elseif($val=='') {
          mysql_query(sprintf(
            "DELETE FROM forward WHERE addressid='%s' AND target='%s'",
            addslashes($ayMatch[1]),
            addslashes($oldval)
          ));
        }
      }
      //--- Add new forwards ---
      if(preg_match('/^fwd_(\d+)$/', $key, $ayMatch)) {
        if($val!='') {
          mysql_query(sprintf(
            "INSERT INTO forward SET target='%s', addressid='%s'",
            addslashes($val),
            addslashes($ayMatch[1])
          ));
        }
      }
    }
    
    $changed = true;
  }
  
  //=== COLLECT ALL TEMPLATE DATA ===
  $ayUsers = array();
  $rs = mysql_query("SELECT id FROM mailbox ORDER BY id");
  while($ayResult = mysql_fetch_array($rs)) {
    $ayUsers[] = $ayResult['id'];
  }
  
  if($changed) {
    $smarty->assign( 'js', 'top.toc.location.href="toc.php";' );
  }
  
  $fwdcnt = 0;
  $rs = mysql_query(sprintf(
    "SELECT a.id id, a.local local, m.id mid, COUNT(f.target) cnt FROM address a LEFT JOIN mailbox m ON a.mailboxid=m.id LEFT JOIN forward f ON a.id=f.addressid WHERE a.domain='%s' GROUP BY a.id ORDER BY a.local",
    addslashes($domain)
  ));
  $ayData = array();
  while($ayResult = mysql_fetch_array($rs)) {
    $rs2 = mysql_query(sprintf(
      "SELECT target FROM forward WHERE addressid='%s' ORDER BY target",
      addslashes($ayResult['id'])
    ));
    $ayResult['forwards'] = array();
    while($ayResult2 = mysql_fetch_array($rs2)) {
      $ayResult['forwards'][] = $ayResult2['target'];
    }
    $ayData[] = $ayResult;
  }

  //=== PROCESS TEMPLATE ===
  $smarty->assign( 'ayData'   , $ayData );
  $smarty->assign( 'ayUsers'  , $ayUsers );
  $smarty->assign( 'title'    , tr('domain_title').' '.$domain );
  $smarty->assign( 'domain'   , $domain );
  $smarty->assign( 'errorMsg' , $errorMsg );

  $smarty->display('domain.tpl');
  
?>
