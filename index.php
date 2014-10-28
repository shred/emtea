<?php
  /**
   * Emtea -- MTA Mini Manager
   * (C) Richard "Shred" K�rber
   *
   * Main page and frameset construction.
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
   * $Id: index.php,v 1.3 2004/03/09 23:15:04 shred Exp $
   */
  require_once('_base.php');
  
?>
<html>
<head>
  <title><?php echo(tr('ix_title'))?></title>
</head>
<frameset cols="20%,*">
  <frame src="toc.php" name="toc">
  <frame src="empty.php" name="index">
</frameset>
<body>
  <?php echo(tr('ix_noframes'))?>
</body>
</html>

