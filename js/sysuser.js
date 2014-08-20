function findUserCandidate(){
	var id_user = get("id_user").value;
	findCustomUser({id_user: id_user}).success(function(answer){
		var response = JSON.parse(answer);
		if (response.result === "ok") {
			var user = response.user;			
			if (typeof user !== "undefined") {				
				get("nombres").innerHTML = user.names;
				get("apellido1").innerHTML = user.parent_names;
				get("apellido2").innerHTML = user.maternal_name;
				if (user.usrnm && typeof user.usrnm !== "undefined" && user.usrnm.length > 0)  {
					errorMsg("Este usuario ya está registrado como usario del sistema, intente editarlo desde el <a href='index.php' class='alert-link' >listado de usuarios</a> del sistema");
					disableFields();
				}else{
					jQuery("#username").val(typeof user.usrnm !== "undefined" ? user.usrnm : "");
					jQuery("#username").prop('disabled', false);

					jQuery("#usertype").prop('disabled', false);
					jQuery("#usertype").prop('value', user.id_usertype);

					jQuery("#newPassword").val("");
					jQuery("#newPassword").prop('disabled', false);

					jQuery("#verification").val("");
					jQuery("#verification").prop('disabled', false);

					jQuery("#sndBtn").click(function(){
						requestUserCreation(user.id_user);
					});
				}
			} else{				
				disableFields();
			};
		} else{
			errorMsg("No se encontró usuario con ese id");
		};
	});
}

function disableFields(){
	jQuery("#nombres").html("");
	jQuery("#apellido1").html("");
	jQuery("#apellido2").html("");
	jQuery("#username").val("");
	jQuery("#password").val("");
	jQuery("#verification").val("");

	jQuery("#username").prop('disabled', true);
	jQuery("#usertype").prop('disabled', true);
	jQuery("#newPassword").prop('disabled', true);
	jQuery("#verification").prop('disabled', true);
}

function requestUserCreation(id_user){
	var username = jQuery("#username").val();
	var usertype = jQuery("#usertype").val();
	var pwd = jQuery("#newPassword").val();
	var verif = jQuery("#verification").val();
	var proof = get('password');
	var errors = [];
	var warnings = [];
	var override = true;
	var original = null;

	if (username.length === 0) {
		errors.push({msg: "El nombre de usuario es un requisito", type: "error"});
	}

	if (pwd.length === 0 || verif.length === 0 ) {
		errors.push({msg: "El password y su verificación son necesarios", type: "error"});			
	}

	if (pwd !== verif) {
		errors.push({msg: "El password y su verificación no coinciden, borre e intente nuevamente", type: "error"});
	}

	if (proof && typeof proof !== "undefined") {
		override = false;
		original = proof.value;
		if (original.length === 0) {
			errors.push({msg: "Debe proporcionar la contraseña actual de este usuario", type: "error"});
		}
	}

	if (errors.length === 0) {
		usernameUpdate({id_user: id_user, override: override, userInfo: {username: username, password: pwd, usertype: usertype, currentPassword: original}})
		.success(function(answer){
			
			var response = JSON.parse(answer);
			if (response.result === "ok") {
				disableFields();
				var loc = document.URL;
				var res = loc.match(/edit\.php/g);
				if (res && res.length > 0) {
					location.href = "index.php";
				} else{
					location.reload();
				}
				successMsg("El usuario ha sido actualizado correctamente!");
			}else{
				errorMsg("Se ha encontrado un error al intentar modificar el usuario, HINT: " + response.error_msg);
			}
		});
	}else {
		printErrors(errors);
	}
}

function deleteSysUser(id_user){
	var confirmed = confirm("Seguro que desea borrar este usaurio del sistema?");
	if (confirmed) {
		requestSysUserDelete(id_user).success(function(answer){
			var response = JSON.parse(answer);
			if (response!== 'undefined') {
				if (response.result === "ok") {
					location.reload();
					infoMsg("Transacción completa, " + response.info_msg);
				} else{
					errorMsg("No se pudo eliminar ese usuario del sistema, HINT: "+response.error_msg);
				}
			}else {
				errorMsg("Uncatched error");
			}
		});
	}
}

