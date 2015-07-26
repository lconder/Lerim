$('select#tipo').on('change',function(){
    if($(this).val() == 0)
    {
		$('#divTipo').removeClass('hide');
		$('#nuevoTipo').attr("required", "true");
	}
    else
    {
    	$('#divTipo').addClass('hide');
    	$('#nuevoTipo').attr("required", false);
    }
});

$('#otroAnalisis').on('change',function(){
    if($(this).is(':checked'))
    {
        $('#nuevoNombre').attr("required", "true");
        $('#nuevaDescripcion').attr("required", "true");
    }
    else
    {
        $('#nuevoNombre').attr("required", false);
        $('#nuevaDescripcion').attr("required", false)
    }
});