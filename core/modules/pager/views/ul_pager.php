<?php
	if($items_count > 0) {
?>

<div class="pagination">

	<ul>
		<?php
			$idx = $page;

			while(true) {
				if($idx%10 != 1) --$idx;
				else break;
			}

			if($page > 1) {
		?>
			<li><a href="<?php e($base_url.$path)?>/page/1<?php e($params)?>"><?php _l('pager_first_page')?></a></li>
			<li><a href="<?php e($base_url.$path)?>/page/<?php e(($page-1).$params)?>">&lt;</a></li>
		<?php
			}

		while($idx%10 != 0) {
			if($idx > ceil($items_count/$per_page)) break;

			if($page == $idx) e('<li class="active"><a href="#">'.$idx.'</a></li>');
			else {
	?>
    	<li><a href="<?php e($base_url.$path)?>/page/<?php e($idx.$params)?>"><?php e($idx)?></a></li>
    <?php
			}

    		++$idx;
		}

		if(($idx) < ceil($items_count/$per_page)) {
			if($page==$idx) e('<li class="active"><a>'.$idx.'</a></li>');
			else {
	?>
	<li><a href="<?php e($base_url.$path)?>/page/<?php e($idx.$params)?>"><?php e($idx)?></a></li>
	<?php
			}
		}

		if($page < ceil($items_count/$per_page)) {
    ?>
    <li><a href="<?php e($base_url.$path)?>/page/<?php e(($page+1).$params)?>">&gt;</a></li>
    <li><a href="<?php e($base_url.$path)?>/page/<?php e(ceil($items_count/$per_page).$params)?>"><?php _l('pager_last_page')?></a></li>
    <?php
		}
    ?>
	</ul>

	<?php if($items_count > 0) {?>
	<div class="table_pager_rec_cnt"><?php e(_l('pager_record_s')." ".$items_count)?></div>
	<?php } ?>

</div>

<?php
	}
?>

