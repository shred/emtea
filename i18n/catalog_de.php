<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" K�rber
   *
   * German Language catalog file.
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
   * $Id: catalog_de.php,v 1.1 2004/03/09 23:15:05 shred Exp $
   */

  //--- Authorization ---
  $lang{'auth_error_login'}     = '<h1>401 - Unauthorized</h1><p>Bitte Mail-User und -Passwort eingeben.</p>';
  $lang{'auth_error_unknown'}   = '<h1>401 - Unauthorized</h1><p>User unbekannt oder Passwort falsch.</p>';

  //--- index.php ---
  $lang{'ix_title'}             = 'Emtea -- MTA Mini Manager';
  $lang{'ix_noframes'}          = 'Frames sind erforderlich. Sorry!';
  
  //--- toc.php ---
  $lang{'toc_title'}            = 'Liste aller User und Mailboxen';
  $lang{'toc_createnew'}        = 'Neue Mailbox anlegen';
  $lang{'toc_logout'}           = 'Abmelden';
  $lang{'toc_update'}           = 'Liste aktualisieren';
  
  //--- logout.php ---
  $lang{'lo_loggedout'}         = 'Abgemeldet';
  $lang{'lo_login'}             = 'Anmelden';
  
  //--- domain.php ---
  $lang{'domain_title'}         = 'Domain';
  $lang{'domain_nodomain'}      = 'Keine Domain';
  $lang{'domain_deleted'}       = 'Domain gel�scht';
  $lang{'domain_plsack'}        = 'Zum L�schen beide Checkboxen markieren';
  $lang{'domain_domain'}        = 'Domain';
  $lang{'domain_error'}         = 'Fehler';
  $lang{'domain_email'}         = 'Mail-Adresse';
  $lang{'domain_mailbox'}       = 'Mailbox';
  $lang{'domain_delete'}        = 'L�schen';
  $lang{'domain_forwards'}      = 'Forwarder';
  $lang{'domain_forward'}       = 'forward';
  $lang{'domain_newmail'}       = 'Neue Mail-Adresse';
  $lang{'domain_deletelabel'}   = 'l�schen';
  $lang{'domain_deletedomain'}  = 'Domain l�schen?';
  $lang{'domain_ack'}           = 'Best�tigen';
  $lang{'domain_submit'}        = '�bernehmen';
  $lang{'domain_leastone'}      = 'Die Catch-All-Adresse wurde automatisch zugewiesen.';
  
  //--- mailbox.php ---
  $lang{'mb_title'}             = 'Mailbox verwalten';
  $lang{'mb_for'}               = 'F�r';
  $lang{'mb_newmb'}             = 'Neue Mailbox';
  $lang{'mb_error'}             = 'Fehler';
  $lang{'mb_mbid'}              = 'Mailbox-ID';
  $lang{'mb_username'}          = 'Username';
  $lang{'mb_passwd'}            = 'Passwort';
  $lang{'mb_userid'}            = 'User-ID';
  $lang{'mb_groupid'}           = 'Group-ID';
  $lang{'mb_homedir'}           = 'Home-Verzeichnis';
  $lang{'mb_modus'}             = 'Modus';
  $lang{'mb_df_mail'}           = 'Mail-';
  $lang{'mb_df_spam'}           = 'Spam-';
  $lang{'mb_df_virus'}          = 'Virus-';
  $lang{'mb_df_empty'}          = 'Leer =';
  $lang{'mb_imap'}              = 'IMAP-Zugriff';
  $lang{'mb_spamvir'}           = 'Spam/Virus-Check';
  $lang{'mb_procmail'}          = 'Procmail';
  $lang{'mb_isadmin'}           = 'Admin-Recht';
  $lang{'mb_isdomadmin'}        = 'Domain-Admin-Recht';
  $lang{'mb_yes'}               = 'Ja';
  $lang{'mb_no'}                = 'Nein';
  $lang{'mb_delete'}            = 'L�schen';
  $lang{'mb_delack'}            = 'Best�tigen';
  $lang{'mb_deluser'}           = 'User l�schen?';
  $lang{'mb_submit'}            = '�bernehmen';
  $lang{'mb_pleaseack'}         = 'Zum L�schen beide Checkboxen markieren!';
  $lang{'mb_pwdmismatch'}       = 'Passw�rter stimmten nicht �berein. Passwort NICHT ge�ndert.';
  $lang{'mb_isdir'}             = 'Verzeichnis';
  $lang{'mb_isfile'}            = 'Datei';
  
?>
