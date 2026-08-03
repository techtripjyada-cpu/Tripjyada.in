<style>
.prof-avatar-section{display:flex;align-items:center;gap:24px;flex-wrap:wrap}
.prof-avatar-ring{position:relative;width:96px;height:96px;flex-shrink:0}
.prof-avatar-ring .ud-avatar-lg{width:96px;height:96px;font-size:36px;cursor:pointer}
.prof-avatar-overlay{position:absolute;inset:0;border-radius:50%;background:rgba(0,0,0,.45);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;cursor:pointer;color:#fff;font-size:11px;font-weight:700;flex-direction:column;gap:3px;text-align:center}
.prof-avatar-ring:hover .prof-avatar-overlay{opacity:1}
.prof-avatar-overlay svg{width:20px;height:20px}
.prof-avatar-info h4{font-size:16px;font-weight:700;color:#1e293b;margin:0 0 3px}
.prof-avatar-info p{font-size:13px;color:#94a3b8;margin:0 0 10px}
.prof-avatar-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:12px;font-weight:600;color:#f97316;background:#fff7ed;cursor:pointer;transition:all .15s}
.prof-avatar-btn:hover{border-color:#f97316;background:#fff}

.ud-upload-area{border:2px dashed #e2e8f0;border-radius:12px;padding:28px 20px;text-align:center;cursor:pointer;transition:all .2s;background:#fafafa;display:block;width:100%}
.ud-upload-area:hover,.ud-upload-area.drag{border-color:#f97316;background:#fff7ed}
.ud-upload-area svg{color:#cbd5e1;width:36px;height:36px;margin:0 auto 10px;display:block}
.ud-upload-area .ua-title{font-size:13px;font-weight:600;color:#374151;margin-bottom:4px}
.ud-upload-area .ua-hint{font-size:11px;color:#94a3b8}
.ud-upload-area input{display:none}

.ud-id-preview{margin-top:14px;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;background:#f8fafc;display:none}
.ud-id-preview img{width:100%;max-height:200px;object-fit:contain;display:block;background:#f1f5f9}
.ud-id-preview-bar{display:flex;align-items:center;justify-content:space-between;padding:8px 12px;background:#f8fafc}
.ud-id-preview-name{font-size:12px;color:#475569;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px}
.ud-id-preview-remove{font-size:11px;color:#dc2626;cursor:pointer;font-weight:600;flex-shrink:0}
.ud-pdf-icon{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:28px;gap:6px}
.ud-pdf-icon svg{width:40px;height:40px;color:#dc2626}
.ud-pdf-icon span{font-size:12px;color:#475569;font-weight:600}
</style>

<h1 class="ud-page-title">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
    My Profile
</h1>
<p class="ud-page-sub">Manage your personal information</p>

<?php if ($this->input->get('saved')): ?>
<div class="ud-alert ud-alert-success">&#10003; Profile updated successfully!</div>
<?php endif; ?>

<form action="<?= site_url('user/update-profile') ?>" method="post" enctype="multipart/form-data" id="profileForm">

    <!-- Avatar -->
    <div class="ud-card">
        <div class="ud-card-title">Profile Photo</div>
        <div class="prof-avatar-section">
            <div class="prof-avatar-ring" id="avatarRing" onclick="document.getElementById('profilePicInput').click()">
                <div class="ud-avatar-lg" id="avatarCircle">
                    <?php if (!empty($user['profile_pic'])): ?>
                        <img src="<?= base_url($user['profile_pic']) ?>" alt="" id="avatarImg" style="width:96px;height:96px;border-radius:50%;object-fit:cover">
                    <?php else: ?>
                        <span id="avatarInitial"><?= strtoupper(substr($user['name'] ?: $user['phone'], 0, 1)) ?></span>
                    <?php endif; ?>
                </div>
                <div class="prof-avatar-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/></svg>
                    Change
                </div>
            </div>
            <div class="prof-avatar-info">
                <h4><?= htmlspecialchars($user['name'] ?: 'Traveller') ?></h4>
                <p>+91 <?= htmlspecialchars($user['phone']) ?></p>
                <button type="button" class="prof-avatar-btn" onclick="document.getElementById('profilePicInput').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                    Upload new photo
                </button>
                <div style="font-size:11px;color:#94a3b8;margin-top:4px">JPG, PNG or WEBP · Max 2MB</div>
            </div>
            <input type="file" name="profile_pic" id="profilePicInput" accept="image/*" style="display:none">
        </div>
    </div>

    <!-- Personal info -->
    <div class="ud-card">
        <div class="ud-card-title">Personal Information</div>
        <div class="ud-form-grid">
            <div class="ud-field">
                <label>Full Name *</label>
                <input type="text" name="name" class="ud-input" value="<?= htmlspecialchars($user['name'] ?? '') ?>" placeholder="Your full name" required>
            </div>
            <div class="ud-field">
                <label>Email</label>
                <input type="email" name="email" class="ud-input" value="<?= htmlspecialchars($user['email'] ?? '') ?>" placeholder="name@example.com">
            </div>
            <div class="ud-field">
                <label>Phone</label>
                <input type="text" class="ud-input" value="+91 <?= htmlspecialchars($user['phone']) ?>" readonly>
            </div>
            <div class="ud-field">
                <label>Gender</label>
                <select name="gender" class="ud-input">
                    <option value="">Select gender</option>
                    <option value="male"   <?= ($user['gender'] ?? '') === 'male'   ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= ($user['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                    <option value="other"  <?= ($user['gender'] ?? '') === 'other'  ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div class="ud-field">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="ud-input" value="<?= htmlspecialchars($user['dob'] ?? '') ?>">
            </div>
            <div class="ud-field">
                <label>Instagram Profile</label>
                <input type="text" name="instagram" class="ud-input" value="<?= htmlspecialchars($user['instagram'] ?? '') ?>" placeholder="@handle">
            </div>
            <div class="ud-field">
                <label>Home Town</label>
                <input type="text" name="hometown" class="ud-input" value="<?= htmlspecialchars($user['hometown'] ?? '') ?>" placeholder="Where are you from?">
            </div>
            <div class="ud-field">
                <label>Current Town</label>
                <input type="text" name="current_town" class="ud-input" value="<?= htmlspecialchars($user['current_town'] ?? '') ?>" placeholder="Where do you live now?">
            </div>
        </div>
        <div class="ud-form-grid" style="margin-top:14px">
            <div class="ud-field">
                <label>Address</label>
                <textarea name="address" class="ud-input" placeholder="Your address"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
            </div>
            <div class="ud-field">
                <label>About Me</label>
                <textarea name="about" class="ud-input" placeholder="Tell us about yourself"><?= htmlspecialchars($user['about'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <!-- ID Proof -->
    <div class="ud-card">
        <div class="ud-card-title">ID Proof</div>

        <?php if (!empty($user['id_proof'])): ?>
        <div style="margin-bottom:16px;padding:12px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;gap:12px">
            <?php $ext = strtolower(pathinfo($user['id_proof'], PATHINFO_EXTENSION)); ?>
            <?php if ($ext === 'pdf'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                <div style="flex:1;min-width:0">
                    <div style="font-size:13px;font-weight:600;color:#1e293b">Current ID Proof (PDF)</div>
                    <a href="<?= base_url($user['id_proof']) ?>" target="_blank" style="font-size:12px;color:#f97316;font-weight:600">View PDF &rarr;</a>
                </div>
            <?php else: ?>
                <img src="<?= base_url($user['id_proof']) ?>" style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0" alt="ID Proof">
                <div style="flex:1;min-width:0">
                    <div style="font-size:13px;font-weight:600;color:#1e293b">Current ID Proof</div>
                    <a href="<?= base_url($user['id_proof']) ?>" target="_blank" style="font-size:12px;color:#f97316;font-weight:600">View full size &rarr;</a>
                </div>
            <?php endif; ?>
            <span style="font-size:11px;color:#94a3b8;background:#e2e8f0;padding:3px 8px;border-radius:20px">Uploaded</span>
        </div>
        <?php endif; ?>

        <label class="ud-upload-area" for="idProofInput" id="idDropZone">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
            <div class="ua-title" id="idUploadTitle">Click to upload or drag & drop</div>
            <div class="ua-hint">JPG, PNG, WEBP or PDF &nbsp;·&nbsp; Max 2 MB</div>
            <input type="file" name="id_proof" id="idProofInput" accept=".jpg,.jpeg,.png,.webp,.pdf">
        </label>

        <!-- Preview shown after file selected -->
        <div class="ud-id-preview" id="idPreviewBox">
            <div id="idPreviewContent"></div>
            <div class="ud-id-preview-bar">
                <span class="ud-id-preview-name" id="idFileName"></span>
                <span class="ud-id-preview-remove" onclick="clearIdProof()">&#10005; Remove</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap">
        <button type="submit" class="ud-submit" id="profileSubmitBtn">Save Profile</button>
        <span style="font-size:12px;color:#94a3b8">Changes are saved immediately</span>
    </div>
</form>

<script>
// ── Avatar live preview ──
document.getElementById('profilePicInput').addEventListener('change', function(e){
    var file = e.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function(ev){
        var circle = document.getElementById('avatarCircle');
        circle.innerHTML = '<img src="' + ev.target.result + '" style="width:96px;height:96px;border-radius:50%;object-fit:cover" alt="">';
    };
    reader.readAsDataURL(file);
});

// ── ID Proof live preview ──
document.getElementById('idProofInput').addEventListener('change', function(e){
    var file = e.target.files[0];
    if (!file) return;
    showIdPreview(file);
});

function showIdPreview(file){
    var box     = document.getElementById('idPreviewBox');
    var content = document.getElementById('idPreviewContent');
    var nameEl  = document.getElementById('idFileName');
    var title   = document.getElementById('idUploadTitle');

    nameEl.textContent = file.name;
    title.textContent  = file.name;
    box.style.display  = 'block';

    if (file.type === 'application/pdf') {
        content.innerHTML = '<div class="ud-pdf-icon">' +
            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>' +
            '<span>PDF selected — will upload on save</span>' +
            '</div>';
    } else {
        var reader = new FileReader();
        reader.onload = function(ev){
            content.innerHTML = '<img src="' + ev.target.result + '" alt="ID Preview">';
        };
        reader.readAsDataURL(file);
    }
}

function clearIdProof(){
    var input = document.getElementById('idProofInput');
    input.value = '';
    document.getElementById('idPreviewBox').style.display  = 'none';
    document.getElementById('idPreviewContent').innerHTML   = '';
    document.getElementById('idUploadTitle').textContent    = 'Click to upload or drag & drop';
}

// ── Drag & drop on upload zone ──
var zone = document.getElementById('idDropZone');
['dragenter','dragover'].forEach(function(ev){
    zone.addEventListener(ev, function(e){ e.preventDefault(); zone.classList.add('drag'); });
});
['dragleave','drop'].forEach(function(ev){
    zone.addEventListener(ev, function(e){ e.preventDefault(); zone.classList.remove('drag'); });
});
zone.addEventListener('drop', function(e){
    var file = e.dataTransfer.files[0];
    if (!file) return;
    var input = document.getElementById('idProofInput');
    var dt = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;
    showIdPreview(file);
});

// ── Prevent double-submit ──
document.getElementById('profileForm').addEventListener('submit', function(){
    var btn = document.getElementById('profileSubmitBtn');
    btn.disabled = true;
    btn.textContent = 'Saving…';
});
</script>
