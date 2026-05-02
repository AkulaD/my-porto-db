<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM skills ORDER BY proficiency_percent DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKILLS_EDITOR | COMMAND_CENTER</title>
    <link rel="stylesheet" href="data/css/dashboard_style.css">
</head>
<body>
    <div class="db-container">
        <aside class="db-sidebar">
            <div class="db-brand">COMMAND_CENTER_V4</div>
            <nav class="db-nav">
                <a href="manage_identity.php">01_IDENTITY</a>
                <a href="manage_skills.php" class="active">02_SKILLS</a>
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
                <h3>/root/dashboard/core_capabilities.metrics</h3>
            </header>
            
            <section class="db-content">
                <!-- Form Tambah Skill Baru -->
                <div class="panel-box-admin">
                    <div class="panel-label">ADD_NEW_METRIC</div>
                    <form action="process_skills.php" method="POST" class="editor-form-inline">
                        <input type="hidden" name="action" value="create">
                        <input type="text" name="skill_name" placeholder="SKILL_NAME (e.g. PHP / LARAVEL)" required>
                        <input type="number" name="proficiency" placeholder="VAL_0-100" min="0" max="100" required>
                        <button type="submit" class="save-btn">INJECT_DATA</button>
                    </form>
                </div>

                <!-- List Skill yang Ada -->
                <div class="skills-list-admin" style="margin-top: 40px;">
                    <div class="panel-label">EXISTING_CAPABILITIES</div>
                    <table class="sys-table">
                        <thead>
                            <tr>
                                <th>CAPABILITY_NAME</th>
                                <th>METRIC_VAL</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $row['skill_name'] ?></td>
                                <td>
                                    <div class="mini-bar">
                                        <div class="mini-fill" style="width: <?= $row['proficiency_percent'] ?>%"></div>
                                        <span><?= $row['proficiency_percent'] ?>%</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="process_skills.php?action=delete&id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('APPLY_DELETION?')">DELETE</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>