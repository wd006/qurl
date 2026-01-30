<form method="post" action="/api/v1/shorten">

    <div class="advanced-settings">
        <details>
            <summary>Advanced Settings</summary>
            <div>
                <?php // require ROOTDIR . '/views/partials/advanced-settings.php'; // soon ?>
            </div>
        </details>
    </div>

    <div class="form-group">
        <p>Long URL:</p>
        <div class="input-group">
            <span class="input-group-text" id="protocol-display">https://</span>
            <input type="text" name="long_url" class="input-group-input" placeholder="example.com/very/long-url" required>
        </div>
    </div>
    <br>
    <div class="form-group">
        <p>Customize Link:</p>
        <div class="input-group">
            <select name="domain_id" id="domain_selector" class="input-group-domain">
                <?php foreach ($domain_list as $domain) : ?>
                    <option value="<?= $domain['id'] ?>" <?= ($domain['id'] === $domain_default['id']) ? 'selected' : '' ?>>
                        <?= $domain['name'] ?>/
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="custom_shortname" class="input-group-shortname" placeholder="custom-shortname (optional)">
        </div>
    </div>
    <div class="setting-item" style="display: flex; justify-content: center; background: none; border: none;">
        <div class="cf-turnstile" data-sitekey="<?= $_ENV['TURNSTILE_SITE_KEY'] ?>" data-theme="dark"></div>
    </div>
    <button type="submit" class="button">Shorten</button>
</form>