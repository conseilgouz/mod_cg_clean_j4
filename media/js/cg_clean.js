/* 
 * @module		CG_Clean for Joomla 4.x/5.x
 * @author		ConseilGouz
 * @license		GNU General Public License version 3 or later
 * Suite aux discussions https://forum.joomla.fr/node/1970249
 * logique reprise depuis lm_memo https://lomart.fr/extensions/lm-memo
 */
var cgcleanoptions;
document.addEventListener("DOMContentLoaded", function(){
  	cgcleanoptions = Joomla.getOptions('cgclean');
	if (typeof cgcleanoptions === 'undefined' ) {return false}

	var btn = document.querySelector('#clean_btn'+cgcleanoptions.id);
	btn.addEventListener ('click', function() {
        var csrf = Joomla.getOptions("csrf.token", "");
        var url = "?"+csrf+"=1&option=com_ajax&module=cg_clean&data=cg_clean&format=raw";
        Joomla.request({
            method : 'POST',
            url : url,
            onSuccess: function(data, xhr) {
				alert(data); 
				btn.style.display = "none";
            },
        }) 
        return false;
    })
    btn.style.color = cgcleanoptions.btncolor; 
	btn.style.backgroundColor = cgcleanoptions.btnbgcolor;    
})
