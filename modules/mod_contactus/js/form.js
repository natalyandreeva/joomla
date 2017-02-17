function contactus_validate(element)
{
	var inputs = element.getElementsByClassName("contactus-fields"),
		errorMessages = element.getElementsByClassName("contactus-error-message");
	for ( var i = errorMessages.length; i > 0; i-- ) {
			errorMessages[ i - 1].parentNode.removeChild( errorMessages[ i - 1] );
			console.log(i);
		}
	
	for (var i = 0; i < inputs.length; i++) {
		if ((inputs[i].hasAttribute("required")) &&(inputs[i].value.length == 0)) { 
			event.preventDefault();	
			parent = inputs[i].parentNode;
			parent.insertAdjacentHTML( "beforeend", "<div class='contactus-error-message'>" + 
			   type_field +
				"</div>" );
				console.log("ad" + i)
		}
	}	
}
function joomly_analytics(){
	if (contactus_params.yandex_metrika_id)
	{
		var yaCounter= new Ya.Metrika(contactus_params.yandex_metrika_id);
		yaCounter.reachGoal(contactus_params.yandex_metrika_goal);
	}
	if (contactus_params.google_analytics_category)
	{
		ga('send', 'event', contactus_params.google_analytics_category, contactus_params.google_analytics_action, contactus_params.google_analytics_label, contactus_params.google_analytics_value);
	}
}
window.addEventListener('load', lightbox(module_id), false); 
	function lightbox(mod_id){		
		if (sending_flag == 1){
			var lightbox = document.getElementById("contactus-sending-alert" + mod_id),
			dimmer = document.createElement("div"),
			close = document.getElementById("contactus-lightbox-sending-alert-close" + mod_id);
			
				dimmer.className = 'dimmer';
			
			dimmer.onclick = function(){
				lightbox.parentNode.removeChild(dimmer);			
				lightbox.style.display = 'none';
			}
			
			close.onclick = function(){
				lightbox.parentNode.removeChild(dimmer);			
				lightbox.style.display = 'none';
			}
				
			document.body.appendChild(dimmer);
			document.body.appendChild(lightbox);
			var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
			lightbox.style.display = 'block';
			if (window.innerHeight > lightbox.offsetHeight )
			{
				lightbox.style.top = scrollTop + (window.innerHeight- lightbox.offsetHeight)/2 + 'px';
			} else
			{
				lightbox.style.top = scrollTop + 10 + 'px';
			}
			if (window.innerWidth>400){
				lightbox.style.width = '400px';
				lightbox.style.left = (window.innerWidth - lightbox.offsetWidth)/2 + 'px';
			} else {
				lightbox.style.width = (window.innerWidth - 70) + 'px';
				lightbox.style.left = (window.innerWidth - lightbox.offsetWidth)/2 + 'px';
			}	
			
			setTimeout(remove_alert, 6000);
			
			function remove_alert()
			{
				lightbox.parentNode.removeChild(dimmer);			
				lightbox.style.display = 'none';
			}
		}	
}