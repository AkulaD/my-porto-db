<?php 
include('session_check.php');
include('db_config.php');

$query = "SELECT * FROM certificates ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CERTIFICATES_EDITOR | COMMAND_CENTER</title>
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
                <a href="manage_certificates.php" class="active">04_CERTIFICATES</a>
                <a href="manage_work.php">05_WORK_LOGS</a>
                <a href="manage_projects.php">06_PROJECTS</a>
                <a href="manage_comments.php">08_COMMENTS</a>
                <a href="manage_social.php">09_SOSIAL</a>
                <a href="logout.php" class="logout">LOGOUT</a>
            </nav>
        </aside>

        <main class="db-main">
            <header class="db-header">
                <h3>/root/dashboard/authorized_certificates.json</h3>
                <button onclick="document.getElementById('add-cert-modal').style.display='block'" class="save-btn">ADD_NEW_CERTIFICATE</button>
            </header>
            
            <section class="db-content">
                <div class="cert-grid-admin">
                    <?php while($cert = mysqli_fetch_assoc($result)): ?>
                    <div class="cert-card-admin">
                        <div class="cert-header-admin">
                            <span class="cert-code"><?= $cert['cert_date'] ?></span>
                            <a href="process_certificates.php?action=delete&id=<?= $cert['id'] ?>" class="cert-del" onclick="return confirm('REVOKE_CERTIFICATE?')">[x]</a>
                        </div>
                        <h4 class="cert-title-admin"><?= $cert['cert_name'] ?></h4>
                        <p class="cert-desc-admin"><?= $cert['issuer'] ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal Tambah Sertifikat -->
    <div id="add-cert-modal" class="modal">
        <div class="modal-content">
            <div class="panel-label">REGISTER_NEW_CERTIFICATE</div>
            <form action="process_certificates.php" method="POST" class="editor-form">
                <input type="hidden" name="action" value="create">
                <div class="editor-row">
                    <div class="input-group">
                        <label>CERT_DATE (e.g. BNSP-WD-2024)</label>
                        <input type="date" name="cert_date" required placeholder="Bulan - Tahun">
                    </div>
                    <div class="input-group">
                        <label>CERTIFICATE_TITLE</label>
                        <input type="text" name="cert_name" required placeholder="Nama Sertifikasi">
                    </div>
                </div>
                <div class="input-group">
                    <label>LINK CERTIFICATE</label>
                    <input type="text" name="link_cert" id="link_cert">
                </div>
                <div class="input-group">
                    <label>DESCRIPTION_LOG</label>
                    <textarea name="description" rows="3" required placeholder="Deskripsi atau badan penerbit..."></textarea>
                </div>
                <button type="submit" class="save-btn">INJECT_CERTIFICATE</button>
                <button type="button" onclick="document.getElementById('add-cert-modal').style.display='none'" class="btn-delete">CANCEL</button>
            </form>
        </div>
    </div>
</body>
</html>