<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   *
   * Default (English) Language catalog file.
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
   * $Id: catalog.php,v 1.1 2004/03/09 23:15:05 shred Exp $
   */

  //--- Authorization ---
  $lang{'auth_error_login'}     = '<h1>401 - Unauthorized</h1><p>Please give your mail user and password.</p>';
  $lang{'auth_error_unknown'}   = '<h1>401 - Unauthorized</h1><p>Unknown user or bad password.</p>';

  //--- index.php ---
  $lang{'ix_title'}             = 'Emtea -- MTA Mini Manager';
  $lang{'ix_noframes'}          = 'Frames are required, sorry!';
  
  //--- toc.php ---
  $lang{'toc_title'}            = 'List of all users and mailboxes';
  $lang{'toc_createnew'}        = 'Create new mailbox';
  $lang{'toc_password'}         = 'Change password';
  $lang{'toc_logout'}           = 'Logout';
  $lang{'toc_update'}           = 'Reload list';
  
  //--- logout.php ---
  $lang{'lo_loggedout'}         = 'Logged out';
  $lang{'lo_login'}             = 'Login';
  
  //--- domain.php ---
  $lang{'domain_title'}         = 'Domain';
  $lang{'domain_nodomain'}      = 'No domain';
  $lang{'domain_deleted'}       = 'Domain deleted';
  $lang{'domain_plsack'}        = 'You must check both boxes in order to delete this domain';
  $lang{'domain_domain'}        = 'Domain';
  $lang{'domain_error'}         = 'Error';
  $lang{'domain_email'}         = 'Mail Address';
  $lang{'domain_mailbox'}       = 'Mailbox';
  $lang{'domain_delete'}        = 'Delete';
  $lang{'domain_forwards'}      = 'Forwarder';
  $lang{'domain_forward'}       = 'forward';
  $lang{'domain_folder'}        = 'Folder';
  $lang{'domain_newmail'}       = 'New Mail Address';
  $lang{'domain_deletelabel'}   = 'delete';
  $lang{'domain_deletedomain'}  = 'Delete domain?';
  $lang{'domain_ack'}           = 'Confirm';
  $lang{'domain_submit'}        = 'Submit';  
  $lang{'domain_leastone'}      = 'The catch all address was automatically assigned to you.'; 
  $lang{'domain_reject'}        = 'Reject';
  $lang{'domain_kill'}          = 'Kill';
  
  //--- mailbox.php ---
  $lang{'mb_title'}             = 'Manage Mailbox';
  $lang{'mb_for'}               = 'For';
  $lang{'mb_newmb'}             = 'New Mailbox';
  $lang{'mb_error'}             = 'Error';
  $lang{'mb_mbid'}              = 'Mailbox ID';
  $lang{'mb_username'}          = 'User Name';
  $lang{'mb_passwd'}            = 'Password';
  $lang{'mb_userid'}            = 'User ID';
  $lang{'mb_groupid'}           = 'Group ID';
  $lang{'mb_homedir'}           = 'Home Directory';
  $lang{'mb_modus'}             = 'Mode';
  $lang{'mb_df_mail'}           = 'Mail ';
  $lang{'mb_df_spam'}           = 'Spam ';
  $lang{'mb_df_virus'}          = 'Virus ';
  $lang{'mb_df_empty'}          = 'Empty means';
  $lang{'mb_editfilter'}        = 'Edit filter rules';
  $lang{'mb_imap'}              = 'IMAP Access';
  $lang{'mb_spamvir'}           = 'Spam/Virus check';
  $lang{'mb_procmail'}          = 'Procmail';
  $lang{'mb_isadmin'}           = 'Admin Right';
  $lang{'mb_isdomadmin'}        = 'Domain Admin Right';
  $lang{'mb_yes'}               = 'Yes';
  $lang{'mb_no'}                = 'No';
  $lang{'mb_delete'}            = 'Delete';
  $lang{'mb_delack'}            = 'Confirm';
  $lang{'mb_deluser'}           = 'Delete user?';
  $lang{'mb_submit'}            = 'Submit';
  $lang{'mb_pleaseack'}         = 'You must check both boxes in order to delete an user!';
  $lang{'mb_pwdmismatch'}       = 'Passwords do not match. Password was NOT changed.';
  $lang{'mb_isdir'}             = 'Directory';
  $lang{'mb_isfile'}            = 'File';

  //--- password.php ---
  $lang{'pwd_title'}            = 'Change password';
  $lang{'pwd_old'}              = 'Old password';
  $lang{'pwd_new'}              = 'New password';
  $lang{'pwd_oldbad'}           = 'The old password is wrong!';
  $lang{'pwd_changed'}          = 'Password successfully changed.';
  
  //--- filter.php ---
  $lang{'filter_title'}         = 'Edit filter rules';
  $lang{'filter_mailbox'}       = 'Filter rules for mailbox';
  $lang{'filter_noid'}          = 'No user';
  $lang{'filter_error'}         = 'Error';
  $lang{'filter_submit'}        = 'Submit';
  $lang{'filter_from'}          = 'Sender';
  $lang{'filter_subject'}       = 'Subject';
  $lang{'filter_to'}            = 'Recipient';
  $lang{'filter_folder'}        = 'Folder';
  $lang{'filter_delete'}        = 'Delete';
  $lang{'filter_emptyrule'}     = 'Empty filter rule was not accepted';
  $lang{'filter_nofolder'}      = 'Please specify a folder';
  
?>
