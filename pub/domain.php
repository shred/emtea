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
   */

  require_once('inc/base.php');

  if(!isset($_REQUEST['domain'])) die(tr('domain_nodomain'));
  $domain = trim($_REQUEST['domain']);

  if(isDomAdmin()) {
    $rs = $db->query(sprintf("SELECT id FROM address WHERE domain='%s' AND mailboxid='%s'",
      $db->real_escape_string($domain),
      $db->real_escape_string(getUser())
    ));
    if($rs->num_rows==0) die("Forbidden");
  }

  $errorMsg = '';
  $changed = false;

  //=== PROCESS ALL CHANGES ===
  if(isset($_REQUEST['del1']) || isset($_REQUEST['del2'])) {
    if(isset($_REQUEST['del1']) && isset($_REQUEST['del2']) && $_REQUEST['del1'] && $_REQUEST['del2']) {
      if(!isDomAdmin()) {
        //--- Delete forwards to be deleted ---
        $rs = $db->query(sprintf("SELECT id FROM address WHERE domain='%s'", $db->real_escape_string($domain)));
        while($ayResult = $rs->fetch_array()) {
          $db->query(sprintf("DELETE FROM forward WHERE addressid='%s'", $db->real_escape_string($ayResult['id'])));
        }
        //--- Delete all domain entries ---
        $db->query(sprintf("DELETE FROM address WHERE domain='%s'", $db->real_escape_string($domain)));
        //--- Refresh ---
        $smarty->assign('js', 'top.toc.location.href="toc.php";');
        $smarty->display('domaindeleted.tpl');
        exit();
      }else die("Forbidden");
    }else {
      $errorMsg = tr('domain_plsack');
    }
  }elseif(isset($_REQUEST['event'])) {
    if(trim($_REQUEST['newlocal'])!='') {
      $local = trim($_REQUEST['newlocal']);
      if(($pos = strpos($local,'@')) !== false) {
        $local = substr($local,0,$pos);
      }
      $db->query(sprintf(
        "INSERT INTO address SET local='%s', domain='%s'",
        $db->real_escape_string($local),
        $db->real_escape_string($domain)
      ));
    }

    foreach($_REQUEST as $key=>$val) {
      $val = trim($val);

      //--- Update all users ---
      if(preg_match('/^user_(\d+)$/', $key, $ayMatch)) {
        if(isDomAdmin()) {
          $db->query(sprintf(
            "UPDATE address SET mailboxid=%s, devnull=%s WHERE id='%s' AND (mailboxid='%s' OR mailboxid IS NULL)",
            ($val!='' && $val!='*' ? "'".$db->real_escape_string($val)."'" : "NULL"),
            ($val=='*' ? 1 : 0),
            $db->real_escape_string($ayMatch[1]),
            $db->real_escape_string(getUser())
          ));
        }else {
          $db->query(sprintf(
            "UPDATE address SET mailboxid=%s, devnull=%s WHERE id='%s'",
            ($val!='' && $val!='*' ? "'".$db->real_escape_string($val)."'" : "NULL"),
            ($val=='*' ? 1 : 0),
            $db->real_escape_string($ayMatch[1])
          ));
        }
      }

      //--- Update all folder ---
      if(preg_match('/^folder_(\d+)$/', $key, $ayMatch)) {
        if(isDomAdmin()) {
          $db->query(sprintf(
            "UPDATE address SET folder=%s WHERE id='%s' AND (mailboxid='%s' OR mailboxid IS NULL)",
            ($val!='' ? "'".$db->real_escape_string($val)."'" : "NULL"),
            $db->real_escape_string($ayMatch[1]),
            $db->real_escape_string(getUser())
          ));
        }else {
          $db->query(sprintf(
            "UPDATE address SET folder=%s WHERE id='%s'",
            ($val!='' ? "'".$db->real_escape_string($val)."'" : "NULL"),
            $db->real_escape_string($ayMatch[1])
          ));
        }
      }

      //--- Delete entry ---
      if(preg_match('/^del_(\d+)$/', $key, $ayMatch)) {
        if(isDomAdmin()) {
          $db->query(sprintf(
            "DELETE FROM address WHERE id='%s' AND (mailboxid='%s' OR mailboxid IS NULL)",
            $db->real_escape_string($ayMatch[1]),
            $db->real_escape_string(getUser())
          ));
        }else {
          $db->query(sprintf(
            "DELETE FROM address WHERE id='%s'",
            $db->real_escape_string($ayMatch[1])
          ));
        }
      }
      //--- Change existing forwards ---
      if(preg_match('/^fwd_(\d+)_(\d+)$/', $key, $ayMatch)) {
        $addrid = $ayMatch[1];
        $oldval = $_REQUEST['fwdid_'.$ayMatch[2]];
        $allowed = true;
        if(isDomAdmin()) {
          $rs = $db->query(sprintf(
            "SELECT id FROM address WHERE id='%s' AND (mailboxid='%s' OR mailboxid IS NULL)",
            $db->real_escape_string($addrid),
            $db->real_escape_string(getUser())
          ));
          $allowed = $rs->num_rows!=0;
        }
        if($allowed) {
          if($val!='' && $val!=$oldval) {
            $db->query(sprintf(
              "UPDATE forward SET target='%s' WHERE addressid='%s' AND target='%s'",
              $db->real_escape_string($val),
              $db->real_escape_string($addrid),
              $db->real_escape_string($oldval)
            ));
          }elseif($val=='') {
            $db->query(sprintf(
              "DELETE FROM forward WHERE addressid='%s' AND target='%s'",
              $db->real_escape_string($addrid),
              $db->real_escape_string($oldval)
            ));
          }
        }
      }
      //--- Add new forwards ---
      if(preg_match('/^fwd_(\d+)$/', $key, $ayMatch)) {
        if($val!='') {
          $addrid = $ayMatch[1];
          $allowed = true;
          if(isDomAdmin()) {
            $rs = $db->query(sprintf(
              "SELECT id FROM address WHERE id='%s' AND (mailboxid='%s' OR mailboxid IS NULL)",
              $db->real_escape_string($addrid),
              $db->real_escape_string(getUser())
            ));
            $allowed = $rs->num_rows!=0;
          }
          if($allowed) {
            $db->query(sprintf(
              "INSERT INTO forward SET target='%s', addressid='%s'",
              $db->real_escape_string($val),
              $db->real_escape_string($addrid)
            ));
          }
        }
      }
    }

    //--- Make sure a Domain Admin has at least one entry ---
    if(isDomAdmin()) {
      $rs = $db->query(sprintf(
        "SELECT id FROM address WHERE mailboxid='%s'",
        $db->real_escape_string(getUser())
      ));
      if($rs->num_rows==0) {
        $db->query(sprintf(
          "UPDATE address SET mailboxid='%s' WHERE local IS NULL AND domain='%s'",
          $db->real_escape_string(getUser()),
          $db->real_escape_string($domain)
        ));
      }
      $errorMsg = tr('domain_leastone');
    }

    $changed = true;
  }

  //=== COLLECT ALL TEMPLATE DATA ===
  $ayUsers = array();
  $rs = $db->query("SELECT id FROM mailbox ORDER BY id");
  while($ayResult = $rs->fetch_array()) {
    $ayUsers[] = $ayResult['id'];
  }

  if($changed) {
    $smarty->assign( 'js', 'top.toc.location.href="toc.php";' );
  }

  $fwdcnt = 0;
  $rs = $db->query(sprintf(
    "SELECT a.id id, a.local local, m.id mid, COUNT(f.target) cnt, a.folder folder, a.devnull devnull FROM address a LEFT JOIN mailbox m ON a.mailboxid=m.id LEFT JOIN forward f ON a.id=f.addressid WHERE a.domain='%s' GROUP BY a.id ORDER BY a.local",
    $db->real_escape_string($domain)
  ));
  $ayData = array();
  while($ayResult = $rs->fetch_array()) {
    $rs2 = $db->query(sprintf(
      "SELECT target FROM forward WHERE addressid='%s' ORDER BY target",
      $db->real_escape_string($ayResult['id'])
    ));
    $ayResult['forwards'] = array();
    while($ayResult2 = $rs2->fetch_array()) {
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
