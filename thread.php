<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>iDiscuss - coding Forums</title>
</head>

<body>
    <?php include 'partial/_header.php';?>
    <?php include 'partial/_dbConnect.php';?>
    <?php
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM threads WHERE thread_id=$id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];

        }
    ?>

    <?php
     $showAlart=false;
        $method = $_SERVER['REQUEST_METHOD'];
        //Insert into comments database
        if($method=='POST'){
            $comment_content = $_POST['comment'];
            $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) 
            VALUES ('$comment_content', '$id', '0', CURRENT_TIMESTAMP);";
            $result = mysqli_query($conn,$sql);
            $showAlart=true;
            if($showAlart){
                echo 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your comment has been added!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    ?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc;?></p>
            <hr class="my-4">
            <p>Participate in constructive discussions
                Postings should continue the conversation
                Avoid stating "I agree":
                Stay on topic
                Don't post anything hateful, mean-spirited, or intolerant
                Don't post anything obscene or use foul language
                Don't post spam, advertising, or self-promote
            </p>
            <p>Posted by -<b> Rupam</b></p>
        </div>
    </div>

    <?php
    if(isset($_SESSION["loggedin"]) && isset($_SESSION["loggedin"])==true){
    echo '
    <div class="container">
        <h3 class="py-2">Post a comment</h3>
        <form action="'.$_SERVER["REQUEST_URI"] .'" method="post">
            <div class="form-group">
                <label for="comment">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
    }else{
            echo ' <div class="container">
                        <h3>Post a comment</h3>
                        <p ><b>You are not logged in. Please login to post a comment.</b></p>
                </div>';
        }
    ?>

    <div class="container">
        <h3 class="py-2">Discussions</h3>
        <?php
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM comments WHERE thread_id=$id";
        $result = mysqli_query($conn,$sql);
        $noResult=true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult=false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            echo '
            <div class="media my-4">
                <img src="img/user_default_image.png" width="60px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-bold my-0">Anonoymous user at '.$comment_time.' </p>
                    '.$content.'
                </div>
            </div>';
            }

            if($noResult){
                echo
                '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No threads found!</p>
                        <p class="lead"><b>Be the first person to ask a question</b></p>
                    </div>
                </div>';
            }
        ?>


    </div>

    <?php include 'partial/_footer.php';?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>