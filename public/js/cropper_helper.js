/* 	
	attache un input de type fichier à un 'cropper' de
	telle sorte que le choix d'une image modifie le cropper
 */
function attachFileInputToCropper( file_input_id , cropper_id , error_id )
{
	$('#'+file_input_id).change(function(){

		var file = this.files[0]; 

		if( file.type != "image/png" && 
			file.type != "image/jpg" && 
			file.type != "image/jpeg" ){
			$('#'+error_id).html('Choisissez une image SVP');
		}
		else{
			$('#'+error_id).html('');			
			var reader = new FileReader();
			reader.onload = function(e){
				//console.log(e.target.result);
				$('#'+cropper_id).cropper('replace' , e.target.result);				
			}
			reader.readAsDataURL(file);	
		}
	});
}

/*
	initialise tous les croppers de la page
*/
function initCroppers()
{
	$('.cropper').cropper({
		scalable:false,
		rotatable:false,
	});
}

/*
	retourne les données d'un 'cropper' au format JSON
*/
function getCropperData(cropper_id)
{
	return  $('#'+cropper_id).cropper('getData');
}
