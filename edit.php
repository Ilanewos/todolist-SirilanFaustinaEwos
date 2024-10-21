<?php 
    include "koneksi.php";

//SELECT DATA DIEDIT
    $id = (int) $_GET['id'];
    $q_select = "SELECT * FROM tb_task WHERE id=$id"; 
    $result = $db->query($q_select);
    $d = mysqli_fetch_object($result);

    if (!$d) {
    
   
        die("Task not found!");
        }

    //PROSES EDIT DATA
    if (isset($_POST['edit'])) {
        $tasklabel = $db->real_escape_string($_POST['task']);
    
    
        $q_update_task = "UPDATE tb_task SET tasklabel='$tasklabel' WHERE id=$id";
    
    
    
        if ($db->query($q_update_task) === TRUE) {
        
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating task status: " . $db->error;
        }
    }   
    

    $db->close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todolist</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header class="container">
        <a href="index.php"><i class='bx bx-chevron-left'></i></a>
        <h2 class="text">To Do List</h2>
    </header>

    <section>
        <div class="bagian">
            <div class="content">
                <form method="POST" action="">
                    <input  type="task" name="task" class="control" placeholder="edit task" value="<?= htmlspecialchars($d->tasklabel) ?>" required>

                    <div class="field">
                    <button type="submit" name="edit">Edit</button>
                    </div>
                 </form>
            </div>
        </div>
    </section>
</body>
</html>