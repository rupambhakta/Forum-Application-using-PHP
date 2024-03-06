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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM category WHERE category_id=$id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];

        }
    ?>
    <?php
     $showAlart=false;
        $method = $_SERVER['REQUEST_METHOD'];
        //Insert thread into database
        if($method=='POST'){
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
            VALUES ( '$th_title', '$th_desc', '$id', '0', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn,$sql);
            $showAlart=true;
            if($showAlart){
                echo 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added! Please wait for communuty to respord.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    ?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> forum</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>Participate in constructive discussions
                Postings should continue the conversation
                Avoid stating "I agree":
                Stay on topic
                Don't post anything hateful, mean-spirited, or intolerant
                Don't post anything obscene or use foul language
                Don't post spam, advertising, or self-promote
            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <div class="container">
        <h3 class="py-2">Ask a question</h3>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <div id="emailHelp" class="form-text">Keep your title as sort and crisp as possible. </div>
            </div>
            <div class="form-group">
                <label for="desc">Elaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <div class="container  mb-3">
        <h3 class="py-2">Browse Question</h3>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM threads WHERE thread_cat_id=$id";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            echo '
            <div class="media my-4">
                <img src="img/user_default_image.png" width="60px" class="mr-3" alt="...">
                <div class="media-body">
                    <p class="font-weight-bold my-0">Anonoymous user at '.date("Y-m-d").' </p>
                    <h6 class="mt-0"><a href="thread.php?thread_id='.$id.'">'.$title.'<a/></h6>
                    '.$desc.'
                </div>
            </div>';
            }
            // echo var_dump($noResult);
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