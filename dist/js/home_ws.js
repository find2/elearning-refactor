var link="";
var post_id=0;
var current_event;
function loading(){
	$.post("dist/php/loading.php", {
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function home() {
	$.post("dist/php/home_content.php", {
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function post_comment(event){
	var x = event.which;
	if(x==13){
		$(".box-footer").activateBox();

		var comment = $("#comment-box"+post_id).val();
		comment = comment.trim();
	    if (comment == "") {
	    }
	    else {
	        $.post("dist/php/post_comment.php", {
				comment:comment,
				post_id:post_id
	        }, function (data, status) {
				$("#comment-box").val("");
				post_id=0;
	        });
	    }
		//home();
	}
}

function delete_post(id){
   var conf = confirm("Delete this post?");
    if (conf == true) {
        $.post("dist/php/post_delete.php", {
                id: id
            },
            function (data, status) {
                home();
            }
        );
    }
}

function delete_post_comment(id){
   var conf = confirm("Delete this comment?");
    if (conf == true) {
        $.post("dist/php/post_delete_comment.php", {
                id: id
            },
            function (data, status) {
                home();
            }
        );
    }
}


function posting_home(){
	var title = $("#title_post").val();
	title = title.trim();
	var content = CKEDITOR.instances.editor.getData();
	content=content.trim();
	//var content = document.getElementById("editor").querySelectorAll('*');  
	var post_to="";
	if(document.getElementById("wsn_check").checked == true)
		post_to+="wsn,";
	if(document.getElementById("md_check").checked == true)
		post_to+="01,";
	if(document.getElementById("mc_check").checked == true)
		post_to+="02,";
	if(document.getElementById("ms_check").checked == true)
		post_to+="03,";
	if(document.getElementById("mg_check").checked == true)
		post_to+="04,";
	if(document.getElementById("mn_check").checked == true)
		post_to+="05,";
	post_to=post_to.trim();
	if (title == "" || content=="" || post_to=="") {
		alert("Please type all required information");
    }
    else {
        $.post("dist/php/post_content.php", {
			title:title,
			content:content,
			post_to:post_to
        }, function (data, status) {
			$("#create_post_modal").modal("hide");
			$("#title").val("");
        });
        location.reload();
    }	
}

function set_post_id(id){
	post_id=id;
}

function calendar_event(code) {
	current_event=code;
	$.post("dist/php/calendar_event.php", {
		code:code
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function foundation() {
	$.post("dist/php/foundation/foundation.php", {
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function foundation_content(code){
	$.post("dist/php/foundation_content.php", {
		code:code
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function smm(code){
	code=code+"index.php";
	$.post(code, {
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function operational_yayasan(code){
	var monarch="wsn";
	monarch=monarch.trim();
	$.post("dist/php/operational.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function operational_dalung(code){
	var monarch="dalung";
	monarch=monarch.trim();
	$.post("dist/php/operational.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function operational_candidasa(code){
	var monarch="candidasa";
	monarch=monarch.trim();
	$.post("dist/php/operational.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function operational_singaraja(code){
	var monarch="singaraja";
	monarch=monarch.trim();
	$.post("dist/php/operational.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function operational_gianyar(code){
	var monarch="gianyar";
	monarch=monarch.trim();
	$.post("dist/php/operational.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function operational_negara(code){
	var monarch="negara";
	monarch=monarch.trim();
	$.post("dist/php/operational.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function shop_dalung(code){
	var monarch="dalung";
	monarc=monarch.trim();
	$.post("dist/php/shop.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function shop_candidasa(code){
	var monarch="candidasa";
	monarc=monarch.trim();
	$.post("dist/php/shop.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function shop_singaraja(code){
	var monarch="singaraja";
	monarc=monarch.trim();
	$.post("dist/php/shop.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function shop_gianyar(code){
	var monarch="gianyar";
	monarc=monarch.trim();
	$.post("dist/php/shop.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

function shop_negara(code){
	var monarch="negara";
	monarc=monarch.trim();
	$.post("dist/php/shop.php", {
		code:code,
		monarch:monarch
	}, function (data, status) {
		$("#ws_content").html(data);
	});
}

//Upload File
function _(el){
	return document.getElementById(el);
}

function uploadFile(){
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "dist/php/file_upload_parser.php");
	ajax.send(formdata);
	location.reload();
}

function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}

function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
}

function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}

function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}

function drag_drop(event) {
    event.preventDefault();
    alert(event.dataTransfer.files[0]);
    alert(event.dataTransfer.files[0].name);
    alert(event.dataTransfer.files[0].size+" bytes");   
}

//END Upload File

//DELETE FILE


function delete_file(delete_path) {
	delete_path=delete_path.trim();
    var conf = confirm("Do you really want to delete the file?");
    if (conf == true) {
        $.post("dist/php/delete_file.php", {
                delete_path: delete_path
            },
            function (data, status) {
                // reload Users by using readRecords();
                location.reload();
            }
        );
    }
}
//END DELETE FILE
$(function () {
	home();
  });