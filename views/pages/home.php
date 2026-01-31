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

<template id="swal-success-template">
    <div class="swal-content-wrapper">
        <div class="link-label"> </div>
        
        <div class="link-result-wrapper">
            <input type="text" class="link-input js-short-url" readonly>
            <button class="copy-btn js-copy-btn" title="Copy">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
            </button>
        </div>

        <div class="tip-container js-tip-section" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tip-icon">
                <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-1 1.5-2 1.5-3.5a6 6 0 0 0-6-6 6 6 0 0 0-6 6c0 1.5.5 2.5 1.5 3.5.8.8 1.3 1.5 1.5 2.5"></path>
                <line x1="9" y1="18" x2="15" y2="18"></line>
                <line x1="10" y1="22" x2="14" y2="22"></line>
            </svg>
            
            <span class="tip-text">
                <strong class="text-white">Tip: </strong>To manage the link and view statistics, add a "+" to the end of the short link.<br>
                <a href="#" target="_blank" class="js-manage-link" style="color:#60a5fa; text-decoration:none;"></a>
            </span>
        </div>
    </div>
</template>