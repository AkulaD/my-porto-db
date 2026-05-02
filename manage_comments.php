<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM messages ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMMENTS_VIEWER | COMMAND_CENTER</title>
    <link rel="stylesheet" href="data/css/dashboard_style.css">
</head>
<body>
    <div class="db-container">
        <aside class="db-sidebar">
            <div class="db-brand">COMMAND_CENTER_V4</div>
            <nav class="db-nav">
                <a href="manage_identity.php">01_IDENTITY</a>
                <a href="manage_skills.php">02_SKILLS</a>
                <a href="manage_education.php">03_EDUCATION</a>
                <a href="manage_certificates.php">04_CERTIFICATES</a>
                <a href="manage_work.php">05_WORK_LOGS</a>
                <a href="manage_projects.php">06_PROJECTS</a>
                <a href="manage_comments.php" class="active">08_COMMENTS</a>
                <a href="manage_social.php">09_SOSIAL</a>
                <a href="logout.php" class="logout">LOGOUT</a>
            </nav>
        </aside>

        <main class="db-main">
            <header class="db-header">
                <h3>/root/dashboard/inbound_messages.log</h3>
            </header>
            
            <section class="db-content">
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($msg = mysqli_fetch_assoc($result)): ?>
                    <div class="panel-box-admin" style="margin-bottom: 20px; border-left: 2px solid var(--accent);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div class="msg-meta">
                                <span style="color: var(--accent); font-size: 0.7rem;">[ID: <?= $msg['id'] ?>]</span>
                                <span style="color: var(--text-dim); font-size: 0.7rem; margin-left: 10px;"><?= $msg['created_at'] ?></span>
                                <h4 style="margin: 10px 0 5px 0; color: #fff;">SENDER: <?= $msg['sender_id'] ?></h4>
                                <code style="color: var(--accent); font-size: 0.8rem;">RETURN_PATH: <?= $msg['return_path'] ?></code>
                            </div>
                            <a href="process_comments.php?action=delete&id=<?= $msg['id'] ?>" class="btn-delete" onclick="return confirm('ERASE_MESSAGE_PERMANENTLY?')">PURGE</a>
                        </div>
                        
                        <div class="msg-body" style="margin-top: 15px; padding: 15px; background: #000; border: 1px dashed #333; font-size: 0.9rem; color: #e0e0e0; line-height: 1.5;">
                            <span style="color: var(--accent); font-family: monospace;">DATA_STREAM >></span><br>
                            <?= nl2br($msg['data_stream']) ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert">NO_INBOUND_MESSAGES_DETECTED</div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>