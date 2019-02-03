{*
 * Emtea -- MTA Mini Manager
 * (C) Richard "Shred" Körber
 *
 * This template lists all filters which are related to a mailbox.
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

{include file="header.tpl"}
<h1>{$tr.filter_mailbox}: {$id|escape}</h1>

{if $errorMsg ne ''}<b>{$tr.filter_error|upper}:</b> {$errorMsg}<br>{/if}

<form action="{$smarty.server.PHP_SELF}" method="post">
  <input type="hidden" name="id" value="{$id|escape}">
  <input type="hidden" name="event" value="1">
  <table class="grid">
    <tr>
      <th>{$tr.filter_from}</th>
      <th>{$tr.filter_subject}</th>
      <th>{$tr.filter_to}</th>
      <th>{$tr.filter_folder}</th>
      <th>{$tr.filter_delete}</th>
    </tr>
    {foreach from=$ayData item=entry}
      <tr class="result">
        {* --- From Address --- *}
        <td><input type="hidden" name="r_{$entry.id}_id" value="1"><input type="text" name="r_{$entry.id}_from" value="{$entry.sender|escape}" size="15" maxlength="127"></td>
        {* --- Subject --- *}
        <td><input type="text" name="r_{$entry.id}_subject" value="{$entry.subject|escape}" size="15" maxlength="127"></td>
        {* --- To Address --- *}
        <td><input type="text" name="r_{$entry.id}_to" value="{$entry.recipient|escape}" size="15" maxlength="127"></td>
        {* --- Folder --- *}
        <td><input type="text" name="r_{$entry.id}_folder" value="{$entry.folder|escape}" size="15" maxlength="127"></td>
        {* --- Delete --- *}
        <td><input type="checkbox" name="del_{$entry.id}" value="1"></td>
      </tr>
    {/foreach}
    <tr valign="top">
      {* --- From Address --- *}
      <td><input type="text" name="new_from" size="15" maxlength="127"></td>
      {* --- Subject --- *}
      <td><input type="text" name="new_subject" size="15" maxlength="127"></td>
      {* --- To Address --- *}
      <td><input type="text" name="new_to" size="15" maxlength="127"></td>
      {* --- Folder --- *}
      <td><input type="text" name="new_folder" size="15" maxlength="127"></td>
      {* --- Delete --- *}
      <td>&nbsp;</td>
    </tr>
  </table>
  <input type="submit" value="- {$tr.filter_submit|upper} -"><br>
</form>

{include file="footer.tpl"}

