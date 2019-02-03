{*
 * Emtea -- MTA Mini Manager
 * (C) Richard "Shred" Körber
 *
 * This is the header template of each Emtea page, which will be included
 * above the content, and will contain head definitions and maybe CSS.
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
 *}

<html>
<head>
  <title>{$title} -- Emtea</title>
  <style type="text/css">
    @import url(style.css);
  </style>
</head>
{if isset($js)}
<script language="JavaScript"><!--
  {$js}
//--></script>
{/if}
<body>

