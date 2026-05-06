<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM work_logs ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORK_LOGS_EDITOR | COMMAND_CENTER</title>
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
                <a href="manage_work.php" class="active">05_WORK_LOGS</a>
                <a href="manage_projects.php">06_PROJECTS</a>
                <a href="manage_comments.php">08_COMMENTS</a>
                <a href="manage_social.php">09_SOSIAL</a>
                <a href="logout.php" class="logout">LOGOUT</a>
            </nav>
        </aside>

        <main class="db-main">
            <header class="db-header">
                <h3>/root/dashboard/employment_history.log</h3>
                <button onclick="document.getElementById('add-work-modal').style.display='block'" class="save-btn">CREATE_NEW_LOG</button>
            </header>
            
            <section class="db-content">
                <?php while($work = mysqli_fetch_assoc($result)): ?>
                <div class="panel-box-admin" style="margin-bottom: 30px; border-left: 3px solid var(--accent);">
                    <div class="panel-label">LOG_ENTRY_ID: <?= $work['id'] ?></div>
                    
                    <div class="work-item-admin">
                        <div class="work-header" style="display: flex; justify-content: space-between;">
                            <div>
                                <span style="color: var(--text-dim); font-size: 0.75rem;">[<?= $work['period'] ?>]</span>
                                <h4 style="color: var(--accent); margin: 5px 0; text-transform: uppercase;"><?= $work['role'] ?></h4>
                                <strong style="font-size: 0.9rem;"><?= $work['company_project'] ?></strong>
                                <div style="font-size: 0.7rem; color: var(--accent); margin-top: 5px;">STATUS: <?= $work['status'] ?></div>
                            </div>
                            <a href="process_work.php?action=delete_work&id=<?= $work['id'] ?>" class="btn-delete" onclick="return confirm('ERASE_LOG?')">ERASE_LOG</a>
                        </div>

                        <ul class="admin-list" style="margin-top: 20px;">
                            <?php 
                            $work_id = $work['id'];
                            $detail_query = "SELECT * FROM work_details WHERE work_id = $work_id";
                            $details = mysqli_query($conn, $detail_query);
                            if($details):
                                while($detail = mysqli_fetch_assoc($details)): 
                            ?>
                                <li>
                                    > <?= $detail['description_point'] ?>
                                    <a href="process_work.php?action=delete_detail&id=<?= $detail['id'] ?>" class="text-red">[x]</a>
                                </li>
                            <?php 
                                endwhile; 
                            endif;
                            ?>
                        </ul>

                        <form action="process_work.php" method="POST" class="add-detail-form">
                            <input type="hidden" name="action" value="add_detail">
                            <input type="hidden" name="work_id" value="<?= $work['id'] ?>">
                            <input type="text" name="point" placeholder="Inject new description point..." required>
                            <button type="submit">INJECT</button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </section>
        </main>
    </div>

    <div id="add-work-modal" class="modal">
        <div class="modal-content">
            <div class="panel-label">NEW_WORK_RECORD_INITIALIZATION</div>
            <form action="process_work.php" method="POST" class="editor-form">
                <input type="hidden" name="action" value="create_work">
                <div class="input-group">
                    <label>ROLE / JABATAN</label>
                    <input type="text" name="role" placeholder="e.g. FULL-STACK ENGINEER" required>
                </div>
                <div class="input-group">
                    <label>COMPANY_PROJECT</label>
                    <input type="text" name="company_project" placeholder="e.g. Project 2600L Luxia" required>
                </div>
                <div class="editor-row">
                    <div class="input-group">
                        <label>START_PERIOD</label>
                        <input type="date" name="period_start" required>
                    </div>
                    <div class="input-group">
                        <label>END_PERIOD</label>
                        <input type="date" name="period_end" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>STATUS</label>
                    <select name="status" style="width: 100%; background: #1a1a1a; color: #fff; border: 1px solid #333; padding: 10px;">
                        <option value="COMPLETED">COMPLETED</option>
                        <option value="IN_PROGRESS">IN_PROGRESS</option>
                        <option value="OPTIMAL">OPTIMAL</option>
                    </select>
                </div>
                <button type="submit" class="save-btn">EXECUTE_SAVE</button>
                <button type="button" onclick="document.getElementById('add-work-modal').style.display='none'" class="btn-delete">ABORT</button>
            </form>
        </div>
    </div>
</body>
</html>