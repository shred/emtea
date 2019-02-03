{*
 * Emtea -- MTA Mini Manager
 * (C) Richard "Shred" Körber
 *
 * Template for a list of all mailboxes.
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
<h1>Emtea</h1>

<form action="{$smarty.server.PHP_SELF}" method="post">
  {if !$domadmin}
    {foreach from=$ayBoxes item=box}
      <a href="#{$box.id|escape}">{$box.id|escape}</a><br>
    {/foreach}
    <a href="#NULL"><em>-- (nouser)</em></a><br>
    &nbsp;<br>
    <a href="mailbox.php" target="index">{$tr.toc_createnew}</a><br>
  {/if}
  <a href="toc.php">{$tr.toc_update}</a><br>
  <a href="password.php" target="index">{$tr.toc_password}</a><br>
  <a href="logout.php" target="_top">{$tr.toc_logout}</a>
  <hr noshade size="2">
  {foreach from=$ayBoxes item=box}
    {if (!$domadmin) || ($box.id==$user)}
      <a name="{$box.id|escape}"></a>
      {if $domadmin}
        <a href="filter.php?id={$box.id|escape}" target="index" style="font-size:120%">{$box.id|escape}</a>
      {else}
        <a href="mailbox.php?id={$box.id|escape}" target="index" style="font-size:120%">{$box.id|escape}</a>
      {/if}
      <font color="#808080">{if $box.admin}admin&nbsp;{/if}{if $box.domadmin}domain&nbsp;{/if}{if $box.imapok}imap&nbsp;{/if}{if $box.procmailok}pm&nbsp;{/if}</font><br>
      <ul>
        {foreach from=$box.ayDomains item=boxdomain}
          <li><a href="domain.php?domain={$boxdomain|escape}" target="index">{$boxdomain|escape}</a></li>
        {/foreach}
        {if !$domadmin}
          <li><input type="text" name="new_{$box.id|escape}" size="20" maxlength="127" onchange="form.submit()"></li>
        {/if}
      </ul>
      &nbsp;<br>
    {/if}
  {/foreach}
  {if !$domadmin}
    <a name="NULL"></a><em style="font-size:120%">-- (nouser)</em><br>
    <ul>
      {foreach from=$ayNUDomains item=nudomain}
        <li><a href="domain.php?domain={$nudomain|escape}" target="index">{$nudomain|escape}</a></li>
      {/foreach}
    </ul>
  {/if}
</form>

{include file="footer.tpl"}

