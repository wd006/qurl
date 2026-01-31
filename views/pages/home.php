<form id="shortenForm" method="post" action="/api/v1/shorten" class="url-form">

    <div class="settings-dropdown">
        <details class="settings-dropdown__wrapper">
            <summary class="settings-dropdown__trigger">Advanced Settings</summary>
            <div class="settings-popup">
                <?php require ROOTDIR . '/views/partials/advanced-settings.php'; ?>
            </div>
        </details>
    </div>

    <div class="form-group">
        <label class="form-label">Long URL:</label>
        <div class="input-group">
            <span class="input-group__prefix" id="protocol-display">https://</span>
            <input type="text" name="long_url" class="input-group__field" placeholder="example.com/very/long-url">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Customize Link:</label>
        <div class="input-group">
            <select name="domain_id" id="domain_selector" class="input-group__select">
                <?php foreach ($domain_list as $domain) : ?>
                    <option value="<?= $domain['id'] ?>" <?= ($domain['id'] === $domain_default['id']) ? 'selected' : '' ?>>
                        <?= $domain['name'] ?>/
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="custom_alias" class="input-group__field" placeholder="custom-alias (optional)">
        </div>
    </div>

    <div class="captcha-container">
        <div class="cf-turnstile" data-sitekey="<?= $_ENV['TURNSTILE_SITE_KEY'] ?>" data-theme="dark"></div>
    </div>

    <button type="submit" id="submitBtn" class="btn-primary">
        <span class="btn-text">Shorten</span>
        <span class="loading-spinner hidden"></span>
    </button>

</form>