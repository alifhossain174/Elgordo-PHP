<?php
    include "includes/header.php";
	include "includes/function.php";
    include "includes/connection.php";
?>

<style>
    .add_new_btn{
        display: inline-block;
        padding: 3px 15px;
        background: skyblue;
        border-radius: 4px;
        margin-bottom: 10px;
        color: #1e1e1e !important;
        font-weight: 600 !important;
    }
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 9999; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 30%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .lottery_submit_form{
        margin-top: 10px;
    }

    .lottery_submit_form label{
        display: block;
        font-weight: 600;
        margin-bottom: 2px;
        margin-top: 10px;
        font-size: 15px;
    }

    .lottery_submit_form input {
        width: 100%;
        padding: 4px 5px;
        border: 1px solid lightgray;
        border-radius: 4px;
        font-size: 14px;
    }
    .lottery_submit_form select {
        padding: 4px 5px;
        border: 1px solid lightgray;
        border-radius: 4px;
        font-size: 14px;
        width: 50%;
        background: #ebebeb;
    }

    .lottery_submit_form button{
        padding: 4px 15px;
        margin-top: 20px;
        border-radius: 4px;
        background: green;
        color: white;
        border: none;
        font-weight: 600;
    }

    a.delete_btn{
        display: inline-block;
        background: #d20000;
        color: white;
        padding: 1px 8px;
        border-radius: 4px;
    }

    a.editBtn{
        display: inline-block;
        padding: 1px 8px;
        background: goldenrod;
        color: black;
        border-radius: 4px;
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lottery Info</h5>
                        </div>
                        <div class="card-body">

                            <?php if(isset($_SESSION['msg'])){?>
                                <div class="alert alert-primary alert-dismissible" role="alert"> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <?php echo $_SESSION['msg']; ?> 
                                </div>
                            <?php unset($_SESSION['msg']);}?>

                            <div style="text-align: right">
                                <a href="javascript:void(0)" id="showForm" class="add_new_btn">+ Add New</a>
                            </div>
                            
                            <?php
                                $qry = "SELECT * FROM `lottery_info` ORDER BY id DESC";
                                $result = mysqli_query($mysqli, $qry);

                                // Handle delete request
                                if (isset($_GET['delete_id'])) {
                                    $id_to_delete = intval($_GET['delete_id']);
                                    $delete_query = "DELETE FROM `lottery_info` WHERE id = $id_to_delete";
                                    
                                    if ($conn->query($delete_query) === TRUE) {
                                        echo "Record deleted successfully";
                                        $_SESSION['msg'] = "Record Deleted Successfully";
                                    } else {
                                        echo "Error deleting record: " . $conn->error;
                                        $_SESSION['msg'] = "Something Went Wrong";
                                    }
                                    
                                    // Redirect to avoid resubmission on refresh
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    exit;
                                }
                            ?>

                            <table style="width: 100%;" border="1" cellpadding="1">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">SL</th>
                                        <th style="text-align:center">Image</th>
                                        <th style="text-align:center">Name</th>
                                        <th style="text-align:center">Email</th>
                                        <th style="text-align:center">Password</th>
                                        <th style="text-align:center">Lottery Number</th>
                                        <th style="text-align:center">Balance</th>
                                        <th style="text-align:center">Last Win</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(mysqli_num_rows($result) > 0) {
                                        $sl = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td style="text-align:center"><?= $sl++; ?></td>
                                        <td style="text-align:center">
                                            <?php if($row['image']){ ?>
                                            <img style="width: 60px; object-fit: cover;" src="images/<?php echo $row['image'];?>" alt="">
                                            <?php } ?>
                                        </td>
                                        <td style="text-align:center"><?= htmlspecialchars($row['name']); ?></td>
                                        <td style="text-align:center"><?= htmlspecialchars($row['email']); ?></td>
                                        <td style="text-align:center"><?= htmlspecialchars($row['password']); ?></td>
                                        <td style="text-align:center"><?= htmlspecialchars($row['lottery_number']); ?></td>
                                        <td style="text-align:center"><?= htmlspecialchars($row['balance']); ?></td>
                                        <td style="text-align:center"><?= htmlspecialchars($row['last_win']); ?></td>
                                        <td style="text-align:center">
                                            <a href="?delete_id=<?= $row['id']; ?>" class="delete_btn" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            <a href="javascript:void(0)" class="editBtn" data-id="<?= $row['id']; ?>" data-name="<?= htmlspecialchars($row['name']); ?>" data-email="<?= htmlspecialchars($row['email']); ?>" data-password="<?= htmlspecialchars($row['password']); ?>" data-lottery_number="<?= htmlspecialchars($row['lottery_number']); ?>" data-balance="<?= htmlspecialchars($row['balance']); ?>" data-last_win="<?= htmlspecialchars($row['last_win']); ?>" data-comprobar_status="<?= $row['comprobar_status']; ?>">Edit</a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' style='text-align:center'>No records found</td></tr>";
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<!-- Add Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="lottery_submit_form" action="save_lottery_info.php" method="POST" enctype="multipart/form-data">
            <label>User Image</label>
            <input type="file" name="image" required>
            <label>Full Name</label>
            <input type="text" name="name" required placeholder="Mr./Miss/Mrs.">
            <label>Email</label>
            <input type="email" name="email" required placeholder="example@sample.com">
            <label>Password</label>
            <input type="text" name="password" required placeholder="********">
            <label>Lottery No</label>
            <input type="text" name="lottery_number" required>
            <label>Balance</label>
            <input type="number" name="balance">
            <label>Last Win</label>
            <input type="text" name="last_win">
            <div style="text-align:right">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="lottery_submit_form" action="update_lottery_info.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="edit_id">
            <label>Change Image</label>
            <input type="file" name="image">
            <label>Full Name</label>
            <input type="text" name="name" id="edit_name" required>
            <label>Email</label>
            <input type="email" name="email" id="edit_email" required>
            <label>Password</label>
            <input type="text" name="password" id="edit_password" required>
            <label>Lottery No</label>
            <input type="text" name="lottery_number" id="edit_lottery_number" required>
            <label>Balance</label>
            <input type="number" name="balance" id="edit_balance">
            <label>Last Win</label>
            <input type="text" name="last_win" id="edit_last_win">
            <div style="text-align:right">
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("showForm");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Edit Modal
    var editModal = document.getElementById("editModal");
    var editBtns = document.getElementsByClassName("editBtn");
    var editSpan = document.getElementsByClassName("close")[1];
    for(var i = 0; i < editBtns.length; i++){
        editBtns[i].onclick = function() {
            var id = this.getAttribute("data-id");
            var name = this.getAttribute("data-name");
            var email = this.getAttribute("data-email");
            var password = this.getAttribute("data-password");
            var lottery_number = this.getAttribute("data-lottery_number");
            var balance = this.getAttribute("data-balance");
            var last_win = this.getAttribute("data-last_win");

            document.getElementById("edit_id").value = id;
            document.getElementById("edit_name").value = name;
            document.getElementById("edit_email").value = email;
            document.getElementById("edit_password").value = password;
            document.getElementById("edit_lottery_number").value = lottery_number;
            document.getElementById("edit_balance").value = balance;
            document.getElementById("edit_last_win").value = last_win;

            editModal.style.display = "block";
        }
    }
    editSpan.onclick = function() {
        editModal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }
</script>

<?php include "includes/footer.php";?>