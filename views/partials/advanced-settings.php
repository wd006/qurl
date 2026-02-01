<div class="setting-card setting-card--highlight">
    <div class="setting-card__header">
        <span class="setting-card__title">Encryption</span>
        <span class="setting-card__subtitle">Secure Redirect (SSL)</span>
    </div>
    <div class="switch-wrapper">
        <span class="switch-label">http</span>
        <label class="toggle-switch">
            <input type="checkbox" id="protocolToggle" name="settings[use_https]" checked>
            <span class="toggle-slider"></span>
        </label>
        <span class="switch-label active">https</span>
    </div>
</div>

<div class="setting-card">
    <label class="checkbox-label">
        <input type="checkbox" name="admin[enabled]">
        <span class="checkbox-custom"></span>
        <span>Management Dashboard</span>
        <?= tooltip('Allows you to track clicks, edit or delete this link later. Requires a password.') ?>
    </label>
    <div class="mt-2">
        <input type="password" name="admin[password]" placeholder="Create an admin password..." class="setting-input">
    </div>
</div>

<div class="setting-card">
    <label class="checkbox-label">
        <input type="checkbox" name="protection[enabled]">
        <span class="checkbox-custom"></span>
        <span>Password Protect Link</span>
        <?= tooltip('Visitors must enter this password to access the destination URL.') ?>
    </label>
    <div class="mt-2">
        <input type="password" name="protection[password]" placeholder="Set access password..." class="setting-input">
    </div>
</div>

<div class="setting-card">
    <label class="checkbox-label">
        <input type="checkbox" name="preview[enabled]">
        <span class="checkbox-custom"></span>
        <span>Preview Mode</span>
        <?= tooltip('Displays the destination URL and your note to the visitors before redirecting them.') ?>
    </label>
    <div class="mt-2">
        <input type="text" name="preview[note]" placeholder="Message to visitor (optional)..." maxlength="150" class="setting-input">
        <p class="text-warning">Only letters and numbers allowed.</p>
    </div>
</div>