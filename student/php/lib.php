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


	//---------------------------Home CONTENT------------------------------------------
	public function Access_Code($class_id){
		$query = $this->db->prepare("SELECT enroll_key FROM class WHERE id= :class_id");
        $query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $enroll_key='';
        if(count($data)>0){
        foreach($data as $data_code){
          $enroll_key.='<p>Access Code: '. $data_code['enroll_key'] .'</p>';
        }
      }
        return $enroll_key;
	}
	
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
							<label for="nama">Title Post</label>
							<input type="text" id="title_post" placeholder="Title Post" class="form-control"/>
						</div>
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
		$query = $this->db->prepare("SELECT users.name AS username, posts.date_created AS date_created, posts.description AS description, posts.id AS post_id FROM posts, users
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

    public function Read_Comment($id, $monarch){
        $query = $this->db->prepare("SELECT users.name AS username, comment_tb.date_created AS date_created, comment_tb.description AS content, comment_tb.id AS comment_id FROM comment_tb, users
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
			<!--<button class="btn btn-success btn-md" data-toggle="modal" data-target="#show_post_modal">Show Post</button>-->
			<button class="btn btn-success btn-md" onclick="show_post()">Show Post</button>
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
								<br><span class="title">'. $description .'</span>
							</div>
							<!-- /.user-block -->
							<div class="box-tools">

								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
							</div>
							<!-- /.box-tools -->
						</div>
							<!-- /.box-header -->
							<!--<div class="box-body">
							'. $description .'
							</div>-->
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

	public function Comment_Post($username, $date_created, $description, $comment_id, $current_user){
		$data='
						<div class="box-footer box-comments">
						  <div class="box-comment">
							<!-- User image -->
							<img class="img-circle img-sm" src="../dist/img/avatar5.png" alt="User Image">

							<div class="comment-text">
								  <span class="username">
									'. $username .':
									<span class="text-muted pull-right">'. $date_created .'</span>
								  </span><!-- /.username -->';
						if($username==$current_user){
							$data .=
								  '<span><button type="button" class="btn btn-box-tool" onclick="delete_comment('. $comment_id .')"><i class="fa fa-trash"></i></button></span>';
						}
		$data .=
							   $description .'
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
							  <textarea id="t_'. $id .'" class="form-control" rows="5"></textarea>
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
		return $data;
	}
	
	public function Delete_Comment($id)
    {
        $query = $this->db->prepare("DELETE FROM comment_tb WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }

	//---------------------------End Home CONTENT------------------------------------------
	//---------------------------Start Enroll------------------------------------------

	//---------------------------End Enroll------------------------------------------
	public function Enroll_Modal($monarch){
    $query = $this->db->prepare("SELECT class.id AS id, class.class_name AS class_name FROM users, class
           WHERE class.monarch= :monarch AND class.id_user=users.id ORDER BY class.class_name ASC");
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
              <select name="code" id="code" class="form-control">
                <option value="">Choose Subject:</option>
                '. $data_code .'
              </select>
						</div>
						<div class="form-group">
							<label for="password">Access Code:</label>
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

		<div class="modal fade" id="create_class_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Create New Class</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="code">Code Subject:</label>
							<input type="text" id="code_class" placeholder="Code Subject" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="password">Enrollment Key:</label>
							<input type="password" id="password_class" placeholder="" class="form-control"/>
						</div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="create_class()">Create</button>
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
				<button class="btn btn-success btn-md" data-toggle="modal" data-target="#enroll_modal">Sign In</button>
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
    	//$class_id=explode("_", $class_name)[1];
    	$data='
    		<tr>
              <td>'. $number .'</td>
              <td>'. $code .'</td>
              <td><a href="class.php?cid='. $class_name .'">'. $class_name .'</a></td>
              <td>'. $date_created .'</td>
              <td><button class="btn btn-danger btn-sm" onclick="delete_enrolled_class(' . $id . ')">Delete</button>
              </td>
            </tr>';
        return $data;
    }

    public function Data_Enroll_Table($username){
    	$query = $this->db->prepare("SELECT enroll.code AS code, enrolled_user.date_created AS date_created, class.class_name AS class_name, enrolled_user.id AS id FROM enrolled_user, users, class, enroll
        	 WHERE users.username= :username AND enrolled_user.id_user=users.id AND enrolled_user.id_enroll=enroll.id AND enrolled_user.id_class=class.id");
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

    public function Enroll_Class_Validate($enroll_id, $enroll_key, $username, $id_class, $monarch){
        $query = $this->db->prepare("SELECT class_name FROM class WHERE id= :id AND enroll_key= :enroll_key");
		$query->bindParam("id", $id_class, PDO::PARAM_STR);
		$query->bindParam("enroll_key", $enroll_key, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if(count($data)>0){
        	$result= "1";//Belum Enroll

        	$query2 = $this->db->prepare("SELECT users.username AS username, enroll.code AS code, class.class_name AS class_name FROM enrolled_user, users, enroll, class WHERE enrolled_user.id_enroll= :id_enroll AND users.username= :username AND enrolled_user.id_class = :id_class AND enrolled_user.monarch= :monarch AND enrolled_user.id_user=users.id AND enrolled_user.id_enroll=enroll.id AND enrolled_user.id_class=class.id");
			$query2->bindParam("id_enroll", $enroll_id, PDO::PARAM_STR);
			$query2->bindParam("username", $username, PDO::PARAM_STR);
      $query2->bindParam("id_class", $id_class, PDO::PARAM_STR);
      $query2->bindParam("monarch", $monarch, PDO::PARAM_STR);
	        $query2->execute();
	        $data2 = array();
	        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
	            $data2[] = $row2;
	        }
	        if(count($data2)>0){
	        	$result= "2"; // already enroll
	        }
        }
        else
        	$result= "0"; // Password Salah
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
        $query = $this->db->prepare("SELECT id_class FROM enrolled_user
        	 WHERE id= :id_enrolled");
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

    public function Get_Enroll_Id($class_code){
        $query = $this->db->prepare("SELECT id_enroll, class_name FROM class
        	 WHERE id= :id_class");
		$query->bindParam("id_class", $class_code, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

	public function Get_Class_Name($id_enrolled){
      $query = $this->db->prepare("SELECT class.class_name FROM enrolled_user, class WHERE enrolled_user.id= :id_enrolled AND enrolled_user.id_class=class.id");
      $query->bindParam("id_enrolled", $id_enrolled, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      return $codes;
    }
    
    public function Assignment_Id_Delete_Enroll($class_id){
      $query = $this->db->prepare("SELECT id FROM assignment WHERE class_id= :class_id");
      $query->bindParam("class_id", $class_id, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      return $codes;
    }
    
    public function File_Name_Delete_Enroll($assignment_id, $user_id){
      $query = $this->db->prepare("SELECT file_name FROM assignment_submitted WHERE assignment_id= :assignment_id AND user_id= :user_id");
      $query->bindParam("assignment_id", $assignment_id, PDO::PARAM_STR);
      $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
      $query->execute();
      $codes = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $codes[] = $row;
      }
      $file_name='';
      foreach($codes as $code){
      	$file_name=$code['file_name'];
      }
      return $file_name;
    }
    
    public function Delete_Assignment_Enroll($assignment_id, $user_id){
    	$query = $this->db->prepare("DELETE FROM assignment_submitted WHERE assignment_id= :assignment_id AND user_id= :user_id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }

    //ENROLL END

    //MATERIAL START
    public function Material_Header(){
		$data = '
			
			<section class="content">
				<br>
				<div class="box box-solid box-primary">
					<div class="box-body">
						<table class="table table-striped table-bordered">
			              <thead>
			                <tr>
			                  <th>No.</th>
			                  <th>Material Title</th>
			                  <th>Download</th>
			                </tr>
			              </thead>
			              <tbody>
		';
			
		return $data;
	}
	
	public function Data_Material_Table($class_id){
    	$query = $this->db->prepare("SELECT title, link FROM general_material WHERE class_id= :class_id ORDER BY title ASC");
    	//$query = $this->db->prepare("SELECT * FROM enroll_user
        	 //WHERE username= :username");
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        }
        $data_code='';
        if(count($datas)>0){
	        $number=0;
	        foreach ($datas as $code) {
	            $number++;
	            $data_code.= '
	            <tr>
	            	<td>'. $number .'</td>
	            	<td>'. $code['title'] .'</td>
	            	<td><a href="'. $code['link'] .'" target="_blank"><button class="btn btn-primary btn-sm"><i class="fa fa-download"></i></button></a></td>
	            </tr>
	            ';
	        }
	    }
	    else{
	        $data_code.='
	        <tr>
	            <td colspan="3">Record Not Found. </td>
	        </tr>
	        ';
	    }
        
        return $data_code;
    }
    
    public function Learning_Header(){
		$data = '
			<section class="content">
				<br>
				<div class="box box-solid box-primary">
					<div class="box-header">
					</div>
					<div class="box-body">
						<!--<div id="learning_source_content"></div>-->
						<table id="datatable" class="table table-striped table-bordered">
			              <thead>
			                <tr>
			                  <th>No.</th>
			                  <th>Material Name</th>
			                  <th>Download</th>
			                </tr>
			              </thead>
			              <tbody>
		';
			
		return $data;
	}
	
	public function Data_Learning_Table($class_id){
    	$query = $this->db->prepare("SELECT title, link FROM learning_source WHERE class_id= :class_id ORDER BY title ASC");
    	//$query = $this->db->prepare("SELECT * FROM enroll_user
        	 //WHERE username= :username");
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        }
        $data_code='';
        if(count($datas)>0){
	        $number=0;
	        foreach ($datas as $code) {
	            $number++;
	            $data_code.= '
	            <tr>
	            	<td>'. $number .'</td>
	            	<td>'. $code['title'] .'</td>
	            	<td><a href="'. $code['link'] .'" target="_blank"><button class="btn btn-primary btn-sm"><i class="fa fa-download"></i></button></a></td>
	            </tr>
	            ';
	        }
	    }
	    else{
	        $data_code.='
	        <tr>
	            <td colspan="3">Record Not Found. </td>
	        </tr>
	        ';
	    }
        
        return $data_code;
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
		<!--<div class="modal fade" id="assignment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
		</div>-->
		
		<div class="modal fade" id="upload_assignment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Upload Assignment</h4>
		            </div>
		            <div class="modal-body">
						<!--<div class="form-group">
							<label for="code">Show Subject:</label>
		                    <select name="class_id" id="class_id" class="form-control" onchange="get_assignment_number()">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
						</div>-->
						<!--<div class="form-group">
							<label for="code">Assignment Number:</label>
		                    <select name="assignment_number" id="assignment_number" class="form-control" onchange="get_assignment_id()">
								<option value="">Assignment Number:</option>
							</select>
		                </div>-->
		                <div class="form-group">
		                	<label for="assignment_title">Assignment Title</label>
		                	<input type="text" id="assignment_title" class="form-control" placeholder="Input Title">
		                	<input type="hidden" id="hidden_assignment_id" value=""/>
		                </div>
		                <div class="form-group">
		                	<label for="input-file">Select File to Upload:</label>
		                	<input type="file" id="input-file" name="input-file" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required="required">
							
		                </div>
					</div>
		            <div class="modal-footer" id="button_div">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button id="upload_student" type="button" class="btn btn-primary" onclick="validate_file_name()">Upload Assignment</button>
		            </div>
		        </div>
		    </div>
		</div>
		
		<!--<div class="modal fade" id="submitted_assignment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Submitted Assignment</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="class_code">Show Subject:</label>
		                    <select name="class_code" id="class_code" class="form-control">
								<option value="">Choose Subject:</option>
								'. $data_code .'
							</select>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="submitted_assignment()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>-->
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
						<button class="btn btn-success btn-md" onclick="show_assignment()">Show Assignment</button>
						<!--<button class="btn btn-success btn-md" data-toggle="modal" data-target="#upload_assignment_modal" onclick="get_assignment_number()">Submit Assignment</button>-->
						<button class="btn btn-success btn-md" onclick="submitted_assignment()">Show Submitted Assignment</button>
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
	
	public function Show_Assignment($class_id, $monarch, $current_date){
		$query = $this->db->prepare("SELECT assignment.id, assignment.file_name, assignment.md5_filename, class.class_name, assignment.assignment_note, assignment.date_started, assignment.date_ended FROM class, assignment WHERE assignment.class_id= :class_id AND assignment.class_id=class.id");
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
	                  <th>Assignment Title</th>
	                  <th>Date Started</th>
	                  <th>Date Ended</th>
	                  <th>Assignment Note</th>
	                  <th>Download</th>
	                  <th>Submit</th>
	                </tr>
	              </thead>
	              <tbody>
        	';
        	foreach($codes as $code){
        		$data_code .='
        				<tr>
	        				<td>'. $i .'</td>
	        				<td>'. $code['file_name'] .'</td>
	        				<td>'. $code['date_started']. '</td>
	        				<td>'. $code['date_ended'] .'</td>
	        				<td>'. $code['assignment_note'] .'</td>
	        				<!--<td><a href="../assignment/'. $code['class_name'] . '_' . $monarch .'/question/'. $code['file_name'] .'" target="_blank"><button class="btn btn-primary">Download</button></a></td>-->
		        				<td><button class="btn btn-primary btn-xs" onclick="download_assignment('. $i .')">Download</button>
	        					<input type="hidden" id="md5_filename_'. $i .'" value="'. $code['md5_filename'] .'">
	        				</td>
	        				<td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#upload_assignment_modal" onclick="submit_assignment_id('. $code['id'] .')">Submit</button></td>
	        			</tr>
	        	';
        		$i++;
        		// $data_code.='<p><strong>'. $code['assignment_number'] .'. </strong>'. $code['file_name'] .'</p> 
        		// 			<a href="../assignment/'. $code['class_name'] . '_' . $monarch .'/question/'. $code['file_name'] .'"><button class="btn btn-primary">Download</button></a>';
        	}
        }
        
        return $data_code;
	}
	
	public function Upload_Assignment($user_id, $file_name, $assignment_id, $score, $md5_filename, $date_uploaded){
		$query = $this->db->prepare("INSERT INTO assignment_submitted (assignment_id, file_name, md5_filename, date_uploaded, user_id, score)
			VALUES (:assignment_id, :file_name, :md5_filename, :date_uploaded, :user_id, :score)");
        $query->bindParam("assignment_id", $assignment_id, PDO::PARAM_STR);
        $query->bindParam("file_name", $file_name, PDO::PARAM_STR);
        $query->bindParam("md5_filename", $md5_filename, PDO::PARAM_STR);
        $query->bindParam("date_uploaded", $date_uploaded, PDO::PARAM_STR);
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->bindParam("score", $score, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}
	
	public function Submitted_Assignment($user_id, $class_id, $monarch, $current_date){
		//select score here
		$query = $this->db->prepare("SELECT DISTINCT assignment_submitted.id, assignment_submitted.file_name, assignment_submitted.md5_filename, class.class_name, assignment_submitted.score, assignment.date_ended, assignment_submitted.date_uploaded FROM class, assignment, assignment_submitted WHERE assignment_submitted.user_id= :user_id AND assignment.class_id= :class_id AND assignment.class_id=class.id AND assignment_submitted.assignment_id=assignment.id");
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
	                  <th>File Name</th>
	                  <th>Date Ended</th>
	                  <th>Date Uploaded</th>
	                  <th>Score</th>
	                  <th>Download</th>
	                  <th>Delete</th>
	                </tr>
	              </thead>
	              <tbody>
        	';
        	foreach($codes as $code){
        		if($code['date_uploaded'] > $code['date_ended']){
        			$date_upload='<td style="color: red;">'. $code['date_uploaded'] .'</td>';
        		}
        		else{
        			$date_upload='<td>'. $code['date_uploaded'] .'</td>';
        		}
        		$data_code .= '
        			<tr>
        				<td> '. $i .'</td>
        				<td> '. $code['file_name'] .'</td>
        				<td> '. $code['date_ended'] .'</td>
        				'. $date_upload .'
        				<td> '. $code['score'].'</td>
        				<!--<td> <a href="../assignment/'. $code['class_name'] . '_' . $monarch .'/answer/'. $code['file_name'] .'"><button class="btn btn-primary">Download</button></a></td>-->
        				<td><button class="btn btn-primary btn-xs" onclick="download_submitted('. $i .')">Download</button>
        					<input type="hidden" id="md5_filename_'. $i .'" value="'. $code['md5_filename'] .'">
        				</td>
        				<td><button class="btn btn-danger btn-xs" onclick="delete_assignment('. $code['id'] .')">Delete</button></td>
        			</tr>
        		';
        		$i++;
        		
        		// $data_code.='<p>'. $code['file_name'] .'</p> 
        		// 			<a href="../assignment/'. $code['class_name'] . '_' . $monarch .'/answer/'. $code['file_name'] .'"><button class="btn btn-primary">Download</button></a>
        		// 			<button class="btn btn-danger" onclick="delete_assignment('. $code['id'] .')">Delete</button>';
        	}
        }
        
        return $data_code;
	}
	
	public function Get_File_Name($assignment_submitted_id){
		$query = $this->db->prepare("SELECT file_name FROM assignment_submitted WHERE id= :assignment_submitted_id");
		$query->bindParam("assignment_submitted_id", $assignment_submitted_id, PDO::PARAM_STR);
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
	
	public function Get_Assignment_Number($class_id){
		$query = $this->db->prepare("SELECT COUNT(file_name) AS total FROM assignment WHERE class_id= :class_id");
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
	
	public function Get_Assignment_Id($class_id, $assignment_number, $current_date){
		$query = $this->db->prepare("SELECT id, date_started, date_ended FROM assignment WHERE class_id= :class_id AND assignment_number= :assignment_number");
		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
		$query->bindParam("assignment_number", $assignment_number, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $assignment_id=0;
        if(count($codes)>0){
        	
        	foreach($codes as $code){
        		if($current_date >= $code['date_started'] && $current_date <= $code['date_ended']){
        			$assignment_id=$code['id'];
        		}
        	}
        }
        
        //echo '<script>alert('. $assignment_id .')</script>';
        
        return $assignment_id;
	}
	
	public function Delete_Assignment($assignment_submitted_id){
		$query = $this->db->prepare("DELETE FROM assignment_submitted WHERE id = :id");
        $query->bindParam("id", $assignment_submitted_id, PDO::PARAM_STR);
        $query->execute();
	}
	
	public function Validate_Assignment_Number($assignment_id, $user_id){
		$query = $this->db->prepare("SELECT id FROM assignment_submitted WHERE assignment_id= :assignment_id AND user_id= :user_id");
		$query->bindParam("assignment_id", $assignment_id, PDO::PARAM_STR);
		$query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $result='0'; // Belum pernah upload 
        if(count($codes)>0){
        	$result='1'; // Sudah pernah upload
        }
        
        //echo '<script>alert('. $assignment_id .')</script>';
        
        return $result;
	}
	
	public function Link_Download_Assignment($md5_filename, $monarch){
		$query = $this->db->prepare("SELECT assignment.file_name, class.class_name FROM assignment, class WHERE assignment.md5_filename= :md5_filename AND assignment.class_id=class.id");
		$query->bindParam("md5_filename", $md5_filename, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.= '../assignment/'. $code['class_name'] . '_' . $monarch .'/question/'. $code['file_name'];
        	}
        }
        
        return $data_code;
	}
	
	public function Link_Download_Submitted($md5_filename, $monarch){
		$query = $this->db->prepare("SELECT assignment_submitted.file_name, class.class_name FROM assignment_submitted, class, assignment WHERE assignment_submitted.md5_filename= :md5_filename AND assignment_submitted.assignment_id=assignment.id AND assignment.class_id=class.id");
		$query->bindParam("md5_filename", $md5_filename, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		$data_code.= '../assignment/'. $code['class_name'] . '_' . $monarch .'/answer/'. $code['file_name'];
        	}
        }
        
        return $data_code;
	}
	
    //ASSIGNMENT END

    //Quiz START
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
		<!--<div class="modal fade" id="quiz_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
									<label for="question_mc_n">Number of Multiple Choices Questions:</label>
				                    <select name="question_mc_n" id="question_mc_n" class="form-control" onchange="set_question_mc()" required >
										<option value="0">0</option>
										'. $total_question .'
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="question_essay_n">Number of Essay Questions</label>
									<select name="question_essay_n" id="question_essay_n" class="form-control" onchange="set_question_essay()" required >
										<option value="0">0</option>
										'. $total_question .'
									</select>
								</div>
							</div>
		                </div>
		                <div id="mc_content"></div>
		                <div id="essay_content"></div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="create_quiz()">Create</button>
		            </div>
		        </div>
		    </div>
		</div>-->
		<h1>
			Quiz
			<small></small>
		</h1>
		</br>
			<div class="pull-left">
				<!--<button class="btn btn-success btn-md" data-toggle="modal" data-target="#quiz_modal">Create Quiz</button>-->
				<button class="btn btn-success btn-md" data-toggle="modal" data-target="#show_quiz_modal">Show Quiz</button>
			</div>
		</br></br>
		';


	return $data;
	}

	public function Question_Field_Mc($number){
        $data='<label><h4>Multiple Choice</h4></label>';
        for($i=1;$i<=$number;$i++){
        	$data.='
	        	<div class="form-group">
					<label for="qm_">Question Number '. $i .':</label>
		    		<textarea id="qm_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<div class="row">
			    		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			    			<label for="ama_'. $i .'">Choice A:</label>
							<input type="input" id="ama_'. $i .'" placeholder="" class="form-control" required />
			    		</div>
			    		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			    			<label for="amb_'. $i .'">Choice B:</label>
							<input type="input" id="amb_'. $i .'" placeholder="" class="form-control" required />
			    		</div>
			    		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			    			<label for="amc_'. $i .'">Choice C:</label>
							<input type="input" id="amc_'. $i .'" placeholder="" class="form-control" required />
			    		</div>
			    		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			    			<label for="amd_'. $i .'">Choice D:</label>
							<input type="input" id="amd_'. $i .'" placeholder="" class="form-control" required />
			    		</div>
			    		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
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
        	';
        }
		return $data;
	}

	public function Question_Field_Essay($number){
        $data='<label><h4>Essay</h4></label>';
        for($i=1;$i<=$number;$i++){
        	$data.='
	        	<div class="form-group">
					<label for="em_">Question Number '. $i .':</label>
		    		<textarea id="em_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="ek_">Answer:</label>
	    			<textarea id="ek_'. $i .'" rows="4" cols="30" class="form-control" required ></textarea>
		    	</div>
        	';
        }
		return $data;
	}

	public function Write_Quiz($users_id, $class_id, $quiz_name, $duration, $date_created, $monarch, $number_mc, $number_e){
		$query = $this->db->prepare("INSERT INTO quiz (id_user, id_class, quiz_name, duration, date_created, monarch, total_question_mc, total_question_essay)
			VALUES (:users_id, :class_id, :quiz_name, :duration, :date_created, :monarch, :total_question_mc, :total_question_essay)");
        $query->bindParam("users_id", $users_id, PDO::PARAM_STR);
        $query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->bindParam("quiz_name", $quiz_name, PDO::PARAM_STR);
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->bindParam("date_created", $date_created, PDO::PARAM_STR);
        $query->bindParam("monarch", $monarch, PDO::PARAM_STR);
        $query->bindParam("total_question_mc", $number_mc, PDO::PARAM_STR);
        $query->bindParam("total_question_essay", $number_e, PDO::PARAM_STR);
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

	public function Write_QA_Essay($quiz_id, $question_number, $question_e, $answer_e){
		$query = $this->db->prepare("INSERT INTO qa_essay_quiz (id_quiz, question_number, question_essay, answer_essay)
			VALUES (:id_quiz, :question_number, :question_essay, :answer_essay)");
        $query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("question_essay", $question_e, PDO::PARAM_STR);
        $query->bindParam("answer_essay", $answer_e, PDO::PARAM_STR);
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

  /*
    Mengecek apakah nama quiz sudah ada enroll dan monarch yang sma
  */
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
		                <h4 class="modal-title" id="myModalLabel">Show Quiz</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="class_code">Choose Subject:</label>
				                    <select name="class_code" id="class_code" class="form-control" onchange="set_quiz_question()" required >
										<option value="">--</option>
										'. $data_code .'
									</select>
								</div>-->
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="quiz_code">Quiz Name</label>
									<select name="quiz_code" id="quiz_code" class="form-control" onchange="set_id_quiz()" required >
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
	
	public function Student_Score_Modal(){
		$data='
		<div class="modal fade" id="student_score_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="quiz()"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Quiz Score</h4>
		            </div>
		            <div class="modal-body">
						<div id="student_score"></div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="quiz()">Close</button>
		            </div>
		        </div>
		    </div>
		</div>
   
		';


		return $data;
	}
	
	public function Student_Score($id_attempt){
		$query = $this->db->prepare("SELECT score_quiz.score_mc, score_quiz.score_tf, quiz.total_question_tf, quiz.total_question_mc FROM score_quiz, quiz, attempt_quiz WHERE score_quiz.id_attempt_quiz= :id_attempt AND score_quiz.id_attempt_quiz=attempt_quiz.id AND attempt_quiz.id_quiz=quiz.id");
		$query->bindParam("id_attempt", $id_attempt, PDO::PARAM_STR);
        $query->execute();
        $codes = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $codes[] = $row;
        }
        $data_code="";
        if(count($codes)>0){
        	foreach($codes as $code){
        		if($code['total_question_tf'] > 0){
        			$data_code .='
        			<div class="row">
        				<div class="col-lg-6 col-sm-12">
		        			<div class="callout callout-info">
					            <h3 class="text-center">True or False Score</h3>
								<h2 class="text-center">'. $code['score_tf'] .'</h2>
					        </div>
					    </div>
		        	';
        		}
        		
        		if($code['total_question_mc'] > 0){
        			$data_code .='
        				<div class="col-lg-6 col-sm-12">
		        			<div class="callout callout-info">
					            <h3 class="text-center">Multiple Choice Score</h3>
								<h2 class="text-center">'. $code['score_mc'] .'</h2>
					        </div>
					    </div>
				     </div>
		        	';
        		}
        	}
        }
        
        $data_code.='
        	<div class="row">
        		<div class="col-lg-12 col-sm-12">
        			<label for="quiz_type_submit">Quiz Type</label>
        			<select name="quiz_type_submit" id="quiz_type_submit" class="form-control" onchange="show_submit_answer()" required>
        				<option value="--">--</option>
        				<option value="1">True or False</option>
        				<option value="2">Multiple Choice</option>
        			</select>
        		</div>
        	</div>
        	<hr>
        	<div id="show_submit_answer"></div>
        ';
		
		return $data_code;
	}
	
	public function Show_Score_Quiz_Modal($username, $monarch){
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
		                <h4 class="modal-title" id="myModalLabel">Show Quiz Score</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label for="class_code_score">Choose Subject:</label>
				            <select name="class_code_score" id="class_code_score" class="form-control" required >
								<option value="">--</option>
										'. $data_code .'
							</select>
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary" onclick="show_quiz_score()">Show</button>
		            </div>
		        </div>
		    </div>
		</div>
   
		';


	return $data;
	}
	
	public function Quiz_Header(){
    	$data = '
    	<section class="content-header">
	    	<h1>
				Quiz
				<small></small>
			</h1>
			</br>
				<div class="pull-left">
					<button class="btn btn-success btn-md" onclick="set_quiz_question()">Show Quiz</button>
	    			<button class="btn btn-success btn-md" onclick="show_quiz_score()">Show Score</button>
				</div>
		</section>
		<section class="content">
			<br>
			<div class="box box-solid box-primary">
				<div class="box-body">
					<div id="quiz_content"></div>
					<div id="quiz_score_content"></div>
				</div>
			</div>
		</section>
    	';
    	
    	return $data;
    }
	
	 // Dipanggil dari student.js funtion set_quiz_question
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
	
	public function Timer_Style(){
		$data = '
		<style>
        	#timer_cont {
				position: fixed;
				height: 100px;
				width: 15%;
				min-width: 250px;
				color: white;
				text-align: center;
				bottom: 2%;
				left: 65%;
				font-size: 18px;
				padding: .5% 0;
				border-radius: 6px;
				-webkit-transition: background 0.3s ease-in-out;
		        -ms-transition:     background 0.3s ease-in-out;
		        transition:         background 0.3s ease-in-out;
        	}
        	.red {
        		background-color: red;
        		opacity: 1;
        	}
        	.red.opacity{
        		opacity: 0.5;
        	}
        	.green {
        		background-color: #00a65a;
        	}
        	#quiz_duration{
        		font-size: 2.5em;
        	}
        	@media screen and (max-width: 992px) {
	        	#timer_cont {
	        		height: 85px;
		        	min-width: 200px;
					font-size: 14px;
					padding: 1% 0;
	        	}
			    #quiz_duration{
	        		font-size: 2.5em;
	        	}
			}
			@media screen and (max-width: 768px) {
	        	#timer_cont {
	        		height: 70px;
		        	min-width: 180px;
					font-size: 12px;
					padding: 1% 0;
					bottom: 1%;
					left: 50%;
	        	}
			    #quiz_duration{
	        		font-size: 2.3em;
	        	}
			}
        </style>';
        
        return $data;
	}
	
	public function Timer_Script($duration){
		$data = '
		var blinkInterval;
				    
		function blink_background(){
			var blink = $("#timer_cont");
			blink.attr("class", "red");
			blinkInterval = setInterval(function(){
			blink.toggleClass("opacity");
			},500);
		}
				    
		var repeat = true;
		var timer = new Date();
		timer.setMinutes(timer.getMinutes() + '. $duration .');
		var countdown = timer;
		clock = $("#quiz_duration").countdown(countdown, function(event) {
			$(this).html(event.strftime("%H : %M : %S"));
		}).on("update.countdown", function(event) {
			panic_time = $("#quiz_duration").text().split(" : ");
			if (repeat && parseInt(panic_time[1]) == 0 && parseInt(panic_time[2]) <= 59) {
				blink_background();
			    repeat = false;
			}
		}).on("finish.countdown", function(event) {
			clearInterval(blinkInterval);
	       	$("#timer_cont").attr("class", "red");
	        submit_question();
		});
	    ';
	    
	    return $data;
	}

  // Dipanggil dari student.js funtion show_question
	public function Show_Quiz_Question($attempt, $quiz_id, $duration){
        $data='<label><h4>Question</h4></label>';
        // Query get attempt di kuiz
        $query3 = $this->db->prepare("SELECT attempt FROM quiz WHERE id= :quiz_id3");
		$query3->bindParam("quiz_id3", $quiz_id, PDO::PARAM_STR);
        $query3->execute();
        $attempt_get = array();
        while ($row3 = $query3->fetch(PDO::FETCH_ASSOC)) {
            $attempt_get[] = $row3;
        }
        if(count($attempt_get)>0){
        	foreach($attempt_get as $attempts){
        		$max_attempt=$attempts['attempt'];
        	}
        }
        //end get attempt
        //Start True False
        $query4 = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_tf_quiz.question_number AS question_number_tf, qa_tf_quiz.question_tf FROM quiz, qa_tf_quiz WHERE quiz.id= :quiz_id AND qa_tf_quiz.id_quiz=quiz.id GROUP BY qa_tf_quiz.question_number");
		$query4->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query4->execute();
        $tf_quiz = array();
        while ($row4 = $query4->fetch(PDO::FETCH_ASSOC)) {
            $tf_quiz[] = $row4;
        }
        // End true false
        //start multiple
        $query = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_mc_quiz.question_number AS question_number_mc, qa_mc_quiz.question_mc, mc_quiz.answer_a, mc_quiz.answer_b, mc_quiz.answer_c, mc_quiz.answer_d FROM quiz, qa_mc_quiz, mc_quiz WHERE quiz.id= :quiz_id AND qa_mc_quiz.id_quiz=quiz.id AND mc_quiz.id_qa_mc_quiz=qa_mc_quiz.id GROUP BY qa_mc_quiz.question_number");
		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $mc_quiz = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $mc_quiz[] = $row;
        }
        $total_tf=0;
        $total_mc=0;
        $total_essay=0;
        $remaining=$max_attempt-$attempt;
        $data_code = $this->Timer_Style().'
	    <hr>
        	<div class="row">
        		<div class="col-lg-6 col-sm-6">
        			Number of Attempt(s): '. $attempt .'
        		</div>
        		<div class="col-lg-6 col-sm-6">
        			Remaining Chance(s): '. $remaining .'<br>
        		</div>
        	</div>
        	<!--<div class="timer">
        		<div class="col-lg-12 col-sm-12 col-xs-12">
        			Duration: <div id="quiz_duration" class="blue"></div>
        		</div>
        	</div>-->
        	<div id=timer_cont class="green">
        		Time left for this assessment: <div id="quiz_duration"></div>
        	</div>
	    ';
	    
	    
	   // Show time in js, move to student.js
	    echo '
	    <script type="text/javascript">
				$(document).ready(function() {
					/*clock = $("#quiz_duration").FlipClock({
				        clockFace: "HourlyCounter",
				        autoStart: false,
				        callbacks: {
				        	stop: function() {
				        		submit_question();
				        	}
				        }
				    });
						    
				    clock.setTime('. $duration*60 .');
				    clock.setCountdown(true);
				    clock.start();*/
				    
				    '. $this->Timer_Script($duration) .'
				});
			</script>';
        
        // Start Multiple Choice
        if(count($mc_quiz)>0){
          $data_code.='<hr><h4 class="text-center">Multiple Choice</h4>';
        	foreach($mc_quiz as $mc){
				$data_code.=
				'
					<div class="form-group">
						<label for="qm_">Question Number '. $mc['question_number_mc'] .':</label>
						<textarea rows="4" cols="30" class="form-control" disabled>'. $mc['question_mc'] .'</textarea>
					</div>
					<div class="form-group">
						<label>A </label><input type="radio" name="answer_'. $mc['question_number_mc'] .'" value="a">'. $mc['answer_a'] .'<br>
				        <label>B </label><input type="radio" name="answer_'. $mc['question_number_mc'] .'" value="b">'. $mc['answer_b'] .'<br>
				        <label>C </label><input type="radio" name="answer_'. $mc['question_number_mc'] .'" value="c">'. $mc['answer_c'] .'<br>
				        <label>D </label><input type="radio" name="answer_'. $mc['question_number_mc'] .'" value="d">'. $mc['answer_d'] .'
					</div>
				';
        	   $total_mc++;
        	}
        }// End Multiple Choice
        
        // Start True False
		if(count($tf_quiz)>0){
          $data_code.='<hr><h4 class="text-center">True or False</h4>';
        	foreach($tf_quiz as $tf){
				$data_code.=
				'
					<div class="form-group">
						<label for="qm_">Question Number '. $tf['question_number_tf'] .':</label>
						<textarea rows="4" cols="30" class="form-control" disabled>'. $tf['question_tf'] .'</textarea>
					</div>
					<div class="form-group">
						<input type="radio" name="answer_tf_'. $tf['question_number_tf'] .'" value="t"> True<br>
				        <input type="radio" name="answer_tf_'. $tf['question_number_tf'] .'" value="f"> False<br>
					</div>
				';
        	   $total_tf++;
        	}
        }// End True False
        
        // Start Essay
        $query2 = $this->db->prepare("SELECT quiz.id AS quiz_id, quiz.quiz_name AS quiz_name, qa_essay_quiz.question_number AS question_number_essay, qa_essay_quiz.question_essay FROM quiz, qa_essay_quiz WHERE quiz.id= :quiz_id AND qa_essay_quiz.id_quiz=quiz.id GROUP BY qa_essay_quiz.question_number");
		$query2->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query2->execute();
        $essay_quiz = array();
        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            $essay_quiz[] = $row2;
        }
        if(count($essay_quiz)>0){
          $data_code.='<hr><h4 class="text-center">Essay</h4>';
        	foreach($essay_quiz as $essay){
        		$data_code.=
        		'
        			<div class="form-group">
						<label">Question Number '. $essay['question_number_essay'] .':</label>
						<textarea rows="4" cols="30" class="form-control" disabled>'. $essay['question_essay'] .'</textarea>
					</div>
        			<div class="form-group">
						<label">You Answer: </label>
						<textarea id="answer_essay_'. $essay['question_number_essay'] .'" name="answer_essay_'. $essay['question_number_essay'] .' rows="4" cols="30" class="form-control" required>
						</textarea>
					</div>
        		';
        		
                $total_essay++;
        	}
        }// End Essay
        
        $data_code.='
        	<input type="hidden" id="total_mc" value="'. $total_mc .'">
        	<input class="form-control" type="hidden" id="total_essay" value="'. $total_essay .'">
        	<input class="form-control" type="hidden" id="total_tf" value="'. $total_tf .'">
        	<br>
           	<button type="button" class="btn btn-primary" onclick="validate_submit_answer()">Submit</button>
        ';
		return $data_code;
	}

  /*
    Digunakan utk melakukan validasi apakah student sudah mencoba mnjawb quiz sbnyak 3x ato belum
  */
  public function Validate_Quiz_Attempt($quiz_id, $user_id){
  	// Query get attempt di quiz
  	$query2 = $this->db->prepare("SELECT attempt FROM quiz WHERE id= :quiz_id2");
    $query2->bindParam("quiz_id2", $quiz_id, PDO::PARAM_STR);
    $query2->execute();
    $quizes2 = array();
    while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
        $quizes2[] = $row2;
    }
    if (count($quizes2)>0) {
      foreach ($quizes2 as $quiz2) {
        $attempt=$quiz2['attempt'];
      }
    }
    //End attempt
    // Query validasi quiz attempt
    $query = $this->db->prepare("SELECT attempt, is_scored, is_submit, duration FROM attempt_quiz WHERE id_quiz= :quiz_id AND id_user= :user_id");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    $quizes = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $quizes[] = $row;
    }
    if (count($quizes)>0) {
      foreach ($quizes as $quiz) {
        if($quiz['attempt']>=$attempt || $quiz['is_scored']==1 || $quiz['duration']<=0 || $quiz['is_submit']==1){
          $result= "2"; // Tidak bisa mnjwab soal
        }
        else{
          $result= "1"; // sudah mnjawab soal tetapi msih memliki ksmpatan
        }
      }
    }
    else{
      $result= "0"; // belum prnah mnjwab soal
    }

    return $result;
  }

  // Untk menmbahkan row baru pada attempt_quiz jika student belum prnah sma skli mnjawab soal tersbut
  public function Insert_Attempt($quiz_id, $user_id, $attempt, $is_scored, $duration){
    $query = $this->db->prepare("INSERT INTO attempt_quiz (id_quiz, id_user, attempt, is_scored, duration)
			VALUES (:id_quiz, :id_user, :attempt, :is_scored, :duration)");
        $query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
        $query->bindParam("id_user", $user_id, PDO::PARAM_STR);
        $query->bindParam("attempt", $attempt, PDO::PARAM_STR);
        $query->bindParam("is_scored", $is_scored, PDO::PARAM_STR);
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
  }

  /*
    Digunakan saat siswa msh memiliki ksmpatan utk mnjawab soal. Dan akan melakukan update attemt pada attempt quiz table utk siswa yg msh bsa mnjawab.
  */
  public function Update_Attempt($attempt, $id_quiz, $id_user){
    $attempt += 1;
    $query = $this->db->prepare("UPDATE attempt_quiz SET attempt= :attempt WHERE id_quiz= :id_quiz AND id_user= :id_user");
        $query->bindParam("attempt", $attempt, PDO::PARAM_STR);
        $query->bindParam("id_user", $id_user, PDO::PARAM_STR);
        $query->bindParam("id_quiz", $id_quiz, PDO::PARAM_STR);
        $query->execute();
  }

  /*
    Mendpatkan nilai attempt sesuai dngan user id dan quiz id
  */
  public function Get_Attempt($quiz_id, $user_id){
    $query = $this->db->prepare("SELECT attempt FROM attempt_quiz WHERE id_quiz= :quiz_id AND id_user= :user_id");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    if (count($datas)>0) {
      foreach ($datas as $data) {
        $attempt=$data['attempt'];
      }
    }
    return $attempt;
  }

 /*
  Mendapatkan id_attempt yg digunakan untuk mnympan dan menvalidasi score
 */
  public function Get_Id_Attempt($quiz_id, $user_id){
    $query = $this->db->prepare("SELECT id FROM attempt_quiz WHERE id_quiz= :quiz_id AND id_user= :user_id");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    if (count($datas)>0) {
      foreach ($datas as $data) {
        $id_attempt=$data['id'];
      }
    }
    return $id_attempt;
  }

  /*
    Menbandingkan jawaban yg djwab student dngan knci jawaban
  */
  public function Get_Answer($quiz_id, $mc_number, $answer){
    $query = $this->db->prepare("SELECT answer_mc FROM qa_mc_quiz WHERE id_quiz= :quiz_id AND question_number= :mc_number");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->bindParam("mc_number", $mc_number, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    $result=0; // Jika jawaban berbeda dengan knci
    if (count($datas)>0) {
      foreach ($datas as $data) {
        if($data['answer_mc']==$answer){
          $result=1; // jika jawaban sama dengan kunci
        }
      }
    }
    return $result;
  }
  
  /*
    Menbandingkan jawaban yg djwab student dngan knci jawaban
  */
  public function Get_Answer_TF($quiz_id, $tf_number, $answer_tf){
    $query = $this->db->prepare("SELECT answer_tf FROM qa_tf_quiz WHERE id_quiz= :quiz_id AND question_number= :tf_number");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->bindParam("tf_number", $tf_number, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    $result=0; // Jika jawaban berbeda dengan knci
    if (count($datas)>0) {
      foreach ($datas as $data) {
        if($data['answer_tf']==$answer_tf){
          $result=1; // jika jawaban sama dengan kunci
        }
      }
    }
    return $result;
  }

  /*
    Menympan nilai yg diperoleh student jika belum perna mensubmit jawaban seblumnya
  */
  public function Save_Score($id_attempt, $total_score_mc, $total_score_essay, $total_score_tf){
    $query = $this->db->prepare("INSERT INTO score_quiz (id_attempt_quiz, score_mc, score_essay, score_tf)
			VALUES (:id_attempt_quiz, :score_mc, :score_essay, :score_tf)");
        $query->bindParam("id_attempt_quiz", $id_attempt, PDO::PARAM_STR);
        $query->bindParam("score_mc", $total_score_mc, PDO::PARAM_STR);
        $query->bindParam("score_essay", $total_score_essay, PDO::PARAM_STR);
        $query->bindParam("score_tf", $total_score_tf, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
  }

  /*
    Mencocokan apakah student sudah prnah mensubmit jawaban ato belum
  */
  public function Validate_Score($id_attempt){
    $query = $this->db->prepare("SELECT score_mc, score_essay FROM score_quiz WHERE id_attempt_quiz= :id_attempt");
    $query->bindParam("id_attempt", $id_attempt, PDO::PARAM_STR);
    $query->execute();
    $attempts = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $attempts[] = $row;
    }
    if (count($attempts)>0){
      $result= "1"; // Sudah pernah mensubmit jawaban
    }
    else{
      $result= "0"; // belum prnah mensubmit jawaban
    }
    
    return $result;
  }

  /*
    Merubah nilai yg dtrma oleh student
  */
  public function Update_Score($id_attempt, $total_score_mc, $total_score_essay, $total_score_tf){
    $query = $this->db->prepare("UPDATE score_quiz SET score_mc= :score_mc, score_essay= :score_essay, score_tf= :score_tf WHERE id_attempt_quiz= :id_attempt_quiz");
        $query->bindParam("score_mc", $total_score_mc, PDO::PARAM_STR);
        $query->bindParam("score_essay", $total_score_essay, PDO::PARAM_STR);
        $query->bindParam("score_tf", $total_score_tf, PDO::PARAM_STR);
        $query->bindParam("id_attempt_quiz", $id_attempt, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Save_Tf($question_number, $answer, $id_attempt_quiz){
    $query = $this->db->prepare("INSERT INTO answer_tf (question_number, answer, id_attempt_quiz)
			VALUES (:question_number, :answer, :id_attempt_quiz)");
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("answer", $answer, PDO::PARAM_STR);
        $query->bindParam("id_attempt_quiz", $id_attempt_quiz, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
  }
  
  public function Save_Mc($question_number, $answer, $id_attempt_quiz){
    $query = $this->db->prepare("INSERT INTO answer_mc (question_number, answer, id_attempt_quiz)
			VALUES (:question_number, :answer, :id_attempt_quiz)");
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("answer", $answer, PDO::PARAM_STR);
        $query->bindParam("id_attempt_quiz", $id_attempt_quiz, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
  }

  public function Save_Essay($question_number, $answer, $id_attempt_quiz){
    $query = $this->db->prepare("INSERT INTO answer_essay (question_number, answer, id_attempt_quiz)
			VALUES (:question_number, :answer, :id_attempt_quiz)");
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("answer", $answer, PDO::PARAM_STR);
        $query->bindParam("id_attempt_quiz", $id_attempt_quiz, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
  }

  /*public function Update_Essay($question_number, $answer, $id_attempt_quiz){
    $query = $this->db->prepare("UPDATE answer_essay SET answer= :answer WHERE question_number= :question_number AND id_attempt_quiz= :id_attempt_quiz");
        $query->bindParam("answer", $answer, PDO::PARAM_STR);
        $query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->bindParam("id_attempt_quiz", $id_attempt_quiz, PDO::PARAM_STR);
        $query->execute();
  }*/
  
  public function Delete_Tf($id_attempt){
    $query = $this->db->prepare("DELETE FROM answer_tf WHERE id_attempt_quiz= :id_attempt_quiz");
        $query->bindParam("id_attempt_quiz", $id_attempt, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Delete_Mc($id_attempt){
    $query = $this->db->prepare("DELETE FROM answer_mc WHERE id_attempt_quiz= :id_attempt_quiz");
        $query->bindParam("id_attempt_quiz", $id_attempt, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Delete_Essay($id_attempt){
    $query = $this->db->prepare("DELETE FROM answer_essay WHERE id_attempt_quiz= :id_attempt_quiz");
        $query->bindParam("id_attempt_quiz", $id_attempt, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Validate_Quiz_Date($quiz_id, $current_date){
  	$query = $this->db->prepare("SELECT date_started, date_ended FROM quiz WHERE id= :id_quiz");
    $query->bindParam("id_quiz", $quiz_id, PDO::PARAM_STR);
    $query->execute();
    $dates = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $dates[] = $row;
    }
    if (count($dates)>0){
    	foreach($dates as $date){
    		if($current_date >= $date['date_started'] && $current_date <= $date['date_ended']){
    			$is_in_date= "1"; // Tanggal sesuai dengan tanggl pngrjaan quiz
    		}
    		else{
    			$is_in_date= "0"; // tanggal tidak sesuai dengan tnggl pngrjaan kuiz
    		}
    	}
    }

    return $is_in_date;
  }
  
  public function Show_Available_Date($quiz_id, $quiz_name){
  	$query = $this->db->prepare("SELECT date_started, date_ended FROM quiz WHERE id= :quiz_id");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    if (count($datas)>0) {
      foreach ($datas as $data) {
        $date_started=$data['date_started'];
        $date_ended=$data['date_ended'];
      }
    }
  	$data_code='<h2 class="text-center">'. $quiz_name .'</h2>
  				<hr>
  				<h3>Available Date: '. $date_started .'
  				- '. $date_ended .'</h3>';
  				
  	return $data_code;
  }
  
  public function Get_Quiz_Duration($quiz_id){
  	$query = $this->db->prepare("SELECT duration FROM quiz WHERE id= :quiz_id");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    if (count($datas)>0) {
      foreach ($datas as $data) {
        $quiz_duration=$data['duration'];
      }
    }
    return $quiz_duration;
  }
  
  public function Get_Attempt_Duration($quiz_id, $user_id){
  	$query = $this->db->prepare("SELECT duration FROM attempt_quiz WHERE id_quiz= :quiz_id AND id_user= :user_id");
    $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
    $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    $datas = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $datas[] = $row;
    }
    if (count($datas)>0) {
      foreach ($datas as $data) {
        $attempt_duration=$data['duration'];
      }
    }
    return $attempt_duration;
  }
  
  public function Update_Attempt_Duration($quiz_id, $user_id, $duration){
    $query = $this->db->prepare("UPDATE attempt_quiz SET duration= :duration WHERE id_quiz= :quiz_id AND id_user= :user_id");
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
  }
  
  public function Update_Attempt_Submit($id_attempt, $is_submit){
    $query = $this->db->prepare("UPDATE attempt_quiz SET is_submit= :is_submit WHERE id= :id_attempt");
        $query->bindParam("is_submit", $is_submit, PDO::PARAM_STR);
        $query->bindParam("id_attempt", $id_attempt, PDO::PARAM_STR);
        $query->execute();
  }
  
	public function Select_Id_Quiz($class_id){
		$query = $this->db->prepare("SELECT id, quiz_name FROM quiz WHERE id_class= :class_id");
	    $query->bindParam("class_id", $class_id, PDO::PARAM_STR);
	    $query->execute();
	    $datas = array();
	    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	        $datas[] = $row;
	    }
	    return $datas;
	}
	
	public function Show_Quiz_Score($number, $attempt_id, $quiz_name, $quiz_id){
		$query = $this->db->prepare("SELECT score_quiz.score_mc, score_quiz.score_essay, score_quiz.score_tf, quiz.total_question_tf AS total_tf, quiz.total_question_mc AS total_mc, quiz.total_question_essay AS total_essay FROM score_quiz, quiz, attempt_quiz WHERE score_quiz.id_attempt_quiz= :attempt_id AND score_quiz.id_attempt_quiz AND score_quiz.id_attempt_quiz=attempt_quiz.id AND attempt_quiz.id_quiz=quiz.id");
	    $query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
	    $query->execute();
	    $datas = array();
	    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	        $datas[] = $row;
	    }
	    $data_code='';
	    if(count($datas)>0){
        	foreach ($datas as $data) {
        		$score_tf='-';
        		$score_mc='-';
        		$score_essay='-';
        		if($data['total_tf'] > 0){
        			$score_tf=$data['score_tf'];
        		}
        		if($data['total_mc'] > 0){
        			$score_mc=$data['score_mc'];
        		}
        		if($data['total_essay'] > 0){
        			$score_essay=$data['score_essay'];
        		}
	            $data_code.='
	            <tr>
	              <td>'. $number .'</td>
	              <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#show_student_score_modal" onclick="quiz_id_score_answer('. $quiz_id .')"><i class="fa fa-info"></i></button>  '. $quiz_name .'
	            	  <input type="hidden" id="hidden_attempt_score_'. $quiz_id .'" value="'. $attempt_id .'" />
	              </td>
	              <td>'. $score_tf .'</td>
        		  <td>'. $score_mc .'</td>
        		  <td>'. $score_essay .'</td>
	            </tr>';
	        }
	    }
	    return $data_code;
	}
	
	public function Show_Student_Score_Modal(){

		$data='
		<div class="modal fade" id="show_student_score_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Student Answer</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="quiz_type_score">Quiz Type</label>
									<select name="quiz_type_score" id="quiz_type_score" class="form-control" onchange="show_score_answer()" required >
										<option value="--">--</option>
										<option value="1">True or False</option>
										<option value="2">Multiple Choice</option>
										<option value="3">Essay</option>
									</select>
								</div>
							</div>
		                </div>
		                <hr>
		                <div id="student_score_content">
		                </div>
					</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		            </div>
		        </div>
		    </div>
		</div>
		';


	return $data;
	}
	
	public function Show_Answer_MC($quiz_id, $attempt_id){
		$query = $this->db->prepare("SELECT DISTINCT quiz.total_question_mc, qa_mc_quiz.question_number, qa_mc_quiz.question_mc, qa_mc_quiz.answer_mc FROM quiz, qa_mc_quiz WHERE quiz.id= :quiz_id AND qa_mc_quiz.id_quiz=quiz.id ORDER BY qa_mc_quiz.question_number");
  		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $mc){
          		if($mc['total_question_mc']>0){
          			$data_code .= $this->Show_Answer_MC_Content($mc['question_number'], $mc['question_mc'], $this->MC_Description($quiz_id, $mc['question_number'], $mc['answer_mc']), $this->Answer_MC_Student($attempt_id, $mc['question_number'], $quiz_id) );
          		}
          		else{
          			$data_code .='<p>There is no Multiple Choice Quiz</p>';
          		}
          	}
        }
        else{
        	$data_code .='<p>Record Not Found</p>';
        }
        return $data_code;
	}
	
	public function Answer_MC_Student($attempt_id, $question_number, $quiz_id){
		$query = $this->db->prepare("SELECT answer FROM answer_mc WHERE id_attempt_quiz= :attempt_id AND question_number= :question_number");
  		$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
  		$query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $mc){
          		$data_code=$this->MC_Description($quiz_id, $question_number, $mc['answer']);
          	}
        }
        return $data_code;
	}
	
	public function MC_Description($quiz_id, $question_number, $answer){
		$query = $this->db->prepare("SELECT DISTINCT mc_quiz.answer_a, mc_quiz.answer_b, mc_quiz.answer_c, mc_quiz.answer_d FROM quiz, qa_mc_quiz, mc_quiz WHERE quiz.id= :quiz_id AND qa_mc_quiz.question_number= :question_number AND qa_mc_quiz.id_quiz=quiz.id AND mc_quiz.id_qa_mc_quiz=qa_mc_quiz.id");
  		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
  		$query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $mc){
          		switch ($answer) {
				    case "a":
				        $data_code='a. ' . $mc['answer_a'];
				        break;
				    case "b":
				        $data_code='b. ' . $mc['answer_b'];
				        break;
				    case "c":
				        $data_code='c. ' . $mc['answer_c'];
				        break;
				    case "d":
				        $data_code='d. ' . $mc['answer_d'];
				        break;
				    default:
				        $data_code='No Answer';
				        break;
				}
          	}
        }
        return $data_code;
	}
	
	public function Show_Answer_MC_Content($number, $question, $key_answer, $answer){
		if($key_answer == $answer){
			$data = '
				<div class="callout callout-success">
					<h4> <i class="fa fa-check"></i> Correct Answer</h4>
			';
		}
		else{
			$data = '
				<div class="callout callout-danger">
					<h4> <i class="fa fa-times"></i> Wrong Answer</h4>
			';
		}
		
		$data .= '
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				
					'. $number .'. '. $question .'
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					Student Answer: <input type="text" class="form-control" disabled value="'. $answer .'">	
				</div>
				<div class="col-lg-6 col-sm-6">
					Key Answer: <input type="text" class="form-control" disabled value="'. $key_answer .'">	
				
				</div>
			</div>
		</div>';
		return $data;
	}
	
	public function Show_Answer_TF($quiz_id, $attempt_id){
		$query = $this->db->prepare("SELECT DISTINCT quiz.total_question_tf, qa_tf_quiz.question_number, qa_tf_quiz.question_tf, qa_tf_quiz.answer_tf FROM quiz, qa_tf_quiz WHERE quiz.id= :quiz_id AND qa_tf_quiz.id_quiz=quiz.id ORDER BY qa_tf_quiz.question_number");
  		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $tf){
          		if($tf['total_question_tf']>0){
          			$data_code .= $this->Show_Answer_TF_Content($tf['question_number'], $tf['question_tf'], $this->TF_Description($tf['answer_tf']), $this->Answer_TF_Student($attempt_id, $tf['question_number']) );
          			
          		}
          		else{
          			$data_code.='<p>There is no True or False Quiz</p>';
          		}
          	}
        }
        else{
        	$data_code.='<p>Record Not Found</p>';
        }
        return $data_code;
	}
	
	public function Answer_TF_Student($attempt_id, $question_number){
		$query = $this->db->prepare("SELECT answer FROM answer_tf WHERE id_attempt_quiz= :attempt_id AND question_number= :question_number");
  		$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
  		$query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $mc){
          		$data_code=$this->TF_Description($mc['answer']);
          	}
        }
        return $data_code;
	}
	
	public function TF_Description($answer){
		if($answer == "f")
			$answer = "False";
		else
			$answer = "True";
		
		return $answer;
	}
	
	public function Show_Answer_TF_Content($number, $question, $key_answer, $answer){
		
		if($key_answer == $answer){
			$data = '
				<div class="callout callout-success">
					<h4> <i class="fa fa-check"></i> Correct Answer</h4>
			';
		}
		else{
			$data = '
				<div class="callout callout-danger">
					<h4> <i class="fa fa-times"></i> Wrong Answer</h4>
			';
		}
		
		$data .= '
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				
					'. $number .'. '. $question .'
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					Student Answer: <input type="text" class="form-control" disabled value="'. $answer .'">	
				</div>
				<div class="col-lg-6 col-sm-6">
					Key Answer: <input type="text" class="form-control" disabled value="'. $key_answer .'">	
				
				</div>
			</div>
		</div>';
		return $data;
	}
	
	public function Show_Answer_Essay($quiz_id, $attempt_id){
		$query = $this->db->prepare("SELECT DISTINCT quiz.total_question_essay, qa_essay_quiz.question_number, qa_essay_quiz.question_essay, qa_essay_quiz.answer_essay, qa_essay_quiz.max_essay_score FROM quiz, qa_essay_quiz WHERE quiz.id= :quiz_id AND qa_essay_quiz.id_quiz=quiz.id ORDER BY qa_essay_quiz.question_number");
  		$query->bindParam("quiz_id", $quiz_id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $essay){
          		if($essay['total_question_essay']>0){
          			$data_code .= $this->Show_Answer_Essay_Content($essay['question_number'], $essay['question_essay'], $essay['answer_essay'], $this->Answer_Essay_Student($attempt_id, $essay['question_number']), $essay['max_essay_score'], $this->Score_Essay_Student($attempt_id, $essay['question_number']) );
          		}
          		else{
          			$data_code .='<p>There is no Essay Quiz</p>';
          		}
          	}
        }
        else{
        	$data_code .='<p>Record Not Found</p>';
        }
        return $data_code;
	}
	
	public function Answer_Essay_Student($attempt_id, $question_number){
		$query = $this->db->prepare("SELECT answer FROM answer_essay WHERE id_attempt_quiz= :attempt_id AND question_number= :question_number");
  		$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
  		$query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $essay){
          		$data_code=$essay['answer'];
          	}
        }
        return $data_code;
	}
	
	public function Score_Essay_Student($attempt_id, $question_number){
		$query = $this->db->prepare("SELECT score_essay FROM answer_essay WHERE id_attempt_quiz= :attempt_id AND question_number= :question_number");
  		$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
  		$query->bindParam("question_number", $question_number, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        $data_code='';
        if(count($data)>0){
        	foreach($data as $essay){
          		$data_code=$essay['score_essay'];
          	}
        }
        return $data_code;
	}
	
	public function Show_Answer_Essay_Content($number, $question, $key_answer, $answer, $max_score, $score){
		if($score > ($max_score/2)){
			$data = '
				<div class="callout callout-success">
					<h4> <i class="fa fa-check"></i></h4>
			';
		}
		else{
			$data = '
				<div class="callout callout-danger">
					<h4> <i class="fa fa-times"></i></h4>
			';
		}
		
		$data .= '
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				
					'. $number .'. '. $question .'
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					Student Answer: <input type="text" class="form-control" disabled value="'. $answer .'">	
					Student Score: <b>'. $score .'</b>
				</div>
				<div class="col-lg-6 col-sm-6">
					Key Answer: <input type="text" class="form-control" disabled value="'. $key_answer .'">	
					Max Score: <b>'. $max_score .'</b>
				</div>
			</div>
		</div>';
		return $data;
	}

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

    public function Update_Statistic_Comment($id_user, $id_class, $statistic_comment){
      $query = $this->db->prepare("UPDATE statistic SET total_comment= :comment WHERE user_id= :user_id AND class_id= :class_id");
          $query->bindParam("comment", $statistic_comment, PDO::PARAM_STR);
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->execute();
    }
    
    public function Get_Statistic_Upload($id_user, $id_class){
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

    public function Update_Statistic_Upload($id_user, $id_class, $statistic_upload){
      $query = $this->db->prepare("UPDATE statistic SET total_upload= :upload WHERE user_id= :user_id AND class_id= :class_id");
          $query->bindParam("upload", $statistic_upload, PDO::PARAM_STR);
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->execute();
    }
    
    public function Get_Statistic_Download($id_user, $id_class){
      $query = $this->db->prepare("SELECT total_download FROM statistic WHERE user_id= :id_user AND class_id= :id_class");
  		$query->bindParam("id_user", $id_user, PDO::PARAM_STR);
  		$query->bindParam("id_class", $id_class, PDO::PARAM_STR);
          $query->execute();
          $data = array();
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
          if(count($data)>0){
              foreach ($data as $download) {
                $total_download=$download['total_download'];
              }
          }
          return $total_download;
    }
    
    public function Update_Statistic_Download($id_user, $id_class, $statistic_download){
      $query = $this->db->prepare("UPDATE statistic SET total_download= :download WHERE user_id= :user_id AND class_id= :class_id");
          $query->bindParam("download", $statistic_download, PDO::PARAM_STR);
          $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
          $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
          $query->execute();
    }
    // Statistic END
    
    // Notifikasi START
    
    public function Write_Notif($id_class, $type, $type_id, $date_created, $created_by){
		$query = $this->db->prepare("INSERT INTO notif (class_id, type, type_id, date_created, created_by)
			VALUES (:class_id, :type, :type_id, :date_created, :created_by)");
        $query->bindParam("class_id", $id_class, PDO::PARAM_STR);
        $query->bindParam("type", $type, PDO::PARAM_STR);
        $query->bindParam("type_id", $type_id, PDO::PARAM_STR);
        $query->bindParam("date_created", $date_created, PDO::PARAM_STR);
        $query->bindParam("created_by", $created_by, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}
	
	public function Write_User_Notif($id_user, $notif_id, $status){
		$query = $this->db->prepare("INSERT INTO user_notif (user_id, notif_id, status)
			VALUES (:user_id, :notif_id, :status)");
        $query->bindParam("user_id", $id_user, PDO::PARAM_STR);
        $query->bindParam("notif_id", $notif_id, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}
	
	public function Get_User_Id_Enrolled($id_class, $user_id){
      $query = $this->db->prepare("SELECT id_user FROM enrolled_user WHERE id_class= :id_class AND id_user != :id_user");
  		$query->bindParam("id_class", $id_class, PDO::PARAM_STR);
  		$query->bindParam("id_user", $user_id, PDO::PARAM_STR);
          $query->execute();
          $data = array();
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
          
          return $data;
    }
    
    public function Count_Post_Comment($user_id){
    	$query = $this->db->prepare("SELECT COUNT(notif.id) AS total_notif FROM notif, user_notif, enrolled_user, class WHERE (notif.type= 2 OR notif.type= 1) AND user_notif.status= 0 AND user_notif.user_id= :user_id1 AND notif.created_by != :user_id2 AND notif.id=user_notif.notif_id AND enrolled_user.id_user= :user_id3 AND enrolled_user.id_class=class.id AND notif.class_id=class.id");
  		$query->bindParam("user_id2", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id1", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id3", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $total=0;
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$total=$data['total_notif'];
			}
		}
        return $total;
    }
    
    public function Count_Assignment_Quiz($user_id){
    	$query = $this->db->prepare("SELECT COUNT(notif.id) AS total_notif FROM notif, user_notif, enrolled_user, class WHERE (notif.type != 2 AND notif.type != 1) AND user_notif.status= 0 AND user_notif.user_id= :user_id1 AND notif.created_by != :user_id2 AND notif.id=user_notif.notif_id AND enrolled_user.id_user= :user_id3 AND enrolled_user.id_class=class.id AND notif.class_id=class.id");
  		$query->bindParam("user_id2", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id1", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id3", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $total=0;
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$total=$data['total_notif'];
			}
		}
        return $total;
    }
    
    public function Show_Post_Comment($user_id){
    	$query = $this->db->prepare("SELECT notif.id, notif.type, notif.type_id, notif.class_id, notif.date_created, user_notif.status, notif.created_by FROM notif, user_notif, enrolled_user, class WHERE (notif.type= 2 OR notif.type= 1) AND user_notif.user_id= :user_id1 AND notif.created_by != :user_id2 AND notif.id=user_notif.notif_id AND enrolled_user.id_user= :user_id3 AND enrolled_user.id_class=class.id AND notif.class_id=class.id ORDER BY notif.date_created DESC LIMIT 0, 10");
  		$query->bindParam("user_id2", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id1", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id3", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $data_code='';
        if(count($datas)>0){
          	foreach ($datas as $data) {
          		$bg='bg-info';
          		if($data['status'] == 1)
          			$bg='';
		    	$data_code.=$this->Read_Post_Comment_Notif($data['type_id'], $data['status'], $data['date_created'], $data['created_by'], $data['id'], $data['type'], $data['class_id'], $bg);
			}
		}
        return $data_code;
    }
    
    public function Show_Assignment_Quiz($user_id){
    	$query = $this->db->prepare("SELECT notif.id, notif.type, notif.type_id, notif.class_id, notif.date_created, user_notif.status, notif.created_by FROM notif, user_notif, enrolled_user, class WHERE (notif.type != 2 AND notif.type != 1) AND user_notif.user_id= :user_id1 AND notif.created_by != :user_id2 AND notif.id=user_notif.notif_id AND enrolled_user.id_user= :user_id3 AND enrolled_user.id_class=class.id AND notif.class_id=class.id ORDER BY notif.date_created DESC LIMIT 0, 10");
  		$query->bindParam("user_id2", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id1", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id3", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $data_code='';
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$bg='bg-info';
          		if($data['status'] == 1)
          			$bg='';
		    	$data_code.=$this->Read_Quiz_Assignment_Notif($data['type_id'], $data['status'], $data['date_created'], $data['created_by'], $data['id'], $data['type'], $data['class_id'], $bg);
			}
		}
        return $data_code;
    }
    
    public function Read_Post_Comment_Notif($type_id, $status, $date_created, $created_by, $notif_id, $type, $class_id, $bg){
    	$name = $this->User_Name($created_by);
    	$class_name = $this->Class_Name($class_id);
    	$data_code='';
		if($type==1){ // Post Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-users text-aqua"></i>
                      <span><div style="white-space: normal;"><strong>'. $name .'</strong> post on "'. $class_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		}
		else if($type==2){ // Comment Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-users text-aqua"></i>
                      <span><div style="white-space: normal;"><strong>'. $name .'</strong> commented on your post</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		}
        return $data_code;
    }
    
    public function Read_Quiz_Assignment_Notif($type_id, $status, $date_created, $created_by, $notif_id, $type, $class_id, $bg){
    	$name = $this->User_Name($created_by);
    	$assignment_name = $this->Assignment_Name($type_id);
    	$assignment_submit = $this->Assignment_Submit($type_id);
    	$class_name = $this->Class_Name($class_id);
    	$quiz_name = $this->Quiz_Name($type_id);
    	$quiz_attempt = $this->Quiz_Attempt($type_id);
    	$learning_name = $this->Learning_Name($type_id);
    	$data_code='';
		if($type==3){ // Quiz Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> create quiz: "'. $quiz_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		}
		else if($type==4){ // Assignment Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> create assignment: "'. $assignment_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		} else if($type==5){ // Assignment Note Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> update assignment note: "'. $assignment_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		} else if($type==6){ // Assignment Score Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> update assignment score: "'. $assignment_submit .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		} else if($type==7){ // Quiz Score Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> update quiz score: "'. $quiz_attempt .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		} else if($type==8){ // Learning Source Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> upload learning source: "'. $learning_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		} else if($type==11){ // Edit Quiz Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> edit quiz: "'. $quiz_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		} else if($type==12){ // Edit Learning Notif
			$data_code='<li class="'. $bg .'">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <i class="fa fa-tasks text-aqua"></i>
                      <span><div style="white-space: normal; color: black;"><strong>'. $name .'</strong> edit learning source: "'. $learning_name .'"</div></span>
                      <span class="text-primary">'. $date_created .'</span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </li>';
		}
        return $data_code;
    }
    
    public function Show_All_Post_Comment($user_id){
    	$query = $this->db->prepare("SELECT notif.id, notif.type, notif.type_id, notif.class_id, notif.date_created, user_notif.status, notif.created_by FROM notif, user_notif, enrolled_user, class WHERE (notif.type= 2 OR notif.type= 1) AND user_notif.user_id= :user_id1 AND notif.created_by != :user_id2 AND notif.id=user_notif.notif_id AND enrolled_user.id_user= :user_id3 AND enrolled_user.id_class=class.id AND notif.class_id=class.id ORDER BY notif.date_created DESC");
  		$query->bindParam("user_id2", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id1", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id3", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $data_code='';
        if(count($datas)>0){
          	foreach ($datas as $data) {
          		$bg='bg-info';
          		if($data['status'] == 1)
          			$bg='';
		    	$data_code.=$this->Read_All_Post_Comment_Notif($data['type_id'], $data['status'], $data['date_created'], $data['created_by'], $data['id'], $data['type'], $data['class_id'], $bg);
			}
		}
        return $data_code;
    }
    
    public function Show_All_Assignment_Quiz($user_id){
    	$query = $this->db->prepare("SELECT notif.id, notif.type, notif.type_id, notif.class_id, notif.date_created, user_notif.status, notif.created_by FROM notif, user_notif, enrolled_user, class WHERE (notif.type != 2 AND notif.type != 1) AND user_notif.user_id= :user_id1 AND notif.created_by != :user_id2 AND notif.id=user_notif.notif_id AND enrolled_user.id_user= :user_id3 AND enrolled_user.id_class=class.id AND notif.class_id=class.id ORDER BY notif.date_created DESC");
  		$query->bindParam("user_id2", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id1", $user_id, PDO::PARAM_STR);
  		$query->bindParam("user_id3", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $data_code='';
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$bg='bg-info';
          		if($data['status'] == 1)
          			$bg='';
		    	$data_code.=$this->Read_All_Quiz_Assignment_Notif($data['type_id'], $data['status'], $data['date_created'], $data['created_by'], $data['id'], $data['type'], $data['class_id'], $bg);
			}
		}
        return $data_code;
    }
    
    public function Read_All_Post_Comment_Notif($type_id, $status, $date_created, $created_by, $notif_id, $type, $class_id, $bg){
    	$name = $this->User_Name($created_by);
    	$class_name = $this->Class_Name($class_id);
    	$data_code='';
		if($type==1){ // Post Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-users text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> post on "'. $class_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		}
		else if($type==2){ // Comment Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-users text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> commented on your post</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		}
        return $data_code;
    }
    
    public function Read_All_Quiz_Assignment_Notif($type_id, $status, $date_created, $created_by, $notif_id, $type, $class_id, $bg){
    	$name = $this->User_Name($created_by);
    	$assignment_name = $this->Assignment_Name($type_id);
    	$assignment_submit = $this->Assignment_Submit($type_id);
    	$class_name = $this->Class_Name($class_id);
    	$quiz_name = $this->Quiz_Name($type_id);
    	$quiz_attempt = $this->Quiz_Attempt($type_id);
    	$learning_name = $this->Learning_Name($type_id);
    	$data_code='';
		if($type==3){ // Quiz Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> create quiz: "'. $quiz_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==4){ // Assignment Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i><h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> create assignment: "'. $assignment_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==5){ // Assignment Note Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> update assignment note: "'. $assignment_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==6){ // Assignment Score Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> update assignment score: "'. $assignment_submit .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==7){ // Quiz Score Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> update quiz score: "'. $quiz_attempt .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==8){ // Learning Source Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> upload learning source: "'. $learning_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==11){ // Edit Quiz Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> edit quiz: "'. $quiz_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		} else if($type==12){ // Edit Learning Notif
			$data_code='<div class="btn-default '. $bg .'" style="padding:.5% 1%; cursor: pointer">
                    <a href="notif.php?cid='. $class_name .'_'. $notif_id .'">
                      <h2><i class="fa fa-tasks text-aqua"></i></h2>
                      <span><div style="white-space: normal; color: black;"><h4><strong>'. $name .'</strong> edit learning source: "'. $learning_name .'"</h4></div></span>
                      <span class="text-primary"><h4>'. $date_created .'</h4></span>
                    </a>
                    <input type="hidden" id="post_notif_'. $type_id .'">
                  </div>
                  <hr>';
		}
        return $data_code;
    }
    
    public function User_Name($user_id){
    	$query = $this->db->prepare("SELECT name FROM users WHERE id= :id");
  		$query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['name'];
			}
		}
		
		return $name;
    }
    
    public function Class_Name($class_id){
    	$query = $this->db->prepare("SELECT class_name FROM class WHERE id= :id");
  		$query->bindParam("id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['class_name'];
			}
		}
		
		return $name;
    }
    
    public function Assignment_Name($submitted_id){
    	$query = $this->db->prepare("SELECT file_name FROM assignment WHERE id= :submitted_id");
  		$query->bindParam("submitted_id", $submitted_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['file_name'];
			}
		}
		
		return $name;
    }
    
    public function Assignment_Submit($submitted_id){
    	$query = $this->db->prepare("SELECT file_name FROM assignment_submitted WHERE id= :submitted_id");
  		$query->bindParam("submitted_id", $submitted_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['file_name'];
			}
		}
		
		return $name;
    }
    
    public function Quiz_Name($attempt_id){
    	$query = $this->db->prepare("SELECT quiz_name FROM quiz WHERE id= :attempt_id");
  		$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['quiz_name'];
			}
		}
		
		return $name;
    }
    
    public function Quiz_Attempt($attempt_id){
    	$query = $this->db->prepare("SELECT quiz.quiz_name FROM attempt_quiz, quiz WHERE attempt_quiz.id= :attempt_id AND attempt_quiz.id_quiz=quiz.id");
  		$query->bindParam("attempt_id", $attempt_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['quiz_name'];
			}
		}
		
		return $name;
    }
    
    public function Learning_Name($learning_id){
    	$query = $this->db->prepare("SELECT title FROM learning_source WHERE id= :learning_id");
  		$query->bindParam("learning_id", $learning_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['title'];
			}
		}
		
		return $name;
    }
    
    public function Class_Admin($class_id){
    	$query = $this->db->prepare("SELECT id_user FROM class WHERE id= :class_id");
  		$query->bindParam("class_id", $class_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $name='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$name=$data['id_user'];
			}
		}
		
		return $name;
    }
    
    public function Update_User_Notif($notif_id, $user_id, $status){
		$query = $this->db->prepare("UPDATE user_notif SET status= :status WHERE notif_id= :notif_id AND user_id= :user_id");
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("notif_id", $notif_id, PDO::PARAM_STR);
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
	}
	
	public function Notification_Type($notif_id){
    	$query = $this->db->prepare("SELECT type FROM notif WHERE id= :id");
  		$query->bindParam("id", $notif_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $type='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$type=$data['type'];
			}
		}
		
		return $type;
    }
    
    public function Notification_Type_Id($notif_id){
    	$query = $this->db->prepare("SELECT type_id FROM notif WHERE id= :id");
  		$query->bindParam("id", $notif_id, PDO::PARAM_STR);
        $query->execute();
        $datas = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        } 
        $type_id='';
        
        if(count($datas)>0){
          	foreach ($datas as $data) {
		    	$type_id=$data['type_id'];
			}
		}
		
		return $type_id;
    }
    
    public function Read_Post_Notification($type_id){
		$query = $this->db->prepare("SELECT users.name AS username, posts.date_created AS date_created, posts.description AS description, posts.id AS post_id FROM posts, users
        	 WHERE posts.id= :type_id AND posts.id_user=users.id
        	 ORDER BY posts.id DESC ");
        /*$query = $this->db->prepare("SELECT * FROM posts
        	 WHERE id_class LIKE '%". $monarch ."%'
        	 ORDER BY id DESC ");*/
        $query->bindParam("type_id", $type_id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function Post_Notification($username, $date_created, $description, $id){
		$data='

					<div class="col-lg-12 col-sm-12 pull-left">
						<!-- Box Comment -->
						<div class="box box-widget">
						<div class="box-header with-border">
							<div class="user-block">
								<img class="img-circle" src="../dist/img/avatar5.png" alt="User Image">
								<span class="username">Posted By : '. $username .'</a></span>
								<!--<span class="username"><a href="#">'. $description .'</a></span>-->
								<span class="description">Posted On '. $date_created .'</span>
								<br><span class="title">'. $description .'</span>
							</div>
							<!-- /.user-block -->
							<!--<div class="box-tools">

								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-box-tool" onclick="delete_post('. $id .')"><i class="fa fa-trash"></i></button>
								
								
							</div>-->
							<!-- /.box-tools -->
						</div>
							<!-- /.box-header -->
							<!--<div class="box-body">
							'. $description .'
							</div>-->
							<!-- /.box-body -->
						';
						//<button type="button" class="btn btn-box-tool" onclick="delete_post('. $id .')"><i class="fa fa-trash"></i></button>
	return $data;
	}
	
	public function End_Post_Notification($id){
		$data='
						<!-- /.box-footer -->
						<div class="box-footer">
						  <form action="" method="post">
							<img class="img-responsive img-circle img-sm" src="../dist/img/avatar5.png" alt="Alt Text">
							<!-- .img-push is used to add margin to elements next to floating images -->
							<div class="img-push">
								<div class="form-group">
									<label for="comment">Comment:</label>
									<textarea id="t_'. $id .'" class="form-control" rows="5"></textarea>
									<button id="b_'. $id .'" type="button" class="btn btn-sm btn-success" onclick="post_comment_notif('. $id .')">Post Comment</button>
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
    
    public function Header_Notif($title, $small){
		$data ='
		<section class="content-header">
			<h1>
				'. $title .'
				<small>'. $small .'</small>
			</h1><br>
		</section>
		';
		return $data;
    }
    
    public function Post_Content_Notif(){
		$data ='<section class="content">
	        <div id="notif-content">
		';
		return $data;
    }
    
    public function View_Content_Notif(){
		$data ='<section class="content">
	        <div id="notif-content" class="container">
		';
		return $data;
    }
    
    // Notifikasi END
}


?>
