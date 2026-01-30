<!-- 1. Encryption Setting -->
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

<!-- 2. Manage Link Setting -->
<div class="setting-card">
    <label class="checkbox-label">
        <input type="checkbox" name="admin[enabled]" value="true">
        <span class="checkbox-custom"></span>
        <span>Enable Link Management</span>
    </label>
    <div class="mt-2">
        <input type="password" name="admin[password]" placeholder="Set password for manage..." class="setting-input">
    </div>
</div>

<!-- 3. Password Protection Setting -->
<div class="setting-card">
    <label class="checkbox-label">
        <input type="checkbox" name="protection[enabled]" value="true">
        <span class="checkbox-custom"></span>
        <span>Password Protect Link</span>
    </label>
    <div class="mt-2">
        <input type="password" name="protection[password]" placeholder="Set password for link..." class="setting-input">
    </div>
</div>

<!-- 4. Info Page / Preview Setting -->
<div class="setting-card">
    <label class="checkbox-label">
        <input type="checkbox" name="preview[enabled]" value="true">
        <span class="checkbox-custom"></span>
        <span>Show Info Before Redirect</span>
    </label>
    <div class="mt-2">
        <input type="text" name="preview[note]" placeholder="Message to visitor..." maxlength="150" class="setting-input">
        <p class="text-warning">Only letters and numbers allowed.</p>
    </div>
</div>