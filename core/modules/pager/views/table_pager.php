<table class="table_pager_tbl">
<tr>
	<th><?php _l('pager_page_s')?>:</th>
	<?php
		$idx = $page;

		while(true) {
			if($idx%10 != 1) --$idx;
			else break;
		}

		if($page > 1) {
	?>
	<td style="padding: 5px;"><a href="<?php e($base_url.$path)?>/page/1<?php e($params)?>"><?php _l('pager_first_page')?></a></td>
	<td style="padding: 5px;"><a href="<?php e($base_url.$path)?>/page/<?php e(($page-1).$params)?>">&lt;</a></td>
	<?php
		}

		while($idx%10 != 0) {
			if($idx >= ceil($items_count/$per_page)) break;

			if($page == $idx) e("<td><b>".$idx."</b></td>");
			else {
	?>
    <td style="padding: 5px;"><a href="<?php e($base_url.$path)?>/page/<?php e($idx.$params)?>"><?php e($idx)?></a></td>
    <?php
			}

    		++$idx;
		}

		if($idx < ceil($items_count/$per_page)) {
			if($page == $idx) e("<td><b>".$idx."</b></td>");
			else {
	?>
		    <td style="padding: 5px;">
		    	<a href="<?php e($base_url.$path)?>/page/<?php e($idx.$params)?>"><?php e($idx)?></a>
		    </td>
	<?php
			}
		}

		if($idx == ceil($items_count/$per_page)) {
			if($page==$idx) e("<td><b>".$idx."</b></td>");
			else {
	?>
	<td style="padding: 5px;"><a href="<?php e($base_url.$path)?>/page/<?php e($idx.$params)?>"><?php e($idx)?></a></td>
	<?php
			}
		}

		if($page < ceil($items_count/$per_page)) {
    ?>
    <td style="padding: 5px;"><a href="<?php e($base_url.$path)?>/page/<?php e(($page+1).$params)?>">&gt;</a></td>
    <td style="padding: 5px;"><a href="<?php e($base_url.$path)?>/page/<?php e(ceil($items_count/$per_page).$params)?>"><?php _l('pager_last_page')?></a></td>
    <?php
		}
    ?>
</tr>
</table>

<div class="table_pager_rec_cnt"><?php e(_l('pager_record_s')." ".$items_count)?></div>
