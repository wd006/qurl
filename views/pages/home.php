<form method="post" action="/api/v1/shorten" class="url-form">

    <!-- Advanced Settings Dropdown -->
    <div class="settings-dropdown">
        <details class="settings-dropdown__wrapper">
            <summary class="settings-dropdown__trigger">Advanced Settings</summary>
            <div class="settings-popup">
                <?php require ROOTDIR . '/views/partials/advanced-settings.php'; ?>
            </div>
        </details>
    </div>

    <!-- Long URL Input -->
    <div class="form-group">
        <label class="form-label">Long URL:</label>
        <div class="input-group">
            <span class="input-group__prefix" id="protocol-display">https://</span>
            <input type="text" name="long_url" class="input-group__field" placeholder="example.com/very/long-url" required>
        </div>
    </div>

    <!-- Customize Link Input -->
    <div class="form-group">
        <label class="form-label">Customize Link:</label>
        <div class="input-group">
            <!-- Domain Selector -->
            <select name="domain_id" id="domain_selector" class="input-group__select">
                <?php foreach ($domain_list as $domain) : ?>
                    <option value="<?= $domain['id'] ?>" <?= ($domain['id'] === $domain_default['id']) ? 'selected' : '' ?>>
                        <?= $domain['name'] ?>/
                    </option>
                <?php endforeach; ?>
            </select>
            <!-- Custom Alias Input -->
            <input type="text" name="custom_shortname" class="input-group__field" placeholder="custom-shortname (optional)">
        </div>
    </div>

    <!-- Captcha -->
    <div class="captcha-container">
        <div class="cf-turnstile" data-sitekey="<?= $_ENV['TURNSTILE_SITE_KEY'] ?>" data-theme="dark"></div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-primary">Shorten</button>

</form>