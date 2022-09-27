
<?php
class Validation
{
    public $error=[];
        function validateName($pst)
        {
            foreach($pst as $k=>$v)
            {
                if($k=='firstname' || $k=='lastname')
                {
                    if(empty($pst[$k]))
                    {
                        $this->error[$k]="Please Enter $k";
                    }
                }
            }
            return $this->error;
        }
        function validateEmail($email,$password)
        {
            if(empty($email))
            {
                $this->error['email'] = "Email is required";
            }
            else
            {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $this->error['email']="please enter valid email";
                }
            }
            if(empty($password))
            {
                $this->error['password']="Password is required";
            }
            else
            {   $password=trim($password);
                if(empty($password))
                {
                    $this->error['password']="Please don't enter spaces in password";
                }
                
            }
            return $this->error;
        }
        function validateEmailExists($email,$check)
        {
            $data=$check->query("select *from user where email='$email' ");
            $d=$data->fetch();
            if($d)
            {
                $this->error['email']="Email Already Exists";         
            }
            return $this->error;
        }
        function validateBlog($pst)
        {
            foreach($pst as $k=>$v)
            {
                if($k=='title' || $k=='description')
                {
                    if(empty($pst[$k]))
                    {
                        $this->error[$k]="Please Enter $k";
                    }
                }
            }            
            return $this->error;
        }
}
?>

