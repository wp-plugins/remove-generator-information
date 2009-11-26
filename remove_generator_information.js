jQuery(document).ready(function(){
	
  if(jQuery("input.checkbox_no_generator_metatag:checked").length==7){
    jQuery("#no_generator_select_unselect").attr("checked","true");
  }	
	
  jQuery("#no_generator_select_unselect").click(function(){
	  if (jQuery(this).attr("checked")){
		  jQuery("input.checkbox_no_generator_metatag").attr("checked","true");
	  }else{
		  jQuery("input.checkbox_no_generator_metatag").attr("checked","");
	  }
  })
});