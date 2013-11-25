<img class="img-responsive" src="tmp/still.jpg?d={$smarty.now}" />
{if $widget->result != null}
	{if $widget->result|count_characters:true > 0}
	<pre>
		{$widget->result}
	</pre>
	{elseif count($widget->result) > 0}
	<pre>
		{foreach $widget->result as $res}
			{$res}
		{/foreach}
	</pre>
	{/if}
{/if}
