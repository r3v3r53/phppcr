{foreach from=$calendario item=vars}
<div id="mes">
<table class="mes">
<tr class="calendario_titulo_mes">
	<td colspan="7">{$vars['mes']['titulo']}, {$vars['ano']}</td>
</tr>
<tr class="calendario_titulo_dias">
	<td>d</td>
	<td>s</td>
	<td>t</td>
	<td>q</td>
	<td>q</td>
	<td>s</td>
	<td>s</td>
</tr>

{assign var=i value=0}	
	{foreach from=$vars['dias'] key=key_dia item=dia}
    	{if $i eq 7 }
    		</tr>
    		{assign var=i value=0}
    	{/if}
    	{if $i eq 0}
			<tr>
		{/if}
    	<td class="calendario_dias">
    			<div class="{if array_key_exists($dia, $vars['class'])}{$vars['class'][$dia]}{/if}">
    				{if $dia > 0}
	    				<a 
	    					href="?Calendar&setDay={$vars['data'][$key_dia]}" 
	    					title="{$vars['nomes'][$key_dia]}"
	    				>
	    					{$dia}
	    				</a>
    				{else}
    					&nbsp;
    				{/if}
    			</div>
    	</td>
    	
    	{$i = $i+1}
    {/foreach}
</table>
</div>
{/foreach}