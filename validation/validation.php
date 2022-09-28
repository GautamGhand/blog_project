
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
                    if(is_numeric($pst[$k]) || preg_match('/[^a-z_+-0-9]/i',$pst[$k]))
                    {       
                        $this->error[$k]="Please Enter Correct $k";
                    }
                    for($i=0;$i<strlen($pst[$k]);$i++)
                    {
                        if($pst[$k][$i]==" ")
                        {
                            $this->error[$k]="Please Don't Enter space in $k";
                            break;
                        }
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
                    $this->error['email']="Please enter Valid Email";
                }
            }
            if(empty($password))
            {
                $this->error['password']="Password is Required";
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
                $this->error['email']="Email Already Exists in User";         
            }
            $a=$check->query("select *from admin where email='$email'");
            $admin=$a->fetch();
            if($admin)
            {
                $this->error['email']="Email taken By Admin Already";
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

