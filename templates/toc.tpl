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
 *
 * $Id: toc.tpl,v 1.1 2004/03/09 23:15:05 shred Exp $
 *}

{include file="header.tpl"}
<h1>Emtea</h1>

<form action="{$smarty.server.PHP_SELF}" method="post">
  {foreach from=$ayBoxes item=box}
    <a href="#{$box.id|escape}">{$box.id|escape}</a><br>
  {/foreach}
  <a href="#NULL"><em>-- (nouser)</em></a><br>
  &nbsp;<br>
  <a href="mailbox.php" target="index">{$tr.toc_createnew}</a><br>
  <a href="toc.php">{$tr.toc_update}</a>
  <hr noshade size="2">
  {foreach from=$ayBoxes item=box}
    <a name="{$box.id|escape}"></a>
    <a href="mailbox.php?id={$box.id|escape}" target="index" style="font-size:120%">{$box.id|escape}</a>
    <font color="#808080">{if $box.admin}admin&nbsp;{/if}{if $box.imapok}imap&nbsp;{/if}{if $box.procmailok}pm&nbsp;{/if}</font><br>
    <ul>
      {foreach from=$box.ayDomains item=boxdomain}
        <li><a href="domain.php?domain={$boxdomain|escape}" target="index">{$boxdomain|escape}</a></li>
      {/foreach}
      <li><input type="text" name="new_{$box.id|escape}" size="20" maxlength="127" onchange="form.submit()"></li>
    </ul>
    &nbsp;<br>
  {/foreach}
  <a name="NULL"></a><em style="font-size:120%">-- (nouser)</em><br>
  <ul>
    {foreach from=$ayNUDomains item=nudomain}
      <li><a href="domain.php?domain={$nudomain|escape}" target="index">{$nudomain|escape}</a></li>
    {/foreach}
  </ul>
</form>

{include file="footer.tpl"}

