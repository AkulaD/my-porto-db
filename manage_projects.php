<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM projects ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECTS_EDITOR | COMMAND_CENTER</title>
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
                <a href="manage_projects.php" class="active">06_PROJECTS</a>
                <a href="manage_comments.php">08_COMMENTS</a>
                <a href="manage_social.php">09_SOSIAL</a>
                <a href="logout.php" class="logout">LOGOUT</a>
            </nav>
        </aside>

        <main class="db-main">
            <header class="db-header">
                <h3>/root/dashboard/deployed_projects.exe</h3>
                <button onclick="document.getElementById('add-project-modal').style.display='block'" class="save-btn">REGISTER_NEW_PROJECT</button>
            </header>
            
            <section class="db-content">
                <div class="project-list-admin">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="panel-box-admin" style="margin-bottom: 20px;">
                        <div class="project-item-header" style="display: flex; justify-content: space-between;">
                            <div>
                                <h4 style="color: var(--accent); margin: 0;"><?= $row['project_name'] ?></h4>
                                <small style="color: var(--text-dim);">STATUS: <?= $row['status'] ?></small>
                            </div>
                            <div class="actions">
                                <a href="process_projects.php?action=delete&id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('UNSET_PROJECT?')">DELETE</a>
                            </div>
                        </div>
                        
                        <div style="margin-top: 15px; font-size: 0.85rem; color: #ccc;">
                            <p><?= $row['description'] ?></p>
                            <div style="margin-top: 10px;">
                                <span style="color: var(--accent);">STACK:</span> <?= $row['tech_stack'] ?>
                            </div>
                            <?php if($row['url']): ?>
                            <div style="margin-top: 5px;">
                                <span style="color: var(--accent);">URL:</span> <a href="<?= $row['url'] ?>" target="_blank" style="color: #44aaff;"><?= $row['url'] ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal Tambah Proyek -->
    <div id="add-project-modal" class="modal">
        <div class="modal-content">
            <div class="panel-label">INITIALIZE_PROJECT_DATA</div>
            <form action="process_projects.php" method="POST" class="editor-form">
                <input type="hidden" name="action" value="create">
                <div class="input-group">
                    <label>PROJECT_NAME</label>
                    <input type="text" name="project_name" required>
                </div>
                <div class="input-group">
                    <label class="label">DEPLOY_DATE</label>
                    <input type="date" name="deploy_date" required>
                </div>
                <div class="editor-row">
                    <div class="input-group">
                        <label>STATUS</label>
                        <input type="text" name="status" placeholder="e.g. PRODUCTION / STAGING" required>
                    </div>
                    <div class="input-group">
                        <label>TECH_STACK (comma separated)</label>
                        <input type="text" name="tech_stack" placeholder="PHP, Laravel, MySQL" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>EXTERNAL_URL (GitHub / Live)</label>
                    <input type="url" name="url" placeholder="https://github.com/shakabanuasta/...">
                </div>
                <div class="input-group">
                    <label>PROJECT_DESCRIPTION</label>
                    <textarea name="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="save-btn">DEPLOY_METADATA</button>
                <button type="button" onclick="document.getElementById('add-project-modal').style.display='none'" class="btn-delete">CANCEL</button>
            </form>
        </div>
    </div>
</body>
</html>