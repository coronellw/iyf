function findUserCandidate(){
	var id_user = get("id_user").value;
	findCustomUser({id_user: id_user}).success(function(answer){
		var response = JSON.parse(answer);
		console.dir(response);
		if (response.result === "ok") {
			var user = response.user;
			console.dir(user);
			if (typeof user !== "undefined") {
				console.log("type of user not undefined");
				get("nombres").innerHTML = user.names;
				get("apellido1").innerHTML = user.parent_names;
				get("apellido2").innerHTML = user.maternal_name;
			} else{
				console.log("type of user is undefined");
				get("nombres").innerHTML = "";
				get("apellido1").innerHTML = "";
				get("apellido2").innerHTML = "";
			};
		} else{
			errorMsg("No se encontró usuario con ese id");
		};
	});
}