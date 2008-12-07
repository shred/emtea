{*
 * Emtea -- MTA Mini Manager
 * (C) Richard "Shred" Körber
 *
 * Template for a password change.
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
 * $Id: mailbox.tpl,v 1.1 2004/03/09 23:15:05 shred Exp $
 *}

{include file="header.tpl"}

<h1>{$tr.pwd_title}</h1>

{if $errorMsg }<b>{$tr.mb_error|upper}:</b> {$errorMsg}<br>{/if}

<form action="{$smarty.server.PHP_SELF}" method="post">
  <table class="grid">
    <tr>
      <td class="label">{$tr.mb_passwd}</td>
      <td><input type="password" name="pwd1" size="50" maxlength="127"><br><input type="password" name="pwd2" size="50" maxlength="127"></td>
    </tr>
  </table>
  <input type="submit" value="{$tr.mb_submit}">
</form>

{include file="footer.tpl"}

