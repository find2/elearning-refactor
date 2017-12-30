
function loading(){
	$.post("php/loader.php", {
	}, function (data, status) {
		$("#main_content").html(data);
	});
}
//Home Start
function home() {
	// loading();
	$.post("php/home.php", {
	}, function (data, status) {
		$("#main_content").html(data);
	});
}

function information(){
	$.post("php/information.php", {
	}, function (data, status) {
		$("#main_content").html(data);
	});
	
}

function users(){
	
}

function subject(){
	
}


