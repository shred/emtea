<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" Körber
   * https://emtea.shredzone.org
   *
   * Configuration file. TAKE CARE: since this file contains passwords
   * in plain text, make sure to set the file permissions properly, so
   * no one except you and PHP is able to read this file.
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

  $CONFIG = array();


  /*
   * Please enter the database parameters to connect to the
   * EXIM4 MySQL database.
   */

  $CONFIG['dbHost']   = 'db';
  $CONFIG['dbUser']   = 'emtea';
  $CONFIG['dbPasswd'] = 'secret';
  $CONFIG['dbName']   = 'mta';

?>
