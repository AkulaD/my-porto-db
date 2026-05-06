<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM social_protocols ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCIAL_PROTOCOLS | COMMAND_CENTER</title>
    <link rel="stylesheet" href="data/css/dashboard_style.css">
</head>
<body>
    <div class="db-container">
        <aside class="db-sidebar">
            <div class="db-brand">COMMAND_CENTER_V4.5</div>
            <nav class="db-nav">
                <a href="manage_identity.php">01_IDENTITY</a>
                <a href="manage_skills.php">02_SKILLS</a>
                <a href="manage_education.php">03_EDUCATION</a>
                <a href="manage_certificates.php">04_CERTIFICATES</a>
                <a href="manage_work.php">05_WORK_LOGS</a>
                <a href="manage_projects.php">06_PROJECTS</a>
                <a href="manage_comments.php">08_COMMENTS</a>
                <a href="manage_social.php" class="active">09_SOSIAL</a>
                <a href="logout.php" class="logout">LOGOUT</a>
            </nav>
        </aside>

        <main class="db-main">
            <header class="db-header">
                <h3>/root/dashboard/external_links.cfg</h3>
                <button onclick="document.getElementById('add-social-modal').style.display='block'" class="save-btn">ADD_PROTOCOL</button>
            </header>
            
            <section class="db-content">
                <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="panel-box-admin">
                        <div class="panel-label">PROTOCOL_ID: <?= $row['id'] ?></div>
                        <div style="margin-top: 10px;">
                            <h4 style="color: var(--accent); margin: 0; text-transform: uppercase;"><?= $row['platform_name'] ?></h4>
                            <p style="font-family: monospace; font-size: 0.85rem; margin: 10px 0; color: #fff;">
                                DISPLAY: <span style="color: var(--text-dim);"><?= $row['display_value'] ?></span><br>
                                ENDPOINT: <a href="<?= $row['url'] ?>" target="_blank" style="color: #44aaff; text-decoration: none;"><?= $row['url'] ?></a>
                            </p>
                        </div>
                        <div style="text-align: right; margin-top: 15px; border-top: 1px solid #222; padding-top: 10px;">
                            <a href="process_social.php?action=delete&id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('DEACTIVATE_PROTOCOL?')">TERMINATE</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal Tambah Protokol -->
    <div id="add-social-modal" class="modal">
        <div class="modal-content">
            <div class="panel-label">NEW_SOCIAL_LINK_CONFIGURATION</div>
            <form action="process_social.php" method="POST" class="editor-form">
                <input type="hidden" name="action" value="create">
                <div class="input-group">
                    <label>PLATFORM_NAME</label>
                    <input type="text" name="platform_name" placeholder="e.g. GITHUB, LINKEDIN, KOMPASIANA" required>
                </div>
                <div class="input-group">
                    <label>DISPLAY_VALUE</label>
                    <input type="text" name="display_value" placeholder="e.g. @shaka_banuasta" required>
                </div>
                <div class="input-group">
                    <label>EXTERNAL_URL</label>
                    <input type="url" name="url" placeholder="https://..." required>
                </div>
                <button type="submit" class="save-btn">SAVE_PROTOCOL</button>
                <button type="button" onclick="document.getElementById('add-social-modal').style.display='none'" class="btn-delete">ABORT</button>
            </form>
        </div>
    </div>
</body>
</html>