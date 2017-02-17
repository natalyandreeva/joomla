<div>
	<div class="row-fluid">
		<h2><?php echo JText::_('COM_CONTACTUS_FEEDBACKS_LIST');?></h2> 
		<table id="ContactusTable" class="table "> 
			<thead> 
				<tr> 
					<?php if (count($this->list)>0){
							foreach ($this->list[0] as $key=>$caption){
								if (($key !== 'read') && ($key !== 'replied')){?>
									<th><?php echo $key;?></th>
								<?php }
							}		
					}?>
					<th></th>	
					<th></th>
				</tr> 
			</thead>
			<tbody>
				<?php foreach($this->list as $feed){ ?>
					<tr <?php if ($feed->read == 1){echo 'class="read"';};?>>
						<?php foreach($feed as $key=>$v){
							if (($key !== 'read') && ($key !== 'replied'))
							{			
								if ($key == 'message'){
									mb_internal_encoding("UTF-8");
									$v = '<a href="index.php?option=com_contactus&view=feedback&id='.$feed->id.'">'.mb_substr($v, 0, 30).'</a>'; 
								}
								?>
								<td class="contactus_td_long"><?php echo $v;?></td>
							<?php }	
						}?>
						<td class="contactus-td"><a href="index.php?option=com_contactus&view=feedback&id=<?php echo $feed->id;?>"><?php echo JText::_('COM_CONTACTUS_VIEW');?></a></td>
						<td class="contactus-td"><i class="fa fa-trash-o delete_class" onclick="delete_feed(this);" id="<?php echo $feed->id;?>"></i></td>
					</tr>
				<?php }
				?>
				</tr>
			</tbody>	
		</table>	
		<div>
			<ul class="pager">
				<li><a href="index.php?option=com_contactus&page=<?php echo $this->PreviousPage;?>" class="previous"><?php echo JText::_('COM_CONTACTUS_PREVIOUS');?></a></li>
				<li><a href="index.php?option=com_contactus&page=<?php echo $this->NextPage;?>" class="next"><?php echo JText::_('COM_CONTACTUS_NEXT');?></a></li>
			</ul>
		</div>	
	</div>
</div>
<script>
function delete_feed(feed)
{
	var con = confirm( "Delete this feed?" );
	if (con == true){
		del_id = feed.getAttribute("id");
		d = feed.parentNode.parentNode;
		d.parentNode.removeChild(d);
		
		var xhr = new XMLHttpRequest();
		
		var body = 'delete_id='+del_id;

		xhr.open("POST", 'index.php?option=com_contactus&task=deletefeed', true)
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		xhr.send(body);
	}	
}
var current = <?php echo $this->CurrentPage;?>;
if (current==1){
	var b = document.getElementsByClassName("previous");
	b[0].className = b[0].className + " disabled";
	b[0].onclick = function(){
		return false;
	};
}	
var max = <?php echo $this->MaxPage;?>;
if (current>= max){
	var a = document.getElementsByClassName("next");
	a[0].className = a[0].className + " disabled";
	a[0].onclick = function(){
		return false;
	};
}	
</script>