<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM education ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUCATION_EDITOR | COMMAND_CENTER</title>
    <link rel="stylesheet" href="data/css/dashboard_style.css">
</head>
<body>
    <div class="db-container">
        <aside class="db-sidebar">
            <div class="db-brand">COMMAND_CENTER_V4</div>
            <nav class="db-nav">
                <a href="manage_identity.php">01_IDENTITY</a>
                <a href="manage_skills.php">02_SKILLS</a>
                <a href="manage_education.php" class="active">03_EDUCATION</a>
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
                <h3>/root/dashboard/academic_records.db</h3>
                <button onclick="document.getElementById('add-edu-modal').style.display='block'" class="save-btn">ADD_NEW_RECORD</button>
            </header>
            
            <section class="db-content">
                <?php while($edu = mysqli_fetch_assoc($result)): ?>
                <div class="panel-box-admin" style="margin-bottom: 30px;">
                    <div class="panel-label">INSTITUTION_ID: <?= $edu['id'] ?></div>
                    <div class="edu-item-admin">
                        <div class="edu-info">
                            <h4 style="color: var(--accent); margin: 0;"><?= $edu['institution'] ?></h4>
                            <p style="font-size: 0.8rem; color: var(--text-dim);"><?= $edu['period'] ?> | <?= $edu['major'] ?></p>
                        </div>
                        
                        <!-- List Deskripsi -->
                        <ul class="admin-list">
                            <?php 
                            $edu_id = $edu['id'];
                            $detail_query = "SELECT * FROM education_details WHERE education_id = $edu_id";
                            $details = mysqli_query($conn, $detail_query);
                            while($detail = mysqli_fetch_assoc($details)): 
                            ?>
                                <li>
                                    > <?= $detail['description_point'] ?>
                                    <a href="process_education.php?action=delete_detail&id=<?= $detail['id'] ?>" class="text-red">[x]</a>
                                </li>
                            <?php endwhile; ?>
                        </ul>

                        <!-- Form Tambah Detail -->
                        <form action="process_education.php" method="POST" class="add-detail-form">
                            <input type="hidden" name="action" value="add_detail">
                            <input type="hidden" name="education_id" value="<?= $edu['id'] ?>">
                            <input type="text" name="point" placeholder="Add description point..." required>
                            <button type="submit">+</button>
                        </form>

                        <div class="item-actions">
                            <a href="process_education.php?action=delete_edu&id=<?= $edu['id'] ?>" class="btn-delete" onclick="return confirm('DELETE_RECORD?')">DELETE_INSTITUTION</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </section>
        </main>
    </div>

    <!-- Modal Tambah Instansi (Simple Hidden Div) -->
    <div id="add-edu-modal" class="modal">
        <div class="modal-content">
            <div class="panel-label">NEW_ACADEMIC_ENTRY</div>
            <form action="process_education.php" method="POST" class="editor-form">
                <input type="hidden" name="action" value="create_edu">
                <div class="input-group">
                    <label>INSTITUTION_NAME</label>
                    <input type="text" name="institution" required>
                </div>
                <div class="editor-row">
                    <div class="input-group">
                        <label>PERIOD</label>
                        <input type="text" name="period" placeholder="e.g. 2021 - 2024" required>
                    </div>
                    <div class="input-group">
                        <label>MAJOR</label>
                        <input type="text" name="major" required>
                    </div>
                </div>
                <button type="submit" class="save-btn">SAVE_RECORD</button>
                <button type="button" onclick="document.getElementById('add-edu-modal').style.display='none'" class="btn-delete">CANCEL</button>
            </form>
        </div>
    </div>
</body>
</html>