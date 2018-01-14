<div class="knowledgebase">
	<form role="form" method="post" action="./knowledgebase.php?action=search">
	    <div class="input-group">
	        <input type="text" name="search" class="form-control" placeholder="{$LANG.kbsearchexplain}" />
	        <span class="input-group-btn">
	            <input type="submit" class="btn btn-primary btn-input-padded-responsive" value="{$LANG.search}" />
	        </span>
	    </div>
	</form>
</div>

<h2 class="know">{$LANG.knowledgebasecategories}</h2>

{if $kbcats}
    <div class="row kbcategories">
        {foreach from=$kbcats name=kbcats item=kbcat}
            <div class="col-sm-4 col-md-3">
                <a href="{if $seofriendlyurls}./knowledgebase/{$kbcat.id}/{$kbcat.urlfriendlyname}{else}knowledgebase.php?action=displaycat&amp;catid={$kbcat.id}{/if}">
                    <span class="icons"></span>
                    <h3 class="title">{$kbcat.name}</h3>
					<p>{$kbcat.description}</p>
                </a>
            </div>
        {/foreach}
    </div>
{else}
    {include file="$template/includes/alert.tpl" type="info" msg=$LANG.knowledgebasenoarticles textcenter=true}
{/if}

{if $kbmostviews}

    <h2>{$LANG.knowledgebasepopular}</h2>

    <div class="kbarticles">
        {foreach from=$kbmostviews item=kbarticle}
            <a href="{if $seofriendlyurls}./knowledgebase/{$kbarticle.id}/{$kbarticle.urlfriendlytitle}.html{else}knowledgebase.php?action=displayarticle&amp;id={$kbarticle.id}{/if}">
                <span class="glyphicon glyphicon-file"></span>&nbsp;{$kbarticle.title}
            </a>
            <p>{$kbarticle.article|truncate:100:"..."}</p>
        {/foreach}
    </div>

{/if}
