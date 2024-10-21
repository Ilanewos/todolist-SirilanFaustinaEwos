<?php 
    include "koneksi.php";

//proses insert data
    if (isset($_POST['task']) && !empty($_POST['task'])) {
        // Mendefinisikan query
        $task = $db->real_escape_string($_POST['task']);
        $q_insert = "INSERT INTO tb_task (tasklabel, taskstatus) VALUES ('$task', 'open')";
        }
    
    // Eksekusi query hanya jika query sudah diatur
    if (!empty($q_insert)) {
        if ($db->query($q_insert) === TRUE) {
            echo "New task created successfully";
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $q_insert . "<br>" . $db->error;
        }
    }



//proses show database
    $q_select = "SELECT * FROM tb_task ORDER BY id DESC"; 
    $result = $db->query($q_select);



//proses delete data
if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id']; 
    $q_delete = "DELETE FROM tb_task WHERE id = $delete_id"; 
    
    if ($db->query($q_delete) === TRUE) {
        echo "Task deleted successfully";
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . $db->error;
    }
}

//proses update data 
if (isset($_GET['done'])) {

    $id = (int) $_GET['done'];
    $status = 'close';

    if ($_GET['status'] == 'open'){
        $status = "close";
    } else {
        $status = "open";
    }

    // Query untuk mengupdate status tugas
    $q_update_status = "UPDATE tb_task SET taskstatus='$status' WHERE id=$id";

    if ($db->query($q_update_status) === TRUE) {
        echo "Task status updated successfully";
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
        <h2 class="text">To Do List</h2>
    </header>

    <section>
        <div class="bagian">
            <div class="content">
                <form method="POST" action="">
                    <input  type="task" name="task" class="control" placeholder="Tambah">

                    <div class="field">
                        <button type="submit" name="add">Tambah</button>
                    </div>
                 </form>
            </div>
        </div>

        <div class="bagian">
        <?php 
                    if ($result->num_rows > 0);
                    while($row = $result->fetch_assoc()){
        ?>
            <div class="item <?= $row['taskstatus'] == 'close' ? 'done' : ''; ?>">
                <div>
                    <input type="checkbox" onclick="window.location.href = '?done=<?= $row['id'] ?>&status=<?= $row['taskstatus'] ?>'" <?= $row['taskstatus'] == 'close' ? 'checked':""?>>
                    <span><?= $row['tasklabel']?></span>
                </div>
   
                <div>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue" title="edit"><i class="bx bx-edit"></i></a>
                    <a href="?delete_id=<?= $row['id'] ?>" class="text-red" title="delete" onclick="return confirm('Are you Sure ?')"><i class="bx bx-trash"></i></a>
                </div>
            </div>
        <?php  } ?>
        </div>
    </section>
</body>
</html>