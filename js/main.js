var phones = [];
var mex = false;
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
    var name = get("names").value;
    var parent_name = get("parent_name").value;
    var maternal_name = get("maternal_name").value;
    var genre = jQuery('input[name="sex"]:checked').val();
    var birthdate = get("birthdate").value;
    var scholarity = jQuery('input[name="education"]:checked').val();
    var contacts = phones;
    var id_country = get("country").value;
    var id_city = get("city").value;
    var id_hq = get("hq").value;
    var email = get("email").value;
    var id_modality = get("modality").value;
    var id_publicity = get("publicity").value;
    var hosted = jQuery('input[name="hosted"]:checked').val();
    var assistance = jQuery('input[name="assistance"]:checked').val();
    var price = get("price").value;
    var url = root + "requests/createUser.php"

    console.log("{\nname: " + name + ",\nparent_name: " + parent_name + ",\nmaternal_name:" + maternal_name + ",\nemail: "
            + email + ",\ngenre: " + genre + ",\neducation: " + scholarity + ",\nid_country: " + id_country +
            ",\nid_city:" + id_city + ",\nid_hq: " + id_hq + ",\nemail" + email + ",\nid_modality: " + id_modality +
            ",\nid_publicity: " + id_publicity + ",\nhosted: " + hosted + ",\nassistance: " + assistance +
            ",\nprice" + price + "\n}");
    jQuery.ajax({
        type: "POST",
        url: url,
        data: {name: name, parent_name: parent_name, maternal_name: maternal_name, genre: genre, born: birthdate,
            scholarity: scholarity, contacts: contacts, id_country: id_country, id_city: id_city, id_hq: id_hq, email: email,
            id_modality: id_modality, id_publicity: id_publicity, hosted: hosted, assistance: assistance, pirce: price}
    }).success(function() {
        console.log("The user was saved on the data base");
    }).fail(function() {
        console.log("There was an error while performing this operation")
    });
}

function updateStates() {
    var id_country = get("country").value;
    var url = root + "requests/getStates.php";
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
    var url = root + "requests/getCities.php";
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
        price = "90";
    } else {
        if (hosted === '1') {
            price = "45";
        } else {
            price = "25";
        }
    }

    get("price").innerHTML = price;
}

function mask() {
    jQuery("#birthdate").mask("99/99/9999");
}