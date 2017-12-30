var link = ''
var post_id = 0
var quiz_id = 0
var clock
var quiz_id_score = 0
var assignment_id = 0
var attempt_id_score = 0
var quiz_start = false

function welcome_alert() {
    var status = 'Welcome to E-learning Monarch Bali'
    var type = 'success'
    $.post('php/info_alert.php', {
        status: status,
        type: type
    }, function(data, status) {
        $('#info_alert').html(data)
    })
}

function class_alert() {
    var class_name = $('#g_class_name').val().trim()
    var status = 'Welcome to Class ' + class_name + " <i class='fa fa-plane'></i>"
    var type = 'success'
    $.post('php/info_alert.php', {
        status: status,
        type: type
    }, function(data, status) {
        $('#info_alert').html(data)
    })
}

function success_alert(status) {
    var type = 'success'
    $.post('php/info_alert.php', {
        status: status,
        type: type
    }, function(data, status) {
        $('#info_alert').html(data)
    })
}

function warning_alert(status) {
    var type = 'warning'
    $.post('php/info_alert.php', {
        status: status,
        type: type
    }, function(data, status) {
        $('#info_alert').html(data)
    })
}

function info_alert(status) {
    var type = 'info'
    $.post('php/info_alert.php', {
        status: status,
        type: type
    }, function(data, status) {
        $('#info_alert').html(data)
    })
}

function danger_alert(status) {
    var type = 'danger'
    $.post('php/info_alert.php', {
        status: status,
        type: type
    }, function(data, status) {
        $('#info_alert').html(data)
    })
}

function alert_hide() {
    $('#alert_box').fadeOut(1000)
}

function loading() {
    $.post('php/loader.php', {}, function(data, status) {
        $('#main_content').html(data)
    })
}

function update_attempt_duration() {
    if (clock != null) {
        clock.countdown('pause')
        quiz_start = false
            // var duration = clock.getTime()/60.0
        var duration = calculate_duration()
        $.post('php/update_attempt_duration.php', {
            quiz_id: quiz_id,
            duration: duration
        }, function(data, status) {
            $('#quiz_content').html('')
        })
    } else {
        $('#quiz_content').html('')
    }
}

function back_home() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
            window.location.href = 'index.php'
        }
    } else {
        window.location.href = 'index.php'
    }
}

function logout() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
            window.location.href = '../logout.php'
        }
    } else {
        window.location.href = '../logout.php'
    }
}
// Home Start
function home() {
    // loading()
    $.post('php/home.php', {}, function(data, status) {
        $('#main_content').html(data)
    })
}

function access_code() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/access_code.php', {
        class_id: class_id
    }, function(data, status) {
        $('#access_code').html(data)
    })
}
// Home End

// Enrollment Starts
function enrollment() {
    // loading()
    $.post('php/enroll.php', {}, function(data, status) {
        // $().DataTable()
        $('#main_content').html(data)
    })
}

function enroll_class() {
    var id_class = $('#code').val()
    id_class = id_class.trim()
    var password = $('#password').val()
    password = password.trim()
    var class_name = $('#code option:selected').text()
    $.post('php/enroll_class_validate.php', {
        id_class: id_class,
        password: password
    }, function(data, status) {
        $('#enroll_modal').modal('hide')
        if (data == 1)
        // alert(class_name+" was successfully registered")
            success_alert(class_name + ' was successfully registered')
        else if (data == 2)
        // alert("Already Enrolled Subject "+class_name+".")
            warning_alert('Already Enrolled Subject ' + class_name + '.')
        else
        // alert("Failed to enroll.")
            danger_alert('Failed to enroll.')
        enrollment()
    })
}

// function create_class(){
// 	var code = $("#code_class").val()
// 	code = code.trim()
// 	var password = $("#password_class").val()
// 	password = password.trim()
// 	$.post("php/enroll_create_class.php", {
// 		code:code,
// 		password:password
// 	}, function (data, status) {
// 		$("#create_class_modal").modal("hide")
// 		if(data==0)
// 			alert("New class created.")
// 		else
// 			alert("Class already created, please use other code subject.")
// 		enrollment()
// 	})
// }

function delete_enrolled_class(id) {
    var conf = confirm('Delete the enrolled class?')
    if (conf == true) {
        $.post('php/enroll_delete.php', {
                id: id
            },
            function(data, status) {
                success_alert('Class Deleted Successfully')
                    // alert(data)
                enrollment()
            }
        )
    }
}
// Enrollment End

// Post Start
function post() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
            $.post('php/post.php', {
                // Need Input id_class
            }, function(data, status) {
                $('#main_content').html(data)
                show_post()
            })
        }
    } else {
        $.post('php/post.php', {
            // Need Input id_class
        }, function(data, status) {
            $('#main_content').html(data)
        })
    }
}

function post_comment(id) {
    // $(".box-footer").activateBox()
    var comment = $('#t_' + id).val().trim()
    var id_class = $('#g_class_id').val().trim()
    var type = 2 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    
    if (comment == '') {
        // console.log("NULL")
    } else {
        $.post('php/post_comment.php', {
            comment: comment,
            id_class: id_class,
            post_id: id,
            type: type
        }, function(data, status) {
            // alert(status)
            $('t_' + id).val('')
                // post_id=0
            show_post()
        })
    }
    // home()
}

/*function post_comment(event){
	var x = event.which
	if(x==13){
		$(".box-footer").activateBox()

		var comment = $("#t_"+post_id).val()
		comment = comment.trim()
	    if (comment == "") {
	    }
	    else {
	        $.post("php/post_comment.php", {
				comment:comment,
				post_id:post_id
	        }, function (data, status) {
				$("#comment-box").val("")
				post_id=0
	        })
	    }
		//home()
	}
}*/

/*function set_post_id(id){
	post_id=id
}*/

/*
	dipanggil pada onchange dropbox pada menu utama post lecture untk merender data pada table post sesuai dengan class yg sdh d enroll
*/
function show_post() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/show_post.php', {
        class_id: class_id
    }, function(data, status) {
        $('#post-content').children().remove()
        $('#post-content').append(data)
        $('#show_post_modal').modal('hide')
    })
}

function delete_comment(id) {
    var conf = confirm('Delete this comment?')
    if (conf == true) {
        $.post('php/comment_delete.php', {
                id: id
            },
            function(data, status) {
                // comment
                // alert("Comment Deleted.")
                success_alert('Comment Deleted Successfully')
            }
        )
    }
}
// Post End

// GENERAL MATERIAL START
function general_material() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
                // loading()
            var class_id = $('#g_class_id').val().trim()
            $.post('php/material.php', {
                class_id: class_id
            }, function(data, status) {
                // $().DataTable()
                $('#main_content').html(data)
            })
        }
    } else {
        // loading()
        var class_id = $('#g_class_id').val().trim()
        $.post('php/material.php', {
            class_id: class_id
        }, function(data, status) {
            // $().DataTable()
            $('#main_content').html(data)
        })
    }
}

function show_material_folder() {
    var material = $('#code').val()
    material = material.trim()
    location = '../subject_material/' + material + '/index.php'
    $.post(location, {}, function(data, status) {
        // window.open(data)
        $('#main_content').html(data)
    })
}

function learning_source() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
            var class_id = $('#g_class_id').val().trim()
            $.post('php/learning_source.php', {
                class_id: class_id
            }, function(data, status) {
                // $().DataTable()
                $('#main_content').html(data)
            })
        }
    } else {
        var class_id = $('#g_class_id').val().trim()
        $.post('php/learning_source.php', {
            class_id: class_id
        }, function(data, status) {
            // $().DataTable()
            $('#main_content').html(data)
        })
    }
}

// GENERAL MATERIAL END

// ASSIGNMENT START
function assignment() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
                // loading()
            $.post('php/assignment.php', {}, function(data, status) {
                // $().DataTable()
                $('#main_content').html(data)
                show_assignment()
            })
        }
    } else {
        // loading()
        $.post('php/assignment.php', {}, function(data, status) {
            // $().DataTable()
            $('#main_content').html(data)
            show_assignment()
        })
    }
}

function show_assignment() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/show_assignment.php', {
        class_id: class_id
    }, function(data, status) {
        // window.open(data)
        $('#assignment_content').html(data)
        $('#assignment_modal').modal('hide')
    })
}

function submit_assignment_id(id) {
    $('#hidden_assignment_id').val(id)
    assignment_id = id
}

function submitted_assignment() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/submitted_assignment.php', {
        class_id: class_id
    }, function(data, status) {
        // window.open(data)
        $('#assignment_content').html(data)
        $('#submitted_assignment_modal').modal('hide')
    })
}

function delete_assignment(id) {
    var class_name = $('#g_class_name').val().trim()
    var conf = confirm('Delete the assignment file?')
    if (conf == true) {
        $.post('php/delete_assignment.php', {
            assignment_submitted_id: id,
            class_name: class_name
        }, function(data, status) {
            // alert(data)
            success_alert(data)
            submitted_assignment()
        })
    }
}

function get_assignment_number() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/get_assignment_number.php', {
        class_id: class_id
    }, function(data, status) {
        $('#assignment_number').children().remove()
        $('#assignment_number').append(data)
    })
}

/*function get_assignment_id(){
	var class_id = $("#g_class_id").val().trim()
	var assignment_number = $('#assignment_number').val().trim()
	$.post("php/get_assignment_id.php", {
		class_id:class_id,
		assignment_number:assignment_number
	}, function (data, status) {
		if(data==0){ // Tanggal tidak sesuai dengan tnggl pngrjaan assignment
			var child = '<button id="upload_student" type="button" class="btn btn-primary" onclick="validate_file_name()" disabled>Upload Assignment</button>'
			$('#upload_student').remove()
			$('#button_div').append(child)
		}
		else{ // Tanggal sesuai dengan tnggl pngrjaan assignment
			var child = '<button id="upload_student" type="button" class="btn btn-primary" onclick="validate_file_name()">Upload Assignment</button>'
			$('#upload_student').remove()
			$('#button_div').append(child)
			assignment_id=data
		}
		//alert(assignment_id)
	})
}*/

// move file to folder it belong and rename it
function move_assignment(file_target) {
    var class_id = $('#g_class_id').val().trim()
    var file_title = $('#assignment_title').val().trim()
    var class_name = $('#g_class_name').val().trim()
    file_title = file_title.split(' ').join('_')
    var type = 9 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    
    if (file_title == null || file_title == '') {
        alert('Cannot be empty.')
    } else {
        $.post('php/move_assignment.php', {
            assignment_id: assignment_id,
            file_title: file_title,
            class_name: class_name,
            class_id: class_id,
            file_target: file_target,
            type: type
        }, function(data, status) {
            // alert(data)
            $('#assignment_title').val('')
            $('#input-file').val('')
        })
    }
}

// upload file to the assignment folder
function upload_assignment() {
    var file = $('#input-file').prop('files')[0]
    var formdata = new FormData()
    formdata.append('input-file', file)
    $.ajax({
        url: 'php/upload_assignment.php',
        type: 'POST',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            // alert(data)
            move_assignment(data)
        }
    })
}

// Check file name already exist or not
function validate_file_name() {
    var file_name = $('#input-file').prop('files')[0]['name']
    var file_title = $('#assignment_title').val().trim()
    var class_name = $('#g_class_name').val().trim()
    file_title = file_title.split(' ').join('_')
    $.post('php/validate_file_name.php', {
        file_title: file_title,
        class_name: class_name,
        file_name: file_name,
        assignment_id: assignment_id
    }, function(data, status) {
        // alert(data)
        if (data == 1) {
            // alert("Assignment Title already exist")
            warning_alert('Assignment Title already exist')
        } else if (data == 2) {
            // alert("Assignment Already Submitted.\nPlease delete the previous one.")
            danger_alert('Assignment Already Submitted.\nPlease delete the previous one.')
        } else if (data == 3) {
            warning_alert('Only accept PDF, DOC and DOCX file.')
        } else {
            upload_assignment()
            $('#upload_assignment_modal').modal('hide')
            success_alert('Assignment File Uploaded Successfully')
        }
    })
}

function download_assignment(number) {
    var class_id = $('#g_class_id').val().trim()
    var md5_filename = $('#md5_filename_' + number).val().trim()
    var download_type = 1
    $.post('php/download.php', {
        class_id: class_id,
        md5_filename: md5_filename,
        type: download_type
    }, function(data, status) {
        window.open(data, '_blank')
    })
}

function download_submitted(number) {
    var class_id = $('#g_class_id').val().trim()
    var md5_filename = $('#md5_filename_' + number).val().trim()
    var download_type = 2
    $.post('php/download.php', {
        class_id: class_id,
        md5_filename: md5_filename,
        type: download_type
    }, function(data, status) {
        window.open(data, '_blank')
    })
}
// ASSIGNMENT END

// TEST AND QUIZ START
var number_mc = number_e = 0

function quiz() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
                // loading()
            $.post('php/quiz.php', {}, function(data, status) {
                // $().DataTable()
                $('#main_content').html(data)
            })
        }
    } else {
        // loading()
        $.post('php/quiz.php', {}, function(data, status) {
            // $().DataTable()
            $('#main_content').html(data)
        })
    }
}

/*function set_question_mc(){
	var number = $("#question_mc_n").val()
	number = number.trim()
	number_mc=number
	var type="1"
	$.post("php/quiz_set_question_modal.php", {
		number:number,
		type:type
	}, function (data, status) {
		$("#mc_content").html(data)
	})
}

function set_question_essay(){
	var number = $("#question_essay_n").val()
	number = number.trim()
	number_e=number
	var type="2"
	$.post("php/quiz_set_question_modal.php", {
		number:number,
		type:type
	}, function (data, status) {
		$("#essay_content").html(data)
	})
}

function create_quiz(){
	var class_code = $("#code").val()
	class_code = class_code.trim()
	var title = $("#code_test").val()
	title = title.trim()
	var duration = 600000 // get input user
	var qm = new Array(number_mc)
	var ama = new Array(number_mc)
	var amb = new Array(number_mc)
	var amc = new Array(number_mc)
	var amd = new Array(number_mc)
	var km = new Array(number_mc)
	for(var i=1; i<=number_mc; i++)
	{
		qm[i] = $("#qm_"+i).val().trim()
		ama[i] = $("#ama_"+i).val().trim()
		amb[i] = $("#amb_"+i).val().trim()
		amc[i] = $("#amc_"+i).val().trim()
		amd[i] = $("#amd_"+i).val().trim()
		km[i] = $("#km_"+i).val()
	}
	var qe = new Array(number_e)
	var ke = new Array(number_e)
	for(var i=1; i<=number_e; i++)
	{
		qe[i] = $("#em_"+i).val().trim()
		ke[i] = $("#ek_"+i).val().trim()
	}
	$.post("php/quiz_create.php", {
		class_code:class_code,
		title:title,
		qm:qm,
		ama:ama,
		amb:amb,
		amc:amc,
		amd:amd,
		km:km,
		qe:qe,
		ke:ke,
		duration:duration,
		number_mc:number_mc,
		number_e:number_e
	}, function (data, status) {
		if(data==0){
			alert("Quiz Created.")
			number_mc=0
			number_e=0
			quiz()
		}
		else if(data==1)
			alert("Quiz title already exist.")
	})
}*/

/*
	Melihatkan prtanyaan yg sdah dibuat oleh lecture sesuai dengan class
*/
function show_question() {
    var quiz_name = $('#quiz_code option:selected').text()
    quiz_name = quiz_name.trim()
    $.post('php/quiz_question.php', {
        quiz_id: quiz_id,
        quiz_name: quiz_name
    }, function(data, status) {
        $('#quiz_content').html(data)
        $('#show_quiz_modal').modal('hide')
        quiz_id_score = quiz_id
        quiz_start = true
    })
}

/*
	dipanggil pda onchange pda dropbox choose subject pda menu show quiz yang digunakan untuk merubah dropbox quiz name
*/
function set_quiz_question() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
            $('#show_quiz_modal').modal('show')
            var class_id = $('#g_class_id').val().trim()
            $.post('php/set_quiz_question_modal.php', {
                class_id: class_id
            }, function(data, status) {
                $('#quiz_code').children().remove()
                $('#quiz_code').append(data)
            })
        }
    } else {
        $('#show_quiz_modal').modal('show')
        var class_id = $('#g_class_id').val().trim()
        $.post('php/set_quiz_question_modal.php', {
            class_id: class_id
        }, function(data, status) {
            $('#quiz_code').children().remove()
            $('#quiz_code').append(data)
        })
    }
}

// Digunkan utk mnmpan id_quiz
function set_id_quiz() {
    quiz_id = $('#quiz_code').val()
    quiz_id = quiz_id.trim()
}

function calculate_duration() {
    var curr_duration = $('#quiz_duration').text().split(' : ')
    var calc = parseInt((curr_duration[0] * 60)) + parseInt(curr_duration[1]) + Math.round(curr_duration[2] / 60)

    return calc
}

function stop_countdown_timer() {
    // clock.stop()
    // alert("Stop countdown")
    clock.countdown('pause')
    submit_question()
}

function validate_submit_answer() {
    var c_total_mc = $('#total_mc').val().trim()
    var c_total_essay = $('#total_essay').val().trim()
    var c_total_tf = $('#total_tf').val().trim()
    var c_mc = []
    var c_essay = []
    var c_tf = []
    var total_not_answer = not_tf = not_mc = not_essay = 0
    var curr_index = 0
    var conf_text = ''
        // Save nmber yg blm trjwab
    if (c_total_tf > 0) {
        curr_index = 0
        for (var i = 1; i <= c_total_tf; i++) {
            if (!$('input[name=answer_tf_' + i + ']').is(':checked')) {
                c_tf[curr_index] = i
                total_not_answer++
                curr_index++
                not_tf++
            }
        }
    }
    if (c_total_mc > 0) {
        curr_index = 0
        for (var i = 1; i <= c_total_mc; i++) {
            if (!$('input[name=answer_' + i + ']').is(':checked')) {
                c_mc[curr_index] = i
                total_not_answer++
                curr_index++
                not_mc++
            }
        }
    }
    if (c_total_essay > 0) {
        curr_index = 0
        for (var i = 1; i <= c_total_essay; i++) {
            if ($('#answer_essay_' + 1).val() == null) {
                c_essay[i] = i
                total_not_answer++
                curr_index++
                not_essay++
            }
        }
    }
    // end save
    // show number yg blm trjwab
    if (not_tf > 0) {
        var tf_text = '( '
        for (var t = 0; t < not_tf; t++) {
            tf_text += c_tf[t] + ' '
        }
        conf_text += 'True or False: ' + not_tf + ' ' + tf_text + ' )' + '\n'
    }
    if (not_mc > 0) {
        var mc_text = '( '
        for (var m = 0; m < not_mc; m++) {
            mc_text += c_mc[m] + ' '
        }
        conf_text += 'Multiple Choice: ' + not_mc + ' ' + mc_text + ' )' + '\n'
    }
    if (not_essay > 0) {
        var essay_text = '( '
        for (var e = 0; e < not_essay; e++) {
            essay_text += c_essay[e] + ' '
        }
        conf_text += 'Essay: ' + not_essay + ' ' + essay_text + ' )' + '\n'
    }
    // end show
    if (total_not_answer > 0) {
        var conf = confirm('Still not answer: ' + total_not_answer +
            '\n' + conf_text +
            '\nAre you sure to submit?')
        if (conf == true) {
            stop_countdown_timer()
        }
    } else {
        stop_countdown_timer()
    }
}

// Digunkan untuk mengumpulkan jawaban saat studen mnkan button submit
function submit_question() {
	var class_id = $('#g_class_id').val().trim()
    var total_mc = $('#total_mc').val().trim()
    var total_essay = $('#total_essay').val().trim()
    var total_tf = $('#total_tf').val().trim()
    var type = 10 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    
        // var duration = clock.getTime()/60.0
    var duration = calculate_duration()
    var mc = new Array(total_mc)
    var essay = new Array(total_essay)
    var tf = new Array(total_tf)
    if (total_tf > 0) {
        for (var i = 1; i <= total_tf; i++) {
            if ($('input[name=answer_tf_' + i + ']').is(':checked')) {
                tf[i] = $('input[name=answer_tf_' + i + ']:checked').val().trim()
            } else {
                tf[i] = null
            }
        }
    }
    if (total_mc > 0) {
        for (var i = 1; i <= total_mc; i++) {
            if ($('input[name=answer_' + i + ']').is(':checked')) {
                mc[i] = $('input[name=answer_' + i + ']:checked').val().trim()
            } else {
                mc[i] = null
            }
        }
    }
    if (total_essay > 0) {
        for (var i = 1; i <= total_essay; i++) {
            if ($('#answer_essay_' + i).val() != null) {
                essay[i] = $('#answer_essay_' + i).val().trim()
            } else {
                essay[i] = ''
            }
        }
    }
    $.post('php/submit_question.php', {
        quiz_id: quiz_id,
        tf: tf,
        total_tf: total_tf,
        mc: mc,
        total_mc: total_mc,
        essay: essay,
        total_essay: total_essay,
        duration: duration,
        class_id: class_id,
        type: type
    }, function(data, status) {
        if (duration <= 0) {
            alert("Time's out!")
        }
        show_student_score(data)
        $('#student_score_modal').modal({
            backdrop: 'static',
            keybord: false,
            show: true
        })
        success_alert('Quiz Submitted')
    })
}

/*function set_id_quiz_score(){
	quiz_id_score = $("#quiz_code_score").val()
	quiz_id_score = quiz_id_score.trim()
}*/

/*function set_quiz_title_score(){
	var class_id = $("#class_code_score").val()
	class_id = class_id.trim()
	$.post("php/set_quiz_question_modal.php", {
		class_id:class_id
	}, function (data, status) {
		$("#quiz_code_score").children().remove()
		$("#quiz_code_score").append(data)
	})
}*/

function show_quiz_score() {
    if (quiz_start == true) {
        var conf = confirm('Are you sure want to leave quiz?\nYour answer will be deleted and your time will be saved.')
        if (conf == true) {
            update_attempt_duration()
            var class_name_score = $('#g_class_name').val().trim()
            var class_id_score = $('#g_class_id').val().trim()
            $.post('php/quiz_score.php', {
                class_id: class_id_score,
                class_name: class_name_score
            }, function(data, status) {
                $('#quiz_content').html(data)
                $('#show_score_modal').modal('hide')
            })
        }
    } else {
        var class_name_score = $('#g_class_name').val().trim()
        var class_id_score = $('#g_class_id').val().trim()
        $.post('php/quiz_score.php', {
            class_id: class_id_score,
            class_name: class_name_score
        }, function(data, status) {
            $('#quiz_content').html(data)
            $('#show_score_modal').modal('hide')
        })
    }
}

function show_student_score(id_attempt) {
    $.post('php/show_student_score.php', {
        id_attempt: id_attempt
    }, function(data, status) {
        $('#student_score').html(data)
        attempt_id_score = id_attempt
    })
}

function quiz_id_score_answer(this_quiz_id) {
    quiz_id_score = this_quiz_id
    attempt_id_score = $('#hidden_attempt_score_' + this_quiz_id).val().trim()
    $('#quiz_type_score').val('--')
    $('#student_score_content').children().remove()
}

function show_score_answer() {
    var answer_type = $('#quiz_type_score').val().trim()
    $.post('php/show_student_answer.php', {
        quiz_id_score: quiz_id_score,
        attempt_id_score: attempt_id_score,
        type: answer_type
    }, function(data, status) {
        $('#student_score_content').children().remove()
        $('#student_score_content').append(data)
    })
}

function show_submit_answer() {
    var answer_type = $('#quiz_type_submit').val().trim()
    $.post('php/show_student_answer.php', {
        quiz_id_score: quiz_id_score,
        attempt_id_score: attempt_id_score,
        type: answer_type
    }, function(data, status) {
        $('#show_submit_answer').children().remove()
        $('#show_submit_answer').append(data)
    })
}

// TEST AND QUIZ END


// NOTIFICATION START

function count_post_comment() {
    var c_type = 1
    $.post('php/count_notification.php', {
        type:c_type
    }, function(data, status) {
        $('#post_comment_label').html(data)
        if(data > 1)
            $('#post_comment_header').html("You have " +data+ " new notifications")
        else
            $('#post_comment_header').html("You have " +data+ " new notification")
    })
}

function count_assignment_quiz() {
    var c_type = 2
    $.post('php/count_notification.php', {
        type:c_type
    }, function(data, status) {
        $('#assignment_quiz_label').html(data)
        if(data > 1)
            $('#assignment_quiz_header').html("You have " +data+ " new notifications")
        else
            $('#assignment_quiz_header').html("You have " +data+ " new notification")
    })
}

function show_post_comment_notif() {
    var s_type = 1
    $.post('php/show_notification.php', {
        type:s_type
    }, function(data, status) {
        $('#post_comment_notif').children().remove()
        $('#post_comment_notif').append(data)
    })
}

function show_assignment_quiz_notif() {
    var s_type = 2
    $.post('php/show_notification.php', {
        type:s_type
    }, function(data, status) {
        $('#assignment_quiz_notif').children().remove()
        $('#assignment_quiz_notif').append(data)
    })
}

function all_notif(){
    var view_all = $('#g_notif_all').val().trim()
    $.post('php/all_notification.php', {
        view_all: view_all
    }, function(data, status) {
        $('#main_content').html(data)
    })
}

function notif(){
    var notif_id = $('#g_notif_id').val().trim()
    var class_id = $('#g_class_id').val().trim()
    var class_name = $('#g_class_name').val().trim()
    $.post('php/notification.php', {
        notif_id: notif_id,
        class_id: class_id,
        class_name: class_name
    }, function(data, status) {
        $('#main_content').html(data)
    })
}

function post_comment_notif(id) {
    // $(".box-footer").activateBox()
    
	var type = 2 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var comment = $('#t_' + id).val()
    comment = comment.trim()
    var id_class = $('#g_class_id').val().trim()
    if (comment == '') {} else {
        $.post('php/post_comment.php', {
            comment: comment,
            post_id: id,
            id_class: id_class,
            type: type
        }, function(data, status) {
            $('#t_' + id).val('')
            success_alert('New Comment Added')
            notif()
                // post_id=0
        })
    }
    // home()
}

// NOTIFICATION END