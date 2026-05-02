<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM users LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDENTITY_EDITOR | COMMAND_CENTER</title>
    <link rel="stylesheet" href="data/css/dashboard_style.css">
</head>
<body>
    <div class="db-container">
        <aside class="db-sidebar">
            <div class="db-brand">COMMAND_CENTER_V4</div>
            <nav class="db-nav">
                <a href="manage_identity.php" class="active">01_IDENTITY</a>
                <a href="manage_skills.php">02_SKILLS</a>
                <a href="manage_education.php">03_EDUCATION</a>
                <a href="manage_certificates.php">04_CERTIFICATES</a>
                <a href="manage_work.php">05_WORK_LOGS</a>
                <a href="manage_projects.php">06_PROJECTS</a>
                <a href="manage_comments.php">08_COMMENTS</a>
                <a href="manage_social.php">09_SOSIAL</a>
                <a href="logout.php" class="logout">LOGOUT</a>
            </nav>
        </aside>

        <main class="db-main">
            <header class="db-header">
                <h3>/root/dashboard/identity_editor.exe</h3>
            </header>
            
            <section class="db-content">
                <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="alert success">CORE_DATA_UPDATED_SUCCESSFULLY</div>
                <?php endif; ?>

                <form action="update_identity.php" method="POST" class="editor-form">
                    <div class="editor-row">
                        <div class="input-group">
                            <label>FULL_NAME</label>
                            <input type="text" name="full_name" value="<?= $user['full_name'] ?? '' ?>" required>
                        </div>
                        <div class="input-group">
                            <label>SYSTEM_TITLE</label>
                            <input type="text" name="title" value="<?= $user['title'] ?? '' ?>" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label>BIO_DATA_STREAM (fetch-profile --brief)</label>
                        <textarea name="bio" rows="4" required><?= $user['bio'] ?? '' ?></textarea>
                    </div>

                    <div class="input-group">
                        <label>LOCATION (get-location)</label>
                        <input type="text" name="location" value="<?= $user['location'] ?? '' ?>" required>
                    </div>

                    <div class="editor-row">
                        <div class="input-group">
                            <label>HARDWARE_INFO</label>
                            <input type="text" name="hardware_info" value="<?= $user['hardware_info'] ?? '' ?>">
                        </div>
                        <div class="input-group">
                            <label>OS_INFO</label>
                            <input type="text" name="os_info" value="<?= $user['os_info'] ?? '' ?>">
                        </div>
                        <div class="input-group">
                            <label>KERNEL_INFO</label>
                            <input type="text" name="kernel_info" value="<?= $user['kernel_info'] ?? '' ?>">
                        </div>
                    </div>

                    <button type="submit" class="save-btn">EXECUTE_UPDATE</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>