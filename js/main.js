var phones = [];
var mex = false;
var timeout = 0;
function get(elem) {
    return document.getElementById(elem);
}

function toggleAccountInfo() {
    jQuery("#account_info").fadeToggle();
}

function addPhone() {
    var valid = true;
    var contactValue = get("phone").value;
    var contactType = get("contact_type").value;
    var elem = get("contact_type");
    var contactTypeName = elem.options[elem.selectedIndex].text;

    var obj = get("elem-" + contactValue + "-" + contactType);

    if (obj !== null) {
        console.log("repeated value");
        valid = false;
    }

    if (contactValue.length < 1) {
        console.log("Value is empty");
        valid = false;
    }

    if (contactType === "2" || contactType === "1") {
        if (isNaN(contactValue)) {
            valid = false;
            console.log("That isn't a valid number");
        }
    }

    if (valid) {
        var li = document.createElement("li");
        var deleteLink = document.createElement("a");

        // sets the id so that we can find and identify this element
        li.id = "elem-" + contactValue + "-" + contactType;

        // creates a link in order to remove a number in the event it is mistaken
        deleteLink.setAttribute("onclick", 'deletePhone("' + li.id + '")'); // onclick = deletePhone;
        deleteLink.innerHTML = "delete";

        // add the contents of the item
        li.innerHTML = contactValue + " - " + contactTypeName + " ";
        li.appendChild(deleteLink);

        // finally add it to the phones list
        document.getElementById("phones").appendChild(li);

        // clear the value for next item to insert
        document.getElementById("phone").value = "";
        // saves the element in a global phones lists
        phones.push({type: contactType, value: contactValue});
    }
}

function deletePhone(elem) {
    var elems = elem.split("-");
    var value = elems[1];
    var contactType = elems[2];
    var index = -1;

    for (var i in phones) {
        var phone = phones[i];
        if (phone.type === contactType && phone.value === value) {
            index = i;
        }
    }

    if (index > -1) {
        phones.splice(index, 1);
        var del = document.getElementById(elem);
        document.getElementById("phones").removeChild(del);
    }
}

function requestRegistration() {
    var validations = {};
    validations = checkRequiredContacts(validations);
    var name = get("names").value;

    if (name.length === 0) {
        validations.errors.push({msg: "El nombre es obligatorio", title: "Sin nombre"});
    }

    var parent_name = get("parent_name").value;
    var maternal_name = get("maternal_name").value;
    var genre = jQuery('input[name="sex"]:checked').val();
    if (genre !== 'F' && genre !== 'M') {
        validations.errors.push({msg: "Por favor seleccione su sexo", title: "Sexualidad"});
    }
    var birthdate = get("birthdate").value;
    if (birthdate.length === 0) {
        validations.errors.push({msg: "Por favor proporcione su fecha de nacimiento", title: "Fecha de nacimiento"});
    }
    var scholarity = jQuery('input[name="education"]:checked').val();
    if (scholarity === 'undefined') {
        validations.errors.push({msg: "No ha seleccionado su nivel escolar", title: "Escolaridad"});
    }
    var contacts = phones;
    var id_country = get("country").value;
    if (id_country.length === 0) {
        validations.errors.push({msg: "El país de origen es obligatorio", title: "País de origen"});
    }
    var id_city = get("city").value;
    var id_hq = get("hq").value;
    if (id_hq.length === 'null') {
        validations.errors.push({msg: "Debe seleccionar una sede", title: "Sede"});
    }
    var email = get("email").value;
    if (email.length === 0) {
        validations.errors.push({msg: "Por favor proporcione un correo electronico", title: "Correo electrónico"});
    }
    var id_modality = get("modality").value;
    var id_publicity = get("publicity").value;
    var hosted = jQuery('input[name="hosted"]:checked').val();
    var assistance = jQuery('input[name="assistance"]:checked').val();
    var price = get("price").innerHTML;
    var username;
    var usertype;
    var password;
    var password_confirmation;

    var sysUser = get('register_system_user');

    if (sysUser !== null) {
        if (sysUser !== 'undefined' && sysUser.checked) {
            username = jQuery("#username").val();
            usertype = jQuery("#usertype").val();
            password = jQuery("#password").val();
            password_confirmation = jQuery("#password_confirmation").val();

            if (username.length === 0) {
                validations.errors.push({msg: "Proporcione un nombre de usuario", title: "Nombre de usuario incorrecto"});
            }

            if (password.length < 6) {
                validations.errors.push({msg: "Su contraseña es muy corta", title: "Contraseña no valida"});
            }

            if (password !== password_confirmation) {
                validations.errors.push({msg: "La contraseña y la confirmación no coinciden", title: "Contraseña no concuerda"});
            }
        }
    }

    if (!get('rules').checked) {
        validations.errors.push({msg: "Usted debe leer y aceptar el reglamento para poder asistir al campamento", title: "Reglamento"});
    }

    var url = "/requests/createUser.php";
    var msg = "";

    if (validations.errors === "undefined" || validations.errors.length === 0) {
        jQuery.ajax({
            type: "POST",
            url: url,
            data: {name: name, parent_name: parent_name, maternal_name: maternal_name, genre: genre, born: birthdate,
                scholarity: scholarity, contacts: contacts, id_country: id_country, id_city: id_city, id_hq: id_hq, email: email,
                id_modality: id_modality, id_publicity: id_publicity, hosted: hosted, assistance: assistance, price: price,
                username: username, id_usertype: usertype, password: password}
        }).success(function(data) {
            var datos = JSON.parse(data);
            if (datos.result === "ok") {
                var registerer = get('registered_by').value;
                alert(registerer+" and event started ="+datos.event_started);
                if (datos.event_started == true && registerer !== '100002') {
                    makePayment(datos.id_user, price, 2, registerer).success(function(answer){
                        var response = JSON.parse(answer);
                        msg = response.info_msg || response.error_msg;
                    });
                    getGroupForUser(datos.id_user).success(function(answer){
                        var response = JSON.parse(answer);
                        if (response.result === "ok") {
                            alert(msg+"\nMaestro asignado: "+ response.asignacion.group.professor+"\nNombre del grupo: "+response.asignacion.group.name);
                        } else {
                            alert("No se ha podido asignar un grupo, verifique con su superior");
                        }
                        location.href = "/users/view.php?user=" + datos.id_user;
                    });
                }else{
                    location.href = "/users/view.php?user=" + datos.id_user;
                }
            } else {
                get("alerts").innerHTML = '<div class="alert alert-danger" role="alert">El usuario no pudo ser creado en la base de datos, verifique su información. <br><strong>Hint:</strong> ' + datos.error_msg + '</div>';
            }
        }).fail(function() {
            console.log("There was an error while performing this operation");
            errorMsg("No se pudo establecer contacto para su request, intente más tarde, si el problema persiste comuniquese con un administrador del sistema");
        });
    } else {
        printErrors(validations.errors);
    }
}

function checkRequiredContacts(validations) {
    var home = get('home_phone').value;
    var cell = get('cell_phone').value;
    var errores = [];
    var warnings = [];

    if (home.length === 0 || isNaN(home)) {
        errores.push({msg: "El contacto de casa no es un número válido", title: "Contacto incorrecto"});
    } else {
        if (isUnique(home)) {
            phones.push({type: "1", value: home});
        } else {
            warnings.push({msg: "El contacto de casa ya esta registrado en los telefonos", title: "Contacto incorrecto"});
        }
    }

    if (cell.length === 0 || isNaN(cell)) {
        errores.push({msg: "El contacto de celular no es un número válido", title: "Celular incorrecto"});
    } else {
        if (isUnique(cell)) {
            phones.push({type: "2", value: cell});
        } else {
            warnings.push({msg: "El contacto de celular ya esta registrado en los telefonos", title: "Celular incorrecto"});
        }
    }

    validations.errors = errores;
    validations.warnings = warnings;
    console.log("Returning: " + validations.errors + "\nFound errors:" + errores);
    return validations;
}

function isUnique(number) {
    for (var phone in phones) {
        var current = phones[phone];
        if (current.value === number) {
            return false;
        }
    }
    return true;
}

function updateStates() {
    var id_country = get("country").value;
    var url = "/requests/getStates.php";
    var options = document.getElementsByName("hosted");
    mex = id_country === 'MEX' ? true : false;

    if (mex) {
        for (var i = 0; i < options.length; i++) {
            options[i].disabled = false;
        }
    } else {
        for (var i = 0; i < options.length; i++) {
            options[i].disabled = true;
        }
    }
    get("hosted").checked = true;
    recalcPrice();

    jQuery.ajax({
        type: "POST",
        url: url,
        data: {"id_country": id_country}
    }).success(function(data) {
        get("state").innerHTML = data;
    }).fail(function() {
        console.log("Could not complete request");
    });
}

function updateCities() {
    var state = get("state").value;
    var id_country = get("country").value;
    var url = "/requests/getCities.php";
    jQuery.ajax({
        type: 'POST',
        url: url,
        data: {"state": state, "id_country": id_country}
    }).success(function(data) {
        get("city").innerHTML = data;
    }).fail(function() {
        console.log("Could not complete request");
    });
}

function recalcPrice() {
    var hosted = jQuery('input[name="hosted"]:checked').val();
    var price = 0;
    if (!mex) {
        price = "780";
    } else {
        if (hosted === '1') {
            price = "700";
        } else {
            price = "350";
        }
    }

    get("price").innerHTML = price;
}

function requestLogin() {
    var username = get("username").value;
    var password = get("password").value;
    var url = "/requests/createSession.php";

    console.log("requesting login for user " + username + " and btw the url is " + url);

    jQuery.ajax({
        type: "POST",
        url: url,
        data: {username: username, password: password}
    }).success(function(data) {
        if (data !== "fail") {
            window.location.href = "index.php";
        } else {
            console.log("Error, invalid credentials.");
        }
    });
}

function logout() {
    var url = "/requests/destroySession.php";
    jQuery.ajax({
        type: "POST",
        url: url
    }).success(function(data) {
        if (data === "ok") {
            window.location.href = "/login.php";
        }
    });
}

function successMsg(msg) {
    var closeable = '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
    get("alerts").innerHTML = '<div class="alert alert-success alert-dismissible" role="alert">' + closeable + msg + '</div>';
}
function warningMsg(msg) {
    var closeable = '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
    get("alerts").innerHTML = '<div class="alert alert-warning alert-dismissible" role="alert">' + closeable + msg + '</div>';
}
function errorMsg(msg) {
    var closeable = '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
    get("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert">' + closeable + msg + '</div>';
}
function infoMsg(msg) {
    var closeable = '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
    get("alerts").innerHTML = '<div class="alert alert-info alert-dismissible" role="alert">' + closeable + msg + '</div>';
}

function printErrors(errors) {
    var message = "<ul>";
    for (var index in errors) {
        var current = errors[index];
        message += "<li>" + current.msg + "</li>";
    }
    message += "</ul>";
    errorMsg(message);
}

function printErrors(warnings) {
    var message = "<ul>";
    for (var index in warnings) {
        var current = warnings[index];
        message += "<li>" + current.msg + "</li>";
    }
    message += "</ul>";
    warningMsg(message);
}

function findUser() {
    var id_user = jQuery("#user_id").val();
    var url = "/requests/getUser.php";
    jQuery.ajax({
        type: "GET",
        url: url,
        data: {id_user: id_user, format: "json"}
    }).success(function(data) {
        if (data !== "fail") {
            var jsonData = JSON.parse(data);
//            getGroups(jsonData.id_user);
            get("names").innerHTML = jsonData.names;
            get("parent").innerHTML = jsonData.parent_names;
            get("maternal").innerHTML = jsonData.maternal_name;
            get("country").innerHTML = jsonData.country_name;
            get("pays").innerHTML = jsonData.pays;
            get("paid").innerHTML = jsonData.paid;
            get("pending").innerHTML = jsonData.pending;
            get("register_payment").href = "create.php?user=" + jsonData.id_user;
            get("print_barcode").href = "/users/view.php?user=" + jsonData.id_user;
            jQuery("#assistance").click(function() {
                changeAssistance(jsonData.id_user);
            });

            if (jsonData.assistance === '1') {
                jQuery("#assistance").html("REVOCAR ASISTENCIA");
                get("can_assist").innerHTML = "Si";
                get("register_payment").style.display = "none";
            } else {
                jQuery("#assistance").html("APROBAR ASISTENCIA");
                get("can_assist").innerHTML = "No";
                get("register_payment").style.display = "inline-block";
            }

            jQuery.ajax({
                type: "GET",
                url: "/requests/getPayments.php",
                data: {id_user: jsonData.id_user}
            }).success(function(data) {
                //console.dir(data);
                get("payments").innerHTML = data;
            });
        } else {
            window.clearTimeout(timeout);
            errorMsg("Usuario no encontrado");
            get("names").innerHTML = "";
            get("parent").innerHTML = "";
            get("maternal").innerHTML = "";
            get("country").innerHTML = "";
            get("pays").innerHTML = "";
            get("paid").innerHTML = "";
            get("pending").innerHTML = "";
            get("can_assist").innerHTML = "";
            get("payments").innerHTML = "";
            get("register_payment").href = "#";
            get("print_barcode").href = "#";

            timeout = setTimeout(function() {
                jQuery(".close").click();
            }, 2500);
        }
    });
}

function findUserRequest(options) {
    var id_user = jQuery("#user_id").val();
    var url = "/requests/getCustomUser.php";
    var respuesta = {};

    return jQuery.ajax({
        type: "GET",
        url: url,
        data: {id_user: id_user, format: "json", modalities: options.modalities}
    });
}

function findCustomUser(options) {
    var url = "/requests/getCustomUser.php";

    return jQuery.ajax({
        type: "GET",
        url: url,
        data: {id_user: options.id_user, format: "json", modalities: options.modalities}
    });
}

function getMaestro(options) {
    findUserRequest(options).success(function(data) {
        var jsonData = JSON.parse(data);
        
        if (jsonData.result==="ok") {
            console.log("ok");
            if (typeof jsonData.user !== 'undefined') {
                if (jsonData.user.checked === '0') {
                    get("id").innerHTML = jsonData.user.id_user;
                    get("nombres").innerHTML = jsonData.user.names;
                    get("apellidos").innerHTML = jsonData.user.parent_names + " " + jsonData.user.maternal_name;
                    get("sede").innerHTML = jsonData.user.sede;
                    get("mail").innerHTML = jsonData.user.email;
                    jQuery("#btnCnf").click(function(){ confirmarAsistenciaMaestro(jsonData.user.id_user); }); 
                    jQuery("#maestroModal").modal();    
                } else{
                    var sex = jsonData.user.genre === 'M'?'o':'a';
                    warningMsg(jsonData.user.names +" "+jsonData.user.parent_names+" "+jsonData.user.maternal_name +" ya ha sido confirmad"+sex+" como maestr"+sex);
                    clickClose();
                }
            } else{
                errorMsg("No se encontro un maestro con esa información");
                clickClose();
            };
        } else {
            console.log("not ok");
            errorMsg("unable to complete query");
            clickClose();
        }
    });
    
}

function getEstudiante(options){
    findUserRequest(options).success(function(data){
        var jsonData = JSON.parse(data);
        if (jsonData.result==="ok") {
            if (typeof jsonData.user !== 'undefined') {
                get("id").innerHTML = jsonData.user.id_user;
                get("nombres").innerHTML = jsonData.user.names;
                get("apellidos").innerHTML = jsonData.user.parent_names + " " + jsonData.user.maternal_name;
                get("sede").innerHTML = jsonData.user.sede;
                get("mail").innerHTML = jsonData.user.email;
                jQuery("#btnCnf").click(function(){});

                if (jsonData.user.checked === '0') {
                    jQuery("#btnCnf").click(function(){ confirmarAsistenciaEstudiante(jsonData.user.id_user); });
                    jQuery("#btnCnf").removeClass('hidden');
                } else{
                    jQuery("#btnCnf").addClass('hidden');
                    var sex = jsonData.user.genre === 'M'?'o':'a';
                    warningMsg(jsonData.user.names +" "+jsonData.user.parent_names+" "+jsonData.user.maternal_name +" ya ha sido confirmad"+sex+" como estudiante");
                    clickClose();
                }
                setGroupInfo(jsonData.user.id_group);
            } else{
                warningMsg("No se encontro un estudiante con esa información");
                clickClose();
                get("id").innerHTML = "";
                get("nombres").innerHTML = "";
                get("apellidos").innerHTML = "";
                get("sede").innerHTML = "";
                get("mail").innerHTML = "";
                get("grupo").innerHTML = "No encontrado";
                get("maestro").innerHTML = "No encontrado";
                jQuery("#btnCnf").addClass('hidden');
                
                jQuery("#btnCnf").click(function(){});
                jQuery("btnCnf").addClass('hidden');
            };
        } else{
            console.log("not ok");
            errorMsg("unable to complete query");
        };
    });
}

function clickClose(){
    timeout = setTimeout(function() {
        jQuery(".close").click();
    }, 2500);
}

function setGroupInfo(id_group){
    get("grupo").innerHTML = "No encontrado";
    get("maestro").innerHTML = "No encontrado";
    getGroup(id_group).success(function(data){
        var jsonData = JSON.parse(data);
        if (jsonData.result === "ok") {
            if (jsonData.group !== "undefined") {
                get("grupo").innerHTML = jsonData.group.name;
                get("maestro").innerHTML = jsonData.group.professor;
            }
        }        
    });
}

function getGroups(id_user) {
    jQuery.ajax({
        type: "GET",
        url: "/requests/getGroupsForUser.php",
        data: {user: id_user}
    }).success(function(data) {
        var jsonData = JSON.parse(data);
        if (jsonData.result === "ok") {
            console.dir(jsonData.groups);
        }
    }).fail(function() {
        console.log("Unable to complete this request");
    });
}

function getGroupForUser(id_user){
    return jQuery.ajax({
        type: "GET",
        url: "/requests/getGroupsForUser.php",
        data: {user: id_user}
    });
}

function makePayment(options) {
    var registered_by = options.registered_by;
    var registered_to = options.registered_to;
    var total_payment = options.total_payment;

    var payment = get("amount").value;
    var payment_method = get("payment_method").value;
    var msg = "El pago es valido";

    if ((parseFloat(payment) > parseFloat(options.pending)) || (isNaN(payment))) {
        msg = "El pago es invalido";
        alert("El monto a cancelar excede al saldo pendiente, corrija su transacción e intente de nuevo");
    } else {
        jQuery.ajax({
            type: "POST",
            url: "/requests/createPayment.php",
            data: {payer: registered_to,
                amount: payment,
                payment_type: payment_method,
                registerer: registered_by}
        }).success(function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData.result === "ok") {
                location.reload();
                if (typeof jsonData.info_msg !== "undefined") {
                    infoMsg(jsonData.info_msg);
                    console.dir(jsonData);
                }
                console.log("Transaction complete");
            } else {
                errorMsg(jsonData.error_msg);
            }

        });
    }

    console.log(msg +
            "\nRegistrado por : " + registered_by +
            "\nRegistrado para : " + registered_to +
            "\nCantidad : " + payment +
            "\nMetodo : " + payment_method +
            "\nA pagar : " + total_payment +
            "\nPendiente : " + options.pending
            );
}

function changeAssistance(id_user) {
    jQuery.ajax({
        type: "POST",
        url: "/requests/toggleAssistance.php",
        data: {id_user: id_user}
    }).success(function(data) {
        if (data === "ok") {
            console.log("Assistance updated!");
            var assistance = jQuery("#can_assist").html() === "Si" ? "No" : "Si";
            jQuery("#can_assist").html(assistance);
            var assistance = assistance === "Si" ? "REVOCAR ASISTENCIA" : "APROBAR ASISTENCIA";
            jQuery("#assistance").html(assistance);
            jQuery("#register_payment").toggle();
        }
    });
}

function sendUserEditRequest(id_user, id_country) {
    var user = {};
    var errors = [];
    user.id_user = id_user;
    user.names = get('nombre').value;
    if (user.names.length === 0) {
        errors.push({msg: "El nombre es obligatorio", title: "Sin nombre"});
    }
    user.birthdate = get('birthdate').value;
    console.log("Bdate is " + user.birthdate);
    if (user.birthdate.length === 0) {
        errors.push({msg: "Por favor proporcione su fecha de nacimiento", title: "Fecha de nacimiento"});
    }
    user.parent_names = get('apellido1').value;
    user.maternal_name = get('apellido2').value;
    user.modality = get("modality").value;
    user.scholarity = jQuery('input[name="education"]:checked').val();

    if (user.scholarity === 'undefined') {
        errors.push({msg: "No ha seleccionado su nivel escolar", title: "Escolaridad"});
    }
    user.id_headquarters = get('hq').value;
    if (user.id_headquarters.length === 'null') {
        errors.push({msg: "Debe seleccionar una sede", title: "Sede"});
    }
    user.hosted = jQuery('input[name="hosted"]:checked').val();
    
    user.country = id_country;

    if (errors.length === 0) {
        jQuery.ajax({
            type: "POST",
            url: "/requests/updateUser.php",
            data: {user: user}
        }).success(function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData.result === 'ok') {
                window.location.href = "/users/view.php?user=" + jsonData.id_user;
                successMsg("El usuario se actualizo correctamente");
            } else {
                errorMsg("No se pudo actualizar el usuario.\nHINT: " + jsonData.error_msg);
            }
        });
    } else {
        printErrors(errors);
    }
}

function toggleChecked(id_user){
    return jQuery.ajax({
        type: "POST",
        url: "/requests/toggleChecked.php",
        data: {id_user: id_user}
    });
}

function confirmarAsistenciaEstudiante(id_user){
    asignarGrupo(id_user).success(function(data){
        jsonData = JSON.parse(data);
        if (jsonData.result === "ok") {
            successMsg("El esutidante ha sido confirmado");
            setGroupInfo(jsonData.asignacion.group.id_group);
        } else{
            errorMsg("Al parecer hubo un error al confirmar al estudiante, contacte al supervisor y/o administrador del sistema. HINT: "+ jsonData.error_msg+". "+jsonData.info_msg);
        };

        clickClose();
    });
}
function confirmarAsistenciaMaestro(id_user){
    toggleChecked(id_user).success(function(data){
        jsonData = JSON.parse(data);
        if (jsonData.result === "ok") {
            successMsg("El maestro ha sido confirmado");
        } else{
            errorMsg("No se pudo confirmar al maestro, contacte al supervisor y/o administrador del sistema. HINT: "+ jsonData.error_msg+". "+jsonData.info_msg);
        };
        clickClose();
    });
}

function asignarGrupo(id_user){
    return jQuery.ajax({
        type: "GET",
        url: "/requests/getGroupsForUser.php",
        data: {user: id_user}
    });
}

// RETORNA EL GRUPO A PARTIR DEL ID DEL USUARIO
function getGrupo(id_user){
    return jQuery.ajax({
        type: "GET",
        url: "/requests/getGroupInfo.php",
        data: {user: id_user}
    });
}

// RETRONA LA INFORMACION DEL GRUPO A PARTIR DEL ID DEL GRUPO
function getGroup(id_group){
    return jQuery.ajax({
        type: "GET",
        url: "/requests/getGroup.php",
        data: {group: id_group}
    });   
}

// BORRA UN USUARIO BASADO EN SU ID
function deleteUser(id_user){
    var k = confirm('Seguro que desa borrar este usuario del sistema?');
    if (k) {
        return jQuery.ajax({
            type: "GET",
            url: "/requests/deleteUser.php",
            data: {user: id_user}
        }).success(function(data){
            var jsonData = JSON.parse(data);
            if (jsonData.result === "ok") {
                location.reload();
                infoMsg(jsonData.info_msg);
            } else{
                errorMsg("No se pudo borrar el usuario. HINT: "+ jsonData.error_msg);
            };
        });
    }
}

function usernameUpdate(options){
    return jQuery.ajax({
        type: "POST",
        url: "/requests/updateUsername.php",
        data: {id_user: options.id_user, override: options.override, userInfo: options.userInfo}
    });
}

function requestSysUserDelete(id_user){
    return jQuery.ajax({
        type: "POST",
        url: "/requests/deleteSysUser.php",
        data: {user: id_user}
    });
}

function makePayment(registered_to, payment, payment_method, registered_by){
    return jQuery.ajax({
            type: "POST",
            url: "/requests/createPayment.php",
            data: {payer: registered_to,
                amount: payment,
                payment_type: payment_method,
                registerer: registered_by}
        });
}