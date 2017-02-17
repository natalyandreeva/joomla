<div class="row-fluid">
		<div class="row-fluid">
			<div class="span6">
				<h2><?php echo JText::_('COM_CONTACTUS_FEEDBACK');?></h2>
			</div>	
			<div class="span6">
				<p class="text-right"><a href="<?php echo JURI::base();?>index.php?option=com_contactus&view=list" class="text-right"><?php echo JText::_('COM_CONTACTUS_BACK_LIST');?></a></p>
			</div>
		</div>
		<div class="row-fluid">
			<table id="ContactusTable" class="table table-striped">
				<tbody>			
				<?php foreach ($this->feedback as $key=>$value){
					if (($key !== "read")&&($key !== "replied")){?>
						<tr><th><?php echo $key;?>:</th><td> <?php echo $value;?></td></tr>
					<?php }
				}?>
				</tbody>
			</table>
		</div>
	</div>
</div>