<?php
trait common
{
    public $obj;
    function __construct()
    {
        $db=new Database();
        $this->obj=$db->connect();
    }
    function edit($table_name,$id,$pst)
    {
        $data=$this->obj->query("select *from $table_name where id='$id' ");
        $s=$data->fetch();
            if($s && $table_name=='user')
            {
                $name=$pst['UserName'];
                $password=$pst['UserPassword'];
                $this->obj->exec("update $table_name set email='$name',password='$password' where id='$id' ");
                header('location:view_users.php');              
            }
            else
            {
                $title=$pst['title'];
                $description=$pst['description'];
                $this->obj->exec("update $table_name set title='$title',password='$description' where id='$id' ");
                header('location:view_users.php');  
            }
    }
    function delete($table_name,$id)
    {
        $data=$this->obj->query("select *from $table_name where id='$id'");
        $s=$data->fetch();
            if($s)
            {
                $this->obj->exec("delete from $table_name where id='$id'");
                $this->obj->exec("alter table $table_name AUTO_INCREMENT=1");
                header('location:view_users.php');
            }    
    }

}
?>