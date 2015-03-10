//@prepros-prepend ../Libraries/bower_components/jquery/dist/jquery.js
//@prepros-prepend ../Libraries/bower_components/modernizr/modernizr.js
//@prepros-prepend ../Libraries/bower_components/foundation/js/foundation.js
//@prepros-prepend ../Libraries/bower_components/foundation/js/foundation/foundation.abide.js
//@prepros-prepend ../Libraries/bower_components/foundation/js/foundation/foundation.reveal.js
//@prepros-prepend ../Libraries/bower_components/foundation/js/foundation/foundation.topbar.js
//@prepros-prepend ../Libraries/bower_components/foundation/js/foundation/foundation.alert.js
//@prepros-prepend ../Libraries/bower_components/foundation-datepicker/js/foundation-datepicker.js

$(document).foundation();
$('.fdatepicker').fdatepicker({'format':'dd.mm.yyyy'});
$( document ).ready(function() {
	$('#addPosition').click(function() {
		addReimbursementPosition();
	});
});


function addReimbursementPosition() {
	//var $counter = 0;
	var $counter = $('#positions > div').length;
	var $content = $('#firstPosition').first().html();
	$content = replaceAll($content, '[entries][0][', '[entries]['+$counter.toString()+'][');
	$('#positions').append('<div id="position_'+$counter+'" class="position row">'+$content+'</div>');
	registerEventHandler();

}

function replaceAll(string, find, replace) {
	return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function registerEventHandler() {
	$('.removeRow').click(function() {
		//console.log($(this).parent().parent());
		$(this).parent().parent().remove();
	});
}

function escapeRegExp(string) {
	return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}