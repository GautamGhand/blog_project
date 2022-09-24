<link rel="stylesheet" type="text/css" href="../css/style.css">
<?php 
include('../validation.php');
session_start();
class Database
{
    public $obj;
    function connect()
    {
        $this->obj=new PDO('mysql:dbname=blog_project;host=localhost;','root','');
        return $this->obj;
    }
}
class Admin extends Database
{   
    public $data;
    public $obj;
    public $valid;
    function __construct($data=null)
    {
        $this->data=$data;
        $this->obj=parent::connect();
        $this->valid=new Validation();
    }
    function login()
    {
        $_SESSION['error']=$this->valid->validateEmail($this->data['admin_email'],$this->data['admin_password']);
        if(empty($_SESSION['error']))
        {
            if(!empty($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
        foreach($this->obj->query("select *from admin") as $row)
        {
                if($this->data['admin_email']==$row['email'] && $this->data['admin_password']==$row['password'])
                {
                    echo "YOU HAVE BEEN LOGGED IN";
                    $_SESSION['login']=$row;
                    $_SESSION['login']['status']=0;
                    header('location:main_page.php');
                }
                else
                {
                    echo "<h1 class=\"head\">WRONG CREDENTIALS</h1>";
                }
        }
        }
    }   
    function create()
    {
        $_SESSION['error']=$this->valid->validateName($this->data);
        $_SESSION['error']=$this->valid->validateEmailExists($this->data['UserName'],$this->obj);
        $_SESSION['error']=$this->valid->validateEmail($this->data['UserName'],$this->data['UserPassword']);
        if(empty($_SESSION['error']))
        {
            if(!empty($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
        $fname=$this->data['firstname'];
        $lname=$this->data['lastname'];
        $email=$this->data['UserName'];
        $password=$this->data['UserPassword'];
        if($this->obj->exec("insert into user(firstname,lastname,email,password) values('$fname','$lname','$email','$password')"))
        {
            // header('location:create_user.php');
            echo "<h1 class=\"head\">USERCREATED SUCCESSFULLY</h1>";
        }
        }
    }
    function view()
    {
        echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>FIRST NAME</th>";
        echo "<th>LAST NAME</th>";
        echo "<th>EMAIL</th>";
        echo "<th>EDIT</th>";
        echo "<th>DELETE</th>";
        echo "<th>ACTIVATE</th>";
        echo "<th>STATUS</th>";
        foreach($this->obj->query("Select *from user") as $row)
        {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['firstname']."</td>";
            echo "<td>".$row['lastname']."</td>";
            echo "<td>".$row['email']."</td>";     
            echo "<td><a href=\"edit.php?id=".$row['id']."\">EDIT</a></td>";
            echo "<td><a href=\"delete.php?id=".$row['id']."\">DELETE</a></td>"; 
            if($row['status']==0)
            {
            echo "<td><a href=\"active.php?id=".$row['id']."\" class=\"active\">ACTIVATE</a></td>";
            }
            else
            {
            echo "<td><a href=\"inactive.php?id=".$row['id']."\" class=\"inactive\">INACTIVATE</a></td>";
            }  
            echo "<td>".$row['status']."</td>"; 
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href=\"main_page.php\" class=\"active\">BACK</a>";  
    }
    function edit($id)
    {
        foreach($this->obj->query("select *from user") as $row)
        {
            if($id==$row['id'])
            {
                $name=$this->data['UserName'];
                $password=$this->data['UserPassword'];
                $this->obj->exec("update user set email='$name',password='$password' where id='$id' ");
                header('location:view_users.php');              
            }
        }
    }
    function delete($id)
    {
        foreach($this->obj->query("select *from user") as $row)
        {
            if($id==$row['id'])
            {
                $this->obj->exec("delete from user where id='$id'");
                $this->obj->exec("alter table user AUTO_INCREMENT=1");
                header('location:view_users.php');
            }    
        }
    }
}
class User extends Database
{
    public $data;
    public $obj;
    public $valid;
    function __construct($p=null)
    {
        $this->data=$p;
        $this->obj=parent::connect();
        $this->valid=new Validation();
    }
    function signup()
    {
        $_SESSION['error']=$this->valid->validateName($this->data);
        $_SESSION['error']=$this->valid->validateEmailExists($this->data['UserName'],$this->obj);
        $_SESSION['error']=$this->valid->validateEmail($this->data['UserName'],$this->data['UserPassword']);
        if(empty($_SESSION['error']))
        {
            if(!empty($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
        $fname=$this->data['firstname'];
        $lname=$this->data['lastname'];
        $email=$this->data['UserName'];
        $password=$this->data['UserPassword'];
        if($this->obj->exec("insert into user(firstname,lastname,email,password) values('$fname','$lname','$email','$password')"))
        {
            echo "<h1 class=\"head\">ACCOUNT CREATED SUCCESSFULLY</h1>";
        }
        }
    }
    function login()
    {
        $count=0;
        $_SESSION['error']=$this->valid->validateEmail($this->data['UserName'],$this->data['UserPassword']);
        if(empty($_SESSION['error']))
        {
            if(!empty($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
        foreach($this->obj->query("select *from user") as $row)
        {
            if($row['status']==1)
            {
                if($this->data['UserName']==$row['email'] && $this->data['UserPassword']==$row['password'])
                {
                    $count=0;
                    $_SESSION['usr_id']=$row['id'];
                    $_SESSION['login']['userstatus']=0;
                    header('location:blogs_page.php');
                }
                $count++;
            }
            else
            {
                if($this->data['UserName']==$row['email'] && $this->data['UserPassword']==$row['password'])
                {
                    echo "<h1 class=\"head\">You are Inactive</h1>";
                    $count=0;
                    break;
                }
                $count++;
            }  
        }  
        if($count>0)
        {
            echo "<h1 class=\"head\">Wrong Credentials</h1>";
        }
        }
    }
    function view()
    {
        echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>TITLE</th>";
        echo "<th>DESCRIPTION</th>";
        echo "<th>VIEW</th>";
        $id=$_SESSION['usr_id'];
        // $blg_id=$_SESSION['blog_id'];
        $data=$this->obj->query("select *from blog_likes where user_id='$id' ");
        $d=$data->fetch(PDO::FETCH_ASSOC);
        foreach($this->obj->query("Select *from blog") as $row)
        {
            if($row['status']==1)
            {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['description']."</td>" ;
            echo "<td><a href=\"view_blog.php?blog_id=".$row['id']."\">VIEW</a></td>";
            }
        }
        echo "</tr>";
        echo "</table>";
        echo "<a href=\"user_logout.php\" class=\"active\">LOGOUT</a>";  
    }
    function view_blog($id)
    {
        $usr_id=$_SESSION['usr_id'];
        $v=$this->obj->query("select *from blog where id='$id'");
        $x=$v->fetch();
        if($x==false)
        {
            header('location:blogs_page.php');
        }
        $cnt=$this->obj->query("select count(likes) as cnt from blog_likes where likes=1 and blog_id='$id' ");
        $cntlikes=$cnt->fetch();
        $cnt1=$this->obj->query("select count(dislikes) as cnt from blog_likes where dislikes=1 and blog_id='$id'");
        $cntdislike=$cnt1->fetch();
        echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>TITLE</th>";
        echo "<th>DESCRIPTION</th>";
        echo "<th>LIKE</th>";
        // echo "<th>DISLIKE</th>";
        $c=$this->obj->query("select likes from blog_likes where user_id='$usr_id' and blog_id='$id'");
        $b=$c->fetch();
      foreach($this->obj->query("Select *from blog where id='$id'") as $row)
      {
          if($row['status']==1)
          {
          echo "<tr>";
          echo "<td>".$row['id']."</td>";
          echo "<td>".$row['title']."</td>";
          echo "<td>".$row['description']."</td>" ;
            if($b==true)
                {
                    if($b['likes']==0)
                    {
                        echo "<td>";
                    // if($row['id']==$id)
                    // {
                    //     echo $cntlikes['cnt'];
                    // }
                    echo "<a href=\"like.php?id=".$id."&user_id=".$usr_id."\">LIKE</a></td>";
                    }
                    else
                    {
                    echo "<td>";
                    // if($row['id']==$id)
                    // {
                    //     echo $cntdislike['cnt'];
                    // }
                    echo "<a href=\"dislike.php?id=".$id."&user_id=".$usr_id."\">DISLIKE</a></td>";
                    }
                }
                else
                {
                    echo "<td>";
                    echo "<a href=\"like.php?id=".$id."&user_id=".$usr_id."\">LIKE</a></td>";
                }
            }   
      }
      echo "</tr>";
      echo "</table>";
      echo "<a href=\"blogs_page.php\" class=\"active\">BACK</a>"; 
    }
}
class Blog extends Database
{
    public $data;
    public $obj;
    public $valid;
    function __construct($data=null)
    {
        $this->data=$data;
        $this->obj=parent::connect();
        $this->valid=new Validation();
    }
    function create()
    {
        $_SESSION['error']=$this->valid->validateBlog($this->data);
        if(empty($_SESSION['error']))
        {
            if(!empty($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
        $title=$this->data['title'];
        $description=$this->data['description'];
        $cnt=$this->obj->exec("insert into blog(title,description) values('$title','$description')");
        if($cnt>=1)
        {
            header('location:view_blogs.php');
        }
        }      
    }
    function view()
    {
        
        echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>TITLE</th>";
        echo "<th>DESCRIPTION</th>";
        echo "<th>DATE</th>";
        echo "<th>EDIT</th>";
        echo "<th>DELETE</th>";
        echo "<th>ACTIVATE</th>";
        echo "<th>STATUS</th>";
        foreach($this->obj->query("Select *from blog") as $row)
        {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['description']."</td>" ; 
            echo "<td>".$row['date']."</td>";   
            echo "<td><a href=\"edit_blog.php?id=".$row['id']."\">EDIT</a></td>";
            echo "<td><a href=\"delete_blog.php?id=".$row['id']."\">DELETE</a></td>"; 
            if($row['status']==0)
            {
            echo "<td><a href=\"active_blog.php?id=".$row['id']."\" class=\"active\">ACTIVATE</a></td>";
            }
            else
            {
            echo "<td><a href=\"inactive_blog.php?id=".$row['id']."\" class=\"inactive\">INACTIVATE</a></td>";  
            }
            echo "<td>".$row['status']."</td>";
        }
        echo "</tr>";
        echo "</table>";  
        echo "<a href=\"main_page.php\" class=\"active\">BACK</a>";    
    }
    function edit($id)
    {
        foreach($this->obj->query("select *from blog") as $row)
        {
            if($id==$row['id'])
            {
                $title=$this->data['title'];
                $description=$this->data['description'];
                $this->obj->exec("update blog set title='$title',description='$description' where id='$id' ");
                header('location:view_blogs.php');              
            }
        }
    }
    function delete($id)
    {
        foreach($this->obj->query("select *from blog") as $row)
        {
            if($id==$row['id'])
            {
                $this->obj->exec("delete from blog where id='$id'");
                $this->obj->exec("alter table blog AUTO_INCREMENT=1");
                header('location:view_blogs.php');
            }    
        }
    }  
}
class Subadmin extends Database
{
    public $data;
    public $obj;
    public $valid;
    function __construct($data=null)
    {
        $this->data=$data;
        $this->obj=parent::connect();
        $this->valid=new Validation();
    }
    function create()
    {
        $_SESSION['error']=$this->valid->validateEmail($this->data['SadminEmail'],$this->data['SadminPassword']);
        if(empty($_SESSION['error']))
        {
            if(!empty($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
        $email=$this->data['SadminEmail'];
        $password=$this->data['SadminPassword'];
        $cnt=$this->obj->exec("insert into admin(email,password,role) values('$email','$password',2)");
        if($cnt>=1)
        {
            // header('location:create_subadmin.php');
            echo "<h1 class=\"head\">SUB ADMIN CREATED SUCCESSFULLY</h1>";
        }
        }
    }
    function view()
    {
        echo "<table cellspacing=0>";
        echo "<th>EMAIL</th>";
        echo "<th>PASSWORD</th>";
        if($_SESSION['login']['role']==1)
            {
           echo "<th>DELETE</th>";
            }
        foreach($this->obj->query("Select *from admin where role=2") as $row)
        {
            if($_SESSION['login']['role']==1)
            {
            echo "<tr>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "<td><a href=\"delete_subadmin.php?id=".$row['id']."\" class=\"active\">DELETE</a></td>";
            }
            else {
                if($row['role']==1)
                {
                    continue;
                }
                echo "<tr>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['password']."</td>";
            }
        }
        echo "</tr>";
        echo "</table>";
        echo "<a href=\"main_page.php\" class=\"active\">BACK</a>";  
    }
    function delete($id)
    {
        foreach($this->obj->query("select *from admin") as $row)
        {
            if($id==$row['id'])
            {
                $this->obj->exec("delete from admin where id='$id'");
                $this->obj->exec("alter table blog AUTO_INCREMENT=1");
                header('location:view_subadmin.php');
            }    
        }      
    }
}
?>