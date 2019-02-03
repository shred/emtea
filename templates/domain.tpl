{*
 * Emtea -- MTA Mini Manager
 * (C) Richard "Shred" Körber
 *
 * This template lists all entries which are related to a domain.
 * This includes mail addresses, forwarders etc.
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
<h1>{$tr.domain_domain}: {$domain|escape}</h1>

{if $errorMsg ne ''}<b>{$tr.domain_error|upper}:</b> {$errorMsg}<br>{/if}

<form action="{$smarty.server.PHP_SELF}" method="post">
  <input type="hidden" name="domain" value="{$domain|escape}">
  <input type="hidden" name="event" value="1">
  <table class="grid">
    <tr>
      <th colspan="2" width="80%">{$tr.domain_email}</th>
      <th>{$tr.domain_mailbox}</th>
      <th>{$tr.domain_delete}</th>
      <th>{$tr.domain_forwards}</th>
      <th>{$tr.domain_folder}</th>
    </tr>
    {foreach from=$ayData item=entry}
      <tr valign="top">
        {* --- Mail Address --- *}
        <td colspan="2"><tt>{$entry.local|escape|default:'<b>*</b>'}@{$domain|escape}</tt>
        {if $domadmin && $entry.mid!='' && $entry.mid!=$user}
          {* --- Mailbox --- *}
          {if $entry.cnt==0 }
            <td>{$entry.mid|escape}<input type="hidden" name="user_{$entry.id}" value="{$entry.mid|escape}"></td>
          {else}
            <td><em>{$tr.domain_forward}</em><input type="hidden" name="user_{$entry.id}" value="{$entry.mid|escape}"></td>
          {/if}
          {* --- Delete --- *}
          <td>&nbsp;</td>
          {* --- Forwards --- *}
          <td>
            {foreach from=$entry.forwards item=target}
              <input type="hidden" name="fwdid_{counter name=id1}" value="{$target|escape}">
              <input type="hidden" name="fwd_{$entry.id}_{counter name=id2}" value="{$target|escape}">{$target|escape}<br>
            {/foreach}
          </td>
          {* --- Folder --- *}
          <td>
            <input type="hidden" name="folder_{$entry.id}" value="{$entry.folder|escape}">{$entry.folder|escape}
          </td>
        {else}
          {* --- Mailbox --- *}
          {if $entry.cnt==0 }
            <td>
              <select name="user_{$entry.id}" size="1">
                <option value="">-- {$tr.domain_reject}</option>
                <option value="*" {if $entry.devnull!=0}selected{/if}>[] {$tr.domain_kill}</option>
                {foreach from=$ayUsers item=luser}
                  {if !$domadmin || $luser==$user}
                    <option value="{$luser|escape}" {if $entry.devnull==0 && $luser==$entry.mid}selected{/if}>{$luser|escape}</option>
                  {/if}
                {/foreach}
              </select>
            </td>
          {else}
            <td><em>{$tr.domain_forward}</em><input type="hidden" name="user_{$entry.id}" value="{$entry.mid|escape}"></td>
          {/if}
          {* --- Delete --- *}
          {if $entry.local }
            <td><input type="checkbox" name="del_{$entry.id}" value="1"></td>
          {else}
            <td>&nbsp;</td>
          {/if}
          {* --- Forwards --- *}
          <td>
            {foreach from=$entry.forwards item=target}
              <input type="hidden" name="fwdid_{counter name=id1}" value="{$target|escape}">
              <input type="text" name="fwd_{$entry.id}_{counter name=id2}" value="{$target|escape}" size="20" maxlength="255"><br>
            {/foreach}
            <input type="text" name="fwd_{$entry.id}" size="20" maxlength="255">
          </td>
          {* --- Folder--- *}
          <td>
            <input type="text" name="folder_{$entry.id}" value="{$entry.folder|escape}" size="15" maxlength="127">
          </td>
        {/if}
      </tr>
    {/foreach}
    <tr>
      <td class="label" width="10%">{$tr.domain_newmail}</td>
      <td colspan="5"><input type="text" name="newlocal" size="50" maxlength="127"><tt>@{$domain|escape}</tt></td>
    </tr>
    {if !$domadmin}
      <tr>
        <td class="label">{$tr.domain_deletelabel|upper}</td>
        <td colspan="5">{$tr.domain_deletedomain} <input type="checkbox" name="del1" value="1"> {$tr.domain_ack}: <input type="checkbox" name="del2" value="1"></td>
      </tr>
    {/if}
  </table>
  <input type="submit" value="- {$tr.domain_submit|upper} -"><br>
</form>

{include file="footer.tpl"}

