<?php

require __DIR__ . '/db_connection.php';

class CRUD
{

    protected $db;

    function __construct()
    {
        $this->db = DB();
    }

    function __destruct()
    {
        $this->db = null;
    }


	public function monarch($level){
		if($level=="01")
			$monarch="Dalung";
		else if($level=="02")
			$monarch="Candidasa";
		else if($level=="04")
			$monarch="Gianyar";
		else if($level=="03")
			$monarch="Singaraja";
		else if($level=="05")
			$monarch="Negara";
		return $monarch;
	}
	
	// Content Admin
	
	
	public function Information_Header(){
		$data ='
		<section class="content-header">
			<h1>
				Information
				<small>Panel</small>
			</h1><br>
			<button class="btn btn-success btn-md" data-toggle="modal" data-target="#create_information">Create Information</button>
		</section>
	    <section class="content">
	        <div id="information-content"></div>
	    </section>
		';
		return $data;
	}
	
	public function Information_Modal(){
		$data='
		<div class="modal fade" id="create_information" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Show Post</h4>
		            </div>
		            <div class="modal-body">
		    			<div class="form-group">
							<label for="file_image">Title Information</label>
		                    <input type="text" id="title" class="form-control" name="title">
		    			</div>
						<div class="form-group">
							<label for="file_image">Choose Image:</label>
		                    <input type="file" id="file_image" name="file_image">
		    			</div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="create_information()">Create</button>
		            </div>
		        </div>
		    </div>
		</div>
		';
		
		return $data;
	}
	
	
	public function Information_Data(){
		// Select * from table information (Create table information-> id, title, image_url)
		$query = $this->db->prepare(""); // Create query here
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
		return $data;
	}
	
	public function Information_Table_Start(){
		$data = '
		<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Assignment Number</th>
                  <th>Date Start</th>
                  <th>Date End</th>
                  <th>Download</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
		';
		
	}
	
	public function Information_Table_end(){
		
	}
	
	public function Information_Body($id, $image_url, $title){
		$data = '
			
		';
		
		return $data;
	}
	
	
	
	
	
	
	
	
	// End Content Admin

	//---------------------------Home CONTENT------------------------------------------
	public function Create_Post_Modal($username, $monarch){
		$query = $this->db->prepare("SELECT class.id AS id, class.class_name AS class_name FROM enrolled_user, users, class
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_user=users.id AND enrolled_user.id_class=class.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id'] .'"">'. $code['class_name'] .'</option>';
        	}
        }

		$data='
		<div class="modal fade" id="create_post_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Create Post</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="code">Post to Subject:</label>
		                    <select name="code" id="code" class="form-control">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
		       </div>
           <div class="form-group">
             <textarea name="editor1" id="editor1"></textarea>
             <script>
               CKEDITOR.replace( "editor1" );
             </script>
           </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="posting()">Post</button>
		            </div>
		        </div>
		    </div>
		</div>
		';

	return $data;
	}

	public function Read_Post($id_class, $monarch){
		$query = $this->db->prepare("SELECT users.username AS username, posts.date_created AS date_created, posts.description AS description, posts.id AS post_id FROM posts, users
        	 WHERE posts.id_class= :id_class AND users.monarch= :monarch AND posts.id_user=users.id
        	 ORDER BY posts.id DESC ");
        /*$query = $this->db->prepare("SELECT * FROM posts
        	 WHERE id_class LIKE '%". $monarch ."%'
        	 ORDER BY id DESC ");*/
        $query->bindParam("id_class", $id_class, PDO::PARAM_STR);
        $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function Delete_Post($id)
    {
        $query = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }

    public function Read_Comment($id, $monarch){
        $query = $this->db->prepare("SELECT users.username AS username, comment_tb.date_created AS date_created, comment_tb.description AS content, comment_tb.id AS comment_id FROM comment_tb, users
        	 WHERE id_posts= :id AND users.monarch= :monarch AND comment_tb.id_user=users.id ORDER BY comment_tb.id ASC");
		$query->bindParam("id", $id, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function Show_Post_Modal($username, $monarch){
    	$query = $this->db->prepare("SELECT class.id AS id, class.class_name AS class_name FROM enrolled_user, users, class
          	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_user=users.id AND enrolled_user.id_class=class.id");
  		$query->bindParam("username", $username, PDO::PARAM_STR);
      $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      $data_code="";
      if(count($codes)>0){
        foreach($codes as $code){
          $data_code.='<option value="'. $code['id'] .'"">'. $code['class_name'] .'</option>';
        }
      }
      
    	$data='
		<div class="modal fade" id="show_post_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Show Post</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="code">Choose Subject:</label>
		                    <select name="code_class" id="code_class" class="form-control" >
					        <option value="">Choose Subject:</option>
					            '. $data_code .'
					        </select>
		    			 </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_post()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
		';
		
		return $data;
    }

    public function Header_Post(){
		$data ='
		<section class="content-header">
			<h1>
				Post
				<small>Discussion</small>
			</h1><br>
			<button class="btn btn-success btn-md" data-toggle="modal" data-target="#create_post_modal">Create Post</button>
			<button class="btn btn-success btn-md" data-toggle="modal" data-target="#show_post_modal">Show Post</button>
		</section>
	    <section class="content">
	        <div id="post-content"></div>
	    </section>
		';
		return $data;
    }
	public function Post($username, $date_created, $description, $id){
		$data='

					<div class="col-lg-12 col-sm-12 pull-left">
						<!-- Box Comment -->
						<div class="box box-widget collapsed-box">
						<div class="box-header with-border">
							<div class="user-block">
								<img class="img-circle" src="../dist/img/avatar5.png" alt="User Image">
								<span class="username">Posted By : '. $username .'</a></span>
								<!--<span class="username"><a href="#">'. $description .'</a></span>-->
								<span class="description">Posted On '. $date_created .'</span>
							</div>
							<!-- /.user-block -->
							<div class="box-tools">

								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								
								
							</div>
							<!-- /.box-tools -->
						</div>
							<!-- /.box-header -->
							<div class="box-body">
							'. $description .'
							</div>
							<!-- /.box-body -->
						';
						//<button type="button" class="btn btn-box-tool" onclick="delete_post('. $id .')"><i class="fa fa-trash"></i></button>
	return $data;
	}

	public function Write_Comment($posts_id, $user_id, $date_created, $desciption){
		$query = $this->db->prepare("INSERT INTO comment_tb (description, id_user, id_posts, date_created)
			VALUES (:description, :id_user, :id_post, :date_created)");
        $query->bindParam("description", $desciption, PDO::PARAM_STR);
        $query->bindParam("id_user", $user_id, PDO::PARAM_STR);
        $query->bindParam("id_post", $posts_id, PDO::PARAM_STR);
        $query->bindParam("date_created", $date_created, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}

	public function Write_Post($description, $id_class, $date_created, $id_user){
		$query = $this->db->prepare("INSERT INTO posts (description, id_class, date_created, id_user)
			VALUES (:description, :id_class, :date_created, :id_user)");
        $query->bindParam("description", $description, PDO::PARAM_STR);
        $query->bindParam("id_class", $id_class, PDO::PARAM_STR);
        $query->bindParam("id_user", $id_user, PDO::PARAM_STR);
        $query->bindParam("date_created", $date_created, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}

	public function Comment_Post($username, $date_created, $description, $post_id){
		$data='
						<div class="box-footer box-comments">
						  <div class="box-comment">
							<!-- User image -->
							<img class="img-circle img-sm" src="../dist/img/avatar5.png" alt="User Image">

							<div class="comment-text">
								  <span class="username">
									'. $username .':
									<span class="text-muted pull-right">'. $date_created .'</span>
								  </span><!-- /.username -->
							   '. $description .'
							</div>
							<!-- /.comment-text -->
						  </div>
						 </div>
					';
		return $data;
	}

	public function End_Post($id){
		$data='
						<!-- /.box-footer -->
						<div class="box-footer">
						  <form action="" method="post">
							<img class="img-responsive img-circle img-sm" src="../dist/img/avatar5.png" alt="Alt Text">
							<!-- .img-push is used to add margin to elements next to floating images -->
							<div class="img-push">
								<div class="form-group">
									<label for="comment">Comment:</label>
									<textarea id="t_'. $id .'" class="form-control" rows="5" id="comment"></textarea>
									<button id="b_'. $id .'" type="button" class="btn btn-sm btn-success" onclick="post_comment('. $id .')">Post Comment</button>
								</div> 
        						
							</div>
						  </form>
						</div>
						<!-- /.box-footer -->
					  </div>
					  <!-- /.box -->
					</div>
			';
		// <input type="text" id="t_'. $id .'" class="form-control input-sm" placeholder="Comment Here" >
		// <button id="b_'. $id .'" type="button" class="btn btn-sm btn-success" onclick="post_comment('. $id .')">Post Comment</button>
		return $data;
	}

	//---------------------------End Home CONTENT------------------------------------------
	//---------------------------Start Enroll------------------------------------------

	//---------------------------End Enroll------------------------------------------
	public function Enroll_Modal($user_id, $monarch){
		// Query yg digunakan di Delete Student Modal
		$query = $this->db->prepare("SELECT enrolled_user.id_class, class.class_name FROM enrolled_user, class WHERE enrolled_user.id_user= :user_id AND enrolled_user.id_class=class.id");
		$query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        } // END Delete
        //Query yg digunakan di Enroll to class
        $query2 = $this->db->prepare("SELECT code, id FROM enroll");
        $query2->execute();
        $codes2 = array();
        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            $codes2[] = $row2;
        }
        $data_code2="";
        if(count($codes2)>0){
        	foreach($codes2 as $code2){
        		$data_code2.='<option value="'. $code2['id'] .'"">'. $code2['code'] .'</option>';
        	}
        }// END Enroll Class
        
		$data='
		<div class="modal fade" id="enroll_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Class Enrollment</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="code">Code Subject:</label>
							<!--<input type="text" id="code" placeholder="Code Subject" class="form-control"/>-->
							<select id="code" name="code" class="form-control" onchange="generate_class_name()">
								<option value="">--</option>
								'. $data_code2 .'
							</select>
						</div>
						<div class="form-group">
							<label for="code">Class Name:</label>
							<input type="text" id="class_name" placeholder="Class Name" class="form-control" required disabled/>
						</div>
						<div class="form-group">
							<label for="password">Enrollment Key:</label>
							<input type="password" id="password" placeholder="" class="form-control"/>
						</div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="enroll_class()">Enroll</button>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="modal fade" id="delete_student_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel"><h4>Delete Student </h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="class_code">Class Name:</label>
            				<select id="class_code" class="form-control" onchange="show_student_name()">
                					<option value="">--</option>
                '. $data_code .'
            				</select><br>
							<label for="student_code">Student Name:</label>
							<select id="student_code" class="form-control">
                				<option value="">--</option>
            				</select>
						</div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-danger" onclick="delete_student()">Delete Student</button>
		            </div>
		        </div>
		    </div>
		</div>
		';

	return $data;
	}

	public function Header_Enroll(){
    	$data='
    	<section class="content-header">
			<h1>
				Enrollment
				<small>Class</small>
			</h1>
			</br>
			<div class="pull-left">
				<button class="btn btn-success btn-md" data-toggle="modal" data-target="#enroll_modal">Enroll To Class</button>
				<button class="btn btn-success btn-md" data-toggle="modal" data-target="#delete_student_modal">Delete Student</button>
			</div>
		</section>
		';
		$data.='
		<section class="content">
		<br>
		<div class="box box-solid box-primary">
			<div class="box-header text-center">
				<h3 class="box-title">Class That You Already Enrolled</h3>
			</div>
			<div class="box-body">
				<table id="datatable" class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No.</th>
	                  <th>Subject</th>
	                  <th>Class Name</th>
	                  <th>Date Enrolled</th>
	                  <th>Delete Enrolled Class</th>
	                </tr>
	              </thead>
	              <tbody>
		';
			
		
		return $data;
    }

    public function Data_Enroll($number, $code, $date_created, $id, $class_name){
    	$class_id=explode("_", $class_name)[1];
    	$data='
    		<tr>
              <td>'. $number .'</td>
              <td>'. $code .'</td>
              <td><a href="class.php?cid='. $class_id .'">'. $class_name .'</a></td>
              <td>'. $date_created .'</td>
              <td><button class="btn btn-danger btn-sm" onclick="delete_enrolled_class(' . $id . ')">Delete</button>
              </td>
            </tr>';
        return $data;
    }

    public function Data_Enroll_Table($username){
    	$query = $this->db->prepare("SELECT enroll.code AS code, enrolled_user.date_created AS date_created, class.class_name AS class_name, enrolled_user.id AS id FROM enrolled_user, users, class, enroll
        	 WHERE users.username= :username AND enrolled_user.id_user=users.id AND enrolled_user.id_enroll=enroll.id AND enrolled_user.id_class=class.id ORDER BY code, class_name ASC");
    	//$query = $this->db->prepare("SELECT * FROM enroll_user
        	 //WHERE username= :username");
		$query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function Read_Enroll($username){
        $query = $this->db->prepare("SELECT * FROM users
        	 WHERE username= :username");
		$query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function Enroll_Class($id_enroll, $id_user, $date, $id_class, $monarch)
    {
       	$query = $this->db->prepare("INSERT INTO enrolled_user (id_user, id_enroll, date_created, id_class, monarch)
			VALUES ( :id_user, :id_enroll, :date_created, :id_class, :monarch)");
        $query->bindParam("id_user", $id_user, PDO::PARAM_STR);
        $query->bindParam("id_enroll", $id_enroll, PDO::PARAM_STR);
        $query->bindParam("date_created", $date, PDO::PARAM_STR);
        $query->bindParam("id_class", $id_class, PDO::PARAM_STR);
        $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function Enroll_Class_Validate($code, $password, $username, $class_name, $monarch){
        $query = $this->db->prepare("SELECT code FROM enroll WHERE id= :code AND password= :password");
		$query->bindParam("code", $code, PDO::PARAM_STR);
		$query->bindParam("password", $password, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if(count($data)>0){
        	$result= "1";//Belum Enroll

        	$query2 = $this->db->prepare("SELECT users.username AS username, enroll.code AS code FROM enrolled_user, users, enroll WHERE enroll.code= :code2 AND users.username= :username AND enrolled_user.id_user=users.id AND enrolled_user.id_enroll=enroll.id");
			$query2->bindParam("code2", $code, PDO::PARAM_STR);
			$query2->bindParam("username", $username, PDO::PARAM_STR);
	        $query2->execute();
	        $data2 = array();
	        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
	            $data2[] = $row2;
	        }
	        if(count($data2)>0){
	        	$result= "2"; // already enroll belum ad kelas
	        	$query3 = $this->db->prepare("SELECT users.username AS username, class.class_name AS class_name, class.monarch AS monarch FROM enrolled_user, users, class WHERE class.class_name= :class_name AND users.username= :username AND enrolled_user.monarch= :monarch AND enrolled_user.id_user=users.id AND enrolled_user.id_class=class.id");
				$query3->bindParam("class_name", $class_name, PDO::PARAM_STR);
				$query3->bindParam("username", $username, PDO::PARAM_STR);
				$query3->bindParam("monarch", $monarch, PDO::PARAM_STR);
		        $query3->execute();
		        $data3 = array();
		        while ($row3 = $query3->fetch(PDO::FETCH_ASSOC)) {
		            $data3[] = $row3;
		        }
		        if(count($data3)>0)
		        	$result= "3"; // sudah ada kleas sudah enroll
		        else
		        	$result= "1"; // belum enroll belum ada kelas
	        }

        }
        else{
        	$result= "0"; // Password Slah
        }
        return $result;
    }

    public function Enroll_Create_Class($code, $password, $username, $date_created){
    	$query = $this->db->prepare("INSERT INTO enroll (code, password, username, date_created )
			VALUES (:code, :password, :username, :date_created)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password", $password, PDO::PARAM_STR);
        $query->bindParam("code", $code, PDO::PARAM_STR);
        $query->bindParam("date_created", $date_created, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function Enroll_Delete($id){
    	$query = $this->db->prepare("DELETE FROM enrolled_user WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }

    public function Get_Id_Enroll($code){
        $query = $this->db->prepare("SELECT id FROM enroll
        	 WHERE code= :code");
		$query->bindParam("code", $code, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function Generate_Class_Name($code_name){
    	$query = $this->db->prepare("SELECT MAX(id) AS last_class_id FROM class");
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $class_id=0;
        if(count($codes)>0){
	        foreach($codes as $code){
	          $class_id= $code['last_class_id'];
	        }
	    }
	    $class_id++;
	    $data=$code_name . '_' . $class_id;
        return $data;
    }

    public function Create_Class_Name($id_enroll, $class_name, $id_user, $monarch){
    	$query = $this->db->prepare("INSERT INTO class (id_enroll, class_name, id_user, monarch )
			VALUES (:id_enroll, :class_name, :id_user, :monarch)");
        $query->bindParam("id_enroll", $id_enroll, PDO::PARAM_STR);
        $query->bindParam("class_name", $class_name, PDO::PARAM_STR);
        $query->bindParam("id_user", $id_user, PDO::PARAM_STR);
        $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function Get_Id_Class($id_enrolled){
        $query = $this->db->prepare("SELECT class.class_name FROM enrolled_user, class
        	 WHERE enrolled_user.id= :id_enrolled AND enrolled_user.id_class=class.id");
		$query->bindParam("id_enrolled", $id_enrolled, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function Delete_Class($id){
    	$query = $this->db->prepare("DELETE FROM class WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }
    
        public function Show_Student_Name($id_class, $monarch, $id_user){
      $query = $this->db->prepare("SELECT enrolled_user.id_user, users.name FROM enrolled_user, users WHERE enrolled_user.id_class= :id_class AND enrolled_user.id_user=users.id AND enrolled_user.id_user NOT IN(:id_user)");
      $query->bindParam("id_class", $id_class, PDO::PARAM_STR);
      $query->bindParam("id_user", $id_user, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      $data_code='<option value="">--</option>';
      if(count($codes)>0){
        foreach($codes as $code){
          $data_code.='<option value="'. $code['id_user'] .'"">'. $code['name'] .'</option>';
        }
      }
      return $data_code;
    }

    public function Delete_Student_Attempt_Quiz($id_class, $student_id){
      $query = $this->db->prepare("SELECT attempt_quiz.id FROM attempt_quiz, quiz WHERE attempt_quiz.id_user= :student_id AND quiz.id_class= :id_class AND attempt_quiz.id_quiz=quiz.id");
      $query->bindParam("id_class", $id_class, PDO::PARAM_STR);
      $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      if(count($codes)>0){
        foreach($codes as $code){
          $query2 = $this->db->prepare("DELETE FROM attempt_quiz WHERE id = :id");
            $query2->bindParam("id", $code['id'], PDO::PARAM_STR);
            $query2->execute();
        }
      }
    }

    public function Delete_Student_Assignment($id_class, $student_id){
      $query = $this->db->prepare("DELETE FROM assignment WHERE user_id= :student_id AND class_id= :class_id");
        $query->bindParam("student_id", $id_user, PDO::PARAM_STR);
        $query->bindParam("class_id", $student_id, PDO::PARAM_STR);
        $query->execute();
    }

    public function Delete_Student_Badges($id_class, $student_id){
      $query = $this->db->prepare("DELETE FROM badges WHERE user_id= :student_id AND class_id= :class_id");
        $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
        $query->execute();
    }

    public function Delete_Student_Comment_Quiz($id_class, $student_id){
      $query = $this->db->prepare("DELETE FROM comment_quiz WHERE user_id= :student_id AND class_id= :class_id");
        $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
        $query->execute();
    }

    public function Delete_Student_Comment($id_class, $student_id){
      $query = $this->db->prepare("SELECT comment_tb.id FROM comment_tb, posts WHERE comment_tb.id_user= :student_id AND posts.id_class= :id_class AND comment_tb.id_posts=posts.id");
      $query->bindParam("id_class", $id_class, PDO::PARAM_STR);
      $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      if(count($codes)>0){
        foreach($codes as $code){
          $query2 = $this->db->prepare("DELETE FROM comment_tb WHERE id = :id");
            $query2->bindParam("id", $code['id'], PDO::PARAM_STR);
            $query2->execute();
        }
      }
    }

    public function Delete_Student_Enrolled_User($id_class, $student_id){
      $query = $this->db->prepare("DELETE FROM enrolled_user WHERE id_user= :student_id AND id_class= :class_id");
        $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
        $query->execute();
    }

    public function Delete_Student_Rating($id_class, $student_id){
      $query = $this->db->prepare("DELETE FROM rating WHERE user_id= :student_id AND class_id= :class_id");
        $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
        $query->execute();
    }

    public function Delete_Student_Statistic($id_class, $student_id){
      $query = $this->db->prepare("DELETE FROM statistic WHERE user_id= :student_id AND class_id= :class_id");
        $query->bindParam("student_id", $student_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
        $query->execute();
    }

    //ENROLL END

    //MATERIAL START
    public function Material_Modal($username){
		// $query = $this->db->prepare("SELECT code FROM enroll_user
  //      	 WHERE username= :username");
		// $query->bindParam("username", $username, PDO::PARAM_STR);
  //      $query->execute();
  //      $codes = array();
  //      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  //          $codes[] = $row;
  //      }
  //      if(count($codes)>0){
  //      	$data_code="";
  //      	foreach($codes as $code){
  //      		$data_code.='<option value="'. $code['code'] .'"">'. $code['code'] .'</option>';
  //      	}
  //      }
		$data_code = '
			<option value="">Subject 1</option>
			<option value="">Subject 2</option>
			<option value="">Subject 3</option>
		';
		
		$data='
		<div class="modal fade" id="material_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Show Subject Material</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="code">Show Subject:</label>
		                    <select name="code" id="code" class="form-control">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_material_folder()">Post</button>
		            </div>
		        </div>
		    </div>
		</div>
		';

		return $data;
	}
	
	public function Material_Header(){
		$data = '
			<section class="content-header">
		    	<h1>
					Subject Material
					<small></small>
				</h1>
				</br>
					<div class="pull-left">
						<button class="btn btn-success btn-md" data-toggle="modal" data-target="#material_modal">Show Material</button>
					</div>
			</section>
			<section class="content">
				<br>
				<div class="box box-solid box-primary">
					<div class="box-body">
						<table class="table table-striped table-bordered">
			              <thead>
			                <tr>
			                  <th>No.</th>
			                  <th>Subject</th>
			                  <th>Download</th>
			                </tr>
			              </thead>
			              <tbody>
			            	<tr>
			            		<td>1</td>
			            		<td>GEN</td>
			            		<td><button class="btn btn-primary btn-sm">Download</button></td>
			            	</tr>
						<div id="material_content"></div>
					</div>
				</div>
			</section>
		';
			
		return $data;
	}

    //MATERIAL END

    //ASSIGNMENT START
    public function Assignment_Modal($username, $monarch){
    	$trigger="'#input-file'";
		$query = $this->db->prepare("SELECT class.class_name AS class_name, class.id AS id_class FROM enrolled_user, users, class
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_user=users.id AND enrolled_user.id_class=class.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
		$query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        }

		$data='
		<div class="modal fade" id="assignment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Show Assignment</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="code">Show Subject:</label>
		                    <select name="code" id="code" class="form-control">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_assignment()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
		
		<div class="modal fade" id="create_assignment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Create Assignment</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="class_id">Show Subject:</label>
		                    <select name="class_id" id="class_id" class="form-control" onchange="get_assignment_number()">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
							<label for="assignment_number">Assignment Number:</label>
							<select name="assignment_number" id="assignment_number" class="form-control">
							<option value="">Assignment Number:</option>
							</select>
		                </div>
		                <div class="form-group">
			            	<label>Quiz Date range:</label>	
					    	<div class="input-group">
					        	<div class="input-group-addon">
					            	<i class="fa fa-calendar"></i>
					        	</div>
					            <input type="text" id="daterange" name="daterange" value="" />
					    	</div>
						</div>
		                <div class="form-group">
		                	<label for="assignment_title">Assignment Title:</label>
		                	<input type="text" id="assignment_title" class="form-control" placeholder="Input Title">
		                </div>
		                <div class="form-group">
		                	<label for="input-file">Select File:</label>
		                	<input type="file" id="input-file" name="input-file" accept="application/pdf, application/msword, application/msexcel, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required="required">
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="validate_file_name()">Upload Assignment</button>
		            </div>
		        </div>
		    </div>
		</div>
		
		<div class="modal fade" id="submitted_assignment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Submitted Assignment</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="class_code">Show Subject:</label>
		                    <select name="class_code" id="class_code" class="form-control" onchange="show_assignment_number()">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
							<label for="assignment_num">Show Subject:</label>
		                    <select name="assignment_num" id="assignment_num" class="form-control">
								<option value="">Assignment Number:</option>
							</select>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="submitted_assignment()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


		return $data;
	}
	
	public function Assignment_Header(){
		$data = '
			<section class="content-header">
		    	<h1>
					Assignment
					<small></small>
				</h1>
				</br>
					<div class="pull-left">
						<button class="btn btn-success btn-md" data-toggle="modal" data-target="#assignment_modal">Show Assignment</button>
						<button class="btn btn-success btn-md" data-toggle="modal" data-target="#create_assignment_modal">Create Assignment</button>
						<button class="btn btn-success btn-md" data-toggle="modal" data-target="#submitted_assignment_modal">Show Submitted Assignment</button>
					</div>
			</section>
			<section class="content">
				<br>
				<div class="box box-solid box-primary">
					<div class="box-body">
						<div id="assignment_content"></div>
					</div>
				</div>
			</section>
		';
		
		return $data;
	}

	public function Show_Assignment($user_id, $class_id, $monarch){
		$query = $this->db->prepare("SELECT assignment.id, assignment.file_name, class.class_name, assignment.assignment_number, assignment.date_started, assignment.date_ended FROM class, assignment WHERE assignment.user_id= :user_id AND assignment.class_id= :class_id AND assignment.class_id=class.id ORDER BY assignment.assignment_number ASC");
		$query->bindParam("user_id", $user_id, PDO::PARAM_STR);
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	$i = 1;
        	$data_code .='
        		<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No.</th>
	                  <th>Name</th>
	                  <th>Assignment Number</th>
	                  <th>Date Start</th>
	                  <th>Date End</th>
	                  <th>Download</th>
	                  <th>Delete</th>
	                </tr>
	              </thead>
	              <tbody>
        	';
        	foreach($codes as $code){
        		$data_code .='
        			<tr>
        				<td>'. $i .'</td>
        				<td>'. $code['file_name'] .'</td>
        				<td>'. $code['assignment_number'] .'</td>
        				<td>'. $code['date_started'] .'</td>
        				<td>'. $code['date_ended'] .'</td>
        				<td><a href="../assignment/'. $code['class_name'] . '_' . $monarch .'/question/'. $code['file_name'] .'" target="_blank"><button class="btn btn-primary">Download</button></a></td>
        				<td><button class="btn btn-danger" onclick="delete_assignment('. $code['id'] .')">Delete</button></td>
        			</tr>
        		';
        		$i++;
        	}
        	$data_code .='
        			</tbody>
        		</table>
        	';
        }
        
        return $data_code;
	}
	
	public function Delete_Assignment($assignment_id){
		$query = $this->db->prepare("DELETE FROM assignment WHERE id = :id");
        $query->bindParam("id", $assignment_id, PDO::PARAM_STR);
        $query->execute();
	}
	
	public function Upload_Assignment($user_id, $file_name, $class_id, $assignment_number, $start_date, $end_date){
		$query = $this->db->prepare("INSERT INTO assignment (user_id, file_name, class_id, assignment_number, date_started, date_ended)
			VALUES (:user_id, :file_name, :class_id, :assignment_number, :start_date, :end_date)");
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->bindParam("file_name", $file_name, PDO::PARAM_STR);
        $query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->bindParam("assignment_number", $assignment_number, PDO::PARAM_STR);
        $query->bindParam("start_date", $start_date, PDO::PARAM_STR);
        $query->bindParam("end_date", $end_date, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}
	
	public function Get_File_Name($assignment_id){
		$query = $this->db->prepare("SELECT file_name FROM assignment WHERE id= :assignment_id");
		$query->bindParam("assignment_id", $assignment_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data=$code['file_name'];
        	}
        }
		return $data;
	}
	
	public function Get_Assignment_Number($class_id, $user_id){
		$query = $this->db->prepare("SELECT COUNT(file_name) AS total FROM assignment WHERE user_id= :user_id AND class_id= :class_id");
		$query->bindParam("user_id", $user_id, PDO::PARAM_STR);
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        $assignment_number=0;
        if(count($codes)>0){
        	
        	foreach($codes as $code){
        		$assignment_number=$code['total'];
        	}
        }
        $data_code.='<option value="">Assignment Number:</option>';
        $assignment_number++;
        for($i=1; $i<=$assignment_number; $i++){
        	$data_code.='<option value="'. $i .'">'. $i .'</option>';
        }
        
        return $data_code;
	}
	
	public function Input_Score_Modal(){
		$data='
			<div class="modal fade" id="input_score_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			    <div class="modal-dialog" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <h4 class="modal-title" id="myModalLabel">Input Score</h4>
			            </div>
			            <div class="modal-body">
							<div class="form-group">
								<label for="code">Input Score:</label>
								<input type="text" id="assignment_score" class="form-control">
			                </div>
						</div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			                <button type="button" class="btn btn-primary" onclick="update_assignment_score()">Submit</button>
			                <input type="hidden" id="hidden_submitted_id">
			            </div>
			        </div>
			    </div>
			</div>
		';	
		
		return $data;
	}
	
	public function Submitted_Assignment($class_id, $monarch, $assignment_number){
		//Select Ass student id on query
		$id="1";
		$query = $this->db->prepare("SELECT assignment_submitted.id AS submitted_id, assignment_submitted.file_name, class.class_name, users.name AS user_name, assignment.assignment_number, assignment_submitted.score FROM class, assignment, assignment_submitted, users WHERE assignment.class_id= :class_id AND assignment.assignment_number= :assignment_number AND assignment.class_id=class.id AND assignment_submitted.user_id=users.id AND assignment_submitted.assignment_id=assignment.id ORDER BY users.name");
		$query->bindParam("assignment_number", $assignment_number, PDO::PARAM_STR);
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	$i = 1;
        	$data_code .='
        		<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No.</th>
	                  <th>Student</th>
	                  <th>File Name</th>
	                  <th>Assignment Number</th>
	                  <th>Score</th>
	                  <th>Download</th>
	                  <th>Input Score</th>
	                </tr>
	              </thead>
	              <tbody>
        	';
        	foreach($codes as $code){
        		$data_code .= '
        			<tr>
        				<td> '. $i .'</td>
        				<td> '. $code['user_name'] .'</td>
        				<td> '. $code['file_name'] .'</td>
        				<td> '. $code['assignment_number'] .'</td>
        				<td> '. $code['score'] .'</td>
        				<td> <a href="../assignment/'. $code['class_name'] . '_' . $monarch .'/answer/'. $code['file_name'] .'"><button class="btn btn-primary">Download</button></a></td>
        				<td><button class="btn btn-warning btn-md" data-toggle="modal" data-target="#input_score_modal" onclick="get_assignment_score('. $code['submitted_id'] .')">Score</button></td>
        			</tr>
        		';
        		$i++;
        		
        	}
        }
        
        return $data_code;
	}
	
	public function Get_Assignment_Score($submitted_id)
    {
        $query = $this->db->prepare("SELECT score FROM assignment_submitted WHERE id = :submitted_id");
        $query->bindParam("submitted_id", $submitted_id, PDO::PARAM_STR);
        $query->execute();
	    $codes = array();
	    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	        $codes[] = $row;
	    }
	    $score=0;
	    if(count($codes)>0){
        	foreach($codes as $code){
        		$score=$code['score'];
        	}
        }
        
        return $score;
    }
    
    public function Update_Assignment_Score($submitted_id, $score){
    $query = $this->db->prepare("UPDATE assignment_submitted SET score= :score WHERE id= :submitted_id");
        $query->bindParam("score", $score, PDO::PARAM_STR);
        $query->bindParam("submitted_id", $submitted_id, PDO::PARAM_STR);
        $query->execute();
  }
	
	public function Show_Assignment_Number($class_id, $user_id){
		$query = $this->db->prepare("SELECT COUNT(file_name) AS total FROM assignment WHERE user_id= :user_id AND class_id= :class_id");
		$query->bindParam("user_id", $user_id, PDO::PARAM_STR);
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        $assignment_number=0;
        if(count($codes)>0){
        	
        	foreach($codes as $code){
        		$assignment_number=$code['total'];
        	}
        }
        $data_code.='<option value="">Assignment Number:</option>';
        for($i=1; $i<=$assignment_number; $i++){
        	$data_code.='<option value="'. $i .'">'. $i .'</option>';
        }
        
        return $data_code;
	}
	
	public function Validate_Assignment_Number($assignment_number, $class_id, $user_id){
		$query = $this->db->prepare("SELECT id FROM assignment WHERE assignment_number= :assignment_number AND user_id= :user_id AND class_id= :class_id");
		$query->bindParam("assignment_number", $assignment_number, PDO::PARAM_STR);
		$query->bindParam("user_id", $user_id, PDO::PARAM_STR);
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $result= '0'; // assignment number belum ada
        if(count($codes)>0){
        	$result= '1'; // assignment number sudah ada
        }
        
        //echo '<script>alert('. $assignment_id .')</script>';
        
        return $result;
	}

    //ASSIGNMENT END

    //Quiz START
    
    public function Quiz_Header(){
    	$data = '
    	<section class="content-header">
	    	<h1>
				Quiz
				<small></small>
			</h1>
			</br>
				<div class="pull-left">
					<button class="btn btn-success btn-md" data-toggle="modal" data-target="#quiz_modal">Create Quiz</button>
					<button class="btn btn-success btn-md" data-toggle="modal" data-target="#show_quiz_modal">Update Quiz</button>
					<button class="btn btn-success btn-md" data-toggle="modal" data-target="#preview_quiz_modal">Preview Quiz</button>
	    			<button class="btn btn-success btn-md" data-toggle="modal" data-target="#show_score_modal">Student Essay</button>
	    			<button class="btn btn-success btn-md" data-toggle="modal" data-target="#show_student_score_modal">Show Student Score</button>
				</div>
		</section>
		<section class="content">
			<br>
			<div class="box box-solid box-primary">
				<div class="box-body">
					<div id="quiz_content"></div>
					<div id="quiz_score_content"></div>
					<div id="quiz_student_score_content"></div>
					<div id="quiz_preview_content"></div>
				</div>
			</div>
		</section>
    	';
    	
    	return $data;
    }
    public function Quiz_Modal($username, $monarch){
		$query = $this->db->prepare("SELECT class.class_name AS class_name, class.id AS id_class FROM enrolled_user, users, class
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_user=users.id AND enrolled_user.id_class=class.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        }
        $total_question='';
        for($i=1;$i<=20;$i++)
        	$total_question.='<option value="'. $i .'">'. $i .'</option>';

		$data='
		<div class="modal fade" id="quiz_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Create Quiz</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="code">Choose Subject:</label>
				                    <select name="code" id="code" class="form-control" required >
										<option value="">--</option>
										'. $data_code .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="code_test">Quiz Name</label>
									<input type="input" id="code_test" placeholder="" class="form-control" required />
								</div>
							</div>
		                </div>
		                <div class="form-group">
		                	<div class="row">
		                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                			<label for="question_tf_n">Number of True or False Question</label>
		                			<select name="question_tf_n" id="question_tf_n" class="form-control" onchange="set_question_tf()" required >
										<option value="0">0</option>
										'. $total_question .'
									</select>
		                		</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="question_mc_n">Number of Multiple Choices Questions:</label>
				                    <select name="question_mc_n" id="question_mc_n" class="form-control" onchange="set_question_mc()" required >
										<option value="0">0</option>
										'. $total_question .'
									</select>
								</div>
							</div>
		                </div>
		                <div class="form-group">
		                	<div class="row">
		                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="question_essay_n">Number of Essay Questions</label>
									<select name="question_essay_n" id="question_essay_n" class="form-control" onchange="set_question_essay()" required >
										<option value="0">0</option>
										'. $total_question .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			            			<label>Quiz Date range:</label>	
					            	<div class="input-group">
					                	<div class="input-group-addon">
					                    	<i class="fa fa-calendar"></i>
					                	</div>
					                	<input type="text" id="daterange" name="daterange" value="" />
					            	</div>
								</div>
		                	</div>
			            </div>
			            <div class="form-group">
			            	<div class="row">
			            		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Quiz Duration (Minutes):</label>	
									<input type="text" id="duration" value="" name="duration" />
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Quiz Attempt:</label>	
									<input type="text" id="attempt" value="" name="attempt" />
								</div>
			            	</div>
			            </div>
			              
		                <div id="tf_content"><h4>True or False</h4></div>
		                <div id="mc_content"><h4>Multiple Choice</h4></div>
		                <div id="essay_content"><h4>Essay</h4></div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="create_quiz()">Create</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


	return $data;
	}

	public function Question_Field_Mc($number, $current_number_mc){
        $data='';
        $current_number_mc++;
        for($i=$current_number_mc;$i<=$number;$i++){
        	$data.='
        	<div>
	        	<div class="form-group">
					<label for="qm_">Question Number '. $i .':</label>
		    		<textarea id="qm_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<div class="row">
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="ama_'. $i .'">Choice A:</label>
							<textarea type="input" id="ama_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="amb_'. $i .'">Choice B:</label>
							<textarea type="input" id="amb_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="amc_'. $i .'">Choice C:</label>
							<textarea type="input" id="amc_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="amd_'. $i .'">Choice D:</label>
							<textarea type="input" id="amd_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
				    		<label for="km_'. $i .'">Answer:</label>
			                <select name="km_'. $i .'" id="km_'. $i .'" class="form-control">
								<option value="a">A</option>
								<option value="b">B</option>
								<option value="c">C</option>
								<option value="d">D</option>
							</select>
						</div>
					</div>
		    	</div>
        	</div>';
        }
		return $data;
	}

	public function Question_Field_Essay($number, $current_number_essay){
        $data='';
        $current_number_essay++;
        for($i=$current_number_essay;$i<=$number;$i++){
        	$data.='
        	<div>
	        	<div class="form-group">
					<label for="em_">Question Number '. $i .':</label>
		    		<textarea id="em_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="ek_">Answer:</label>
	    			<textarea id="ek_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="es_">Max Score:</label>
	    			<textarea id="es_'. $i .'" rows="1" cols="10" class="form-control" required ></textarea>
		    	</div>
        	</div>';
        }
		return $data;
	}
	
	public function Question_Field_Tf($number, $current_number_tf){
        $data='';
        $current_number_tf++;
        for($i=$current_number_tf;$i<=$number;$i++){
        	$data.='
        	<div>
	        	<div class="form-group">
					<label for="qtf_">Question Number '. $i .':</label>
		    		<textarea id="qtf_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<div class="row">
			    		<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
				    		<label for="ktf_'. $i .'">Answer:</label>
			                <select name="ktf_'. $i .'" id="ktf_'. $i .'" class="form-control">
								<option value="t">True</option>
								<option value="f">False</option>
							</select>
						</div>
					</div>
		    	</div>
        	</div>';
        }
		return $data;
	}

	public function Write_Quiz($users_id, $class_id, $quiz_name, $duration, $date_created, $date_started, $date_ended, $monarch, $number_mc, $number_e, $attempt, $number_tf){
		$query = $this->db->prepare("INSERT INTO quiz (id_user, id_class, quiz_name, duration, date_created, date_started, date_ended, monarch, total_question_tf, total_question_mc, total_question_essay, attempt)
			VALUES (:users_id, :class_id, :quiz_name, :duration, :date_created, :date_started, :date_ended, :monarch, :total_question_tf, :total_question_mc, :total_question_essay, :attempt)");
        $query->bindParam("users_id", $users_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->bindParam("quiz_name", $quiz_name, PDO::PARAM_STR);
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->bindParam("date_created", $date_created, PDO::PARAM_STR);
        $query->bindParam("date_started", $date_started, PDO::PARAM_STR);
        $query->bindParam("date_ended", $date_ended, PDO::PARAM_STR);
        $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->bindParam("total_question_tf", $number_tf, PDO::PARAM_STR);
        $query->bindParam("total_question_mc", $number_mc, PDO::PARAM_STR);
        $query->bindParam("total_question_essay", $number_e, PDO::PARAM_STR);
        $query->bindParam("attempt", $attempt, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}

	public function Write_QA_MC($quiz_id, $question_number, $question_m, $answer_m){
		$query = $this->db->prepare("INSERT INTO qa_mc_quiz (id_quiz, question_number, question_mc, answer_mc)
			VALUES (:id_quiz, :question_number, :question_mc, :answer_mc)");
        $query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("question_mc", $question_m, PDO::PARAM_STR);
        $query->bindParam("answer_mc", $answer_m, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}

	public function Write_QA_Essay($quiz_id, $question_number, $question_e, $answer_e, $score_essay){
		$query = $this->db->prepare("INSERT INTO qa_essay_quiz (id_quiz, question_number, question_essay, answer_essay, max_essay_score)
			VALUES (:id_quiz, :question_number, :question_essay, :answer_essay, :essay_score)");
        $query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("question_essay", $question_e, PDO::PARAM_STR);
        $query->bindParam("answer_essay", $answer_e, PDO::PARAM_STR);
        $query->bindParam("essay_score", $score_essay, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}
	
	public function Write_QA_TF($quiz_id, $question_number, $question_tf, $answer_tf){
		$query = $this->db->prepare("INSERT INTO qa_tf_quiz (id_quiz, question_number, question_tf, answer_tf)
			VALUES (:id_quiz, :question_number, :question_tf, :answer_tf)");
        $query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("question_tf", $question_tf, PDO::PARAM_STR);
        $query->bindParam("answer_tf", $answer_tf, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}

	public function Write_MC_Quiz($qa_mc_id, $ama, $amb, $amc, $amd){
		$query = $this->db->prepare("INSERT INTO mc_quiz (id_qa_mc_quiz, answer_a, answer_b, answer_c, answer_d)
			VALUES (:id_qa_mc_quiz, :answer_a, :answer_b, :answer_c, :answer_d)");
        $query->bindParam("id_qa_mc_quiz", $qa_mc_id, PDO::PARAM_STR);
        $query->bindParam("answer_a", $ama, PDO::PARAM_STR);
        $query->bindParam("answer_b", $amb, PDO::PARAM_STR);
        $query->bindParam("answer_c", $amc, PDO::PARAM_STR);
        $query->bindParam("answer_d", $amd, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}

	public function Validate_Quiz($quiz_name, $class_id, $monarch){
		$query = $this->db->prepare("SELECT quiz_name, id_class FROM quiz WHERE quiz_name= :quiz_name AND id_class= :id_class AND monarch= :monarch");
		$query->bindParam("quiz_name", $quiz_name, PDO::PARAM_STR);
		$query->bindParam("id_class", $class_id, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if(count($data)>0){
        	$result = "1";
        }
        else{
        	$result= "0";
        }
        return $result;
	}

	public function Show_Quiz_Modal($username, $monarch){
		$query = $this->db->prepare("SELECT DISTINCT class.class_name AS class_name, enrolled_user.id_class AS id_class FROM enrolled_user, class, users
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_class=class.id AND enrolled_user.id_user=users.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        }

		$data='
		<div class="modal fade" id="show_quiz_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Update Quiz</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="class_code">Choose Subject:</label>
				                    <select name="class_code" id="class_code" class="form-control" onchange="set_quiz_question()" required >
										<option value="">--</option>
										'. $data_code .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="quiz_code">Quiz Name</label>
									<select name="quiz_code" id="quiz_code" class="form-control" required >
										<option value="">--</option>
									</select>
								</div>
							</div>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_question()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


	return $data;
	}

  // Dipanggil dari lecture.js funtion set_quiz_question
	public function Set_Quiz_Question($class_id){
		$query = $this->db->prepare("SELECT id, quiz_name FROM quiz
        	 WHERE id_class= :id_class");
		$query->bindParam("id_class", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code='<option value="">--</option>';
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id'] .'"">'. $code['quiz_name'] .'</option>';
        	}
        }
        return $data_code;
	}

  // Dipanggil dari lecture.js funtion show_question
	public function Show_Quiz_Question($quiz_id, $quiz_name){
		$query3 = $this->db->prepare("SELECT id, date_started, date_ended, duration, attempt FROM quiz WHERE id= :quiz_id3");
		$query3->bindParam("quiz_id3", $quiz_id, PDO::PARAM_STR);
        $query3->execute();
        $date_quiz = array();
        while ($row3 = $query3->fetch(PDO::FETCH_ASSOC)) {
            $date_quiz[] = $row3;
        }
        if(count($date_quiz)>0){
        	foreach($date_quiz as $date){
        		$start_date = $date['date_started'];
        		$end_date = $date['date_ended'];
        		$duration = $date['duration'];
        		$attempt = $date['attempt'];
        	}
        }
        
        $data='<label><h3>Question</h3></label>';
        //True False Read
        $query4 = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_tf_quiz.question_number AS question_number_tf, qa_tf_quiz.question_tf, qa_tf_quiz.answer_tf FROM quiz, qa_tf_quiz WHERE quiz.id= :quiz_id4 AND qa_tf_quiz.id_quiz=quiz.id GROUP BY qa_tf_quiz.question_number");
		$query4->bindParam("quiz_id4", $quiz_id, PDO::PARAM_STR);
        $query4->execute();
        $tf_quiz = array();
        while ($row4 = $query4->fetch(PDO::FETCH_ASSOC)) {
            $tf_quiz[] = $row4;
        }
        //Mc Quiz Read
        $query = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_mc_quiz.question_number AS question_number_mc, qa_mc_quiz.answer_mc, qa_mc_quiz.question_mc, mc_quiz.answer_a, mc_quiz.answer_b, mc_quiz.answer_c, mc_quiz.answer_d FROM quiz, qa_mc_quiz, mc_quiz WHERE quiz.id= :quiz_id AND qa_mc_quiz.id_quiz=quiz.id AND mc_quiz.id_qa_mc_quiz=qa_mc_quiz.id GROUP BY qa_mc_quiz.question_number");
		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $mc_quiz = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $mc_quiz[] = $row;
        }
        //Essay quiz read
        $query2 = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_essay_quiz.question_number AS question_number_essay, qa_essay_quiz.question_essay, qa_essay_quiz.answer_essay, qa_essay_quiz.max_essay_score FROM quiz, qa_essay_quiz WHERE quiz.id= :quiz_id2 AND qa_essay_quiz.id_quiz=quiz.id GROUP BY qa_essay_quiz.question_number");
		$query2->bindParam("quiz_id2", $quiz_id, PDO::PARAM_STR);
        $query2->execute();
        $essay_quiz = array();
        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            $essay_quiz[] = $row2;
        }
        //Set Question on select
        for($i=1;$i<=20;$i++)
        	$total_question.='<option value="'. $i .'">'. $i .'</option>';
        
        $data_code='
        <div class="form-group">
        	<div class="row">
        		<div class="col-lg-6 col-sm-12">
        			<label>Quiz Name</lavel>
        			<input type="text" class="form-control" id="u_code_test" value="'. $quiz_name  .'">			
        		</div>
        		<div class="col-lg-6 col-sm-12">
        			<label>Quiz Date range:</label>	
	            	<div class="input-group">
	                	<div class="input-group-addon">
	                    	<i class="fa fa-calendar"></i>
	                	</div>
	                	<input type="text" id="u_daterange" name="u_daterange" value="'. $start_date .' - '. $end_date .'" />
	            	</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-lg-6 col-sm-12">
        			<label>Quiz Duration (Minutes):</label>	
					<input type="text" id="u_duration" value="'. $duration .'" name="u_duration" />
        		</div>
        		<div class="col-lg-6 col-sm-12">
        			<label>Quiz Attempt:</label>	
					<input type="text" id="u_attempt" value="'. $attempt .'" name="u_attempt" />
        		</div>
        	</div>
        </div>
        <div class="form-group">
        	<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="question_mc_n">Number of Multiple Choices Questions:</label>
                    <select name="question_mc_n" id="u_question_mc_n" class="form-control" onchange="set_question_mc_update()" required >
						<option value="0">0</option>
						'. $total_question .'
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="question_essay_n">Number of Essay Questions</label>
					<select name="question_essay_n" id="u_question_essay_n" class="form-control" onchange="set_question_essay_update()" required >
						<option value="0">0</option>
						'. $total_question .'
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="question_tf_n">Number of True or False Questions:</label>
                    <select name="question_tf_n" id="u_question_tf_n" class="form-control" onchange="set_question_tf_update()" required >
						<option value="0">0</option>
						'. $total_question .'
					</select>
				</div>
			</div>
        </div>
        
        <div id="u_tf_content">
        ';
        
        //start true False
        $data_code.='<h4 class="text-center">True or False</h4>';
        if(count($tf_quiz)>0){
    		$i = 1;
    		
          
        	foreach($tf_quiz as $tf){
        		$data_code .= '
        		<div>
        			<div class="form-group">
						<label for="u_qtf_">Question Number '. $i .':</label>
			    		<textarea id="u_qtf_'. $i .'" rows="4" cols="30" class="form-control" required >'. $tf['question_tf'] .'</textarea>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
							<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
					    		<label for="u_ktf_'. $i .'">Answer:</label>
				                <select name="u_ktf_'. $i .'" id="u_ktf_'. $i .'" class="form-control">
									<option value="t">True</option>
									<option value="f">False</option>
								</select>
							</div>
						</div>
			    	</div>
        		</div>';
        		
        		$answer_tf = $tf['answer_tf'];
        		
        		echo '
		        <script>
		        	let answer_tf = "#u_ktf_'. $i .'";
		        	$(answer_tf).val("'. $answer_tf .'");
		        </script>';
		        
		        $i++;
        		// $data_code.='<p>'. $mc['question_number_mc'] . $mc['question_mc'] .'</p>
        		// 			<p>'. $mc['answer_a'] .'  '. $mc['answer_b'] .'  '. $mc['answer_c'] .'  '. $mc['answer_d'] .'</p>';
        	}
        }
        $data_code.='
        </div>
        <div id="u_mc_content">';
        // End True False
        
        // Start Multiple Choice
        $data_code.='<h4 class="text-center">Multiple Choice</h4>';
        if(count($mc_quiz)>0){
    		$i = 1;
    		
          
        	foreach($mc_quiz as $mc){
        		$data_code .= '
        		<div>
        			<div class="form-group">
						<label for="u_qm_">Question Number '. $i .':</label>
			    		<textarea id="u_qm_'. $i .'" rows="4" cols="30" class="form-control" required >'. $mc['question_mc'] .'</textarea>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    			<label for="u_ama_'. $i .'">Choice A:</label>
								<textarea type="input" id="u_ama_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required>'. $mc['answer_a'] .'</textarea>
				    		</div>
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    			<label for="u_amb_'. $i .'">Choice B:</label>
								<textarea type="input" id="u_amb_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required>'. $mc['answer_b'] .'</textarea>
				    		</div>
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    			<label for="u_amc_'. $i .'">Choice C:</label>
								<textarea type="input" id="u_amc_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required>'. $mc['answer_c'] .'</textarea>
				    		</div>
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    			<label for="u_amd_'. $i .'">Choice D:</label>
								<textarea type="input" id="u_amd_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required>'. $mc['answer_d'] .'</textarea>
				    		</div>
				    		
				    		<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
					    		<label for="u_km_'. $i .'">Answer:</label>
				                <select name="u_km_'. $i .'" id="u_km_'. $i .'" class="form-control">
									<option value="a">A</option>
									<option value="b">B</option>
									<option value="c">C</option>
									<option value="d">D</option>
								</select>
							</div>
						</div>
			    	</div>
        		</div>';
        		
        		$answer_mc = $mc['answer_mc'];
        		
        		echo '
		        <script>
		        	let answer = "#u_km_'. $i .'";
		        	$(answer).val("'. $answer_mc .'");
		        </script>';
		        
		        $i++;
        		// $data_code.='<p>'. $mc['question_number_mc'] . $mc['question_mc'] .'</p>
        		// 			<p>'. $mc['answer_a'] .'  '. $mc['answer_b'] .'  '. $mc['answer_c'] .'  '. $mc['answer_d'] .'</p>';
        	}
        }
        $data_code.='
        </div>
        <div id="u_essay_content">';
        // End Multiple Choice
        
        // Start Essay
        $data_code.='<h4 class="text-center">Essay</h4>';
        if(count($essay_quiz)>0){
          
          $i=1;
        	foreach($essay_quiz as $essay){
        		$data_code .='
        		<div>
	        		<div class="form-group">
						<label for="u_em_">Question Number '. $i .':</label>
			    		<textarea id="u_em_'. $i .'" rows="4" cols="30" class="form-control" required >'. $essay['question_essay'] .'</textarea>
			    	</div>
			    	<div class="form-group">
			    		<label for="u_ek_">Answer:</label>
		    			<textarea id="u_ek_'. $i .'" rows="2" cols="30" class="form-control" required >'. $essay['answer_essay'] .'</textarea>
			    	</div>
			    	<div class="form-group">
			    		<label for="u_es_">Max Score:</label>
		    			<textarea id="u_es_'. $i .'" rows="1" cols="10" class="form-control" required >'. $essay['max_essay_score'] .'</textarea>
			    	</div>
        		</div>';
        		$i++;
        		// $data_code.='<p>'. $essay['question_number_essay'] . $essay['question_essay'] .'
        		// Answer: '. $essay['answer_essay'] .'</p>';
        	}
        }
        $data_code.='</div>';
        // End Essay
        
        $data_code .= '
        	<div class="form-group">
        		<button class="btn btn-md btn-primary" onclick="update_quiz()">Save</button>
        		<button class="btn btn-md btn-danger" onclick="delete_quiz()">Delete Quiz</button>
        	</div>
        ';
        //Js set value to select
        echo '
        <script>
        	$("#u_question_mc_n").val('. count($mc_quiz) .');
        	$("#u_question_essay_n").val('. count($essay_quiz) .');
        	$("#u_question_tf_n").val('. count($tf_quiz) .');
        </script>';
        //end js
		return $data_code;
	}
	
	public function Question_Field_Mc_Update($number, $current_number_mc){
        $data='';
        $current_number_mc++;
        for($i=$current_number_mc; $i<=$number; $i++){
        	$data.='
        	<div>
	        	<div class="form-group">
					<label for="u_qm_">Question Number '. $i .':</label>
		    		<textarea id="u_qm_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<div class="row">
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="u_ama_'. $i .'">Choice A:</label>
							<textarea type="input" id="u_ama_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="u_amb_'. $i .'">Choice B:</label>
							<textarea type="input" id="u_amb_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="u_amc_'. $i .'">Choice C:</label>
							<textarea type="input" id="u_amc_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    			<label for="u_amd_'. $i .'">Choice D:</label>
							<textarea type="input" id="u_amd_'. $i .'" placeholder="" class="form-control" rows="1" cols="30" required></textarea>
			    		</div>
			    		<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
				    		<label for="u_km_'. $i .'">Answer:</label>
			                <select name="u_km_'. $i .'" id="u_km_'. $i .'" class="form-control">
								<option value="a">A</option>
								<option value="b">B</option>
								<option value="c">C</option>
								<option value="d">D</option>
							</select>
						</div>
					</div>
		    	</div>
        	</div>';
        }
		return $data;
	}
	
	public function Question_Field_Essay_Update($number, $current_number_essay){
        $data='';
        $current_number_essay++;
        for($i=$current_number_essay; $i<=$number; $i++){
        	$data.='
        	<div>
	        	<div class="form-group">
					<label for="u_em_">Question Number '. $i .':</label>
		    		<textarea id="u_em_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="u_ek_">Answer:</label>
	    			<textarea id="u_ek_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="u_es_">Max Score:</label>
	    			<textarea id="u_es_'. $i .'" rows="1" cols="10" class="form-control" required ></textarea>
		    	</div>
        	</div>';
        }
		return $data;
	}
	
	public function Question_Field_Tf_Update($number, $current_number_tf){
        $data='';
        $current_number_tf++;
        for($i=$current_number_tf; $i<=$number; $i++){
        	$data.='
        	<div>
	        	<div class="form-group">
					<label for="u_qtf_">Question Number '. $i .':</label>
		    		<textarea id="u_qtf_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<div class="row">
			    		<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
				    		<label for="u_ktf_'. $i .'">Answer:</label>
			                <select name="u_ktf_'. $i .'" id="u_ktf_'. $i .'" class="form-control">
								<option value="t">True</option>
								<option value="f">False</option>
							</select>
						</div>
					</div>
		    	</div>
        	</div>';
        }
		return $data;
	}
	
	public function Validate_Quiz_Update($quiz_name, $class_id, $monarch, $quiz_id){
		$query = $this->db->prepare("SELECT quiz_name, id_class FROM quiz WHERE quiz_name= :quiz_name AND id_class= :id_class AND monarch= :monarch AND id NOT IN(:quiz_id)");
		$query->bindParam("quiz_name", $quiz_name, PDO::PARAM_STR);
		$query->bindParam("id_class", $class_id, PDO::PARAM_STR);
	    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
	    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if(count($data)>0){
        	$result = "1";
        }
        else{
        	$result= "0";
        }
        return $result;
	}

  public function Show_Score_Modal($username, $monarch){
		$query = $this->db->prepare("SELECT DISTINCT class.class_name AS class_name, enrolled_user.id_class AS id_class FROM enrolled_user, class, users
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_class=class.id AND enrolled_user.id_user=users.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        }

		$data='
		<div class="modal fade" id="show_score_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Student Essay</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="class_id">Choose Subject:</label>
				                    <select name="class_id" id="class_id" class="form-control" onchange="quiz_id_set()" required >
										<option value="">--</option>
										'. $data_code .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="quiz_id">Quiz Name</label>
									<select name="quiz_id" id="quiz_id" class="form-control" required >
										<option value="">--</option>
									</select>
								</div>
							</div>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_student_dropdown()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


	return $data;
	}
	
	public function Show_Student_Score_Modal($username, $monarch){
		$query = $this->db->prepare("SELECT DISTINCT class.class_name AS class_name, enrolled_user.id_class AS id_class FROM enrolled_user, class, users
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_class=class.id AND enrolled_user.id_user=users.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        }

		$data='
		<div class="modal fade" id="show_student_score_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Student Score</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="class_id_score">Choose Subject:</label>
				                    <select name="class_id_score" id="class_id_score" class="form-control" onchange="quiz_id_score_set()" required >
										<option value="">--</option>
										'. $data_code .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="quiz_id_score">Quiz Name</label>
									<select name="quiz_id_score" id="quiz_id_score" class="form-control" required >
										<option value="">--</option>
									</select>
								</div>
							</div>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_student_score()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


	return $data;
	}
	
	public function Preview_Quiz_Modal($username, $monarch){
		$query = $this->db->prepare("SELECT DISTINCT class.class_name AS class_name, enrolled_user.id_class AS id_class FROM enrolled_user, class, users
        	 WHERE users.username= :username AND class.monarch= :monarch AND enrolled_user.id_class=class.id AND enrolled_user.id_user=users.id");
		$query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id_class'] .'"">'. $code['class_name'] .'</option>';
        	}
        }

		$data='
		<div class="modal fade" id="preview_quiz_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Preview Quiz</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="class_code_preview">Choose Subject:</label>
				                    <select name="class_code_preview" id="class_code_preview" class="form-control" onchange="quiz_id_preview_set()" required >
										<option value="">--</option>
										'. $data_code .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="quiz_code_preview">Quiz Name</label>
									<select name="quiz_code_preview" id="quiz_code_preview" class="form-control" required >
										<option value="">--</option>
									</select>
								</div>
							</div>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="preview_quiz()">Preview</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


	return $data;
	}
	
	public function Preview_Quiz($quiz_id, $quiz_name){
		$query3 = $this->db->prepare("SELECT id, date_started, date_ended, duration, attempt FROM quiz WHERE id= :quiz_id3");
		$query3->bindParam("quiz_id3", $quiz_id, PDO::PARAM_STR);
        $query3->execute();
        $date_quiz = array();
        while ($row3 = $query3->fetch(PDO::FETCH_ASSOC)) {
            $date_quiz[] = $row3;
        }
        if(count($date_quiz)>0){
        	foreach($date_quiz as $date){
        		$start_date = $date['date_started'];
        		$end_date = $date['date_ended'];
        		$duration = $date['duration'];
        		$attempt = $date['attempt'];
        	}
        }
        
        $data='<label><h3>Question</h3></label>';
        // True false Quiz Read
        $query4 = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_tf_quiz.question_number AS question_number_tf, qa_tf_quiz.question_tf, qa_tf_quiz.answer_tf FROM quiz, qa_tf_quiz WHERE quiz.id= :quiz_id4 AND qa_tf_quiz.id_quiz=quiz.id GROUP BY qa_tf_quiz.question_number");
		$query4->bindParam("quiz_id4", $quiz_id, PDO::PARAM_STR);
        $query4->execute();
        $tf_quiz = array();
        while ($row4 = $query4->fetch(PDO::FETCH_ASSOC)) {
            $tf_quiz[] = $row4;
        }
        //Mc Quiz Read
        $query = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_mc_quiz.question_number AS question_number_mc, qa_mc_quiz.answer_mc, qa_mc_quiz.question_mc, mc_quiz.answer_a, mc_quiz.answer_b, mc_quiz.answer_c, mc_quiz.answer_d FROM quiz, qa_mc_quiz, mc_quiz WHERE quiz.id= :quiz_id AND qa_mc_quiz.id_quiz=quiz.id AND mc_quiz.id_qa_mc_quiz=qa_mc_quiz.id GROUP BY qa_mc_quiz.question_number");
		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $mc_quiz = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $mc_quiz[] = $row;
        }
        //Essay quiz read
        $query2 = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_essay_quiz.question_number AS question_number_essay, qa_essay_quiz.question_essay, qa_essay_quiz.answer_essay FROM quiz, qa_essay_quiz WHERE quiz.id= :quiz_id2 AND qa_essay_quiz.id_quiz=quiz.id GROUP BY qa_essay_quiz.question_number");
		$query2->bindParam("quiz_id2", $quiz_id, PDO::PARAM_STR);
        $query2->execute();
        $essay_quiz = array();
        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            $essay_quiz[] = $row2;
        }
        // Header data
        $data_code='<h4>'. $quiz_name .'</h4>
        			<h5>'. $start_date .' s/d '. $end_date .'</h5>
        			<p>Duration: '. $duration .'</p>
        			<p>Attempt: '. $attempt .'</p>';
        // end header
        // True False
        $data_code .='<h5>True or False</h5>';
        if(count($tf_quiz)>0){
        	foreach($tf_quiz as $tf){
        		$true_false='False';
        		if($tf['answer_tf']=='t'){
        			$true_false='True';
        		}
        		$data_code .='<p>'. $tf['question_number_tf'] .'. '. $tf['question_tf'] .'</p>
        			<p>Answer: '. $true_false .'</p>';
        	}
        }
        // end true false
        // Multiple choice
        $data_code .='<h5>Multiple Choice</h5>';
        if(count($mc_quiz)>0){
        	foreach($mc_quiz as $mc){
        		$data_code .='<p>'. $mc['question_number_mc'] .'. '. $mc['question_mc'] .'</p>
        			<p>a. '. $mc['answer_a'] .'     b. '. $mc['answer_b'] .'     c. '. $mc['answer_c'] .'     d. '. $mc['answer_d'] .'</p>
        			<p>Answer: '. $mc['answer_mc'] .'</p>';
        	}
        }
        // end multiple
        // Essay
        $data_code .='<h5>Essay</h5>';
        if(count($essay_quiz)>0){
        	foreach($essay_quiz as $essay){
        		$data_code .='<p>'. $essay['question_number_essay'] .'. '. $essay['question_essay'] .'</p>
        			<p>Answer: '. $essay['answer_essay'] .'</p>';
        	}
        }
        // end essay
        
        return $data_code;
	}

  public function Quiz_Id_Set($class_id){
		$query = $this->db->prepare("SELECT id, quiz_name FROM quiz
        	 WHERE id_class= :id_class");
		$query->bindParam("id_class", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code='<option value="">--</option>';
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id'] .'"">'. $code['quiz_name'] .'</option>';
        	}
        }
        return $data_code;
	}
	
	public function Quiz_Id_Score_Set($class_id){
		$query = $this->db->prepare("SELECT id, quiz_name FROM quiz
        	 WHERE id_class= :id_class");
		$query->bindParam("id_class", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code='<option value="">--</option>';
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id'] .'"">'. $code['quiz_name'] .'</option>';
        	}
        }
        return $data_code;
	}
	
	public function Quiz_Id_Preview_Set($class_id){
		$query = $this->db->prepare("SELECT id, quiz_name FROM quiz
        	 WHERE id_class= :id_class");
		$query->bindParam("id_class", $class_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code='<option value="">--</option>';
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['id'] .'"">'. $code['quiz_name'] .'</option>';
        	}
        }
        return $data_code;
	}

  public function Student_Dropdown($quiz_id, $quiz_name){
    $query = $this->db->prepare("SELECT users.name AS student_name, attempt_quiz.id AS attempt_id, quiz.date_started, quiz.date_ended FROM quiz, attempt_quiz, users WHERE attempt_quiz.id_quiz= :id_quiz AND attempt_quiz.id_user=users.id AND quiz.id= :id_quiz2");
		$query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
		$query->bindParam("id_quiz2", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data='<h3 class="text-center">'. $quiz_name .'</h3>';
        $data_code='';
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.='<option value="'. $code['attempt_id'] .'"">'. $code['student_name'] .'</option>';
        		$date_started=$code['date_started'];
        		$date_ended=$code['date_ended'];
        	}
        }
        $data.='<h3 class="text-center">Date Available: '. $date_started .'
        		s/d '. $date_ended .'</h3>
        		<label for="attempt_id">Choose Student:</label>
                  <select name="attempt_id" id="attempt_id" class="form-control" onchange="show_score()" required >
          <option value="">--</option>
          '. $data_code .'
        </select>';
        return $data;
  }

  public function Show_Score($attempt_id, $student_name){
        $data_code='<!--<h2 class="text-center">'. $student_name .'</h2>
        			<h2 class="text-center">Essay</h2>--><hr>';

     //   $query = $this->db->prepare("SELECT score_mc FROM score_quiz WHERE id_attempt_quiz= :attempt_id");
    	// $query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
     //   $query->execute();
     //   $score_quiz = array();
     //   while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
     //       $score_quiz[] = $row;
     //   }
     //   if(count($score_quiz)>0){
     //     $data_code.='
     //     <hr>
     //     <h4>Multiple Choice</h4>';
     //     foreach($score_quiz as $score){
     //       $data_code.='<p><b>Score: </b>'. $score['score_mc'] .'</p>';
     //     }
     //   }// End Score Multiple Choice
        
        
        // Start Essay
        $i=0;
        $query2 = $this->db->prepare("SELECT DISTINCT answer_essay.answer, qa_essay_quiz.question_number, qa_essay_quiz.question_essay, qa_essay_quiz.answer_essay, qa_essay_quiz.max_essay_score FROM answer_essay, attempt_quiz, qa_essay_quiz WHERE answer_essay.id_attempt_quiz= :attempt_id3 AND answer_essay.id_attempt_quiz=attempt_quiz.id AND qa_essay_quiz.id_quiz= (SELECT attempt_quiz.id_quiz FROM attempt_quiz WHERE attempt_quiz.id= :attempt_id2)");
    	$query2->bindParam("attempt_id3", $attempt_id, PDO::PARAM_STR);
    	$query2->bindParam("attempt_id2", $attempt_id, PDO::PARAM_STR);
        $query2->execute();
        $essay_quiz = array();
        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            $essay_quiz[] = $row2;
        }
        if(count($essay_quiz)>0){
          //$data_code.='<hr><h4>Essay</h4>';
          foreach($essay_quiz as $essay){
            $i++;
            $data_code .='
            	<div class="form-group">
					<label for="u_em_">Question Number '. $i .':</label>
		    		<textarea id="u_em_'. $i .'" rows="4" cols="30" class="form-control" required disabled>'. $essay['question_essay'] .'</textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="u_ek_">Answer Key:</label>
	    			<textarea id="u_ek_'. $i .'" rows="2" cols="30" class="form-control" required disabled>'. $essay['answer_essay'] .'</textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="u_ek_">Student Answer:</label>
	    			<textarea id="u_ea_'. $i .'" rows="2" cols="30" class="form-control" required disabled>'. $essay['answer'] .'</textarea>
		    	</div>
		    	<div class="row">
	        		<div class="col-lg-6 col-sm-12">
	        			<label for="essay_score_'. $essay['question_number'] .'">Input Score</label>
	        			<input type="text" name="essay_score_'. $essay['question_number'] .'" id="essay_score_'. $essay['question_number'] .'" value="">
	        			<input type="hidden" value="'. $essay['max_essay_score'] .'" id="e_es_'. $essay['question_number'] .'">
	        		</div>
	        	</div>
            ';
            
            // $data_code.=
	           // '<p>'. $essay['question_essay'] .'</p>
	           // <p>'. $essay['answer_essay'] .'</p>
	           // <p>'. $essay['answer'] .'</p>
	           // <label for="essay_score_'. $essay['question_number'] .'">Input Score</label>
	           // <input class="form-control" type="text" name="essay_score_'. $essay['question_number'] .'" id="essay_score_'. $essay['question_number'] .'">';
          }
        }
        $data_code.='
        	<br>
        	<button type="button" class="btn btn-primary" onclick="submit_score_essay()">Submit</button>
        	<input type="hidden" id="total_essay" value="'. $i .'">
        ';
        // End Essay
    return $data_code;
  }
  
  public function Show_Student_Score($quiz_id, $quiz_name){
    $query = $this->db->prepare("SELECT users.name, score_quiz.score_mc, score_quiz.score_essay, score_quiz.score_tf, quiz.date_started, quiz.date_ended FROM users, score_quiz, attempt_quiz, quiz WHERE attempt_quiz.id_quiz= :quiz_id AND score_quiz.id_attempt_quiz=attempt_quiz.id AND attempt_quiz.id_user=users.id AND attempt_quiz.id_quiz=quiz.id");
		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data='<h3 class="text-center">'. $quiz_name .'</h3>';
        $data_code .='
        		<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No.</th>
	                  <th>Name</th>
	                  <th>True or False</th>
	                  <th>Multiple Choice</th>
	                  <th>Essay</th>
	                </tr>
	              </thead>
	              <tbody>
        	';
        if(count($codes)>0){
        	$i=1;
        	foreach($codes as $code){
        		$date_started=$code['date_started'];
        		$date_ended=$code['date_ended'];
        		$data_code .='
        				<tr>
        					<td>'. $i .'</td>
        					<td>'. $code['name'] .'</td>
        					<td>'. $code['score_tf'] .'</td>
        					<td>'. $code['score_mc'] .'</td>
        					<td>'. $code['score_essay'] .'</td>
        				</tr>
        				';
        		$i++;
        	}
        }
        else{
        	$data_code .='
        				<tr>
        					<td colspan="5">No record found.</td>
        				</tr>
        				';
        }
        $data_code .='
        			</tbody>
        		</table>
        	';
        $data.='<h3 class="text-center">Date Available: '. $date_started .'
        		s/d '. $date_ended .'</h3>
        		'. $data_code;
        return $data;
  }

  public function Update_Score($attempt_id, $total_score){
    $query = $this->db->prepare("UPDATE score_quiz SET score_essay= :score_essay WHERE id_attempt_quiz= :id_attempt_quiz");
        $query->bindParam("score_essay", $total_score, PDO::PARAM_STR);
        $query->bindParam("id_attempt_quiz", $attempt_id, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Update_Attempt($attempt_id, $is_Scored){
    $query = $this->db->prepare("UPDATE attempt_quiz SET is_Scored= :is_Scored WHERE id= :id_attempt");
        $query->bindParam("id_attempt", $attempt_id, PDO::PARAM_STR);
        $query->bindParam("is_Scored", $is_Scored, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Update_Quiz($quiz_name, $duration, $date_started, $date_ended, $number_mc, $number_e, $quiz_id, $attempt, $number_tf){
    $query = $this->db->prepare("UPDATE quiz SET quiz_name= :quiz_name, duration= :duration, date_started= :date_started, date_ended= :date_ended, total_question_tf= :number_tf, total_question_mc= :number_mc, total_question_essay= :number_e, attempt= :attempt WHERE id= :quiz_id");
        $query->bindParam("quiz_name", $quiz_name, PDO::PARAM_STR);
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->bindParam("date_started", $date_started, PDO::PARAM_STR);
        $query->bindParam("date_ended", $date_ended, PDO::PARAM_STR);
        $query->bindParam("number_tf", $number_tf, PDO::PARAM_STR);
        $query->bindParam("number_mc", $number_mc, PDO::PARAM_STR);
        $query->bindParam("number_e", $number_e, PDO::PARAM_STR);
        $query->bindParam("attempt", $attempt, PDO::PARAM_STR);
        $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
  }
	
	public function Delete_Quiz($quiz_id){
    	$query = $this->db->prepare("DELETE FROM quiz WHERE id = :id");
        $query->bindParam("id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
    }
	
	public function Delete_QA_MC($quiz_id){
    	$query = $this->db->prepare("DELETE FROM qa_mc_quiz WHERE id_quiz= :quiz_id");
        $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
	}
	
	public function Delete_QA_Essay($quiz_id){
    	$query = $this->db->prepare("DELETE FROM qa_essay_quiz WHERE id_quiz= :quiz_id");
        $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
	}
	
	public function Delete_QA_TF($quiz_id){
    	$query = $this->db->prepare("DELETE FROM qa_tf_quiz WHERE id_quiz= :quiz_id");
        $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
	}
	
	// public function Count_Essay_Number($quiz_id){
	// 	$query = $this->db->prepare("SELECT question_essay FROM qa_essay_quiz WHERE id_quiz= :quiz_id");
	// 	$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
 //       $query->execute();
 //       $codes = array();
 //       while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 //           $codes[] = $row;
 //       }
 //       $total_number=count($codes);
        
 //       //echo '<script>alert('. $assignment_id .')</script>';
        
 //       return $total_number;
	// }
	
	// public function Get_Max_Score($attempt_id, $question_number){
	// 	$query = $this->db->prepare("SELECT qa_essay_quiz.max_essay_score FROM quiz, attempt_quiz, qa_essay_quiz WHERE attempt_quiz.id= :attempt_id AND qa_essay_quiz.question_number= :question_number AND attempt_quiz.id_quiz=quiz.id AND qa_essay_quiz.id_quiz=quiz.id");
	// 	$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
	// 	$query->bindParam("question_number", $question_number, PDO::PARAM_STR);
 //       $query->execute();
 //       $codes = array();
 //       while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 //           $codes[] = $row;
 //       }
 //       $max_score=0;
 //       if(count($codes)>0){
 //       	foreach($codes as $code){
 //       		$max_score=$code['max_essay_score'];
 //       	}
 //       }
        
 //       //echo '<script>alert('. $assignment_id .')</script>';
        
 //       return $max_score;
	// }
	
    //Quiz END
    
        // Statistic START
    public function Validate_Statistic($id_user, $id_class){
      $query = $this->db->prepare("SELECT total_post, total_comment, total_upload, total_download FROM statistic WHERE user_id= :id_user AND class_id= :id_class");
  		$query->bindParam("id_user", $id_user, PDO::PARAM_STR);
  		$query->bindParam("id_class", $id_class, PDO::PARAM_STR);
          $query->execute();
          $data = array();
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
          if(count($data)>0){
          	$result = "1";
          }
          else{
          	$result= "0";
          }
          return $result;
    }

    public function Save_Statistic($id_user, $id_class, $post, $comment, $download, $upload){
      $query = $this->db->prepare("INSERT INTO statistic (user_id, class_id, total_post, total_comment, total_upload, total_download)
  			VALUES (:user_id, :class_id, :post, :coment, :upload, :download)");
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->bindParam("post", $post, PDO::PARAM_STR);
          $query->bindParam("coment", $comment, PDO::PARAM_STR);
          $query->bindParam("upload", $download, PDO::PARAM_STR);
          $query->bindParam("download", $upload, PDO::PARAM_STR);
          $query->execute();
          return $this->db->lastInsertId();
    }

    public function Get_Statistic_Post($id_user, $id_class){
      $query = $this->db->prepare("SELECT total_post FROM statistic WHERE user_id= :id_user AND class_id= :id_class");
  		$query->bindParam("id_user", $id_user, PDO::PARAM_STR);
  		$query->bindParam("id_class", $id_class, PDO::PARAM_STR);
          $query->execute();
          $data = array();
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
          if(count($data)>0){
              foreach ($data as $post) {
                $total_post=$post['total_post'];
              }
          }
          return $total_post;
    }

    public function Get_Statistic_Comment($id_user, $id_class){
      $query = $this->db->prepare("SELECT total_comment FROM statistic WHERE user_id= :id_user AND class_id= :id_class");
  		$query->bindParam("id_user", $id_user, PDO::PARAM_STR);
  		$query->bindParam("id_class", $id_class, PDO::PARAM_STR);
          $query->execute();
          $data = array();
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
          if(count($data)>0){
              foreach ($data as $comment) {
                $total_comment=$comment['total_comment'];
              }
          }
          return $total_comment;
    }
    
    public function Get_Statistic_upload($id_user, $id_class){
      $query = $this->db->prepare("SELECT total_upload FROM statistic WHERE user_id= :id_user AND class_id= :id_class");
  		$query->bindParam("id_user", $id_user, PDO::PARAM_STR);
  		$query->bindParam("id_class", $id_class, PDO::PARAM_STR);
          $query->execute();
          $data = array();
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
          if(count($data)>0){
              foreach ($data as $upload) {
                $total_upload=$upload['total_upload'];
              }
          }
          return $total_upload;
    }

    public function Update_Statistic_Post($id_user, $id_class, $statistic_post){
      $query = $this->db->prepare("UPDATE statistic SET total_post= :post WHERE user_id= :user_id AND class_id= :class_id");
          $query->bindParam("post", $statistic_post, PDO::PARAM_STR);
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->execute();
    }

    public function Update_Statistic_Comment($id_user, $id_class, $statistic_comment){
      $query = $this->db->prepare("UPDATE statistic SET total_comment= :comment WHERE user_id= :user_id AND class_id= :class_id");
          $query->bindParam("comment", $statistic_comment, PDO::PARAM_STR);
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->execute();
    }
    
    public function Update_Statistic_Upload($id_user, $id_class, $statistic_upload){
      $query = $this->db->prepare("UPDATE statistic SET total_upload= :upload WHERE user_id= :user_id AND class_id= :class_id");
          $query->bindParam("upload", $statistic_upload, PDO::PARAM_STR);
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->execute();
    }
    
    // Statistic END
}


?>
