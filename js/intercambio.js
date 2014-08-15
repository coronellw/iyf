var user1 = {};
var user2 = {};

function setUserOneInfo(){
	var id_user = get("cod1").value;
	user1 = {};
	findCustomUser({id_user:id_user, modalities:[1,2,3,4]}).success(function(data){
		var jsonData = JSON.parse(data);
		if (jsonData.result==="ok") {
			if (typeof jsonData.user !== 'undefined') {
				user1 = jsonData.user;
				get("name1").innerHTML = user1.names;
				get("apellidos1").innerHTML = user1.parent_names+" "+user1.maternal_name;
				get("sede1").innerHTML = user1.sede;
				if (typeof user2.id_user !== 'undefined') {
					if (user1.id_user === user2.id_user) {
						alert("ambos usuarios son el mismo");
					} else{
						// check group types and activate or not the swap button
					};
				}
			} else{
				errorMsg(jsonData.info_msg);
				get("name1").innerHTML = "";
				get("apellidos1").innerHTML = "";
				get("sede1").innerHTML = "";
			};
		} else{
			errorMsg("Ha ocurrido un error al ejecutar la consulta");
			get("name1").innerHTML = "";
			get("apellidos1").innerHTML = "";
			get("sede1").innerHTML = "";
		}
	});
}
function setUserTwoInfo(){
	var id_user = get("cod2").value;
	user2 = {};
	findCustomUser({id_user:id_user, modalities:[1,2,3,4]}).success(function(data){
		var jsonData = JSON.parse(data);
		if (jsonData.result==="ok") {
			if (typeof jsonData.user !== 'undefined') {
				user2 = jsonData.user;
				get("name2").innerHTML = user2.names;
				get("apellidos2").innerHTML = user2.parent_names+" "+user2.maternal_name;
				get("sede2").innerHTML = user2.sede;
				if (typeof user1.id_user !== 'undefined') {
					if (user1.id_user === user2.id_user) {
						alert("ambos usuarios son el mismo");
					} else{
						// check group types and activate or not the swap button
					}
				}
			} else{
				errorMsg(jsonData.info_msg);
				get("name2").innerHTML = "";
				get("apellidos2").innerHTML = "";
				get("sede2").innerHTML = "";
			};
		} else{
			errorMsg("Ha ocurrido un error al ejecutar la consulta");
			get("name2").innerHTML = "";
			get("apellidos2").innerHTML = "";
			get("sede2").innerHTML = "";
		}
	});
}