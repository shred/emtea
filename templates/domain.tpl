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
 *
 * $Id: domain.tpl,v 1.1 2004/03/09 23:15:05 shred Exp $
 *}

{include file="header.tpl"}
<h1>{$tr.domain_domain}: {$domain|escape}</h1>

{if $errorMsg ne ''}<b>{$tr.domain_error|upper}:</b> {$errorMsg}<br>{/if}

<form action="{$smarty.server.PHP_SELF}" method="post">
  <input type="hidden" name="domain" value="{$domain|escape}">
  <input type="hidden" name="event" value="1">
  <table class="grid">
    <tr>
      <th colspan="2" width="60%">{$tr.domain_email}</th>
      <th>{$tr.domain_mailbox}</th>
      <th>{$tr.domain_delete}</th>
      <th>{$tr.domain_forwards}</th>
    </tr>
    {foreach from=$ayData item=entry}
      <tr valign="top">
        {* --- Mail Address --- *}
        <td colspan="2"><tt>{$entry.local|escape|default:'<b>*</b>'}@{$domain|escape}</tt>
        {* --- Mailbox --- *}
        {if $entry.cnt==0 }
          <td>
            <select name="user_{$entry.id}" size="1">
              <option value="">--</option>
              {foreach from=$ayUsers item=user}
                <option value="{$user|escape}" {if $user==$entry.mid}selected{/if}>{$user|escape}</option>
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
            <input type="text" name="fwd_{$entry.id}_{counter name=id2}" value="{$target|escape}" size="30" maxlength="255"><br>
          {/foreach}
          <input type="text" name="fwd_{$entry.id}" size="30" maxlength="255">
        </td>
      </tr>
    {/foreach}
    <tr>
      <td class="label" width="10%">{$tr.domain_newmail}</td>
      <td colspan="4"><input type="text" name="newlocal" size="50" maxlength="127"><tt>@{$domain|escape}</tt></td>
    </tr>
    <tr>
      <td class="label">{$tr.domain_deletelabel|upper}</td>
      <td colspan="4">{$tr.domain_deletedomain} <input type="checkbox" name="del1" value="1"> {$tr.domain_ack}: <input type="checkbox" name="del2" value="1"></td>
    </tr>
  </table>
  <input type="submit" value="- {$tr.domain_submit|upper} -"><br>
</form>

{include file="footer.tpl"}

