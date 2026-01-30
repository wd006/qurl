<div class="page-content">

    <div class="faq-page__category">
        <h3>🚀 General Questions</h3>

        <details class="accordion__item">
            <summary class="accordion__summary">Is this service completely free?</summary>
            <div class="accordion__content">
                <p>Yes, <?= CONFIG['name'] ?> is 100% free to use. There are no hidden fees, subscriptions, or premium tiers for our core URL shortening features.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">Do I need to create an account?</summary>
            <div class="accordion__content">
                <p>No. We believe in speed and privacy. You can start shortening links immediately without any registration or login process.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">Do my shortened links expire?</summary>
            <div class="accordion__content">
                <p>Our goal is to keep links active indefinitely. However, we reserve the right to remove links that have not been accessed for an extended period (e.g., 12 months) or links that violate our <a href="/terms">Terms of Service</a>.</p>
            </div>
        </details>
    </div>

    <div class="faq-page__category">
        <h3>✨ Features & Usage</h3>

        <details class="accordion__item">
            <summary class="accordion__summary">Can I customize my short link?</summary>
            <div class="accordion__content">
                <p>Yes! You can choose a custom alias (e.g., <code><?= CONFIG['domain'] ?>/my-brand</code>) instead of a random string. This is subject to availability.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">Can I password-protect my links?</summary>
            <div class="accordion__content">
                <p>Absolutely. You can set a password for any link you create. Users will be required to enter this password before they are redirected to the destination URL.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">What is the "Info Page" feature?</summary>
            <div class="accordion__content">
                <p>This is a transparency feature. If enabled, users will see an intermediate page containing your custom note and the destination URL before being redirected. This helps build trust by showing users exactly where they are going.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">Can I edit or delete a link later?</summary>
            <div class="accordion__content">
                <p>Since we do not have user accounts, you cannot currently edit or delete a link once it is created. Please double-check your long URL before shortening. If you need a link removed for legal reasons, please contact us.</p>
            </div>
        </details>
    </div>

    <div class="faq-page__category">
        <h3>🛡️ Security & Technical</h3>

        <details class="accordion__item">
            <summary class="accordion__summary">Is <?= CONFIG['name'] ?> safe to use?</summary>
            <div class="accordion__content">
                <p>Yes. We use industry-standard encryption (HTTPS) for all connections. We also use Cloudflare Turnstile to prevent bot abuse and regularly check links against global blocklists to prevent malware distribution.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">Do you offer an API for developers?</summary>
            <div class="accordion__content">
                <p>Yes, we have a public API endpoint. Developers can programmatically shorten URLs using our API. Please check our documentation or GitHub repository for integration details.</p>
            </div>
        </details>

        <details class="accordion__item">
            <summary class="accordion__summary">Why do I see a CAPTCHA?</summary>
            <div class="accordion__content">
                <p>To ensure the stability of our service and protect against automated spam attacks, we use a privacy-friendly CAPTCHA challenge (Cloudflare Turnstile). It usually verifies you automatically without requiring any interaction.</p>
            </div>
        </details>
    </div>
</div>