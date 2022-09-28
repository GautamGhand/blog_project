<?php
trait common
{
    public $obj;
    public $valid;
    function __construct()
    {
        $db=new Database();
        $this->obj=$db->connect();
    }
    function edit($table_name,$id,$pst)
    {
        $this->valid=new Validation();
            if($table_name=='user')
            {
                $_SESSION['error']=$this->valid->validateName($pst);
                $_SESSION['error']=$this->valid->validateEmail($pst['UserName'],$pst['UserPassword']);
                if(empty($_SESSION['error']))
                {
                    $fname=$pst['firstname'];
                    $lname=$pst['lastname'];
                    $name=$pst['UserName'];
                    $password=$pst['UserPassword'];
                    $this->obj->exec("update $table_name set email='$name',password='$password',firstname='$fname',lastname='$lname' where id='$id' ");
                    header('location:../user/view_users.php');  
                }            
            }
            else
            {
                $_SESSION['error']=$this->valid->validateBlog($pst);
                if(empty($_SESSION['error']))
                {
                    $title=$pst['title'];
                    $description=$pst['description'];
                    $this->obj->exec("update $table_name set title='$title',description='$description' where id='$id' ");
                    header('location:../blog/view_blogs.php');  
                }
            }
    }
    function delete($table_name,$id)
    {
        $data=$this->obj->query("select *from $table_name where id='$id'");
        $s=$data->fetch();
            if($s && $table_name=='user')
            {
                $this->obj->exec("delete from $table_name where id='$id'");
                $this->obj->exec("alter table $table_name AUTO_INCREMENT=1");
                header('location:../user/view_users.php');
            }    
            elseif($table_name=='blog')
            {
                $this->obj->exec("delete from $table_name where id='$id'");
                $this->obj->exec("alter table $table_name AUTO_INCREMENT=1");
                header('location:view_blogs.php');  
            }
            else
            {
                $this->obj->exec("delete from $table_name where id='$id'");
                $this->obj->exec("alter table $table_name AUTO_INCREMENT=1");
                header('location:../admin/view_subadmin.php');
            }
    }

}
?>