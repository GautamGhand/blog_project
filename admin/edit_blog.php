<?php
include('../class.php');
$id = $_GET['id'];
$obj = new PDO('mysql:dbname=blog_project;host=localhost;', 'root', '');
foreach ($obj->query("select *from blog") as $row) {
    if ($id == $row['id']) {
        $val = $row;
    }
}
if (isset($_POST['Edit_Blog'])) {
    $ad = new Blog($_POST);
    $ad->edit($id);
    header('location:view_blogs.php');
}
?>
<html>

<head>
    <title>CREATE USER</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <section class="container">
        <section class="frm">
            <form action="edit_blog.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <label class="txt">TITLE</label>
                <input type="text" name="title" value=<?php echo $val['title'] ?> class="inpt">
                <label class="txt">DESCRIPTION</label>
                <textarea name="description" class="desc"><?php echo $val['description'] ?></textarea>
                <input type="submit" name="Edit_Blog" value="Edit Blog" class="btn">
            </form>
        </section>
    </section>
</body>

</html>