{*
 * Emtea -- MTA Mini Manager
 * (C) Richard "Shred" Körber
 *
 * Template for a mailbox with usernames, passwords and permissions.
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

{if $id }
  <h1>{$tr.mb_for} {$id|escape}</h1>
{else}
  <h1>{$tr.mb_newmb}</h1>
{/if}

{if $errorMsg }<b>{$tr.mb_error|upper}:</b> {$errorMsg}<br>{/if}

<form action="{$smarty.server.PHP_SELF}" method="post">
  <table class="grid">
    <tr>
      <td class="label">{$tr.mb_mbid}</td>
      <td>
        {if $id}
          <input type="hidden" name="id" value="{$id|escape}">{$id|escape}
        {else}
          <input type="text" name="id" size="50" maxlength="127">
        {/if}
      </td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_username}</td>
      <td><input type="text" name="name" value="{$data.name|escape}" size="50" maxlength="127"></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_passwd}</td>
      <td><input type="password" name="pwd1" size="50" maxlength="127"><br><input type="password" name="pwd2" size="50" maxlength="127"></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_userid}</td>
      <td><input type="text" name="uid" value="{$data.uid|escape}" size="5" maxlength="5"></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_groupid}</td>
      <td><input type="text" name="gid" value="{$data.gid|escape}" size="5" maxlength="5"></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_homedir}</td>
      <td><input type="text" name="home" value="{$data.home|escape}" size="50" maxlength="127"></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_df_mail}{$tr.mb_isdir}</td>
      <td><input type="text" name="maildir" value="{$data.maildir|escape}" size="50" maxlength="127"></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_df_spam}{$tr.mb_isdir}</td>
      <td><input type="text" name="spamdir" value="{$data.spamdir|escape}" size="50" maxlength="127"><br><small>{$tr.mb_df_empty} {$tr.mb_df_mail}{$tr.mb_isdir}</small></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_df_virus}{$tr.mb_isdir}</td>
      <td><input type="text" name="virusdir" value="{$data.virusdir|escape}" size="50" maxlength="127"><br><small>{$tr.mb_df_empty} {$tr.mb_df_mail}{$tr.mb_isdir}</small></td>
    </tr>
    <tr>
      <td class="label">&nbsp;</td>
      <td><a href="filter.php?id={$id|escape}">{$tr.mb_editfilter}</a></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_imap}</td>
      <td><select name="imapok" size="1">
        <option value="1" {if $data.imapok}selected{/if}>{$tr.mb_yes}</option>
        <option value="0" {if !$data.imapok}selected{/if}>{$tr.mb_no}</option>
      </select></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_spamvir}</td>
      <td><select name="amavisok" size="1">
        <option value="1" {if $data.amavisok}selected{/if}>{$tr.mb_yes}</option>
        <option value="0" {if !$data.amavisok}selected{/if}>{$tr.mb_no}</option>
      </select></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_procmail}</td>
      <td><select name="procmailok" size="1">
        <option value="1" {if $data.procmailok}selected{/if}>{$tr.mb_yes}</option>
        <option value="0" {if !$data.procmailok}selected{/if}>{$tr.mb_no}</option>
      </select></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_isdomadmin}</td>
      <td><select name="domadmin" size="1">
        <option value="1" {if $data.domadmin}selected{/if}>{$tr.mb_yes}</option>
        <option value="0" {if !$data.domadmin}selected{/if}>{$tr.mb_no}</option>
      </select></td>
    </tr>
    <tr>
      <td class="label">{$tr.mb_isadmin}</td>
      <td><select name="admin" size="1">
        <option value="1" {if $data.admin}selected{/if}>{$tr.mb_yes}</option>
        <option value="0" {if !$data.admin}selected{/if}>{$tr.mb_no}</option>
      </select></td>
    </tr>
    {if $id }
      <tr>
        <td class="label">{$tr.mb_delete|upper}</td>
        <td>{$tr.mb_deluser} <input type="checkbox" name="del1" value="1"> {$tr.mb_delack}: <input type="checkbox" name="del2" value="1"></td>
      </tr>
    {/if}
  </table>
  <input type="submit" value="{$tr.mb_submit}">
</form>

{include file="footer.tpl"}

