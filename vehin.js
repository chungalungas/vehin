// jQuery codes
$(document).ready(()=>{
    // show sign up / registration form
    $(document).on('click', '#sign_up', () => {
        let html = `
            <h2>Sign Up</h2>
            <form id='sign_up_form'>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required />
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required />
                </div>

                <button type='submit' class='btn btn-primary'>Sign Up</button>
            </form>
            `;

        clearResponse();
        $('#content').html(html);
    });

	// show login form
	$(document).on('click', '#login', () => {
		showLoginPage();
	});

	// show Dashboard
	$(document).on('click', '#dashboard', () => {
		showDashboard();
		clearResponse();
	});

	// show add vehicle form
	$(document).on('click', '#add_vehicle', () => {
		showAddVehicleForm();
	});

	// logout the user
	$(document).on('click', '#logout', () => {
		showLoginPage();
		$('#response').html("<div class='alert alert-info'>You are logged out.</div>");
	});

	// trigger when registration form is submitted
	$(document).on('submit', '#sign_up_form', e => {

		// get form data
		let sign_up_form = $(e.target);
		let form_data=JSON.stringify(sign_up_form.serializeObject());

		// submit form data to api
		$.ajax({
			url: "api/create_user.php",
			type : "POST",
			contentType : 'application/json',
			data : form_data,
			success : function(result) {
				// if response is a success, tell the user it was a successful sign up & empty the input boxes
				$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
				sign_up_form.find('input').val('');
			},
			error: function(xhr, resp, text){
				// on error, tell the user sign up failed
				$('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
			}
		});

		return false;
	});

	// trigger when login form is submitted
	$(document).on('submit', '#login_form', e => {

		// get form data
		let login_form=$(e.target);
		let form_data=JSON.stringify(login_form.serializeObject());

		// submit form data to api
		$.ajax({
			url: "api/login.php",
			type : "POST",
			contentType : 'application/json',
			data : form_data,
			success : function(result){

				// store jwt to cookie
				setCookie("jwt", result.jwt, 1);

				// show dashboard & tell the user it was a successful login
				showDashboard();
				$('#response').html("<div class='alert alert-success'>Successful login.</div>");

			},
			error: function(xhr, resp, text){
				// on error, tell the user login has failed & empty the input boxes
				$('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
				login_form.find('input').val('');
			}
		});

		return false;
	});

	// trigger when 'add vehicle' form is submitted
	$(document).on('submit', '#add_vehicle_form', e => {

		// handle for add_vehicle_form
		let add_vehicle_form=$(e.target);

		// validate jwt to verify access
		let jwt = getCookie('jwt');

		// get form data and set the url for the correct call
		let add_vehicle_form_obj = add_vehicle_form.serializeObject();
		let type = add_vehicle_form_obj.type;
		let url = "api/add_" + type.toLowerCase() + ".php";

		// add jwt on the object
		add_vehicle_form_obj.jwt = jwt;

		// convert object to json string
		let form_data=JSON.stringify(add_vehicle_form_obj);

		// submit form data to api
		$.ajax({
			url: url,
			type : "POST",
			contentType : 'application/json',
			data : form_data,
			success : function(result) {

				// tell the vehicle was addee
				$('#response').html("<div class='alert alert-success'>"+result.message+"</div>");

				// store new jwt to coookie
				setCookie("jwt", result.jwt, 1);

				// clear vehicle form
				clearVehicleForm();
			},

			// show error message to user
			error: function(xhr, resp, text){
				if(xhr.responseJSON.message=="Unable to add the vehicle."){
					$('#response').html("<div class='alert alert-danger'>Unable to add the "+type+".</div>");
				}

				else if(xhr.responseJSON.message=="Access denied."){
					showLoginPage();
					$('#response').html("<div class='alert alert-success'>Access denied. Please login</div>");
				}

				else {
					$('#response').html("<div class='alert alert-danger'>Unknown error</div>");
				}
			}
		});

		return false;
	});

	// clear vehicle formulary
	function clearVehicleForm(){
		$('#type').val('');
		$('#hp').val('');
	}


	// remove any prompt messages
	function clearResponse(){
		$('#response').html('');
	}

	// show login page
	function showLoginPage(){

		// remove jwt
		setCookie("jwt", "", 1);

		// login page html
		let html = `
			<h2>Login</h2>
			<form id='login_form'>
				<div class='form-group'>
					<label for='email'>Email address</label>
					<input type='email' class='form-control' id='email' name='email' placeholder='Enter email' required>
				</div>

				<div class='form-group'>
					<label for='password'>Password</label>
					<input type='password' class='form-control' id='password' name='password' placeholder='Password' required>
				</div>

				<button type='submit' class='btn btn-primary'>Login</button>
			</form>
			`;

		$('#content').html(html);
		clearResponse();
		showLoggedOutMenu();
	}

	// if the user is logged in
	function showLoggedInMenu(){
		// hide login and sign up from navbar & show logout button
		$("#login, #sign_up").hide();
		$("#logout").show();
	}

	// if the user is logged out
	function showLoggedOutMenu(){
		// show login and sign up from navbar & hide logout button
		$("#login, #sign_up").show();
		$("#logout").hide();
	}

	// show Dashboard
	function showDashboard(){
		// validate jwt to verify access
		let jwt = getCookie('jwt');
		let inventory_summary = '';

		$.post("api/vehicle_inventory.php", JSON.stringify({ jwt:jwt })).done(function(result) {

			// if valid, show logged in menu & Dashboard data
			showLoggedInMenu();

			let html = `
				<div class="card">
					<div class="card-header"><h4 class="card-title">Inventory Dashboard</h4></div>
					<div class="card-body">
						<h5 class="card-title">Summary</h5>
						<p class="card-text" id="inventory_summary"></p>
					</div>
					<div class="card-body">
						<h5 class="card-title">Detail</h5>
						<p class="card-text" id="inventory_detail"></p>
					</div>
				</div>
				`;

			$('#content').html(html);

			// Add the summary table
			let el = document.getElementById("inventory_summary");
			el.innerHTML = "";
			el.appendChild(json_to_table(result.data.inventory.summary));

			// Add the detail table
			el = document.getElementById("inventory_detail");
			el.innerHTML = "";
			el.appendChild(json_to_table(result.data.inventory.detail));
		})

		// show login page on error
		.fail(function(result){
			showLoginPage();
			$('#response').html("<div class='alert alert-danger'>Please login to access the Dashboard.</div>");
		});
	}

	function showAddVehicleForm(){
		// validate jwt to verify access
		let jwt = getCookie('jwt');
		$.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {

			// if response is valid, put user details in the form
			let html = `
					<h2>Add Vehicle</h2>
					<form id='add_vehicle_form'>
						<div class="form-group">
							<label for="type">Type</label>
							<select name="type" id="type" class="form-control" required>
								<option value="">Select vehicle type</option>
								<option value="Bike">Bike</option>
								<option value="Sedan">Sedan</option>
							</select>
						</div>

						<div class="form-group">
							<label for="hp">Motor Power (Enter HP)</label>
							<input type="text" class="form-control" name="hp" id="hp" required />
						</div>

						<button type='submit' class='btn btn-primary'>
							Add Vehicle
						</button>
					</form>
				`;

			clearResponse();
			$('#content').html(html);
		})

		// on error/fail, tell the user he needs to login to show the vehicle page
		.fail(function(result){
			showLoginPage();
			$('#response').html("<div class='alert alert-danger'>Please login to access the Add Vehicle page.</div>");
		});
	}

	// function to set cookie
	function setCookie(cname, cvalue, exdays) {
		let d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		let expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	// get or read cookie
	function getCookie(cname){
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' '){
				c = c.substring(1);
			}

			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	function json_to_table(list){
		// Process data
		let cols = [];

		for (let i = 0; i < list.length; i++) {
			for (let k in list[i]) {
				if (cols.indexOf(k) === -1) {
					// Push all keys to the array
					cols.push(k);
				}
			}
		}

		 // Create a table element
		let table = document.createElement("table");
		table.className = "table table-striped";

		// Create table row tr element of a table
		let tr = table.insertRow(-1);

		for (let i = 0; i < cols.length; i++) {
			// Create the table header th element
			let theader = document.createElement("th");
			theader.innerHTML = cols[i];

			// Append columnName to the table row
			tr.appendChild(theader);
		}

		// Adding the data to the table
		for (let i = 0; i < list.length; i++) {
			// Create a new row
			trow = table.insertRow(-1);
			for (let j = 0; j < cols.length; j++) {
				let cell = trow.insertCell(-1);

				// Inserting the cell at particular place
				cell.innerHTML = list[i][cols[j]];
			}
		}

		return table;
	}

	// function to make form values to json format
	$.fn.serializeObject = function(){

		let o = {};
		let a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name] !== undefined) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
});
