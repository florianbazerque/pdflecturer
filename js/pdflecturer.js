$(document).ready(function(){
	$('#search').keyup(function(){
		var search = $(this).val();
		search = $.trim(search);

		$.post('php/pdflecturer.php',{search:search},function(data){
			$('#resultat ul').html(data);
		});
	})	

	$('#resultat').on('click', 'button', function(){
    	var viewer = $('#viewpdf');
    	var file = $(this).attr('value');
		PDFObject.embed('pdf/' + file, viewer);
	});

});