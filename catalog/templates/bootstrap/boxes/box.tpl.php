<?php
/*
$Id: box.tpl.php 1692 2012-02-26 01:26:50Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


    if (!defined ('DIR_FS_CATALOG')) die ("Access denied.");
    /* infobox template  */ 
?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<?php echo $boxHeading; ?>
                    <span style="float:right"><?php if (isset($boxLink)) echo $boxLink; ?></span>
				</h3>
                
			</div>
			<div class="panel-body">
				<?php echo $boxContent; ?>
			</div>
		</div>