var link = ''
var post_id = 0
var attempt_id = 0
var quiz_id_update = 0
var class_id_update = 0
var current_number_mc = current_number_essay = current_number_tf = 0
var learning_id = 0
var assignment_id_submitted = 0
var quiz_id_notif=0

// function slider(){
// 	$( '#example1' ).sliderPro({
// 		width: 960,
// 		height: 500,
// 		arrows: true,
// 		buttons: false,
// 		waitForLayers: true,
// 		thumbnailWidth: 200,
// 		thumbnailHeight: 100,
// 		thumbnailPointer: true,
// 		autoplay: false,
// 		autoScaleLayers: false,
// 		breakpoints: {
// 			500: {
// 				thumbnailWidth: 120,
// 				thumbnailHeight: 50
// 			}
// 		}
// 	})
// }

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

// Home Start
function home() {
    // loading()
    $.post('php/home.php', {}, function(data, status) {
        $('#main_content').html(data)
            // slider()
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

// Enrollment Start
function enrollment() {
    // loading()
    $.post('php/enroll.php', {}, function(data, status) {
        // $().DataTable()
        $('#main_content').html(data)
    })
}

function enroll_class() {
    var code_id = $('#code').val().trim()
    var code_name = $('#code option:selected').text().trim()
    var password = $('#password').val()
    password = password.trim()
    var class_name = $('#class_name').val().trim() // Input User
    $.post('php/enroll_class_validate.php', {
        code_id: code_id,
        password: password,
        class_name: class_name
    }, function(data, status) {
        $('#enroll_modal').modal('hide')
        if (data == 1) // Berhasil enroll
            success_alert('Class ' + class_name + ' was successfully registered.')
        else if (data == 0) // Salah password
            danger_alert('Failed to Enroll')
        else if (data == 3) // Name kelas sudah ada
            warning_alert('Class already created.')
            // else if(data==2)
            // 	alert("You Done.")
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
                enrolled_id: id
            },
            function(data, status) {
                success_alert('Class ' + data)
                enrollment()
            }
        )
    }
}

function show_student_name() {
    var class_id = $('#class_code').val().trim()
    $.post('php/show_student_name.php', {
        class_id: class_id
    }, function(data, status) {
        $('#student_code').children().remove()
        $('#student_code').append(data)
    })
}

function delete_student() {
    var student_id = $('#student_code').val().trim()
    var class_name = $('#class_code option:selected').text()
    var student_name = $('#student_code option:selected').text()
    $.post('php/delete_student.php', {
        student_id: student_id,
        class_name: class_name
    }, function(data, status) {
        success_alert(student_name + ' has been deleted.')
    })
}

function generate_class_name() {
    // var code_id = $('#code').val().trim()
    var code_name = $('#code option:selected').text().trim()
    $.post('php/generate_class_name.php', {
        // code_id:code_id,
        code_name: code_name
    }, function(data, status) {
        $('#class_name').val(data)
    })
}
// Enrollment End

// Post Start
function post() {
    $.post('php/post.php', {}, function(data, status) {
        $('#main_content').html(data)
        show_post()
    })
}

function post_comment(id) {
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
            show_post()
                // post_id=0
        })
    }
    // home()
}

function delete_post(id) {
    var conf = confirm('Delete this post?')
    if (conf == true) {
        $.post('php/post_delete.php', {
                id: id
            },
            function(data, status) {
                // Post
                success_alert('Post Deleted')
                    // alert("Post Deleted.")
            }
        )
    }
}

function delete_comment(id) {
    var conf = confirm('Delete this comment?')
    if (conf == true) {
        $.post('php/comment_delete.php', {
                id: id
            },
            function(data, status) {
                // comment
                success_alert('Comment Deleted')
                    // alert("Comment Deleted.")
            }
        )
    }
}

function posting() {
    var description = CKEDITOR.instances.editor1.getData()
    var class_id = $('#g_class_id').val().trim()
    description = description.trim()
    var type = 1 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    
        // var post_to=$('#code').val()
        // post_to=post_to.trim()

    if (description == '' || description == null) {
        alert('Cannot Be Empty')
    } else {
        $.post('php/post_content.php', {
            description: description,
            class_id: class_id,
            type: type
        }, function(data, status) {
            // alert(class_id)
            $('#title').val('')
            $('#create_post_modal').modal('hide')
            success_alert('New Post Created')
            post()
        })
    }
    // home()
}

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
// Post End

// GENERAL MATERIAL START
function general_material() {
    // loading()
    var class_id = $('#g_class_id').val().trim()
    $.post('php/material.php', {
        class_id: class_id
    }, function(data, status) {
        // $().DataTable()
        $('#main_content').html(data)
    })
}

function show_material_folder() {
    var code = $('#code').val().trim()
    $.post('location/to/php', {
        code: code
    }, function(data, status) {
        $('#material_content').html(data)
        $('#material_modal').modal('hide')
    })
}

function learning_source() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/learning_source.php', {
        class_id: class_id
    }, function(data, status) {
        // $().DataTable()
        $('#main_content').html(data)
    })
}

function upload_learning_source() {
    var class_id = $('#g_class_id').val().trim()
    var material_title = $('#material_title').val().trim()
    var material_link = $('#material_link').val().trim()
    var type= 8 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    
    if (material_title == null || material_link == null) {
        alert('Cannot be empty.')
    } else {
        $.post('php/upload_learning_source.php', {
            class_id: class_id,
            title: material_title,
            link: material_link,
            type: type
        }, function(data, status) {
            // $().DataTable()
            success_alert('Material Uploaded')
            $('#material_title').val('')
            $('#material_link').val('')
            $('#upload_learning_modal').modal('hide')
            learning_source()
        })
    }
}

function edit_learning_source() {
    var u_material_title = $('#u_material_title').val().trim()
    var u_material_link = $('#u_material_link').val().trim()
    var type = 12 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()
    
    if (u_material_title == null || u_material_link == null) {
        alert('Cannot be empty.')
    } else {
        $.post('php/edit_learning_source.php', {
            learning_id: learning_id,
            u_title: u_material_title,
            u_link: u_material_link,
            type: type,
            class_id: class_id
        }, function(data, status) {
            // $().DataTable()
            success_alert('Material Updated')
            $('#edit_learning_modal').modal('hide')
            learning_source()
        })
    }
}

function delete_learning_source(id) {
    var conf = confirm('Delete the learning source?')
    if (conf == true) {
        $.post('php/delete_learning_source.php', {
            learning_id: id
        }, function(data, status) {
            // alert(data)
            success_alert('Material Deleted')
            learning_source()
        })
    }
}

function hidden_learning_id(id) {
    learning_id = id
    $('#u_learning_modal').children().remove()
    $.post('php/get_learning_source.php', {
        learning_id: learning_id
    }, function(data, status) {
        // $().DataTable()

        $('#u_learning_modal').append(data)
    })
}

function validate_create_learning() {
    var class_id = $('#g_class_id').val().trim()
    var material_title = $('#material_title').val().trim()
    var type = 1
    $.post('php/validate_learning_title.php', {
        class_id: class_id,
        title: material_title,
        type: type
    }, function(data, status) {
        // $().DataTable()
        // alert(data)
        if (data == 0) {
            upload_learning_source()
        } else {
            $('#upload_learning_modal').modal('hide')
            danger_alert('Material Title already exist')
        }
    })
}

function validate_edit_learning() {
    var material_title = $('#u_material_title').val().trim()
    var type = 2
    $.post('php/validate_learning_title.php', {
        learning_id: learning_id,
        title: material_title,
        type: type
    }, function(data, status) {
        // $().DataTable()
        // alert(data)
        if (data == 0) {
            edit_learning_source()
        } else {
            $('#edit_learning_modal').modal('hide')
            danger_alert('Material Title already exist')
        }
    })
}

// GENERAL MATERIAL END

// ASSIGNMENT START
function assignment() {
    // loading()
    $.post('php/assignment.php', {}, function(data, status) {
        // $().DataTable()
        $('#main_content').html(data)
            // Date Range js
        $('input[name="daterange"]').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })
        show_assignment()
            // end date range
    })
}

function show_assignment() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/show_assignment.php', {
        class_id: class_id
    }, function(data, status) {
        // window.open(data)
        $('#assignment_content').html(data)
        $('.box-header').html("<h4 class='text-center'>View Assignment</h4>")
        $('#assignment_modal').modal('hide')
    })
}

function delete_assignment(id) {
    var conf = confirm('Delete the assignment file?')
    if (conf == true) {
        $.post('php/delete_assignment.php', {
            assignment_id: id
        }, function(data, status) {
            // alert(data)
            success_alert(data)
            show_assignment()
        })
    }
}

function submitted_assignment() {
    assignment_id_submitted = $('#assignment_num').val().trim()
    show_submitted_assignment()
}

function show_submitted_assignment() {
    var class_id = $('#g_class_id').val()
    class_id = class_id.trim()
    $.post('php/submitted_assignment.php', {
        class_id: class_id,
        assignment_id: assignment_id_submitted
    }, function(data, status) {
        // window.open(data)
        $('#assignment_content').html(data)
        $('.box-header').html("<h4 class='text-center'>Submitted Assignment</h4>")
        $('#submitted_assignment_modal').modal('hide')
    })
}

function get_assignment_score(id) {
    // Add User ID to the hidden field
    // $('#assignment_score').val("")
    $('#hidden_submitted_id').val(id)
    $.post('php/get_assignment_score.php', {
        submitted_id: id
    }, function(data, status) {
        // $("#assignment_score").val(data)
        // Slide Ion JS
        $('#assignment_score').ionRangeSlider({
                min: 0,
                max: 100
            })
            // end slider ion
            // Open modal popup
        $('#input_score_modal').modal('show')
    })
}

function update_assignment_score() {
    var submitted_id = $('#hidden_submitted_id').val()
    var assignment_score = $('#assignment_score').val().trim()
    var type = 6 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()

    if (assignment_score == null)
        alert('Please input the score')
    else {
        $.post('php/update_assignment_score.php', {
                submitted_id: submitted_id,
                assignment_score: assignment_score,
                type: type,
                class_id: class_id
            }, function(data, status) {
                // alert("score Inputted")
                success_alert('Score Inputted')
            })
            // Open modal popup
        $('#input_score_modal').modal('hide')
        show_submitted_assignment()
    }
}

function get_assignment_note(id) {
    // Add User ID to the hidden field
    $('#hidden_note_id').val(id)
    $.post('php/get_assignment_note.php', {
        note_id: id
    }, function(data, status) {
        $('#u_assignment_note').val(data)
            // Open modal popup
        $('#update_note_modal').modal('show')
    })
}

function update_assignment_note() {
    var note_id = $('#hidden_note_id').val()
    var assignment_note = $('#u_assignment_note').val().trim()
    var type = 5 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()

    if (assignment_note == null)
        alert('Please input the score')
    else {
        $.post('php/update_assignment_note.php', {
                note_id: note_id,
                assignment_note: assignment_note,
                type: type,
                class_id: class_id
            }, function(data, status) {
                // alert("Note Edited")
                success_alert('Note Edited Successfully')
            })
            // Open modal popup
        $('#update_note_modal').modal('hide')
        show_assignment()
    }
}

/*function create_assignment(){
	var class_id = $('#class_id').val()
	var file_title = $('#assignment_title').val().trim()
	var class_name = $("#class_id option:selected").text()
	var file = $('#input-file').prop('files')[0]
	var formdata = new FormData()
	formdata.append("input-file", file)
	$.post("php/upload_assignment.php", {
		formdata:formdata
	}, function (data, status) {
		alert(data)
	})
}*/

/*function create_assignment(tmp_file, file_name, file_size){
	var class_id = $('#class_id').val()
	var file_title = $('#assignment_title').val().trim()
	var class_name = $("#class_id option:selected").text()
	alert(tmp_file+" "+file_name+" "+file_size)
	$.post("php/upload_assignment.php", {
		class_id:class_id,
		file_title:file_title,
		class_name:class_name,
		file_name:file_name,
		file_size:file_size,
		tmp_file:tmp_file
	}, function (data, status) {
		alert(data)
	})
}*/

// move file to folder it belong and rename it
function move_assignment(file_target) {
    var type = 4 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()
        // var assignment_number = $('#assignment_number').val()
    var assignment_note = $('#assignment_note').val().trim()
    var file_title = $('#assignment_title').val().trim()
    var class_name = $('#g_class_name').val().trim()
    var assignment_daterange = $('#daterange').val()
    assignment_daterange = assignment_daterange.split(' - ')
    var assignment_start_date = assignment_daterange[0] // get input user
    var assignment_end_date = assignment_daterange[1] // get input user
    file_title = file_title.split(' ').join('_')
    if (assignment_note == null) {
        assignment_note = 'Nothing'
    }
    if (file_title == null || file_title == '') {
        alert('Cannot be empty.')
    }
    // alert(assignment_number)
    else {
        $.post('php/move_assignment.php', {
            class_id: class_id,
            // assignment_number:assignment_number,
            assignment_note: assignment_note,
            file_title: file_title,
            class_name: class_name,
            file_target: file_target,
            assignment_start_date: assignment_start_date,
            assignment_end_date: assignment_end_date,
            type: type
        }, function(data, status) {
            // alert(data)
            $('#assignment_note').val('')
            $('#assignment_title').val('')
            $('#input-file').val('')
            $('#create_assignment_modal').modal('hide')
            show_assignment()
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
        // var assignment_number = $('#assignment_number').val()
    var class_id = $('#g_class_id').val().trim()
    file_title = file_title.split(' ').join('_')
    $.post('php/validate_file_name.php', {
        file_title: file_title,
        class_name: class_name,
        class_id: class_id,
        // assignment_number:assignment_number,
        file_name: file_name
    }, function(data, status) {
        // alert(data)
        if (data == 1) {
            // alert("Assignment Title already exist")
            warning_alert("Assignment's Title Already Exist")
            $('#create_assignment_modal').modal('hide')
        }
        // else if(data==2){
        // 	alert("Assignment number already exist. Delete first the old one.")
        // }
        else if (data == 3) {
            warning_alert('Only accept PDF, DOC, and DOCX file.')
            $('#create_assignment_modal').modal('hide')
        } else {
            success_alert('Assignment File Successfully Uploaded')
            upload_assignment()
        }
    })
}

// untuk menampilkan assignment number di modal create assignment
function get_assignment_number() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/get_assignment_number.php', {
        class_id: class_id
    }, function(data, status) {
        $('#assignment_number').children().remove()
        $('#assignment_number').append(data)
    })
}

// untuk menampilkan assignment number di modal submitted assignment
function show_assignment_number() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/show_assignment_number.php', {
        class_id: class_id
    }, function(data, status) {
        $('#assignment_num').children().remove()
        $('#assignment_num').append(data)
    })
}

function download_assignment(number) {
    var md5_filename = $('#md5_filename_' + number).val().trim()
    var download_type = 1
    var class_id = $('#g_class_id').val().trim()
    $.post('php/download.php', {
        md5_filename: md5_filename,
        type: download_type,
        class_id: class_id
    }, function(data, status) {
        window.open(data, '_blank')
    })
}

function download_submitted(number) {
    var md5_filename = $('#md5_filename_' + number).val().trim()
    var download_type = 2
    var class_id = $('#g_class_id').val().trim()
    $.post('php/download.php', {
        md5_filename: md5_filename,
        type: download_type,
        class_id: class_id
    }, function(data, status) {
        window.open(data, '_blank')
    })
}
// ASSIGNMENT END

// TEST AND QUIZ START
var number_mc = number_e = number_tf = number_mc_update = number_e_update = number_tf_update = 0
var count_e_number = 0
var quiz_id_answer = attempt_id_answer = 0
var c_curr_num_mc = c_curr_num_tf = c_curr_num_essay = 0

function quiz() {
    // loading()
    $.post('php/quiz.php', {}, function(data, status) {
        $('#main_content').html(data)
            // Date Range js
        $('input[name="daterange"]').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
            // end date range
            // Slide Ion JS
        $('#duration').ionRangeSlider({
                min: 15,
                max: 180,
                from: 60
            })
            // end slider ion
            // Slide Ion JS
        $('#attempt').ionRangeSlider({
                min: 1,
                max: 5,
                from: 3
            })
            // end slider ion
    })
}

function set_question_mc() {
    var number = $('#question_mc_n').val()
    number = number.trim()
    number_mc = number
    var type = '1'
        // Jika jumlah soal multile yang telah disimpan lebih kcil dr jmlah yg akan d update
    if (c_curr_num_mc < number_mc) {
        $.post('php/quiz_set_question_modal.php', {
            number: number,
            current_number_mc: c_curr_num_mc,
            type: type
        }, function(data, status) {
            $('#mc_content').append(data)
            c_curr_num_mc = number_mc
        })
    }
    // Jika jumlah soal multiple yang disimpan lebih besar dri jmlh yg akan d update
    else {
        var diff_num_mc = c_curr_num_mc - number_mc
        for (var i = 0; i < diff_num_mc; i++) {
            $('#mc_content').children().last().remove()
        }
        c_curr_num_mc = number_mc
    }
}

function set_question_essay() {
    var number = $('#question_essay_n').val()
    number = number.trim()
    number_e = number
    var type = '2'
        // Jika jumlah soal multile yang telah disimpan lebih kcil dr jmlah yg akan d update
    if (c_curr_num_essay < number_e) {
        $.post('php/quiz_set_question_modal.php', {
            number: number,
            current_number_essay: c_curr_num_essay,
            type: type
        }, function(data, status) {
            $('#essay_content').append(data)
            c_curr_num_essay = number_e
                // Slide Ion JS
            for (var i = 1; i <= c_curr_num_essay; i++) {
                $('#es_' + i).ionRangeSlider({
                    min: 1,
                    max: 100,
                    from: 50
                })
            }
            // end slider ion
        })
    }
    // Jika jumlah soal multiple yang disimpan lebih besar dri jmlh yg akan d update
    else {
        var diff_num_essay = c_curr_num_essay - number_e
        for (var i = 0; i < diff_num_essay; i++) {
            $('#essay_content').children().last().remove()
        }
        c_curr_num_essay = number_e
    }
}

function set_question_tf() {
    var number = $('#question_tf_n').val()
    number = number.trim()
    number_tf = number
    var type = '3'
        // Jika jumlah soal multile yang telah disimpan lebih kcil dr jmlah yg akan d update
    if (c_curr_num_tf < number_tf) {
        $.post('php/quiz_set_question_modal.php', {
            number: number,
            current_number_tf: c_curr_num_tf,
            type: type
        }, function(data, status) {
            $('#tf_content').append(data)
            c_curr_num_tf = number_tf
        })
    }
    // Jika jumlah soal multiple yang disimpan lebih besar dri jmlh yg akan d update
    else {
        var diff_num_tf = c_curr_num_tf - number_tf
        for (var i = 0; i < diff_num_tf; i++) {
            $('#tf_content').children().last().remove()
        }
        c_curr_num_tf = number_tf
    }
}

function create_quiz() {
    var total_score_e = 0
    var class_code = $('#g_class_id').val().trim()
    var title = $('#code_test').val()
    title = title.trim()
    var type= 3 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var duration = $('#duration').val().trim() // get input user
        // duration = duration * 60; //converts to second(s)
    var attempt = $('#attempt').val().trim()
    var daterange = $('#daterange').val()
    daterange = daterange.split(' - ')
    var start_date = daterange[0] // get input user
    var end_date = daterange[1] // get input user
        // start true false
    var qtf = new Array(number_tf)
    var ktf = new Array(number_tf)
    for (var i = 1; i <= number_tf; i++) {
        qtf[i] = $('#qtf_' + i).val().trim()
        ktf[i] = $('#ktf_' + i).val().trim()
    }
    // end true false
    // start multiple
    var qm = new Array(number_mc)
    var ama = new Array(number_mc)
    var amb = new Array(number_mc)
    var amc = new Array(number_mc)
    var amd = new Array(number_mc)
    var km = new Array(number_mc)
    for (var i = 1; i <= number_mc; i++) {
        qm[i] = $('#qm_' + i).val().trim()
        ama[i] = $('#ama_' + i).val().trim()
        amb[i] = $('#amb_' + i).val().trim()
        amc[i] = $('#amc_' + i).val().trim()
        amd[i] = $('#amd_' + i).val().trim()
        km[i] = $('#km_' + i).val()
    }
    // end multiple
    // start essay
    var qe = new Array(number_e)
    var ke = new Array(number_e)
    var se = new Array(number_e)
    if (number_e > 0) {
        for (var i = 1; i <= number_e; i++) {
            qe[i] = $('#em_' + i).val().trim()
            ke[i] = $('#ek_' + i).val().trim()
            se[i] = $('#es_' + i).val().trim()
            total_score_e += parseInt($('#es_' + i).val().trim())
        }
    } else {
        total_score_e = 100
    }
    // end essay
    if (total_score_e == 100) {
        if (title == null || title == '') {
            alert('Cannot be empty.')
        } else {
            $.post('php/quiz_create.php', {
                class_code: class_code,
                title: title,
                qtf: qtf,
                ktf: ktf,
                qm: qm,
                ama: ama,
                amb: amb,
                amc: amc,
                amd: amd,
                km: km,
                qe: qe,
                ke: ke,
                se: se,
                duration: duration,
                attempt: attempt,
                number_tf: number_tf,
                number_mc: number_mc,
                number_e: number_e,
                start_date: start_date,
                end_date: end_date,
                type:type
            }, function(data, status) {
                if (data == 0) {
                    // alert("Quiz Created.")
                    success_alert('New Quiz Is Created Successfully')
                    $('#quiz_modal').modal('hide')
                    number_mc = 0
                    number_e = 0
                    number_tf = 0
                    quiz()
                } else if (data == 1)
                    warning_alert('Quiz title already exist.')
            })
        }
    } else {
        warning_alert('Total essay score must be 100')
    }
}

/*
	Melihatkan prtanyaan yg sdah dibuat oleh lecture sesuai dengan class
*/
function show_question() {
    var quiz_id = $('#quiz_code').val()
    quiz_id = quiz_id.trim()
    var quiz_name = $('#quiz_code option:selected').text()
    quiz_id_update = quiz_id
    class_id_update = $('#g_class_id').val().trim()
    $.post('php/quiz_question.php', {
        quiz_id: quiz_id,
        quiz_name: quiz_name
    }, function(data, status) {
        $('#quiz_content').html(data)
            // Date Range js
        $('input[name="u_daterange"]').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
            // end date range
            // Slide Ion JS
        $('#u_duration').ionRangeSlider({
                min: 15,
                max: 180
            })
            // end slider ion
        $('#u_attempt').ionRangeSlider({
                min: 1,
                max: 5
            })
            // end slider ion
        $('#quiz_score_content').html('')
        $('#quiz_student_score_content').html('')
        $('#show_quiz_modal').modal('hide')
        $('#quiz_preview_content').html('')
            // Set current total question number
        current_number_mc = $('#u_question_mc_n').val().trim()
        current_number_essay = $('#u_question_essay_n').val().trim()
        current_number_tf = $('#u_question_tf_n').val().trim()
            // Slide Ion JS
        for (var i = 1; i <= current_number_essay; i++) {
            $('#u_es_' + i).ionRangeSlider({
                min: 1,
                max: 100
            })
        }
        // end slider ion
    })
}

/*
	dipanggil pda onchange pda dropbox choose subject pda menu show quiz yang digunakan untuk merubah dropbox quiz name
*/
function set_quiz_question() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/set_quiz_question_modal.php', {
        class_id: class_id
    }, function(data, status) {
        $('#quiz_code').children().remove()
        $('#quiz_code').append(data)
    })
}

function quiz_id_set() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/quiz_id_set_modal.php', {
        class_id: class_id
    }, function(data, status) {
        $('#quiz_id').children().remove()
        $('#quiz_id').append(data)
    })
}

function quiz_id_score_set() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/quiz_id_score_set_modal.php', {
        class_id: class_id
    }, function(data, status) {
        $('#quiz_id_score').children().remove()
        $('#quiz_id_score').append(data)
    })
}

function quiz_id_preview_set() {
    var class_id = $('#g_class_id').val().trim()
    $.post('php/quiz_id_preview_set_modal.php', {
        class_id: class_id
    }, function(data, status) {
        $('#quiz_code_preview').children().remove()
        $('#quiz_code_preview').append(data)
    })
}

function show_student_dropdown() {
    var quiz_id = $('#quiz_id').val()
    quiz_id = quiz_id.trim()
    quiz_id_notif = quiz_id
    var quiz_name = $('#quiz_id option:selected').text()
    $.post('php/show_student_dropdown.php', {
        quiz_id: quiz_id,
        quiz_name: quiz_name
    }, function(data, status) {
        $('#quiz_content').html(data)
        $('#show_score_modal').modal('hide')
        $('#quiz_score_content').children().remove()
        $('#quiz_student_score_content').children().remove()
        $('#quiz_preview_content').children().remove()
            // $("#quiz_score_dropdown").html(data)
    })
}

function show_score() {
    attempt_id = $('#attempt_id').val().trim()
    var student_name = $('#attempt_id option:selected').text()
    $.post('php/show_score.php', {
        attempt_id: attempt_id,
        student_name: student_name
    }, function(data, status) {
        $('#quiz_score_content').html(data)
        var total_essay = $('#total_essay').val().trim()
        for (var i = 1; i <= total_essay; i++) {
            var max_score = $('#e_es_' + i).val().trim()
                // Start ion slider js
            $('#essay_score_' + i).ionRangeSlider({
                    min: 1,
                    max: max_score
                })
                // End ion slider
        }
    })
}

function show_student_score() {
    var quiz_id_score = $('#quiz_id_score').val().trim()
    var quiz_name_score = $('#quiz_id_score option:selected').text()
    quiz_id_answer = quiz_id_score
    $.post('php/show_student_score.php', {
        quiz_id_score: quiz_id_score,
        quiz_name_score: quiz_name_score
    }, function(data, status) {
        $('#quiz_student_score_content').html(data)
        $('#show_student_score_modal').modal('hide')
        $('#quiz_score_content').children().remove()
        $('#quiz_content').children().remove()
        $('#quiz_preview_content').children().remove()
    })
}

function preview_quiz() {
    var quiz_id_preview = $('#quiz_code_preview').val().trim()
    var quiz_name_preview = $('#quiz_code_preview option:selected').text()
    $.post('php/preview_quiz.php', {
        quiz_id_preview: quiz_id_preview,
        quiz_name_preview: quiz_name_preview
    }, function(data, status) {
        $('#quiz_preview_content').html(data)
        $('#quiz_student_score_content').children().remove()
        $('#preview_quiz_modal').modal('hide')
        $('#quiz_score_content').children().remove()
        $('#quiz_content').children().remove()
    })
}

function submit_score_essay() {
    var total_essay = $('#total_essay').val()
    var total_score = 0
    var is_Scored = 1
    var score = new Array(total_essay)
    var type= 7 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()
    
    for (var i = 1; i <= total_essay; i++) {
        total_score += parseInt($('#essay_score_' + i).val())
        score[i] = $('#essay_score_' + i).val()
    }
    $.post('php/submit_score_essay.php', {
        attempt_id: attempt_id,
        total_score: total_score,
        score: score,
        total_essay: total_essay,
        is_Scored: is_Scored,
        quiz_id: quiz_id_notif,
        type:type,
        class_id: class_id
    }, function(data, status) {
        // alert('Score saved')
        $('#quiz_score_content').html('')
        $('#attempt_id').val('')
        success_alert('Score Saved')
    })
}

function set_question_mc_update() {
    var number = $('#u_question_mc_n').val()
    number = number.trim()
    number_mc_update = number
    var type = '1'
        // Jika jumlah soal multile yang telah disimpan lebih kcil dr jmlah yg akan d update
    if (current_number_mc < number_mc_update) {
        $.post('php/quiz_set_question_update_modal.php', {
            number: number,
            current_number_mc: current_number_mc,
            type: type
        }, function(data, status) {
            $('#u_mc_content').append(data)
            current_number_mc = number_mc_update
        })
    }
    // Jika jumlah soal multiple yang disimpan lebih besar dri jmlh yg akan d update
    else {
        var diff_num_mc = current_number_mc - number_mc_update
        for (var i = 0; i < diff_num_mc; i++) {
            $('#u_mc_content').children().last().remove()
        }
        current_number_mc = number_mc_update
    }
}

function set_question_essay_update() {
    var number = $('#u_question_essay_n').val()
    number = number.trim()
    number_e_update = number
    var type = '2'
        // Jika jumlah soal essay yang telah disimpan lebih kcil dr jmlah yg akan d update
    if (current_number_essay < number_e_update) {
        $.post('php/quiz_set_question_update_modal.php', {
            number: number,
            current_number_essay: current_number_essay,
            type: type
        }, function(data, status) {
            $('#u_essay_content').append(data)
            current_number_essay = number_e_update
        })
    }
    // Jika jumlah soal essay yang disimpan lebih besar dri jmlh yg akan d update
    else {
        var diff_num_e = current_number_essay - number_e_update
        for (var i = 0; i < diff_num_e; i++) {
            $('#u_essay_content').children().last().remove()
        }
        current_number_essay = number_e_update
    }
}

function set_question_tf_update() {
    var number = $('#u_question_tf_n').val()
    number = number.trim()
    number_tf_update = number
    var type = '3'
        // Jika jumlah soal multile yang telah disimpan lebih kcil dr jmlah yg akan d update
    if (current_number_tf < number_tf_update) {
        $.post('php/quiz_set_question_update_modal.php', {
            number: number,
            current_number_tf: current_number_tf,
            type: type
        }, function(data, status) {
            $('#u_tf_content').append(data)
            current_number_tf = number_tf_update
        })
    }
    // Jika jumlah soal multiple yang disimpan lebih besar dri jmlh yg akan d update
    else {
        var diff_num_tf = current_number_tf - number_tf_update
        for (var i = 0; i < diff_num_tf; i++) {
            $('#u_tf_content').children().last().remove()
        }
        current_number_tf = number_tf_update
    }
}

function update_quiz() {
    var u_total_score_e = 0
    var u_title = $('#u_code_test').val()
    u_title = u_title.trim()
    var u_duration = $('#u_duration').val().trim() // get input user
    var u_attempt = $('#u_attempt').val().trim()
    var u_daterange = $('#u_daterange').val()
    u_daterange = u_daterange.split(' - ')
    var u_start_date = u_daterange[0] // get input user
    var u_end_date = u_daterange[1] // get input user
    var u_type= 11 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
        // Start True False
    var u_qtf = new Array(current_number_tf)
    var u_ktf = new Array(current_number_tf)
    for (var i = 1; i <= current_number_tf; i++) {
        u_qtf[i] = $('#u_qtf_' + i).val().trim()
        u_ktf[i] = $('#u_ktf_' + i).val().trim()
    }
    // End True False
    // Start Multiple
    var u_qm = new Array(current_number_mc)
    var u_ama = new Array(current_number_mc)
    var u_amb = new Array(current_number_mc)
    var u_amc = new Array(current_number_mc)
    var u_amd = new Array(current_number_mc)
    var u_km = new Array(current_number_mc)
    for (var i = 1; i <= current_number_mc; i++) {
        u_qm[i] = $('#u_qm_' + i).val().trim()
        u_ama[i] = $('#u_ama_' + i).val().trim()
        u_amb[i] = $('#u_amb_' + i).val().trim()
        u_amc[i] = $('#u_amc_' + i).val().trim()
        u_amd[i] = $('#u_amd_' + i).val().trim()
        u_km[i] = $('#u_km_' + i).val()
    }
    // End multiple
    // Start Essay
    var u_qe = new Array(current_number_essay)
    var u_ke = new Array(current_number_essay)
    var u_se = new Array(current_number_essay)
    if (current_number_essay > 0) {
        for (var i = 1; i <= current_number_essay; i++) {
            u_qe[i] = $('#u_em_' + i).val().trim()
            u_ke[i] = $('#u_ek_' + i).val().trim()
            u_se[i] = $('#u_es_' + i).val().trim()
            u_total_score_e += parseInt($('#u_es_' + i).val().trim())
        }
    } else {
        u_total_score_e = 100
    }
    // End Essay
    if (u_total_score_e == 100) {
        var conf = confirm('Update quiz?')
        if (conf == true) {
            if (u_title == null || u_title == '') {
                alert('Cannot be empty')
            } else {
                $.post('php/update_quiz.php', {
                    u_class_code: class_id_update,
                    u_quiz_id: quiz_id_update,
                    u_title: u_title,
                    u_qtf: u_qtf,
                    u_ktf: u_ktf,
                    u_qm: u_qm,
                    u_ama: u_ama,
                    u_amb: u_amb,
                    u_amc: u_amc,
                    u_amd: u_amd,
                    u_km: u_km,
                    u_qe: u_qe,
                    u_ke: u_ke,
                    u_se: u_se,
                    u_duration: u_duration,
                    u_attempt: u_attempt,
                    u_number_tf: current_number_tf,
                    u_number_mc: current_number_mc,
                    u_number_e: current_number_essay,
                    u_start_date: u_start_date,
                    u_end_date: u_end_date,
                    u_type: u_type
                }, function(data, status) {
                    if (data == 0) {
                        // alert("Quiz Updated.")
                        success_alert('Quiz Updated Successfully')
                        current_number_essay = 0
                        current_number_mc = 0
                        current_number_tf = 0
                        quiz()
                    } else if (data == 1)
                        warning_alert('Quiz title already exist.')
                })
            }
        }
    } else {
        warning_alert('Total essay score must be 100')
    }
}

function delete_quiz() {
    var conf = confirm('Delete the quiz?')
    if (conf == true) {
        $.post('php/delete_quiz.php', {
            quiz_id_update: quiz_id_update
        }, function(data, status) {
            success_alert('Quiz Deleted Successfully')
        })
    }
}

function set_answer_attempt(attempt_id) {
    attempt_id_answer = attempt_id
    $('#quiz_type_answer').val('--')
    $('#student_answer_content').children().remove()
}

function show_student_answer() {
    var answer_type = $('#quiz_type_answer').val().trim()
    $.post('php/show_student_answer.php', {
        quiz_id_answer: quiz_id_answer,
        attempt_id_answer: attempt_id_answer,
        type: answer_type
    }, function(data, status) {
        $('#student_answer_content').children().remove()
        $('#student_answer_content').append(data)
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
    var view_all = $('#g_notif_all').val().trim()
    $.post('php/notification.php', {
        notif_id: notif_id,
        class_id: class_id,
        class_name: class_name,
        view_all: view_all
    }, function(data, status) {
        $('#main_content').html(data)
        var total_essay = $('#total_essay').val().trim()
        for (var i = 1; i <= total_essay; i++) {
            var max_score = $('#e_es_' + i).val().trim()
                // Start ion slider js
            $('#essay_score_' + i).ionRangeSlider({
                    min: 1,
                    max: max_score
                })
                // End ion slider
        }
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

function assignment_score_notif(id) {
    var submitted_id = id
    var assignment_score = $('#assignment_score').val().trim()
    var type = 6 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()

    if (assignment_score == null)
        alert('Please input the score')
    else {
        $.post('php/update_assignment_score.php', {
                submitted_id: submitted_id,
                assignment_score: assignment_score,
                type: type,
                class_id: class_id
            }, function(data, status) {
                // alert("score Inputted")
                success_alert('Score Inputted')
            })
            // Open modal popup
        $('#input_score_modal').modal('hide')
        notif()
    }
}

function essay_score_notif(id) {
    var total_essay = $('#total_essay').val()
    var quiz_id = $('#quiz_id').val()
    var total_score = 0
    var is_Scored = 1
    var score = new Array(total_essay)
    var type= 7 // 1=post 2=comment 3=quiz 4=assignment 5=ass note 6=ass score 7=quiz score 8=learning source 9=ass submit 10=quiz submit 11=edit quiz 12=edit learning
    var class_id = $('#g_class_id').val().trim()
    
    for (var i = 1; i <= total_essay; i++) {
        total_score += parseInt($('#essay_score_' + i).val())
        score[i] = $('#essay_score_' + i).val()
    }
    $.post('php/submit_score_essay.php', {
        attempt_id: id,
        total_score: total_score,
        score: score,
        total_essay: total_essay,
        is_Scored: is_Scored,
        quiz_id: quiz_id,
        type:type,
        class_id: class_id
    }, function(data, status) {
        success_alert('Score Saved')
        $('#btn_quiz_notif').attr("disabled", "disabled")
        $('#btn_quiz_notif').attr("onclick", "")
    })
}

// NOTIFICATION END