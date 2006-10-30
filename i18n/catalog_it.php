<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Ivo "eim" Marino
   *
   * Italian Language catalog file.
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
   * $Id: catalog_it.php,v 1.1 2004/03/10 12:59:29 shred Exp $
   */

  //--- Authorization ---
  $lang{'auth_error_login'}     = '<h1>401 - Unauthorized</h1><p>Per favore inserire utente-Mail e -password.</p>';
  $lang{'auth_error_unknown'}   = '<h1>401 - Unauthorized</h1><p>Utente non riconosciuto o password non valida.</p>';

  //--- index.php ---
  $lang{'ix_title'}             = 'Emtea -- MTA Mini Manager';
  $lang{'ix_noframes'}          = 'Frames sono necessari. Sorry!';
  
  //--- toc.php ---
  $lang{'toc_title'}            = 'Lista di tutti utenti e caselle di posta';
  $lang{'toc_createnew'}        = 'Crea nuova casella di posta';
  $lang{'toc_update'}           = 'Aggiorna lista';
  
  //--- domain.php ---
  $lang{'domain_title'}         = 'Dominio';
  $lang{'domain_nodomain'}      = 'Nessun dominio';
  $lang{'domain_deleted'}       = 'Dominio cancellato';
  $lang{'domain_plsack'}        = 'Per cancellare selezionare entrambe le checkbox';
  $lang{'domain_domain'}        = 'Dominio';
  $lang{'domain_error'}         = 'Errore';
  $lang{'domain_email'}         = 'Indirizzo email';
  $lang{'domain_mailbox'}       = 'Casella di posta';
  $lang{'domain_delete'}        = 'Cancella';
  $lang{'domain_forwards'}      = 'Forwarder';
  $lang{'domain_forward'}       = 'forward';
  $lang{'domain_newmail'}       = 'Nuovo indirizzo email';
  $lang{'domain_deletelabel'}   = 'cancellare';
  $lang{'domain_deletedomain'}  = 'Cancella dominio?';
  $lang{'domain_ack'}           = 'Conferma';
  $lang{'domain_submit'}        = 'accetta';  
  
  //--- mailbox.php ---
  $lang{'mb_title'}             = 'Gestione caselle di posta';
  $lang{'mb_for'}               = 'Per';
  $lang{'mb_newmb'}             = 'Nuova casella di posta';
  $lang{'mb_error'}             = 'Errore';
  $lang{'mb_mbid'}              = 'ID casella di posta';
  $lang{'mb_username'}          = 'Nome utente';
  $lang{'mb_passwd'}            = 'Password';
  $lang{'mb_userid'}            = 'ID utente';
  $lang{'mb_groupid'}           = 'ID gruppo';
  $lang{'mb_homedir'}           = 'Cartella home';
  $lang{'mb_modus'}             = 'Modalit&agrave;';
  $lang{'mb_df_mail'}           = 'Mail-';
  $lang{'mb_df_spam'}           = 'Spam-';
  $lang{'mb_df_virus'}          = 'Virus-';
  $lang{'mb_df_empty'}          = 'Vuoto =';
  $lang{'mb_imap'}              = 'Accesso IMAP';
  $lang{'mb_spamvir'}           = 'Controllo Spam/Virus';
  $lang{'mb_procmail'}          = 'Procmail';
  $lang{'mb_isadmin'}           = 'Amministratore';
  $lang{'mb_yes'}               = 'Si';
  $lang{'mb_no'}                = 'No';
  $lang{'mb_delete'}            = 'Cancellare';
  $lang{'mb_delack'}            = 'Conferma';
  $lang{'mb_deluser'}           = 'Cancella utente?';
  $lang{'mb_submit'}            = 'Conferma';
  $lang{'mb_pleaseack'}         = 'Per cancellare selezionare entrambe le checkbox';
  $lang{'mb_pwdmismatch'}       = 'Le password non coincidono. Password NON cambiata.';
  $lang{'mb_isdir'}             = 'Cartella';
  $lang{'mb_isfile'}            = 'File';
  
?>
